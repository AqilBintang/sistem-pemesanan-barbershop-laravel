# 🤝 Panduan Kolaborasi Tim - Pangling Barbershop

## 🚀 Quick Start untuk Developer Baru

### 1. Setup Project
```bash
git clone https://github.com/AqilBintang/sistem-pemesanan-barbershop-laravel.git
cd sistem-pemesanan-barbershop-laravel
composer install
npm install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

### 2. Workflow Harian
```bash
# Selalu mulai dengan update terbaru
git checkout main
git pull origin main

# Buat branch untuk fitur baru
git checkout -b feature/nama-fitur

# Setelah selesai coding
git add .
git commit -m "feat: deskripsi singkat"
git push origin feature/nama-fitur

# Buat Pull Request di GitHub
```

## 📋 Pembagian Tugas

### 👤 Developer Assignments
- **Authentication**: Login, Register, Password Reset
- **Booking System**: Reservasi, Calendar, Notifications
- **Payment**: Integration, History, Invoices
- **Admin Panel**: Dashboard, Reports, User Management
- **Frontend**: UI/UX Improvements, Responsive Design

### 📁 File Structure
```
app/
├── Http/Controllers/
│   ├── Auth/           # Authentication (Dev A)
│   ├── Admin/          # Admin Panel (Dev D)
│   ├── BookingController.php  # Booking (Dev B)
│   └── PaymentController.php  # Payment (Dev C)
resources/views/
├── auth/               # Auth views (Dev A)
├── admin/              # Admin views (Dev D)
├── users/              # User views (Dev B & C)
└── layouts/            # Shared layouts (Team Lead)
```

## 🚫 Aturan Penting

### ❌ JANGAN:
- Push langsung ke branch `main`
- Edit file yang sama secara bersamaan
- Commit tanpa pesan yang jelas
- Merge tanpa review

### ✅ LAKUKAN:
- Selalu buat branch baru untuk fitur
- Pull request untuk semua perubahan
- Code review sebelum merge
- Test sebelum push

## 🔄 Git Commands Penting

```bash
# Update branch main
git checkout main && git pull origin main

# Buat branch baru
git checkout -b feature/nama-fitur

# Lihat status
git status

# Commit dengan pesan yang baik
git commit -m "feat: add user authentication"
git commit -m "fix: resolve navbar responsive issue"
git commit -m "docs: update API documentation"

# Push branch
git push origin feature/nama-fitur

# Merge main ke branch (jika ada konflik)
git checkout feature/nama-fitur
git merge main
```

## 🐛 Mengatasi Konflik

### Jika ada konflik saat merge:
1. `git status` - lihat file yang konflik
2. Edit file, hapus marker `<<<<<<<`, `=======`, `>>>>>>>`
3. `git add .` - tambahkan file yang sudah diperbaiki
4. `git commit -m "resolve: merge conflict"`
5. `git push origin feature/nama-fitur`

## 📞 Komunikasi

### 💬 Channels:
- **GitHub Issues**: Bug reports, feature requests
- **Pull Request Comments**: Code review
- **WhatsApp Group**: Quick questions
- **Weekly Meeting**: Progress update

### 📝 Commit Message Format:
- `feat:` - fitur baru
- `fix:` - bug fix
- `docs:` - dokumentasi
- `style:` - formatting
- `refactor:` - code refactoring
- `test:` - testing

## 🎯 Definition of Done

Sebuah fitur dianggap selesai jika:
- [ ] Code berfungsi dengan baik
- [ ] Responsive di mobile & desktop
- [ ] Tidak ada error di console
- [ ] Code sudah di-review
- [ ] Documentation updated
- [ ] Tested manually

## 🆘 Need Help?

1. Check existing issues di GitHub
2. Tanya di WhatsApp group
3. Create new issue dengan label `question`
4. Contact team lead: @AqilBintang