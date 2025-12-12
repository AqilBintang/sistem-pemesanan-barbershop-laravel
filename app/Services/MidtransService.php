<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class MidtransService
{
    private $serverKey;
    private $clientKey;
    private $isProduction;
    private $baseUrl;

    public function __construct()
    {
        $this->serverKey = config('services.midtrans.server_key');
        $this->clientKey = config('services.midtrans.client_key');
        $this->isProduction = config('services.midtrans.is_production', false);
        $this->baseUrl = $this->isProduction 
            ? 'https://api.midtrans.com/v2' 
            : 'https://api.sandbox.midtrans.com/v2';
    }

    /**
     * Create QRIS payment dengan Midtrans
     */
    public function createQRISPayment($amount, $bookingId, $customerName = null)
    {
        try {
            $orderId = 'BOOKING-' . $bookingId . '-' . time();
            
            $payload = [
                'payment_type' => 'qris',
                'transaction_details' => [
                    'order_id' => $orderId,
                    'gross_amount' => $amount
                ],
                'customer_details' => [
                    'first_name' => $customerName ?: 'Customer',
                    'email' => 'customer@sisbar.com'
                ],
                'item_details' => [
                    [
                        'id' => 'barbershop-service',
                        'price' => $amount,
                        'quantity' => 1,
                        'name' => 'Layanan Barbershop Sisbar'
                    ]
                ],
                'custom_expiry' => [
                    'expiry_duration' => 15,
                    'unit' => 'minute'
                ]
            ];

            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Content-Type' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':')
            ])->post($this->baseUrl . '/charge', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'qr_string' => $data['qr_string'] ?? null,
                    'transaction_id' => $data['transaction_id'] ?? null,
                    'order_id' => $orderId,
                    'amount' => $amount,
                    'expires_at' => now()->addMinutes(15),
                    'status' => 'pending'
                ];
            }

            Log::error('Midtrans QRIS Creation Failed', [
                'response' => $response->body(),
                'status' => $response->status()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal membuat QRIS Midtrans'
            ];

        } catch (\Exception $e) {
            Log::error('Midtrans Service Error', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat membuat QRIS'
            ];
        }
    }

    /**
     * Check payment status
     */
    public function checkPaymentStatus($orderId)
    {
        try {
            $response = Http::withHeaders([
                'Accept' => 'application/json',
                'Authorization' => 'Basic ' . base64_encode($this->serverKey . ':')
            ])->get($this->baseUrl . '/' . $orderId . '/status');

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'status' => $this->mapMidtransStatus($data['transaction_status'] ?? 'pending'),
                    'paid_at' => $data['settlement_time'] ?? null,
                    'amount' => $data['gross_amount'] ?? 0,
                    'reference' => $data['transaction_id'] ?? null
                ];
            }

            return [
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran'
            ];

        } catch (\Exception $e) {
            Log::error('Midtrans Status Check Error', [
                'message' => $e->getMessage(),
                'order_id' => $orderId
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengecek status'
            ];
        }
    }

    /**
     * Handle Midtrans notification
     */
    public function handleNotification($notification)
    {
        try {
            $orderId = $notification['order_id'] ?? null;
            $transactionStatus = $notification['transaction_status'] ?? null;
            $fraudStatus = $notification['fraud_status'] ?? null;

            if (!$orderId || !$transactionStatus) {
                Log::warning('Incomplete Midtrans notification', $notification);
                return false;
            }

            // Extract booking ID from order_id (format: BOOKING-{id}-{timestamp})
            $parts = explode('-', $orderId);
            if (count($parts) < 2) {
                Log::warning('Invalid order_id format', ['order_id' => $orderId]);
                return false;
            }
            
            $bookingId = $parts[1];

            // Find booking
            $booking = \App\Models\Booking::find($bookingId);
            if (!$booking) {
                Log::warning('Booking not found for Midtrans notification', ['booking_id' => $bookingId]);
                return false;
            }

            // Update payment status based on Midtrans response
            if ($transactionStatus == 'settlement' || $transactionStatus == 'capture') {
                if ($fraudStatus == 'accept' || $fraudStatus == null) {
                    $booking->update([
                        'payment_status' => 'paid',
                        'payment_date' => now(),
                        'status' => 'confirmed',
                        'payment_reference' => $notification['transaction_id'] ?? null
                    ]);
                }
            } elseif ($transactionStatus == 'pending') {
                $booking->update([
                    'payment_status' => 'pending'
                ]);
            } elseif (in_array($transactionStatus, ['deny', 'expire', 'cancel'])) {
                $booking->update([
                    'payment_status' => 'failed'
                ]);
            }

            Log::info('Midtrans notification processed', [
                'booking_id' => $bookingId,
                'status' => $transactionStatus,
                'order_id' => $orderId
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('Midtrans Notification Error', [
                'message' => $e->getMessage(),
                'notification' => $notification
            ]);

            return false;
        }
    }

    /**
     * Map Midtrans status to our system
     */
    private function mapMidtransStatus($midtransStatus)
    {
        return match($midtransStatus) {
            'settlement', 'capture' => 'paid',
            'pending' => 'pending',
            'deny', 'expire', 'cancel' => 'failed',
            default => 'pending'
        };
    }
}