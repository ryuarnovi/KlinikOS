{{-- filepath: /mnt/klinikos/resources/views/livewire/admin/dashboard.blade.php --}}
<x-layouts.admin>
    <div class="container mx-auto py-8">
        <h1 class="text-2xl font-bold mb-4">Selamat Datang, {{ Auth::user()->name ?? 'Admin' }}</h1>
        <p class="mb-6 text-gray-600">Ini adalah halaman dashboard admin Klinik. Silakan gunakan menu di samping untuk mengelola data klinik.</p>

        <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Total Obat</div>
                <div class="text-3xl font-bold">{{ \App\Models\Drug::count() }}</div>
            </div>
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Total User</div>
                <div class="text-3xl font-bold">{{ \App\Models\User::count() }}</div>
            </div>
            <div class="bg-white rounded shadow p-6">
                <div class="text-gray-500">Total Supplier</div>
                <div class="text-3xl font-bold">{{ \App\Models\Supplier::count() }}</div>
            </div>
        </div>

        <div class="bg-white rounded shadow p-6">
            <h2 class="text-lg font-semibold mb-2">Menu Cepat</h2>
            <div class="flex flex-wrap gap-4">
                <a href="{{ route('livewire.admin.drug-crud') }}" class="bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Manajemen Obat</a>
                <a href="{{ route('livewire.admin.supplier') }}" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">Supplier</a>
                <a href="{{ route('livewire.admin.users.index') }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Manajemen User</a>
                <a href="{{ route('livewire.admin.report') }}" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Laporan</a>
            </div>
        </div>
    </div>
</x-layouts.admin>
