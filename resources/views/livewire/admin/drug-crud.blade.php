<div>
    <x-slot name="title">Master Data Obat</x-slot>

    <div class="flex items-center justify-between mb-6">
        <h1 class="text-2xl font-bold">Daftar Obat</h1>
        <button
            wire:click="showCreateModal"
            class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded font-semibold"
        >
            + Tambah Obat
        </button>
    </div>

    <!-- Modal Popup Form (Tambah/Edit Obat) -->
    @if($showModal)
        <div class="fixed inset-0 z-30 flex items-center justify-center bg-black bg-opacity-40">
            <div class="bg-white rounded-lg shadow w-full max-w-2xl p-6 relative">
                <button class="absolute top-3 right-3 text-2xl" wire:click="closeModal">&times;</button>
                <h2 class="text-lg font-bold mb-4">{{ $isEdit ? 'Edit Obat' : 'Tambah Obat' }}</h2>
                <form wire:submit.prevent="{{ $isEdit ? 'updateDrug' : 'createDrug' }}">
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label class="block text-sm font-medium mb-1">Nama Obat</label>
                            <input type="text" wire:model.defer="name" class="w-full border px-3 py-2 rounded" required>
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kode</label>
                            <input type="text" wire:model.defer="code" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Kategori</label>
                            <input type="text" wire:model.defer="category" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Merk</label>
                            <input type="text" wire:model.defer="brand" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Dosis</label>
                            <input type="text" wire:model.defer="dose" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Golongan</label>
                            <input type="text" wire:model.defer="group" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Bentuk Obat</label>
                            <input type="text" wire:model.defer="form" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Stok</label>
                            <input type="number" wire:model.defer="stock" min="0" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Harga Modal</label>
                            <input type="number" wire:model.defer="price" min="0" step="0.01" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div>
                            <label class="block text-sm font-medium mb-1">Harga Jual</label>
                            <input type="number" step="0.01" wire:model.defer="retail_price" min="0" class="w-full border px-3 py-2 rounded">
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Deskripsi</label>
                            <textarea wire:model.defer="description" class="w-full border px-3 py-2 rounded"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Fungsi</label>
                            <textarea wire:model.defer="function" class="w-full border px-3 py-2 rounded"></textarea>
                        </div>
                        <div class="md:col-span-2">
                            <label class="block text-sm font-medium mb-1">Efek Samping</label>
                            <textarea wire:model.defer="side_effect" class="w-full border px-3 py-2 rounded"></textarea>
                        </div>
                    </div>
                    <div class="mt-4 flex items-center space-x-3">
                        <button type="submit" class="bg-green-600 hover:bg-green-700 text-white px-4 py-2 rounded font-semibold">
                            {{ $isEdit ? 'Simpan Perubahan' : 'Tambah Obat' }}
                        </button>
                        <button type="button" wire:click="closeModal" class="text-gray-500 hover:text-gray-700">
                            Batal
                        </button>
                    </div>
                </form>
            </div>
        </div>
    @endif

    <!-- Tabel Obat -->
    <div class="bg-white rounded shadow">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-indigo-100">
                <tr>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">#</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Nama</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Kode</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Kategori</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Merk</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Bentuk</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Stok</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Harga Modal</th>
                    <th class="py-2 px-3 text-left text-xs font-semibold text-gray-600 uppercase">Harga Jual</th>
                    <th class="py-2 px-3 text-xs font-semibold text-gray-600 uppercase text-center">Aksi</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-100">
                @php $no = 1; @endphp
                @forelse($drugs as $obat)
                    <tr>
                        <td class="py-2 px-3">{{ $no++ }}</td>
                        <td class="py-2 px-3">{{ $obat->name }}</td>
                        <td class="py-2 px-3">{{ $obat->code }}</td>
                        <td class="py-2 px-3">{{ $obat->category }}</td>
                        <td class="py-2 px-3">{{ $obat->brand }}</td>
                        <td class="py-2 px-3">{{ $obat->form }}</td>
                        <td class="py-2 px-3">{{ $obat->stock }}</td>
                        <td class="py-2 px-3">Rp {{ number_format($obat->price, 0, ',', '.') }}</td>
                        <td class="py-2 px-3">Rp {{ number_format($obat->retail_price, 0, ',', '.') }}</td>
                        <td class="py-2 px-3 flex space-x-1 justify-center">
                            <button wire:click="showEditModal({{ $obat->id }})"
                                class="text-blue-600 hover:underline mr-2" title="Edit">
                                Edit
                            </button>
                            <button wire:click="deleteDrug({{ $obat->id }})"
                                onclick="return confirm('Yakin hapus obat ini?')"
                                class="text-red-600 hover:underline" title="Hapus">
                                Hapus
                            </button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td class="py-2 px-3 text-center text-gray-400" colspan="10">Belum ada data obat.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
