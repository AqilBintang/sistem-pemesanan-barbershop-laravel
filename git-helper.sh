#!/bin/bash

# Colors for better output
RED='\033[0;31m'
GREEN='\033[0;32m'
YELLOW='\033[1;33m'
BLUE='\033[0;34m'
NC='\033[0m' # No Color

echo "========================================"
echo "   PANGLING BARBERSHOP - GIT HELPER"
echo "========================================"
echo

show_menu() {
    echo "Pilih aksi yang ingin dilakukan:"
    echo
    echo "1. Pull perubahan terbaru (Mulai kerja)"
    echo "2. Push perubahan saya (Selesai kerja)"
    echo "3. Cek status repository"
    echo "4. Lihat log commit terbaru"
    echo "5. Setup awal untuk teman baru"
    echo "6. Emergency: Backup dan reset"
    echo "7. Keluar"
    echo
}

pull_latest() {
    echo
    echo -e "${BLUE}[1] Pulling perubahan terbaru...${NC}"
    git pull origin sistem-pemesanan-barbershop-laravel
    echo
    echo -e "${GREEN}✅ Selesai! Anda bisa mulai bekerja.${NC}"
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

push_changes() {
    echo
    echo -e "${BLUE}[2] Mempersiapkan push perubahan...${NC}"
    echo
    echo "Perubahan yang akan di-commit:"
    git status --short
    echo
    read -p "Masukkan pesan commit: " commit_msg
    
    if [ -z "$commit_msg" ]; then
        echo -e "${RED}❌ Pesan commit tidak boleh kosong!${NC}"
        read -p "Tekan Enter untuk melanjutkan..."
        return
    fi

    echo
    echo "Adding files..."
    git add .

    echo "Committing changes..."
    git commit -m "$commit_msg"

    echo "Pulling latest changes..."
    git pull origin sistem-pemesanan-barbershop-laravel

    echo "Pushing to GitHub..."
    git push origin sistem-pemesanan-barbershop-laravel

    echo
    echo -e "${GREEN}✅ Perubahan berhasil di-push!${NC}"
    echo -e "${YELLOW}💬 Jangan lupa beritahu teman bahwa Anda sudah push.${NC}"
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

check_status() {
    echo
    echo -e "${BLUE}[3] Status repository:${NC}"
    echo
    echo "Current branch:"
    git branch --show-current
    echo
    echo "Status:"
    git status
    echo
    echo "Remote info:"
    git remote -v
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

show_log() {
    echo
    echo -e "${BLUE}[4] 10 commit terakhir:${NC}"
    echo
    git log --oneline -10 --graph
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

setup_friend() {
    echo
    echo -e "${BLUE}[5] Setup untuk teman baru:${NC}"
    echo
    echo "Pastikan teman Anda sudah:"
    echo "1. Clone repository: git clone [URL]"
    echo "2. Install composer: composer install"
    echo "3. Install npm: npm install"
    echo "4. Copy .env: cp .env.example .env"
    echo "5. Generate key: php artisan key:generate"
    echo "6. Set git config:"
    echo "   git config user.name \"Nama Teman\""
    echo "   git config user.email \"email@teman.com\""
    echo "7. Checkout branch: git checkout sistem-pemesanan-barbershop-laravel"
    echo
    read -p "Apakah teman sudah melakukan semua langkah di atas? (y/n): " ready
    
    if [[ $ready =~ ^[Yy]$ ]]; then
        echo
        echo -e "${GREEN}✅ Bagus! Sekarang teman bisa mulai kolaborasi.${NC}"
        echo -e "${YELLOW}📋 Berikan file UNTUK-TEMAN-ANDA.md kepada teman.${NC}"
    else
        echo
        echo -e "${YELLOW}⚠️  Pastikan teman menyelesaikan setup dulu.${NC}"
    fi
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

emergency() {
    echo
    echo -e "${RED}[6] 🆘 EMERGENCY BACKUP DAN RESET${NC}"
    echo
    echo -e "${YELLOW}⚠️  PERINGATAN: Ini akan menyimpan perubahan Anda dan reset ke kondisi aman.${NC}"
    echo
    read -p "Apakah Anda yakin? (y/n): " confirm
    
    if [[ $confirm =~ ^[Yy]$ ]]; then
        echo
        echo "Backing up changes..."
        git stash push -m "Emergency backup $(date)"
        
        echo "Resetting to safe state..."
        git reset --hard origin/sistem-pemesanan-barbershop-laravel
        
        echo
        echo -e "${GREEN}✅ Reset selesai!${NC}"
        echo -e "${BLUE}💾 Perubahan Anda disimpan di stash.${NC}"
        echo -e "${YELLOW}🔄 Untuk mengembalikan: git stash pop${NC}"
    else
        echo
        echo -e "${RED}❌ Emergency dibatalkan.${NC}"
    fi
    echo
    read -p "Tekan Enter untuk melanjutkan..."
}

# Main loop
while true; do
    show_menu
    read -p "Masukkan pilihan (1-7): " choice
    
    case $choice in
        1) pull_latest ;;
        2) push_changes ;;
        3) check_status ;;
        4) show_log ;;
        5) setup_friend ;;
        6) emergency ;;
        7) 
            echo
            echo -e "${GREEN}👋 Terima kasih! Selamat coding!${NC}"
            echo
            exit 0
            ;;
        *)
            echo -e "${RED}❌ Pilihan tidak valid!${NC}"
            read -p "Tekan Enter untuk melanjutkan..."
            ;;
    esac
done