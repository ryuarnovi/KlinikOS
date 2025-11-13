<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Admin Klinik</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body class="bg-gray-100 flex min-h-screen">

    <!-- Sidebar -->
    @if (!request()->routeIs('admin.dashboard'))
        <x-sidebar-admin />
    @endif

    <!-- Main Content -->
    <main class="flex-1 p-8">
        {{-- @yield('content') --}}
        {{ $slot }}
    </main>

    @livewireScripts
</body>
</html>
