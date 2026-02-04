<!DOCTYPE html>
<html>
<head>
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
</head>
<body class="bg-gray-100">

<div class="flex min-h-screen">
    <!-- SIDEBAR -->
    <aside class="w-64 bg-white shadow">
        <div class="p-4 font-bold text-lg">ADMIN</div>
        <nav class="space-y-2 px-4">
            <a href="{{ route('dashboard') }}">Dashboard</a>
            {{-- <a href="">Dashboard</a> --}}
            <a href="{{ route('admin.kos.index') }}">Kos</a>
            <a href="{{ route('kamar.index') }}">Kamar</a>
            <a href="{{ route('booking.index') }}">Booking</a>
            <a href="{{ route('blog.index') }}">Blog</a>
            <a href="{{ route('galeri.index') }}">Galeri</a>
            <a href="{{ route('setting.index') }}">Setting</a>
        </nav>
    </aside>

    <!-- CONTENT -->
    <main class="flex-1 p-6">
        @yield('content')
    </main>
</div>

</body>
</html>
