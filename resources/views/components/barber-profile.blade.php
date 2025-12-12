<div class="pt-20 min-h-screen relative">
    <!-- Background Image with Dark Overlay -->
    <div class="absolute inset-0 bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/bg-barber.jpg') }}');">
        <div class="absolute inset-0 bg-black/70"></div>
    </div>

    <!-- Barber Showcase -->
    <section class="py-20 relative z-10">
        <div class="container mx-auto px-4">
            <!-- Section Header -->
            <div class="text-center mb-16">
                <h2 class="text-5xl font-bold text-white mb-6">Tim Profesional Kami</h2>
                <p class="text-gray-300 text-xl max-w-3xl mx-auto leading-relaxed">
                    Setiap kapster memiliki keahlian unik dan pengalaman bertahun-tahun dalam seni memotong rambut
                </p>
                <div class="flex justify-center mt-8">
                    <div class="w-32 h-1 bg-gradient-to-r from-yellow-400 to-yellow-600 rounded-full"></div>
                </div>
            </div>
            
            @if(isset($barbers) && $barbers->count() > 0)
            <div class="space-y-24">
                @foreach($barbers as $index => $barber)
                    @php
                        $isEven = $index % 2 == 0;
                        $colorScheme = match($barber->level) {
                            'master' => ['bg' => 'from-yellow-600 to-yellow-700', 'border' => 'border-yellow-500', 'text' => 'text-black', 'accent' => 'text-black', 'badge_bg' => 'bg-black', 'badge_text' => 'text-yellow-400'],
                            'senior' => ['bg' => 'from-slate-600 to-slate-800', 'border' => 'border-yellow-400', 'text' => 'text-white', 'accent' => 'text-yellow-400', 'badge_bg' => 'bg-yellow-400', 'badge_text' => 'text-slate-900'],
                            'professional' => ['bg' => 'from-blue-600 to-blue-800', 'border' => 'border-blue-300', 'text' => 'text-white', 'accent' => 'text-blue-400', 'badge_bg' => 'bg-blue-300', 'badge_text' => 'text-blue-900'],
                            'specialist' => ['bg' => 'from-purple-600 to-purple-800', 'border' => 'border-purple-300', 'text' => 'text-white', 'accent' => 'text-purple-400', 'badge_bg' => 'bg-purple-300', 'badge_text' => 'text-purple-900'],
                            'creative' => ['bg' => 'from-red-600 to-red-800', 'border' => 'border-red-300', 'text' => 'text-white', 'accent' => 'text-red-400', 'badge_bg' => 'bg-red-300', 'badge_text' => 'text-red-900'],
                            'junior' => ['bg' => 'from-green-600 to-green-800', 'border' => 'border-green-300', 'text' => 'text-white', 'accent' => 'text-green-400', 'badge_bg' => 'bg-green-300', 'badge_text' => 'text-green-900'],
                            default => ['bg' => 'from-slate-600 to-slate-800', 'border' => 'border-slate-400', 'text' => 'text-white', 'accent' => 'text-slate-400', 'badge_bg' => 'bg-slate-400', 'badge_text' => 'text-slate-900']
                        };
                    @endphp

                    <!-- {{ $barber->name }} - {{ ucfirst($barber->level) }} Kapster -->
                    <div class="bg-slate-700 rounded-3xl shadow-2xl overflow-hidden hover:shadow-3xl transition-all duration-500 transform hover:-translate-y-2 border border-slate-600 
                                @if($barber->level === 'master') bg-gradient-to-br {{ $colorScheme['bg'] }} border-2 {{ $colorScheme['border'] }} relative @endif">
                        
                        @if($barber->level === 'master')
                            <!-- Master Crown -->
                            <div class="absolute -top-4 left-1/2 transform -translate-x-1/2 {{ $colorScheme['badge_bg'] }} {{ $colorScheme['badge_text'] }} px-6 py-2 rounded-full text-sm font-bold shadow-xl z-10 flex items-center">
                                <svg class="w-4 h-4 mr-2" fill="currentColor" viewBox="0 0 20 20">
                                    <path d="M5 4a1 1 0 00-2 0v7.268a2 2 0 000 3.464V16a1 1 0 102 0v-1.268a2 2 0 000-3.464V4zM11 4a1 1 0 10-2 0v1.268a2 2 0 000 3.464V16a1 1 0 102 0V8.732a2 2 0 000-3.464V4zM16 3a1 1 0 011 1v7.268a2 2 0 010 3.464V16a1 1 0 11-2 0v-1.268a2 2 0 010-3.464V4a1 1 0 011-1z"/>
                                </svg>
                                MASTER KAPSTER
                            </div>
                        @endif
                        
                        <div class="flex flex-col lg:flex-row @if(!$isEven) lg:flex-row-reverse @endif @if($barber->level === 'master') mt-4 @endif">
                            <!-- Photo Section -->
                            <div class="lg:w-2/5 relative bg-gradient-to-br {{ $colorScheme['bg'] }} p-8 flex items-center justify-center">
                                <div class="relative">
                                    <div class="w-48 h-48 rounded-2xl overflow-hidden border-4 {{ $colorScheme['border'] }} shadow-2xl transform @if($isEven) rotate-3 @else -rotate-3 @endif hover:rotate-0 transition-transform duration-300">
                                        @if($barber->photo)
                                            <img src="{{ asset('storage/' . $barber->photo) }}" alt="{{ $barber->name }}" class="w-full h-full object-cover">
                                        @else
                                            <img src="{{ asset('images/child haircut.jpg') }}" alt="{{ $barber->name }}" class="w-full h-full object-cover">
                                        @endif
                                    </div>
                                    <!-- Experience Badge -->
                                    <div class="absolute -top-3 @if($isEven) -right-3 @else -left-3 @endif {{ $colorScheme['badge_bg'] }} {{ $colorScheme['badge_text'] }} px-3 py-1 rounded-xl text-sm font-bold shadow-lg">
                                        {{ $barber->experience }}
                                    </div>
                                    <!-- Rating Badge -->
                                    <div class="absolute -bottom-3 @if($isEven) -left-3 @else -right-3 @endif bg-slate-900 {{ $colorScheme['accent'] }} px-3 py-1 rounded-xl text-sm font-bold shadow-lg flex items-center">
                                        <svg class="w-4 h-4 mr-1" fill="currentColor" viewBox="0 0 20 20">
                                            <path d="M9.049 2.927c.3-.921 1.603-.921 1.902 0l1.07 3.292a1 1 0 00.95.69h3.462c.969 0 1.371 1.24.588 1.81l-2.8 2.034a1 1 0 00-.364 1.118l1.07 3.292c.3.921-.755 1.688-1.54 1.118l-2.8-2.034a1 1 0 00-1.175 0l-2.8 2.034c-.784.57-1.838-.197-1.539-1.118l1.07-3.292a1 1 0 00-.364-1.118L2.98 8.72c-.783-.57-.38-1.81.588-1.81h3.461a1 1 0 00.951-.69l1.07-3.292z"/>
                                        </svg>
                                        {{ $barber->formatted_rating }}
                                    </div>
                                </div>
                            </div>
                            
                            <!-- Info Section -->
                            <div class="lg:w-3/5 p-8">
                                <div class="mb-6">
                                    <h3 class="text-3xl font-bold {{ $colorScheme['text'] }} mb-2">{{ $barber->name }}</h3>
                                    <p class="{{ $colorScheme['accent'] }} font-bold text-xl">{{ $barber->level_display }}</p>
                                </div>
                                
                                <p class="@if($barber->level === 'master') text-black/80 @else text-gray-300 @endif mb-6 leading-relaxed text-lg">
                                    {{ $barber->bio ?? 'Kapster profesional dengan keahlian dan pengalaman yang luar biasa dalam seni memotong rambut.' }}
                                </p>
                                
                                <!-- Skills -->
                                @if($barber->skills && count($barber->skills) > 0)
                                <div class="mb-6">
                                    <h4 class="{{ $colorScheme['text'] }} font-bold mb-3 text-lg">Keahlian Utama</h4>
                                    <div class="flex flex-wrap gap-2">
                                        @foreach($barber->skills as $skill)
                                            <span class="@if($barber->level === 'master') bg-black/20 text-black @else bg-slate-600 {{ $colorScheme['accent'] }} @endif px-4 py-2 rounded-full text-sm font-medium border @if($barber->level === 'master') border-black/30 @else border-slate-500 @endif">{{ $skill }}</span>
                                        @endforeach
                                    </div>
                                </div>
                                @endif

                                <!-- Schedule -->
                                <div class="flex items-center {{ $colorScheme['text'] }} @if($barber->level === 'master') bg-black/20 @else bg-slate-600 @endif p-4 rounded-xl">
                                    <svg class="w-5 h-5 mr-3 {{ $colorScheme['accent'] }}" fill="currentColor" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"/>
                                    </svg>
                                    <span class="font-medium">{{ $barber->schedule_display }}</span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
            @else
            <!-- No Barbers Message -->
            <div class="text-center py-20">
                <div class="w-24 h-24 bg-yellow-100 rounded-full flex items-center justify-center mx-auto mb-6">
                    <svg class="w-12 h-12 text-yellow-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16 7a4 4 0 11-8 0 4 4 0 018 0zM12 14a7 7 0 00-7 7h14a7 7 0 00-7-7z"></path>
                    </svg>
                </div>
                <h3 class="text-2xl font-bold text-white mb-4">Belum Ada Kapster</h3>
                <p class="text-gray-300 text-lg">Tim kapster profesional kami sedang dalam proses rekrutmen.</p>
            </div>
            @endif

        </div>
    </section>


</div>