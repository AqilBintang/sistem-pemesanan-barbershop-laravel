# 💳 Panduan Lengkap Opsi Pembayaran QRIS

## 🎯 **Opsi yang Tersedia**

### 1. 🟢 **QRIS Statis (Paling Mudah - Tidak Perlu API)**
- Gunakan QRIS yang sudah Anda punya
- Customer scan manual, input nominal sendiri
- Tidak perlu registrasi merchant

### 2. 🔵 **Midtrans (Recommended - Mudah Daftar)**
- Dynamic QRIS dengan nominal otomatis
- Daftar mudah, tidak perlu toko fisik
- Support semua bank dan e-wallet

### 3. 🟡 **GoPay Merchant (Perlu Toko Fisik)**
- Dynamic QRIS khusus GoPay
- Perlu registrasi merchant dengan dokumen lengkap

---

## 🚀 **Opsi 1: QRIS Statis (Mulai Sekarang)**

### Setup:
```env
QRIS_TYPE=static
QRIS_STATIC_DATA="your_qris_string_here"
```

### Cara Dapat QRIS String:
1. Buka aplikasi bank/e-wallet Anda
2. Generate QRIS untuk menerima pembayaran
3. Screenshot QR Code
4. Gunakan QR reader online untuk dapat string QRIS
5. Masukkan ke `.env`

### Kelebihan:
- ✅ Bisa mulai sekarang juga
- ✅ Tidak perlu dokumen apapun
- ✅ Gratis

### Kekurangan:
- ❌ Customer harus input nominal manual
- ❌ Tidak ada notifikasi otomatis

---

## 🎯 **Opsi 2: Midtrans (Recommended)**

### Cara Daftar Midtrans:
1. **Kunjungi**: https://dashboard.midtrans.com/register
2. **Isi Data**:
   - Nama: "Sisbar Hairstudio"
   - Kategori: "Beauty & Personal Care"
   - Tipe: "Individual" (tidak perlu PT)
3. **Upload KTP** saja (tidak perlu SIUP/TDP)
4. **Verifikasi** biasanya 1-2 hari

### Setup:
```env
QRIS_TYPE=midtrans
MIDTRANS_SERVER_KEY=your_server_key
MIDTRANS_CLIENT_KEY=your_client_key
MIDTRANS_IS_PRODUCTION=false
```

### Webhook URL:
`https://yourdomain.com/midtrans/notification`

### Kelebihan:
- ✅ Dynamic QRIS (nominal otomatis)
- ✅ Support semua bank & e-wallet
- ✅ Real-time notification
- ✅ Mudah daftar
- ✅ Fee rendah (0.7%)

### Kekurangan:
- ❌ Perlu verifikasi KTP
- ❌ Ada fee transaksi

---

## 🏪 **Opsi 3: GoPay Merchant**

### Persyaratan:
- KTP
- NPWP (opsional)
- Foto tempat usaha
- Rekening bank

### Cara Daftar:
1. Download **GoPay Merchant App**
2. Pilih kategori **"Salon & Barbershop"**
3. Upload dokumen
4. Tunggu survey (untuk merchant besar)

### Setup:
```env
QRIS_TYPE=gopay
GOPAY_MERCHANT_ID=your_merchant_id
GOPAY_API_KEY=your_api_key
GOPAY_SECRET_KEY=your_secret_key
```

---

## 🛠️ **Implementasi Cepat - QRIS Statis**

Jika Anda ingin mulai sekarang dengan QRIS yang sudah ada:

### 1. Ambil QRIS String Anda:
```bash
# Scan QR Code Anda dengan tool online
# Atau gunakan aplikasi QR Scanner
```

### 2. Update .env:
```env
QRIS_TYPE=static
QRIS_STATIC_DATA="00020101021226670016COM.NOBUBANK.WWW01189360050300000898240214ID1234567890123303UME51440014ID.CO.QRIS.WWW0215ID20220000000015303360054031005802ID5913Sisbar Studio6007Jakarta61051234062070703A016304"
```

### 3. Test Langsung:
- Buka `/test-booking`
- Pilih QRIS payment
- QR Code akan muncul dengan QRIS Anda
- Customer scan dan input nominal manual

---

## 📊 **Perbandingan Opsi**

| Fitur | Static QRIS | Midtrans | GoPay |
|-------|-------------|----------|-------|
| **Setup Time** | 5 menit | 1-2 hari | 3-7 hari |
| **Dokumen** | Tidak perlu | KTP | KTP + NPWP + Foto |
| **Dynamic Amount** | ❌ | ✅ | ✅ |
| **Auto Notification** | ❌ | ✅ | ✅ |
| **Fee** | Gratis | 0.7% | 0.7% |
| **Support** | Manual | All Banks | GoPay Only |

---

## 🎯 **Rekomendasi**

### Untuk Testing Cepat:
**Gunakan QRIS Statis** - bisa mulai dalam 5 menit

### Untuk Production:
**Gunakan Midtrans** - balance antara kemudahan dan fitur

### Untuk GoPay Only:
**Gunakan GoPay Merchant** - jika customer mayoritas GoPay

---

## 🔧 **Setup Cepat QRIS Statis**

Mau coba sekarang? Berikan saya:
1. **Screenshot QRIS Anda**, atau
2. **String QRIS Anda**

Saya akan setup langsung untuk testing! 🚀