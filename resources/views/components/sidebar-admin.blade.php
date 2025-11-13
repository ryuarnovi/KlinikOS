<aside class="w-64 bg-indigo-800 text-gray-700 flex flex-col h-full p-4">
    <div class="text-2xl font-bold mb-8">Admin Klinik</div>
    <a href="{{ route('admin.dashboard') }}" class="mb-2 hover:underline">Dashboard</a>
    <a href="{{ route('livewire.admin.users.index') }}" class="mb-2 hover:underline">User Management</a>
    <a href="{{ route('livewire.admin.supplier') }}" class="mb-2 hover:underline">Supplier</a>
    <a href="{{ route('livewire.admin.drug-crud') }}" class="mb-2 hover:underline">Obat</a>
    <a href="{{ route('livewire.admin.drug-in') }}" class="mb-2 hover:underline">Obat Masuk</a>
    <a href="{{ route('livewire.admin.drug-out') }}" class="mb-2 hover:underline">Obat Keluar</a>
    <a href="{{ route('livewire.admin.report') }}" class="mb-2 hover:underline">Laporan</a>
    <form method="POST" action="{{ route('logout') }}" class="mt-auto">
        @csrf
        <button type="submit" class="text-pink-200 hover:text-pink-400">Logout</button>
    </form>
</aside>
