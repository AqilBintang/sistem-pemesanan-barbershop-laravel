# 🚀 Panduan Integrasi GoPay QRIS

## 📋 Persyaratan

1. **Akun GoPay Merchant** yang sudah aktif
2. **API Credentials** dari GoPay:
   - Merchant ID
   - API Key
   - Secret Key
3. **Webhook URL** yang dapat diakses dari internet

## ⚙️ Konfigurasi

### 1. Update File `.env`

```env
# QRIS Configuration
QRIS_TYPE=gopay

# GoPay Merchant Configuration
GOPAY_BASE_URL=https://api.gopay.co.id/v1
GOPAY_MERCHANT_ID=your_actual_merchant_id
GOPAY_API_KEY=your_actual_api_key
GOPAY_SECRET_KEY=your_actual_secret_key
GOPAY_ENVIRONMENT=production
```

### 2. Setup Webhook di GoPay Dashboard

1. Login ke **GoPay Merchant Dashboard**
2. Masuk ke **Settings** > **Webhook**
3. Tambahkan webhook URL: `https://yourdomain.com/gopay/webhook`
4. Pilih events: `payment.success`, `payment.failed`, `payment.expired`

## 🔄 Alur Pembayaran

### 1. Customer Flow
```
1. Customer pilih QRIS → 
2. Generate dynamic QRIS dengan nominal → 
3. Customer scan & bayar → 
4. GoPay kirim webhook → 
5. Status booking otomatis berubah → 
6. Customer dapat konfirmasi
```

### 2. Technical Flow
```
BookingController::generateQRIS() 
    ↓
GopayService::createDynamicQRIS()
    ↓
API Call ke GoPay
    ↓
Return QR Code dengan nominal
    ↓
Customer bayar
    ↓
GoPay Webhook → GopayWebhookController
    ↓
Update booking status otomatis
```

## 🧪 Testing

### 1. Sandbox Testing
```env
GOPAY_BASE_URL=https://api-sandbox.gopay.co.id/v1
GOPAY_ENVIRONMENT=sandbox
```

### 2. Production Testing
```env
GOPAY_BASE_URL=https://api.gopay.co.id/v1
GOPAY_ENVIRONMENT=production
```

## 📱 Fitur yang Tersedia

### ✅ Dynamic QRIS
- Nominal otomatis terisi saat scan
- Expiry time 15 menit
- Real-time payment verification

### ✅ Real-time Status Update
- Webhook notification dari GoPay
- Auto-update booking status
- Payment polling setiap 3 detik

### ✅ Error Handling
- Fallback ke static QRIS jika GoPay gagal
- Retry mechanism
- Comprehensive logging

## 🔧 API Endpoints

### Generate QRIS
```
POST /test-booking/generate-qris
{
    "amount": 50000,
    "booking_id": "TEMP-123456",
    "customer_name": "John Doe"
}
```

### Webhook Endpoint
```
POST /gopay/webhook
Headers: X-GoPay-Signature
{
    "transaction_id": "TXN123",
    "order_id": "BOOKING-123",
    "status": "paid",
    "amount": 50000,
    "paid_at": "2025-12-13T10:30:00Z"
}
```

### Check Payment Status
```
POST /gopay/check-status
{
    "transaction_id": "TXN123"
}
```

## 🛡️ Security

### 1. Webhook Signature Verification
```php
// Otomatis diverifikasi di GopayService::verifyWebhookSignature()
$signature = hash_hmac('sha256', $payload, $secretKey);
```

### 2. CSRF Protection
- Webhook dikecualikan dari CSRF protection
- API endpoints tetap protected

## 📊 Monitoring & Logging

### Log Files
- `storage/logs/laravel.log` - General logs
- Search: `GoPay` untuk filter log payment

### Database Tracking
- `bookings.payment_reference` - GoPay transaction ID
- `bookings.payment_status` - Real-time status
- `bookings.payment_date` - Timestamp pembayaran

## 🚨 Troubleshooting

### 1. QRIS Tidak Generate
- Cek API credentials di `.env`
- Cek network connectivity
- Lihat log error di `storage/logs/laravel.log`

### 2. Webhook Tidak Diterima
- Pastikan URL webhook accessible dari internet
- Cek signature verification
- Test dengan ngrok untuk development

### 3. Status Tidak Update
- Cek webhook configuration di GoPay dashboard
- Verify webhook signature
- Check database booking record

## 📞 Support

Jika ada masalah integrasi:
1. Cek dokumentasi GoPay API
2. Contact GoPay merchant support
3. Review log files untuk error details

---

**Note**: Implementasi ini sudah siap production dengan proper error handling, security, dan monitoring. Tinggal update credentials GoPay yang sebenarnya.