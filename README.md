<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# KlinikOS SaaS Kompleks (Laravel + Livewire)

Sistem Informasi Klinik berbasis Laravel MVC + Livewire, arsitektur SaaS multi-tenant, siap production. Semua fitur utama klinik, RBAC premium, EMR, antrean, farmasi, billing, dashboard eksekutif, dan HRIS terintegrasi dalam satu aplikasi Laravel (tanpa Next.js/Go).

---

## 🏗️ Arsitektur
- **Backend & Frontend:** Laravel MVC + Livewire + Tailwind CSS v4
- **Database:** PostgreSQL
- **Queue/Cache:** Redis (opsional)
- **Dockerized:** Siap jalan dengan Docker Compose

## 🚀 Cara Menjalankan
1. Clone repo & masuk folder
2. Copy .env & edit sesuai kebutuhan
3. Jalankan dengan Docker Compose
4. Akses di http://localhost:8000

## 📋 Fitur Utama
- ✅ Workflows Spesialis Sesuai Role (RBAC Premium):
  - Resepsionis: Manajemen pendaftaran, antrean, rujukan
  - Dokter: Panel SOAP, daftar tunggu, "Panggil Pasien"
  - Perawat: Pendampingan rekam medis
  - Apoteker: Penebusan obat, inventory real-time
  - Kasir: Pembayaran omnichannel, tracking invoice
- ✅ EMR Terstandardisasi: ICD-10 & ICD-9 CM
- ✅ Manajemen Jadwal Dokter & Shift Staff (HRIS)
- ✅ Sistem Antrean & Rujukan Otomatis
- ✅ Farmasi & Inventory: Stok, notifikasi low stock
- ✅ Billing & Pembayaran: Tunai, transfer, QR, Midtrans, Web3
- ✅ Dashboard Eksekutif: Visualisasi kunjungan, pendapatan, efisiensi

## 📁 Struktur Folder
- app/Models, app/Livewire, resources/views/livewire, database/migrations
- docker-compose.yml, .env.example

## 🗺️ Roadmap & Pengembangan
- Integrasi BPJS (P-Care/vClaim)
- Inventaris & Logistik Farmasi Advanced
- Modul Laboratorium & Radiologi
- Portal Pasien & Mobile App
- Business Intelligence Dashboard

---

## Stack/Technology Notes
- Laravel MVC + Livewire SPA-like UX
- Tailwind CSS v4
- PostgreSQL
- Docker Compose

---

## Installation

1. **Clone the repository**
    ```sh
    git clone <repo-url>
    cd klinikos
    ```

2. **Install dependencies**
    ```sh
    composer install
    npm install
    ```

3. **Prepare environment**
    ```sh
    cp .env.example .env
    php artisan key:generate
    ```

4. **Configure database connection in `.env` and migrate**
    ```sh
    php artisan migrate
    ```

5. **Build frontend assets**
    ```sh
    npm run dev
    ```

6. **Run the server**
    ```sh
    php artisan serve
    ```

## Key Structure

- `resources/views/livewire/admin/layouts/admin.blade.php` — Main admin layout (with sidebar)
- `resources/views/livewire/admin/components/sidebar.blade.php` — Sidebar navigation (Admin)
- `resources/views/livewire/admin/drug-crud.blade.php` — Drug CRUD view
- `app/Livewire/Admin/DrugCrud.php` — Drug logic component
- `tailwind.config.js` — Tailwind CSS 4 configuration (make sure this is v4!)

---

## Stack/Technology Notes

- Using **Tailwind CSS v4 (with dark mode, JIT enabled)**  
- Livewire for SPA-like UX in Laravel  
- Code structure is modular and allows gradual migration to separate stacks.

> **This codebase is likely to be migrated/rewritten to Golang (backend API) and Next.js (frontend) in the near future. Please architect and refactor with this in mind, and focus on keeping business logic, validation, and UI components separated.**

---

## Contributing & Roadmap

- Add new Livewire components under `app/Livewire/Admin/`, `app/Livewire/Dokter/`, `app/Livewire/Kasir/`.
- Register new routes in `routes/web.php` (use `->name()` for route consistency).
- Add new sidebar links in `sidebar.blade.php` to connect new features/pages.
- If helping migrate to Go/Next.js: move logic to API endpoints and decouple frontend components.

---

## Known Issues & TODO

- [ ] **Panel Dokter dan Kasir belum ada tampilan**  
  UI/UX untuk dokter (input resep, lihat stok) dan kasir (antrian resep, checkout, dsb) masih perlu dibuat.
- [ ] **Tampilan admin dan sidebar perlu dioptimasi**  
  - Sidebar tidak selalu tampil proporsional/responsif.
  - Beberapa halaman admin kosong atau tidak konsisten desain.
- [ ] **Drug stok dan harga modal tidak tersimpan saat create/edit**  
  - Form create drug tidak memasukkan field stok & harga modal ke DB.
  - Perlu cek logika DrugCrud dan kolom migration.
- [ ] **Sidebar & navigasi masih hardcoded**
  - Perlu improvement agar dinamis/flexible pada multi-role.
- [ ] **Route names BLADE vs web.php tidak konsisten**
  - Cek semua `route('...')` di sidebar/link sesuai nama di `routes/web.php`.
- [ ] **User management, reporting, dan beberapa fitur admin kurang lengkap**
  - Data tables, filtering, pencarian, validasi baru sebagian.
- [ ] **Form validation kurang optimal**
  - Sebagian form tidak tampilkan error feedback/jika kosong.
- [ ] **Belum ada notifikasi/error toast dengan Livewire untuk feedback aksi**
- [ ] **No password reset/email notification**
  - Email dan fitur pemulihan password belum aktif.
- [ ] **Belum ada dokumentasi API (jika aplikasi dikembangkan untuk REST API)**
- [ ] **Migrasi bertahap ke Golang (RESTful API) dan Next.js (modern frontend)**  
  - Mulai refactor logic dan tipe data agar mudah dipakai di backend lain dan React ecosystem.

---

**Tambahkan issue lain langsung ke file ini atau GitHub issues. Fokuslah pada pemisahan responsibilitas kode untuk memudahkan migrasi stack di masa depan.**

---

**Happy coding!**
