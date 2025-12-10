<div class="pt-20 min-h-screen bg-background">
    <!-- Header -->
    <section class="bg-gradient-to-r from-black to-gray-800 text-white py-16">
        <div class="container mx-auto px-4">
            <div class="text-center">
                <h1 class="text-4xl md:text-5xl font-bold mb-4">Layanan Kami</h1>
                <p class="text-xl opacity-90 max-w-2xl mx-auto">
                    Pilih layanan terbaik sesuai kebutuhan Anda dengan kualitas profesional
                </p>
            </div>
        </div>
    </section>

    <!-- Services Grid -->
    <section class="py-16">
        <div class="container mx-auto px-4">
            <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
                <!-- Basic Haircut -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <span class="text-6xl">✂️</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Potong Rambut Basic</h3>
                        <p class="text-gray-600 mb-4">Potong rambut standar dengan gaya klasik dan modern</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 35.000</span>
                            <span class="text-sm text-gray-500">30 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Konsultasi gaya rambut</li>
                            <li>✓ Potong rambut profesional</li>
                            <li>✓ Styling dasar</li>
                        </ul>
                        <button data-select-service="basic-haircut" data-navigate="barbers" 
                                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            Pilih Layanan
                        </button>
                    </div>
                </div>

                <!-- Premium Haircut -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow border-2 border-accent">
                    <div class="bg-accent text-black text-center py-2 text-sm font-semibold">POPULER</div>
                    <div class="h-48 bg-gradient-to-br from-yellow-100 to-yellow-200 flex items-center justify-center">
                        <span class="text-6xl">💇‍♂️</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Potong Rambut Premium</h3>
                        <p class="text-gray-600 mb-4">Layanan lengkap dengan styling dan treatment rambut</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 55.000</span>
                            <span class="text-sm text-gray-500">45 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Konsultasi mendalam</li>
                            <li>✓ Potong rambut + styling</li>
                            <li>✓ Hair treatment</li>
                            <li>✓ Produk styling premium</li>
                        </ul>
                        <button data-select-service="premium-haircut" data-navigate="barbers"
                                class="w-full bg-accent text-black py-3 rounded-lg hover:bg-yellow-400 transition-colors font-semibold">
                            Pilih Layanan
                        </button>
                    </div>
                </div>

                <!-- Beard Trim -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-gray-100 to-gray-200 flex items-center justify-center">
                        <span class="text-6xl">🧔</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Cukur Jenggot</h3>
                        <p class="text-gray-600 mb-4">Perawatan jenggot profesional untuk tampilan rapi</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 25.000</span>
                            <span class="text-sm text-gray-500">20 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Trimming jenggot</li>
                            <li>✓ Shaping profesional</li>
                            <li>✓ Aftercare treatment</li>
                        </ul>
                        <button data-select-service="beard-trim" data-navigate="barbers"
                                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            Pilih Layanan
                        </button>
                    </div>
                </div>

                <!-- Complete Package -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-green-100 to-green-200 flex items-center justify-center">
                        <span class="text-6xl">💆‍♂️</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Paket Lengkap</h3>
                        <p class="text-gray-600 mb-4">Kombinasi potong rambut, cukur jenggot, dan treatment</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 75.000</span>
                            <span class="text-sm text-gray-500">60 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Potong rambut premium</li>
                            <li>✓ Cukur jenggot</li>
                            <li>✓ Creambath</li>
                            <li>✓ Facial treatment</li>
                        </ul>
                        <button data-select-service="complete-package" data-navigate="barbers"
                                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            Pilih Layanan
                        </button>
                    </div>
                </div>

                <!-- Hair Wash -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-blue-100 to-blue-200 flex items-center justify-center">
                        <span class="text-6xl">🚿</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Keramas + Creambath</h3>
                        <p class="text-gray-600 mb-4">Perawatan rambut dengan produk berkualitas tinggi</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 30.000</span>
                            <span class="text-sm text-gray-500">25 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Keramas dengan shampo premium</li>
                            <li>✓ Creambath treatment</li>
                            <li>✓ Pijat kepala relaksasi</li>
                        </ul>
                        <button data-select-service="hair-wash" data-navigate="barbers"
                                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            Pilih Layanan
                        </button>
                    </div>
                </div>

                <!-- Kids Haircut -->
                <div class="bg-white rounded-xl shadow-lg overflow-hidden hover:shadow-xl transition-shadow">
                    <div class="h-48 bg-gradient-to-br from-pink-100 to-pink-200 flex items-center justify-center">
                        <span class="text-6xl">👶</span>
                    </div>
                    <div class="p-6">
                        <h3 class="text-2xl font-bold mb-2">Potong Rambut Anak</h3>
                        <p class="text-gray-600 mb-4">Layanan khusus untuk anak-anak dengan pendekatan ramah</p>
                        <div class="flex justify-between items-center mb-4">
                            <span class="text-2xl font-bold text-accent">Rp 25.000</span>
                            <span class="text-sm text-gray-500">25 menit</span>
                        </div>
                        <ul class="text-sm text-gray-600 mb-6 space-y-1">
                            <li>✓ Barber berpengalaman dengan anak</li>
                            <li>✓ Suasana ramah dan nyaman</li>
                            <li>✓ Gaya rambut sesuai usia</li>
                        </ul>
                        <button data-select-service="kids-haircut" data-navigate="barbers"
                                class="w-full bg-black text-white py-3 rounded-lg hover:bg-gray-800 transition-colors">
                            Pilih Layanan
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Additional Info -->
    <section class="py-16 bg-gray-50">
        <div class="container mx-auto px-4">
            <div class="text-center mb-12">
                <h2 class="text-3xl font-bold mb-4">Informasi Tambahan</h2>
                <p class="text-gray-600 max-w-2xl mx-auto">
                    Semua layanan sudah termasuk konsultasi gratis dan menggunakan produk berkualitas premium
                </p>
            </div>

            <div class="grid md:grid-cols-3 gap-8">
                <div class="text-center">
                    <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">🕐</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Jam Operasional</h3>
                    <p class="text-gray-600">Senin - Sabtu: 09:00 - 21:00<br>Minggu: 10:00 - 18:00</p>
                </div>

                <div class="text-center">
                    <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">💳</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Metode Pembayaran</h3>
                    <p class="text-gray-600">Cash, Debit, Credit Card<br>E-wallet (GoPay, OVO, DANA)</p>
                </div>

                <div class="text-center">
                    <div class="bg-accent w-16 h-16 rounded-full flex items-center justify-center mx-auto mb-4">
                        <span class="text-2xl">📞</span>
                    </div>
                    <h3 class="text-xl font-bold mb-2">Reservasi</h3>
                    <p class="text-gray-600">Online booking atau<br>Telepon: +62 123 456 789</p>
                </div>
            </div>
        </div>
    </section>
</div>