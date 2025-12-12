<?php

namespace App\Services;

class QRISService
{
    /**
     * Generate QRIS payment code (real implementation)
     */
    public static function generatePaymentCode($amount, $bookingId, $customerName = null)
    {
        $qrisType = config('app.qris_type', 'static'); // static, dynamic, gopay
        
        switch ($qrisType) {
            case 'gopay':
                return self::generateGopayQRIS($amount, $bookingId, $customerName);
            case 'midtrans':
                return self::generateMidtransQRIS($amount, $bookingId, $customerName);
            case 'static':
                return self::generateStaticQRIS($amount, $bookingId);
            case 'dynamic':
                return self::generateDynamicQRIS($amount, $bookingId);
            default:
                return self::generateStaticQRIS($amount, $bookingId);
        }
    }

    /**
     * Generate GoPay dynamic QRIS
     */
    private static function generateGopayQRIS($amount, $bookingId, $customerName = null)
    {
        $gopayService = new \App\Services\GopayService();
        $result = $gopayService->createDynamicQRIS($amount, $bookingId, $customerName);
        
        if ($result['success']) {
            return [
                'qr_code' => $result['qr_string'] ?? $result['qr_code_url'],
                'qr_code_url' => $result['qr_code_url'],
                'payment_reference' => $result['payment_reference'],
                'amount' => $amount,
                'expires_at' => $result['expires_at'],
                'status' => 'pending',
                'type' => 'gopay_dynamic'
            ];
        }
        
        // Fallback to static if GoPay fails
        \Log::warning('GoPay QRIS failed, falling back to static');
        return self::generateStaticQRIS($amount, $bookingId);
    }

    /**
     * Generate Midtrans QRIS
     */
    private static function generateMidtransQRIS($amount, $bookingId, $customerName = null)
    {
        $midtransService = new \App\Services\MidtransService();
        $result = $midtransService->createQRISPayment($amount, $bookingId, $customerName);
        
        if ($result['success']) {
            return [
                'qr_code' => $result['qr_string'],
                'payment_reference' => $result['transaction_id'],
                'order_id' => $result['order_id'],
                'amount' => $amount,
                'expires_at' => $result['expires_at'],
                'status' => 'pending',
                'type' => 'midtrans_qris'
            ];
        }
        
        // Fallback to static if Midtrans fails
        \Log::warning('Midtrans QRIS failed, falling back to static');
        return self::generateStaticQRIS($amount, $bookingId);
    }

    /**
     * Generate static QRIS (menggunakan QRIS tetap Anda)
     */
    private static function generateStaticQRIS($amount, $bookingId)
    {
        return [
            'qr_code' => config('app.qris_static_data', 'default-qris-data'),
            'payment_reference' => 'QRIS-STATIC-' . time() . '-' . $bookingId,
            'amount' => $amount,
            'expires_at' => now()->addMinutes(30), // Static QRIS tidak expire
            'status' => 'pending',
            'type' => 'static',
            'instructions' => 'Scan QR Code dan masukkan nominal: Rp ' . number_format($amount, 0, ',', '.')
        ];
    }

    /**
     * Generate dynamic QRIS (dengan nominal otomatis)
     */
    private static function generateDynamicQRIS($amount, $bookingId)
    {
        // Untuk dynamic QRIS, Anda perlu API dari bank atau payment gateway
        // Contoh implementasi dengan Midtrans, Xendit, dll
        
        return [
            'qr_code' => self::generateQRCode($amount, $bookingId),
            'payment_reference' => 'QRIS-DYN-' . time() . '-' . $bookingId,
            'amount' => $amount,
            'expires_at' => now()->addMinutes(15),
            'status' => 'pending',
            'type' => 'dynamic'
        ];
    }

    /**
     * Generate gateway QRIS (menggunakan payment gateway)
     */
    private static function generateGatewayQRIS($amount, $bookingId)
    {
        // Implementasi dengan payment gateway seperti Midtrans
        // return MidtransService::createQRISPayment($amount, $bookingId);
        
        return self::generateStaticQRIS($amount, $bookingId);
    }

    /**
     * Generate QR Code data (simulation)
     */
    private static function generateQRCode($amount, $bookingId)
    {
        // In real implementation, this would generate actual QRIS QR code
        // For now, we'll return a placeholder QR code data
        
        $qrData = [
            'merchant_id' => 'SISBAR001',
            'merchant_name' => 'Sisbar Hairstudio',
            'amount' => $amount,
            'reference' => 'BOOKING-' . $bookingId,
            'timestamp' => time()
        ];

        return base64_encode(json_encode($qrData));
    }

    /**
     * Verify payment status (simulation)
     */
    public static function verifyPayment($paymentReference)
    {
        // This is a simulation - in real implementation you would:
        // 1. Call payment gateway API to check payment status
        // 2. Verify webhook notifications
        // 3. Handle payment confirmations
        
        // For demo purposes, we'll simulate successful payment after 30 seconds
        $createdTime = substr($paymentReference, 5, 10); // Extract timestamp
        $currentTime = time();
        
        if (($currentTime - $createdTime) > 30) {
            return [
                'status' => 'paid',
                'paid_at' => now(),
                'payment_method' => 'qris',
                'reference' => $paymentReference
            ];
        }

        return [
            'status' => 'pending',
            'paid_at' => null,
            'payment_method' => 'qris',
            'reference' => $paymentReference
        ];
    }

    /**
     * Generate QR Code image URL
     */
    public static function getQRCodeImageUrl($qrData, $qrCodeUrl = null)
    {
        $qrisType = config('app.qris_type', 'static');
        
        switch ($qrisType) {
            case 'gopay':
                // Gunakan URL QR code dari GoPay jika tersedia
                if ($qrCodeUrl) {
                    return $qrCodeUrl;
                }
                // Fallback: generate dari string QRIS
                $data = urlencode($qrData);
                return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$data}";
                
            case 'midtrans':
                // Generate QR code dari string QRIS Midtrans
                $data = urlencode($qrData);
                return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$data}";
                
            case 'static':
                // Option 1: Gunakan gambar QRIS statis Anda
                $staticImagePath = config('app.qris_static_image_path');
                if ($staticImagePath && file_exists(public_path($staticImagePath))) {
                    return asset($staticImagePath);
                }
                
                // Option 2: Generate QR code dari string QRIS Anda
                $staticData = config('app.qris_static_data');
                if ($staticData) {
                    $data = urlencode($staticData);
                    return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$data}";
                }
                break;
                
            case 'dynamic':
                // Generate QR code dengan data dinamis
                $data = urlencode($qrData);
                return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$data}";
        }
        
        // Fallback: generate QR code
        $data = urlencode($qrData);
        return "https://api.qrserver.com/v1/create-qr-code/?size=250x250&data={$data}";
    }

    /**
     * Cancel payment (simulation)
     */
    public static function cancelPayment($paymentReference)
    {
        // In real implementation, you would call payment gateway API to cancel
        return [
            'status' => 'cancelled',
            'cancelled_at' => now(),
            'reference' => $paymentReference
        ];
    }
}