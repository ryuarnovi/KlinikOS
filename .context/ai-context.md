# Context AI KlinikOS

Semua progres, keputusan, dan troubleshooting penting akan dicatat di sini untuk menjaga scope dan roadmap SaaS KlinikOS tetap terarah.

## Prinsip Context AI
- Semua pengembangan harus sesuai roadmap dan fitur di README.md
- Tidak boleh keluar dari scope SaaS KlinikOS (multi-tenant, RBAC, EMR, HRIS, antrean, farmasi, billing, dashboard, dsb)
- Setiap progres, error, dan keputusan penting dicatat di sini
- Jika ada anomali (misal: bug migration order), tulis kronologi dan solusi/eksperimen

## Kronologi Progres Utama [-x]
- [x] **Core Multi-Tenant & RBAC Foundation**:
  - Migration `clinics` dan sinkronisasi `clinic_id` di semua tabel bisnis.
  - Model `User` sudah memiliki method `hasRole()` untuk pengecekan hak akses.
  - Middleware `IdentifyClinic` dan `CheckRole` sudah diimplementasikan.
- [x] **ERP SaaS Modules (Multi-Tenant Ready)**:
  - **Keuangan & Akuntansi**: Invoice, payment tracking, dan rekonsiliasi via Midtrans & manual.
  - **HR & Payroll**: Manajemen jadwal (`staff_schedules`), shift, dan data karyawan.
  - **CRM & CRM Foundation**: Data pasien terpusat, rekam medis, dan histori kunjungan.
- [x] **Manajemen Farmasi & Inventory**:
  - CRUD Obat, Supplier, Stok Masuk (DrugIn), dan Stok Keluar (DrugOut).
  - Implementasi metode **FEFO** (First Expired First Out) pada pengeluaran obat.
- [x] **Billing & Kasir (Payment Gateway Ready)**:
  - Antrean resep dan konfirmasi pembayaran otomatis mengurangi stok.
  - **Integrasi Midtrans**: API Keys sudah dikonfigurasi di `.env` dan `MidtransService`.
- [x] **EMR Foundation**:
  - Model `Patient` dan `MedicalRecord` sudah diimplementasikan.

## Checklist Fitur Utama (README)
- [x] Workflows Spesialis: Admin, Dokter, Kasir, Perawat, Apoteker.
- [x] EMR Terstandardisasi ICD-10/ICD-9.
- [x] Manajemen Jadwal Dokter & Shift Staff (HRIS).
- [x] Farmasi & Inventory: Stok, notifikasi low stock.
- [x] Billing & Pembayaran: Tunai & Midtrans (Ready).

## Keputusan Arsitektur & Integrasi API [-x]
- [x] **Midtrans API**: Menggunakan API Sandbox untuk fase pengembangan (Merchant ID: G489006463).
- [x] **BPJS API**: Diputuskan untuk menggunakan **Manual Input** saja karena alasan birokrasi/kerahasiaan data.

## Catatan Perbaikan (Urgent Fixes) [-x]
- [x] **Fix Role Method**: Menambahkan `hasRole()` di `User.php`.
- [x] **Restore Ghost Models**: Membuat ulang model `Patient` dan `MedicalRecord`.
- [x] **Mass Assignment Fix**: Audit `$fillable` di seluruh model bisnis.

## Rencana Pengembangan Selanjutnya
- [ ] UI/UX Polish untuk Dashboard Eksekutif.
- [ ] Laporan Analytics Kunjungan & Pendapatan.
- [ ] Portal Pasien & Notifikasi (WhatsApp/Email).

## Catatan Anomali & Solusi
- [!] **Bug Volume Mac**: File yang dibuat di container terkadang tidak muncul di host. Solusi: Re-write langsung melalui AI interface.
- [x] **Mac Metadata Cleanup**: Pembersihan file `._*` sudah dilakukan secara rutin di Volume host.
