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
                        <div class="bg-white rounded-3xl shadow-2xl p-8 top-28">
                            <div class="mb-6">
                                <p class="text-sm text-text-gray mb-2">Mulai dari</p>
                                <div class="flex items-baseline space-x-2">
                                    <span class="text-4xl font-bold text-accent">
                                        Rp {{ number_format($kamar->harga_bulanan ?? 800000, 0, ',', '.') }}
                                    </span>
                                    <span class="text-text-gray">/bulan</span>
                                </div>
                            </div>

                            <!-- Jenis Sewa -->
                            <div class="mb-6">
                                <label class="block text-sm font-semibold text-primary mb-3">Jenis Sewa</label>
                                <div class="grid grid-cols-2 gap-3">
                                    <button
                                        class="border-2 border-accent bg-accent text-white py-3 rounded-xl font-semibold transition"
                                        type="button">
                                        Bulanan
                                    </button>
                                    <button
                                        class="border-2 border-gray-300 text-gray-700 hover:border-accent hover:text-accent py-3 rounded-xl font-semibold transition"
                                        type="button">
                                        Tahunan
                                    </button>
                                </div>
                            </div>

                            <!-- Biaya -->
                            <div class="bg-gray-50 rounded-2xl p-6 mb-6">
                                <h3 class="font-semibold text-primary mb-4">Rincian Biaya</h3>
                                <div class="space-y-3">
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Sewa per bulan</span>
                                        <span class="font-semibold text-primary">Rp 800.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Deposit</span>
                                        <span class="font-semibold text-primary">Rp 500.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Listrik (estimasi)</span>
                                        <span class="font-semibold text-primary">Rp 150.000</span>
                                    </div>
                                    <div class="flex justify-between text-sm">
                                        <span class="text-text-gray">Air</span>
                                        <span class="font-semibold text-primary">Rp 50.000</span>
                                    </div>
                                    <div class="border-t border-gray-300 pt-3 flex justify-between">
                                        <span class="font-semibold text-primary">Total Awal</span>
                                        <span class="font-bold text-accent text-xl">Rp 1.500.000</span>
                                    </div>
                                </div>
                            </div>



                            <!-- CTA Buttons -->
                            <div class="space-y-3">
                                @guest
                                    <button
                                        class="w-full bg-gray-400 text-white py-4 rounded-xl font-bold text-lg shadow-lg flex items-center justify-center cursor-not-allowed relative group">

                                        <i class="fas fa-calendar-check mr-3"></i>
                                        Booking Sekarang

                                        <!-- Tooltip -->
                                        <span
                                            class="absolute -top-10 bg-black text-white text-sm px-3 py-1 rounded opacity-0 group-hover:opacity-100 transition">
                                            Login untuk booking
                                        </span>
                                    </button>
                                @endguest

                                @auth
                                    <a href="{{ route('user.booking.create', $kamar->id) }}"
                                        class="w-full bg-accent hover:bg-orange-600 text-white py-4 rounded-xl font-bold text-lg transition shadow-lg flex items-center justify-center">
                                        <i class="fas fa-calendar-check mr-3"></i>
                                        Booking Sekarang
                                    </a>
                                @endauth

                                <button
                                    class="w-full border-2 border-accent text-accent hover:bg-accent hover:text-white py-4 rounded-xl font-semibold transition flex items-center justify-center"
                                    type="button">
                                    <i class="fab fa-whatsapp mr-3 text-xl"></i>
                                    Chat WhatsApp
                                </button>
                                <button type="button" onclick="checkBooking({{ $hasBooked ? 'true' : 'false' }})"
                                    class="w-full border-2 border-gray-300 hover:border-yellow-400
    text-yellow-400 py-4 rounded-xl transition flex items-center justify-center">

                                    <i class="fas fa-star text-xl mr-3"></i>
                                    <span class="font-semibold text-primary tracking-wide">
                                        Rating Kamar
                                    </span>
                                </button>

                                {{-- MODAL --}}
                                <div id="ratingModal"
                                    class="fixed inset-0 bg-black/60 hidden items-center justify-center z-50">

                                    <form action="{{ route('user.reviews.store', $kamar->id) }}" method="POST"
                                        class="bg-white p-6 rounded-xl shadow w-full max-w-md">
                                        @csrf

                                        <label class="block mb-2 font-semibold">Rating</label>
                                        <select name="rating" required class="w-full border rounded-lg p-2 mb-4">
                                            <option value="">Pilih Rating</option>
                                            <option value="5">⭐⭐⭐⭐⭐</option>
                                            <option value="4">⭐⭐⭐⭐</option>
                                            <option value="3">⭐⭐⭐</option>
                                            <option value="2">⭐⭐</option>
                                            <option value="1">⭐</option>
                                        </select>

                                        <textarea name="ulasan" class="w-full border rounded-lg p-3 mb-4" placeholder="Tulis ulasan (opsional)"></textarea>

                                        <button type="submit"
                                            class="w-full border-2 border-yellow-400 text-yellow-500
            hover:bg-yellow-400 hover:text-white py-3 rounded-xl transition
            flex items-center justify-center">
                                            <i class="fas fa-star mr-2"></i>
                                            Kirim Rating
                                        </button>
                                    </form>
                                </div>
                            </div>

                            @if (session('success'))
                                <div id="successModal"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                    <div
                                        class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center animate-fadeIn">

                                        <div
                                            class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-yellow-100 text-yellow-500">
                                            <i class="fas fa-clock text-3xl"></i>
                                        </div>

                                        <h3 class="text-xl font-bold text-primary mb-2">
                                            Rating Berhasil Dikirim 🎉
                                        </h3>

                                        <p class="text-text-gray mb-6">
                                            Terima kasih! Rating kamu <br>
                                            <span class="font-semibold text-yellow-500">
                                                sedang menunggu persetujuan admin
                                            </span>.
                                        </p>

                                        <button onclick="closeSuccessModal()"
                                            class="w-full bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition">
                                            Mengerti
                                        </button>
                                    </div>
                                </div>
                            @endif







                            <!-- Popup Pemberitahuan -->
                            <div id="bookingModal"
                                class="fixed inset-0 z-50 hidden items-center justify-center bg-black/50">

                                <div
                                    class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center animate-fadeIn">

                                    <div
                                        class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-orange-100 text-accent">
                                        <i class="fas fa-info-circle text-3xl"></i>
                                    </div>

                                    <h3 class="text-xl font-bold text-primary mb-2">
                                        Informasi Booking
                                    </h3>

                                    <p class="text-textGray mb-6">
                                        Kamar<span class="font-semibold text-accent ml-1">bisa dibooking dari tanggal
                                            1</span>.
                                        <br>
                                        Harap pilih tanggal 1 disetiap bulan yang anda pilih dan berapa lama durasi kos
                                    </p>

                                    <button id="closeModal" type="button"
                                        class="w-full bg-accent hover:bg-orange-600 text-white py-3 rounded-xl font-semibold transition">
                                        MENGERTI!
                                    </button>

                                    <a href="panduan.html"
                                        class="block w-full bg-primary hover:bg-secondary text-white py-3 rounded-xl font-semibold transition
          flex items-center justify-center mt-3 gap-3">
                                        <i class="fas fa-book-open text-lg"></i>
                                        Baca Panduan
                                    </a>

                                </div>
                            </div>

                            @if (session('error'))
                                <div id="errorModal"
                                    class="fixed inset-0 z-50 flex items-center justify-center bg-black/50">

                                    <div
                                        class="bg-white rounded-2xl shadow-2xl max-w-md w-full mx-4 p-8 text-center animate-fadeIn">

                                        <div
                                            class="w-16 h-16 mx-auto mb-4 flex items-center justify-center rounded-full bg-red-100 text-red-500">
                                            <i class="fas fa-exclamation-circle text-3xl"></i>
                                        </div>

                                        <h3 class="text-xl font-bold text-primary mb-2">
                                            Rating Sudah Ada ⭐
                                        </h3>

                                        <p class="text-text-gray mb-6">
                                            {{ session('error') }}
                                        </p>

                                        <button onclick="closeErrorModal()"
                                            class="w-full bg-red-500 hover:bg-red-600 text-white py-3 rounded-xl font-semibold transition">
                                            Mengerti
                                        </button>
                                    </div>
                                </div>
                            @endif



                            <!-- Info -->
                            <div class="mt-6 p-4 bg-blue-50 border border-blue-200 rounded-xl">
                                <div class="flex items-start space-x-3">
                                    <i class="fas fa-info-circle text-blue-500 mt-1"></i>
                                    <p class="text-sm text-blue-900">
                                        <strong>Harap Perhatikan:</strong> Sebelum booking harap perhatikan kembali
                                    </p>
                                </div>
                            </div>

                        </div>

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


    </body>
@endsection
