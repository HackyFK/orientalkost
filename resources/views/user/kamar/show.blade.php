@extends('user.layouts.app')

@section('content')

    <body class="bg-gray-50">



        <!-- TOMBOL KEMBALI -->
        <section class="pt-28 pb-6 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <a href="{{ url()->previous() }}"
                    class="inline-flex items-center gap-2 text-sm font-medium text-primary
           hover:text-accent transition">
                    <i class="fas fa-arrow-left"></i>
                    Kembali
                </a>
            </div>
        </section>




        <!-- GALLERY SECTION -->
        <section class="pb-8 bg-white">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

                <div
                    class="grid gap-6
            grid-cols-[repeat(auto-fit,minmax(240px,1fr))]
            auto-rows-[200px]">

                    <!-- Gambar BESAR -->
                    <div
                        class="relative overflow-hidden rounded-3xl shadow-lg
                md:col-span-2 md:row-span-2 group">
                        <!-- Gambar Utama -->
                        <img src="{{ $kamar->images->first()
                            ? asset('storage/' . $kamar->images->first()->image_path)
                            : 'https://images.unsplash.com/photo-1522708323590-d24dbb6b0267?w=1200' }}"
                            class="w-full h-full object-cover">

                    </div>


                    <!-- Gambar KECIL -->
                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                    <!-- Gambar KECIL -->
                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1616594039964-ae9021a400a0?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                    <div class="relative overflow-hidden rounded-2xl shadow-lg group">
                        <img src="https://images.unsplash.com/photo-1586105251261-72a756497a11?w=600"
                            class="w-full h-full object-cover group-hover:scale-110 transition">
                    </div>

                </div>


            </div>
        </section>


        <!-- MAIN CONTENT -->
        <section class="py-12 bg-gray-50">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
                <div class="grid lg:grid-cols-3 gap-8">

                    <!-- LEFT COLUMN - MAIN INFO -->
                    <div class="lg:col-span-2 space-y-6">

                        <!-- Header Info -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <div class="flex items-start justify-between mb-6">
                                <div>
                                    <div class="flex items-center gap-3 mb-3">
                                        <i class="fas fa-building text-2xl text-accent"></i>
                                        <h1 class="text-4xl font-bold text-primary">
                                            {{ $kamar->nama_kamar }}
                                        </h1>
                                    </div>

                                    <div class="flex items-center space-x-2 text-text-gray mb-4">

                                        <p class="text-text-gray">
                                            {{ $kamar->kos->alamat }}
                                        </p>
                                    </div>
                                    @php
                                        $fullStars = floor($averageRating);
                                        $halfStar = $averageRating - $fullStars >= 0.5;
                                    @endphp

                                    <div class="flex text-yellow-400 text-xl">
                                        @for ($i = 0; $i < $fullStars; $i++)
                                            <i class="fas fa-star"></i>
                                        @endfor

                                        @if ($halfStar)
                                            <i class="fas fa-star-half-alt"></i>
                                        @endif

                                        @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                                            <i class="far fa-star"></i>
                                        @endfor
                                    </div>

                                    <span
                                        class="text-2xl font-bold text-primary">{{ number_format($averageRating, 1) }}</span>
                                    <span class="text-text-gray">({{ $totalReviews }} ulasan)</span>

                                </div>
                                <button class="bg-gray-100 hover:bg-gray-200 p-3 rounded-xl transition" type="button">
                                    <i class="fas fa-share-alt text-primary text-xl"></i>
                                </button>
                            </div>
                        </div>

                        <!-- Fasilitas -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary mb-6 flex items-center">
                                <i class="fas fa-concierge-bell text-accent mr-3"></i>
                                Fasilitas Kos
                            </h2>

                            <div class="grid md:grid-cols-2 gap-4">
                                <span
                                    class="bg-gray-50 text-gray-700 px-3 py-1 rounded-xl text-sm font-semibold flex items-center">
                                    <i class="fas fa-ruler-combined mr-2 text-accent"></i>
                                    {{ $kamar->panjang + 0 }} × {{ $kamar->lebar + 0 }} m
                                </span>

                                @forelse ($kamar->fasilitas as $fasilitas)
                                    <div class="flex items-center space-x-3 p-3 bg-gray-50 rounded-xl">

                                        <i
                                            class="{{ $fasilitas->icon ?? 'fa-solid fa-circle-check' }}
                   text-accent text-xl"></i>

                                        <span class="text-primary font-medium">
                                            {{ $fasilitas->nama_fasilitas }}
                                        </span>
                                    </div>
                                @empty
                                    <div class="md:col-span-2 text-text-gray text-sm">
                                        Fasilitas belum tersedia
                                    </div>
                                @endforelse

                            </div>
                        </div>


                        <!-- Deskripsi -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <h2 class="text-2xl font-bold text-primary mb-4 flex items-center">
                                <i class="fas fa-info-circle text-accent mr-3"></i>
                                Deskripsi Kamar
                            </h2>
                            <p class="text-text-gray leading-relaxed">
                                {{ $kamar->deskripsi ?? 'Deskripsi kamar belum tersedia.' }}
                            </p>
                        </div>





                        <!-- Ulasan -->
                        <div class="bg-white rounded-3xl shadow-lg p-8">
                            <div class="flex items-center justify-between mb-6">
                                <h2 class="text-2xl font-bold text-primary flex items-center">
                                    <i class="fas fa-comments text-accent mr-3"></i>
                                    Ulasan Penghuni Kamar
                                </h2>

                            </div>

                            <!-- Rating Summary -->
                            <div class="bg-gradient-to-r from-accent-soft to-accent/20 rounded-2xl p-6 mb-6">
                                <div class="flex items-center justify-between">
                                    <div>
                                        <div class="flex items-center space-x-3 mb-2">
                                            <span
                                                class="text-5xl font-bold text-primary">{{ number_format($averageRating, 1) }}</span>
                                            <div>
                                                <div class="flex text-yellow-400 text-xl mb-1">
                                                    @php
                                                        $fullStars = floor($averageRating);
                                                        $halfStar = $averageRating - $fullStars >= 0.5;
                                                    @endphp

                                                    @for ($i = 0; $i < $fullStars; $i++)
                                                        <i class="fas fa-star"></i>
                                                    @endfor

                                                    @if ($halfStar)
                                                        <i class="fas fa-star-half-alt"></i>
                                                    @endif

                                                    @for ($i = $fullStars + ($halfStar ? 1 : 0); $i < 5; $i++)
                                                        <i class="far fa-star"></i>
                                                    @endfor
                                                </div>
                                                <p class="text-text-gray text-sm">dari {{ $totalReviews }} ulasan</p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="space-y-2 flex-1 max-w-sm ml-8">
                                        @for ($i = 5; $i >= 1; $i--)
                                            <div class="flex items-center space-x-2">
                                                <span class="text-sm text-primary w-8">{{ $i }}★</span>
                                                <div class="flex-1 bg-gray-200 rounded-full h-2">
                                                    <div class="bg-accent rounded-full h-2"
                                                        style="width: {{ number_format($ratingPercentages[$i], 1) }}%">
                                                    </div>
                                                </div>
                                                <span class="text-sm text-text-gray w-8">{{ $ratingCounts[$i] }}</span>
                                            </div>
                                        @endfor
                                    </div>
                                </div>
                            </div>


                            <!-- Reviews -->
                            <div class="space-y-4">
                                @foreach ($kamar->reviews as $review)
                                    <div class="border-b border-gray-200 pb-4">
                                        <div class="flex items-start space-x-4">

                                            {{-- Avatar dinamis --}}
                                            @php
                                                $initial = strtoupper(substr($review->user->name ?? 'U', 0, 1));

                                                // Warna bg berdasarkan hash nama (agar selalu sama untuk user yang sama)
                                                $colors = [
                                                    'bg-red-500',
                                                    'bg-green-500',
                                                    'bg-blue-500',
                                                    'bg-yellow-500',
                                                    'bg-purple-500',
                                                    'bg-pink-500',
                                                    'bg-indigo-500',
                                                ];
                                                $colorIndex = isset($review->user->name)
                                                    ? ord(strtolower($review->user->name[0])) % count($colors)
                                                    : 0;
                                                $bgColor = $colors[$colorIndex];
                                            @endphp

                                            <div
                                                class="w-12 h-12 rounded-full flex items-center justify-center text-white font-bold {{ $bgColor }}">
                                                {{ $initial }}
                                            </div>

                                            <div class="flex-1">
                                                <div class="flex items-center justify-between mb-2">
                                                    <div>
                                                        <h4 class="font-semibold text-primary">
                                                            {{ $review->user->name ?? 'User' }}</h4>
                                                        <div class="flex items-center space-x-2">
                                                            <div class="flex text-yellow-400 text-sm">
                                                                @for ($i = 1; $i <= 5; $i++)
                                                                    @if ($i <= $review->rating)
                                                                        <i class="fas fa-star"></i>
                                                                    @elseif($i - $review->rating < 1)
                                                                        <i class="fas fa-star-half-alt"></i>
                                                                    @else
                                                                        <i class="far fa-star"></i>
                                                                    @endif
                                                                @endfor
                                                            </div>
                                                            <span class="text-xs text-text-gray">
                                                                {{ $review->created_at->diffForHumans() }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <p class="text-text-gray text-sm leading-relaxed">
                                                    {{ $review->ulasan ?? '-' }}
                                                </p>
                                            </div>

                                        </div>
                                    </div>
                                @endforeach

                                @if ($kamar->reviews->isEmpty())
                                    <p class="text-sm text-text-gray">Belum ada ulasan untuk kamar ini.</p>
                                @endif
                            </div>


                        </div>

                    </div>

                    <!-- RIGHT COLUMN - BOOKING CARD -->
                    <div class="lg:col-span-1">
                        <div class="bg-white rounded-2xl border border-slate-200 shadow-sm overflow-hidden sticky top-28">

                            {{-- Harga --}}
                            <div class="px-6 py-5 border-b border-slate-100">

                                <p class="text-xs text-slate-400 mb-1">Mulai dari</p>

                                <div class="flex items-baseline gap-2">

                                    <span id="hargaValue" class="text-3xl font-bold text-accent"
                                        data-harian="{{ $kamar->harga_harian }}"
                                        data-bulanan="{{ $kamar->harga_bulanan }}"
                                        data-tahunan="{{ $kamar->harga_tahunan }}">

                                        Rp {{ number_format($kamar->harga_bulanan, 0, ',', '.') }}

                                    </span>

                                    <span id="hargaSuffix" class="text-sm text-slate-400">
                                        /bulan
                                    </span>

                                </div>

                            </div>

                            <div class="p-6 space-y-5">

                                {{-- Jenis Sewa --}}
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-2">
                                        Jenis Sewa
                                    </label>

                                    <div class="grid grid-cols-3 gap-2">

                                        @if ($kamar->harga_harian)
                                            <button type="button" onclick="ubahHarga('harian', this)"
                                                class="btnHarga border-2 border-slate-200 text-slate-600 py-2.5 rounded-xl text-xs font-semibold transition">
                                                Harian
                                            </button>
                                        @endif


                                        @if ($kamar->harga_bulanan)
                                            <button type="button" onclick="ubahHarga('bulanan', this)"
                                                class="btnHarga border-2 border-accent bg-accent text-white py-2.5 rounded-xl text-xs font-semibold transition">
                                                Bulanan
                                            </button>
                                        @endif


                                        @if ($kamar->harga_tahunan)
                                            <button type="button" onclick="ubahHarga('tahunan', this)"
                                                class="btnHarga border-2 border-slate-200 text-slate-600 py-2.5 rounded-xl text-xs font-semibold transition">
                                                Tahunan
                                            </button>
                                        @endif

                                    </div>
                                </div>

                                {{-- CTA Buttons --}}
                                <div class="space-y-2.5">

                                    {{-- Booking --}}
                                    @guest
                                        <button type="button"
                                            class="w-full bg-slate-300 text-white py-3 rounded-xl font-bold text-sm flex items-center justify-center gap-2 cursor-not-allowed relative group">
                                            <i class="fas fa-calendar-check"></i>
                                            Booking Sekarang
                                            <span
                                                class="absolute -top-9 left-1/2 -translate-x-1/2 bg-slate-800 text-white text-xs px-3 py-1.5 rounded-lg opacity-0 group-hover:opacity-100 transition whitespace-nowrap pointer-events-none">
                                                Login untuk booking
                                            </span>
                                        </button>
                                    @endguest

                                    @auth
                                        <a href="{{ route('user.booking.create', $kamar->id) }}"
                                            class="w-full bg-accent hover:bg-orange-600 active:scale-[0.98] text-white py-3 rounded-xl font-bold text-sm transition flex items-center justify-center gap-2 shadow-sm shadow-orange-200">
                                            <i class="fas fa-calendar-check"></i>
                                            Booking Sekarang
                                        </a>
                                    @endauth

                                    {{-- WhatsApp --}}
                                    <button type="button"
                                        class="w-full border-2 border-accent text-accent hover:bg-accent hover:text-white active:scale-[0.98] py-3 rounded-xl font-semibold text-sm transition flex items-center justify-center gap-2">
                                        <i class="fab fa-whatsapp text-base"></i>
                                        Chat WhatsApp
                                    </button>

                                    {{-- Rating --}}
                                    <button type="button" onclick="checkBooking({{ $hasBooked ? 'true' : 'false' }})"
                                        class="w-full border-2 border-slate-200 hover:border-yellow-400 text-slate-600 hover:text-yellow-500 active:scale-[0.98] py-3 rounded-xl font-semibold text-sm transition flex items-center justify-center gap-2">
                                        <i class="fas fa-star text-yellow-400"></i>
                                        Rating Kamar
                                    </button>

                                </div>

                                {{-- Info Box --}}
                                <div class="flex items-start gap-3 p-4 bg-blue-50 border border-blue-100 rounded-xl">
                                    <i class="fas fa-info-circle text-blue-400 mt-0.5 flex-shrink-0 text-sm"></i>
                                    <p class="text-xs text-blue-700 leading-relaxed">
                                        <span class="font-semibold">Harap Perhatikan:</span> Pastikan data yang Anda
                                        masukkan sudah benar sebelum melanjutkan booking.
                                    </p>
                                </div>

                            </div>
                        </div>
                    </div>

                    {{-- ===== MODALS ===== --}}

                    {{-- Modal Rating --}}
                    <div id="ratingModal" class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">
                        <form action="{{ route('user.reviews.store', $kamar->id) }}" method="POST"
                            class="bg-white rounded-2xl shadow-2xl w-full max-w-md mx-4 overflow-hidden">
                            @csrf
                            <div class="px-6 py-4 border-b border-slate-100 flex items-center gap-2.5">
                                <div class="w-7 h-7 rounded-lg bg-yellow-50 flex items-center justify-center">
                                    <i class="fas fa-star text-yellow-400 text-xs"></i>
                                </div>
                                <h3 class="font-semibold text-slate-700 text-sm">Beri Rating Kamar</h3>
                            </div>
                            <div class="p-6 space-y-4">
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Rating</label>
                                    <select name="rating" required
                                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition">
                                        <option value="">-- Pilih Rating --</option>
                                        <option value="5">⭐⭐⭐⭐⭐ &nbsp; Sangat Bagus</option>
                                        <option value="4">⭐⭐⭐⭐ &nbsp; Bagus</option>
                                        <option value="3">⭐⭐⭐ &nbsp; Cukup</option>
                                        <option value="2">⭐⭐ &nbsp; Kurang</option>
                                        <option value="1">⭐ &nbsp; Buruk</option>
                                    </select>
                                </div>
                                <div>
                                    <label
                                        class="block text-xs font-semibold text-slate-500 uppercase tracking-wider mb-1.5">Ulasan
                                        <span class="normal-case font-normal">(opsional)</span></label>
                                    <textarea name="ulasan" rows="3" placeholder="Ceritakan pengalaman kamu di kamar ini..."
                                        class="w-full border border-slate-200 rounded-lg px-3 py-2.5 text-sm text-slate-700 bg-slate-50 focus:outline-none focus:ring-2 focus:ring-yellow-400 focus:border-transparent transition resize-none"></textarea>
                                </div>
                                <button type="submit"
                                    class="w-full bg-yellow-400 hover:bg-yellow-500 active:scale-[0.98] text-white py-3 rounded-xl font-semibold text-sm transition flex items-center justify-center gap-2">
                                    <i class="fas fa-star"></i>
                                    Kirim Rating
                                </button>
                            </div>
                        </form>
                    </div>

                    {{-- Modal Booking Info --}}
                    <div id="bookingModal" class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">
                        <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center">
                            <div
                                class="w-14 h-14 mx-auto mb-4 flex items-center justify-center rounded-full bg-orange-100 text-accent">
                                <i class="fas fa-info-circle text-2xl"></i>
                            </div>
                            <h3 class="text-lg font-bold text-primary mb-2">Informasi Booking</h3>
                            <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                                Kamar <span class="font-semibold text-accent">bisa dibooking mulai tanggal 1</span>.<br>
                                Pilih tanggal 1 di setiap bulan yang Anda inginkan beserta durasi kos.
                            </p>
                            <div class="space-y-2.5">
                                <button id="closeModal" type="button"
                                    class="w-full bg-accent hover:bg-orange-600 active:scale-[0.98] text-white py-3 rounded-xl font-semibold text-sm transition">
                                    Mengerti!
                                </button>
                                <a href="panduan.html"
                                    class="w-full border-2 border-slate-200 hover:border-accent text-slate-600 hover:text-accent py-3 rounded-xl font-semibold text-sm transition flex items-center justify-center gap-2">
                                    <i class="fas fa-book-open"></i>
                                    Baca Panduan
                                </a>
                            </div>
                        </div>
                    </div>

                    {{-- Modal Review Success --}}
                    @if (session('review_success'))
                        <div id="successModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center">
                                <div
                                    class="w-14 h-14 mx-auto mb-4 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500">
                                    <i class="fas fa-clock text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-primary mb-2">Rating Berhasil Dikirim 🎉</h3>
                                <p class="text-sm text-slate-500 mb-6 leading-relaxed">
                                    Terima kasih! Rating kamu sedang<br>
                                    <span class="font-semibold text-yellow-500">menunggu persetujuan admin</span>.
                                </p>
                                <button onclick="closeSuccessModal()"
                                    class="w-full bg-accent hover:bg-orange-600 active:scale-[0.98] text-white py-3 rounded-xl font-semibold text-sm transition">
                                    Mengerti
                                </button>
                            </div>
                        </div>
                    @endif

                    {{-- Modal Error --}}
                    @if (session('error'))
                        <div id="errorModal" class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">
                            <div class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center">
                                <div
                                    class="w-14 h-14 mx-auto mb-4 flex items-center justify-center rounded-full bg-red-100 text-red-500">
                                    <i class="fas fa-exclamation-circle text-2xl"></i>
                                </div>
                                <h3 class="text-lg font-bold text-primary mb-2">Rating Sudah Ada ⭐</h3>
                                <p class="text-sm text-slate-500 mb-6">{{ session('error') }}</p>
                                <button onclick="closeErrorModal()"
                                    class="w-full bg-red-500 hover:bg-red-600 active:scale-[0.98] text-white py-3 rounded-xl font-semibold text-sm transition">
                                    Mengerti
                                </button>
                            </div>
                        </div>
                    @endif

                </div>
            </div>

            </div>
            </div>
        </section>

        <!-- Scroll to Top Button -->
        <button onclick="window.scrollTo({top: 0, behavior: 'smooth'})"
            class="fixed bottom-8 right-8 bg-accent hover:bg-orange-600 text-white w-14 h-14 rounded-full shadow-2xl flex items-center justify-center transition z-50">
            <i class="fas fa-arrow-up text-xl"></i>
        </button>

        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        {{-- Raing --}}
        <script>
            function openRatingModal() {
                document.getElementById('ratingModal').classList.remove('hidden');
                document.getElementById('ratingModal').classList.add('flex');
            }

            function closeRatingModal() {
                document.getElementById('ratingModal').classList.add('hidden');
            }
        </script>

        {{-- CEK BOOKING --}}
        <script>
            function checkBooking(hasBooked) {
                if (hasBooked) {
                    openRatingModal();
                } else {
                    Swal.fire({
                        icon: 'warning',
                        title: 'Belum Pernah Booking',
                        text: 'Silakan booking kamar terlebih dahulu sebelum memberi rating.',
                        confirmButtonColor: '#f59e0b'
                    });
                }
            }
        </script>

        @if (session('success'))
            <script>
                setTimeout(() => {
                    const modal = document.getElementById('successModal');
                    if (modal) modal.classList.add('hidden');
                }, 8000);
            </script>
        @endif

        <script>
            function closeErrorModal() {
                document.getElementById('errorModal')?.classList.add('hidden');
            }
        </script>

        <script>
            function closeSuccessModal() {
                const modal = document.getElementById('successModal');
                if (modal) {
                    modal.classList.add('hidden'); // sembunyikan modal
                }
            }
        </script>
        <script>
            function formatRupiah(angka) {
                return new Intl.NumberFormat('id-ID').format(angka);
            }

            function ubahHarga(jenis, tombol) {
                const hargaElement = document.getElementById('hargaValue');
                const suffixElement = document.getElementById('hargaSuffix');

                const harga = hargaElement.dataset[jenis];

                hargaElement.innerHTML = 'Rp ' + formatRupiah(harga);

                if (jenis === 'harian')
                    suffixElement.innerHTML = '/hari';

                if (jenis === 'bulanan')
                    suffixElement.innerHTML = '/bulan';

                if (jenis === 'tahunan')
                    suffixElement.innerHTML = '/tahun';


                // reset semua tombol
                document.querySelectorAll('.btnHarga').forEach(btn => {
                    btn.classList.remove('border-accent', 'bg-accent', 'text-white');
                    btn.classList.add('border-slate-200', 'text-slate-600');
                });

                // aktifkan tombol dipilih
                tombol.classList.remove('border-slate-200', 'text-slate-600');
                tombol.classList.add('border-accent', 'bg-accent', 'text-white');
            }
        </script>


    </body>
@endsection
