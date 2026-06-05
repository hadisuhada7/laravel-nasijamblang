# PRD — Konversi Landing Page Nasi Jamblang ke Laravel 11

## Original Problem Statement
> Saya memiliki landing page dengan menggunakan phyton, bisakan ubah struktur nya menjadi menggunakan laravel
>
> Saya perlu fitur dinamis Form Daftar Kunjungan dan Data Kunjungan sesuai yang ada di versi React, serta menambahkan database MySQL + form handling.

Sumber: https://github.com/hadisuhada7/gastronominasijamblang.git
Target: Laravel 11 (PHP 8.2+) **dengan MySQL/MariaDB** untuk visitor management.

## Architecture
- **Framework**: Laravel 11
- **PHP**: 8.2.31 (ekstensi: mbstring, xml, curl, zip, gd, pdo_mysql)
- **Database**: MySQL 5.7+ / MariaDB 10.3+ (dikonfigurasi via `.env`)
- **Templating**: Blade
- **Konten**: `config/content.php` (PHP array bilingual ID/EN; mencakup landing + visitor_form + visitor_data)
- **Styling**: Tailwind CSS 3.4 + custom CSS
- **Interaktivitas**: Alpine.js
- **Animasi**: IntersectionObserver (.reveal) + scrollspy
- **Ikon**: Lucide via CDN
- **Font**: Cormorant Garamond + Manrope
- **Export Excel**: `phpoffice/phpspreadsheet`
- **Build**: Vite

Lokasi proyek: `/app/laravel-app/`

## Data Model

**Table `visitors`**:
- `id` (PK, autoincrement)
- `nama_lengkap` VARCHAR(100)
- `domisili` VARCHAR(100)
- `email` VARCHAR(150)
- `created_at` / `updated_at` (timestamps; indexed `created_at`)

## Routes

| Method | URL                    | Nama                  |
|--------|------------------------|-----------------------|
| GET    | `/`                    | `home`                |
| GET    | `/visitor-form`        | `visitor.form`        |
| POST   | `/visitor-form`        | `visitor.store`       |
| GET    | `/visitor-data`        | `visitor.index`       |
| GET    | `/visitor-data/export` | `visitor.export`      |
| DELETE | `/visitor-data`        | `visitor.destroy_all` |

## What's Been Implemented (Jun 5, 2026)

### Iterasi 1 (static landing)
- [x] Bootstrap Laravel 11 + instalasi PHP/Composer di environment
- [x] `config/content.php` bilingual mirror dari `data/content.js`
- [x] 9 section blade partials + footer
- [x] Navbar fixed dengan scrollspy, mobile menu, language toggle
- [x] Reveal-on-scroll & scroll-to-top
- [x] README + verifikasi visual ID & EN

### Iterasi 2 (fitur dinamis + MySQL) ⭐
- [x] Instalasi MariaDB di environment + buat database `nasi_jamblang` + user `laravel`
- [x] Migrasi `create_visitors_table` (nama_lengkap, domisili, email, timestamps, index created_at)
- [x] Model Eloquent `Visitor`
- [x] `VisitorController` dengan 5 action: `form`, `store`, `index`, `export`, `destroyAll`
- [x] View `visitor_form.blade.php` dengan validasi server-side (min 2 / max 100/150, email valid) — error bilingual
- [x] View `visitor_data.blade.php` dengan tabel responsif (desktop) + card view (mobile)
- [x] Search (`?q=`) di nama / domisili / email
- [x] Pagination 10/halaman (prev/next + nomor halaman, format `1 … N`)
- [x] Export ke Excel (`phpoffice/phpspreadsheet`) yang mengikuti filter pencarian aktif
- [x] Delete all dengan confirm dialog
- [x] CSRF protection
- [x] Tombol "Daftar Kunjungan" / "Register Visit" di navbar landing (desktop + mobile)
- [x] Flash toast sukses di landing setelah form submit
- [x] Empty state berbeda untuk "belum ada data" vs "hasil pencarian kosong"
- [x] Format tanggal locale `DD MMM YYYY, HH:mm` (id/en)
- [x] Dump schema MySQL (`database/schema_mysql.sql`) sebagai referensi
- [x] README dilengkapi dengan setup MySQL + dokumentasi route

### Verifikasi
- [x] HTTP 200 untuk `/`, `/visitor-form`, `/visitor-data` (ID & EN)
- [x] Submit form → record tersimpan di MySQL → redirect ke landing dengan toast
- [x] Validasi error muncul (border merah + pesan) saat input invalid
- [x] Search `?q=cirebon` filter dengan benar
- [x] Pagination: 15 record → page 1 (10 row) + page 2 (5 row)
- [x] Export `.xlsx` valid (verified via `file` command: "Microsoft Excel 2007+")
- [x] Screenshot ID + EN visitor data page tampil sempurna

## Personas
- **Pengelola situs / Admin**: ingin mengumpulkan data pengunjung yang tertarik dengan Gastronomi Nasi Jamblang, melihat list lengkap, mencari berdasarkan nama/kota, dan export untuk analisis offline.
- **Pengunjung**: ingin mengisi form kunjungan untuk dicatat sebagai bagian dari pengalaman eksplorasi kuliner.

## Catatan Deployment
**TIDAK DAPAT di-deploy via tombol Deploy Emergent** karena stack berbeda. User harus deploy ke hosting PHP (shared hosting, VPS, Laravel Forge, Cloudways) dengan MySQL/MariaDB tersedia. Production checklist tersedia di README.

## Prioritized Backlog
- **P2** — Rate limiting di endpoint POST `/visitor-form` (cegah spam).
- **P2** — Captcha (hCaptcha/Turnstile) di form.
- **P2** — Email konfirmasi otomatis ke pengunjung setelah submit.
- **P3** — Admin login (Laravel Breeze) untuk proteksi `/visitor-data`.
- **P3** — Detail page per visitor + edit/delete per row.
- **P3** — Chart/statistik kunjungan per kota / per bulan di dashboard.
- **P3** — SEO meta tags + JSON-LD Restaurant schema.
- **P3** — Dark mode toggle.

## Next Tasks
- (Opsional) Tambahkan rate limit `throttle:5,1` di route POST `visitor.store`.
- (Opsional) Tambahkan admin auth untuk `/visitor-data`.
- (Opsional) Push ke GitHub via tombol "Save to Github".
