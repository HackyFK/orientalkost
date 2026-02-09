<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Panel</title>
    {{-- Tailwind CDN --}}
    <script src="https://cdn.tailwindcss.com"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-..." crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.0.1/css/all.css">
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>
<body class="bg-gray-100 text-gray-800">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-gray-800 text-white shadow">
        <div class="p-4 font-bold text-lg border-b border-gray-700">ADMIN PANEL</div>
        <nav class="flex flex-col space-y-2 p-4">
            <a href="{{ route('dashboard') }}" class="px-3 py-2 rounded hover:bg-gray-700">Dashboard</a>
            <a href="{{ route('admin.kos.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Kos</a>
            <a href="{{ route('admin.kamar.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Kamar</a>
            <a href="{{ route('admin.fasilitas.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Fasilitas</a>
            <a href="{{ route('admin.booking.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Booking</a>
            <a href="{{ route('admin.blog.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Blog</a>
            <a href="{{ route('admin.galeri.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Galeri</a>
            <a href="{{ route('admin.setting.index') }}" class="px-3 py-2 rounded hover:bg-gray-700">Setting</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>

</body>
</html>
