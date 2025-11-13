<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

# Klinik Admin ("Klinikos")

A Laravel + Livewire + Tailwind CSS v4 based clinic management system.  
Main features include: **admin dashboard, drug management, supplier management, user management, reporting, and role-based authentication**.  
Designed for extensibility with separate dashboards/components for each role (Admin, Dokter, Kasir).

---

## Features

- Admin dashboard with clinic statistics
- Drug & stock CRUD management (with purchase/sale prices)
- Supplier management
- User/admin management
- Stock & transaction reports
- Responsive sidebar navigation
- Role-based authentication and authorization
- Modern UI (Tailwind CSS v4)

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
