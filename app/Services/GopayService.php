<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GopayService
{
    private $baseUrl;
    private $merchantId;
    private $apiKey;
    private $secretKey;

    public function __construct()
    {
        $this->baseUrl = config('services.gopay.base_url');
        $this->merchantId = config('services.gopay.merchant_id');
        $this->apiKey = config('services.gopay.api_key');
        $this->secretKey = config('services.gopay.secret_key');
    }

    /**
     * Generate dynamic QRIS dengan nominal otomatis
     */
    public function createDynamicQRIS($amount, $bookingId, $customerName = null)
    {
        try {
            $payload = [
                'merchant_id' => $this->merchantId,
                'amount' => $amount,
                'order_id' => 'BOOKING-' . $bookingId,
                'description' => 'Pembayaran booking Sisbar Hairstudio',
                'customer_name' => $customerName,
                'callback_url' => route('gopay.webhook'),
                'expired_time' => now()->addMinutes(15)->toISOString()
            ];

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . '/qris/create', $payload);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'qr_code_url' => $data['qr_code_url'] ?? null,
                    'qr_string' => $data['qr_string'] ?? null,
                    'payment_reference' => $data['transaction_id'] ?? 'GOPAY-' . time(),
                    'amount' => $amount,
                    'expires_at' => now()->addMinutes(15),
                    'status' => 'pending'
                ];
            }

            Log::error('GoPay QRIS Creation Failed', [
                'response' => $response->body(),
                'status' => $response->status()
            ]);

            return [
                'success' => false,
                'message' => 'Gagal membuat QRIS GoPay'
            ];

        } catch (\Exception $e) {
            Log::error('GoPay Service Error', [
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
     * Verify payment status
     */
    public function checkPaymentStatus($transactionId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ])->get($this->baseUrl . '/transaction/' . $transactionId);

            if ($response->successful()) {
                $data = $response->json();
                
                return [
                    'success' => true,
                    'status' => $data['status'] ?? 'pending', // pending, paid, failed, expired
                    'paid_at' => $data['paid_at'] ?? null,
                    'amount' => $data['amount'] ?? 0,
                    'reference' => $data['reference'] ?? null
                ];
            }

            return [
                'success' => false,
                'message' => 'Gagal mengecek status pembayaran'
            ];

        } catch (\Exception $e) {
            Log::error('GoPay Status Check Error', [
                'message' => $e->getMessage(),
                'transaction_id' => $transactionId
            ]);

            return [
                'success' => false,
                'message' => 'Terjadi kesalahan saat mengecek status'
            ];
        }
    }

    /**
     * Handle webhook notification dari GoPay
     */
    public function handleWebhook($payload)
    {
        try {
            // Verify webhook signature (implementasi sesuai dokumentasi GoPay)
            if (!$this->verifyWebhookSignature($payload)) {
                Log::warning('Invalid GoPay webhook signature');
                return false;
            }

            $transactionId = $payload['transaction_id'] ?? null;
            $status = $payload['status'] ?? null;
            $orderId = $payload['order_id'] ?? null;

            if (!$transactionId || !$status || !$orderId) {
                Log::warning('Incomplete GoPay webhook data', $payload);
                return false;
            }

            // Extract booking ID from order_id (format: BOOKING-{id})
            $bookingId = str_replace('BOOKING-', '', $orderId);

            // Update booking status
            $booking = \App\Models\Booking::find($bookingId);
            if (!$booking) {
                Log::warning('Booking not found for GoPay webhook', ['booking_id' => $bookingId]);
                return false;
            }

            // Update payment status based on GoPay response
            switch ($status) {
                case 'paid':
                case 'settlement':
                    $booking->update([
                        'payment_status' => 'paid',
                        'payment_date' => now(),
                        'status' => 'confirmed'
                    ]);
                    
                    // Send notification to customer (optional)
                    // $this->sendPaymentConfirmation($booking);
                    break;

                case 'failed':
                case 'expired':
                    $booking->update([
                        'payment_status' => 'failed'
                    ]);
                    break;
            }

            Log::info('GoPay webhook processed successfully', [
                'booking_id' => $bookingId,
                'status' => $status,
                'transaction_id' => $transactionId
            ]);

            return true;

        } catch (\Exception $e) {
            Log::error('GoPay Webhook Error', [
                'message' => $e->getMessage(),
                'payload' => $payload
            ]);

            return false;
        }
    }

    /**
     * Verify webhook signature
     */
    private function verifyWebhookSignature($payload)
    {
        // Implementasi verifikasi signature sesuai dokumentasi GoPay
        // Biasanya menggunakan HMAC SHA256 dengan secret key
        
        $signature = request()->header('X-GoPay-Signature');
        if (!$signature) {
            return false;
        }

        $expectedSignature = hash_hmac('sha256', json_encode($payload), $this->secretKey);
        
        return hash_equals($expectedSignature, $signature);
    }

    /**
     * Cancel payment
     */
    public function cancelPayment($transactionId)
    {
        try {
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $this->apiKey,
                'Content-Type' => 'application/json'
            ])->post($this->baseUrl . '/transaction/' . $transactionId . '/cancel');

            return $response->successful();

        } catch (\Exception $e) {
            Log::error('GoPay Cancel Payment Error', [
                'message' => $e->getMessage(),
                'transaction_id' => $transactionId
            ]);

            return false;
        }
    }
}