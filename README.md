# Gastronomi Nasi Jamblang — Laravel 11 Edition

Landing page **Gastronomi Nasi Jamblang** yang sebelumnya dibangun dengan
**FastAPI + React** kini telah dikonversi ke **Laravel 11 (PHP 8.2+)**, lengkap
dengan **fitur dinamis Form Daftar Kunjungan + Data Pengunjung** yang
ditenagai MySQL/MariaDB.

## Tech Stack

| Layer        | Teknologi                                     |
|--------------|-----------------------------------------------|
| Framework    | Laravel 11                                    |
| PHP          | 8.2+ (dengan ekstensi `mysql`, `gd`, `zip`)   |
| Database     | **MySQL 5.7+ / MariaDB 10.3+**                |
| Templating   | Blade                                         |
| Styling      | Tailwind CSS 3.4 + custom CSS                 |
| Interaksi    | Alpine.js                                     |
| Animasi      | IntersectionObserver reveal-on-scroll         |
| Ikon         | Lucide (via CDN)                              |
| Font         | Cormorant Garamond + Manrope                  |
| Export Excel | phpoffice/phpspreadsheet                      |
| Build tool   | Vite (laravel-vite-plugin)                    |

## Struktur Proyek

```
laravel-app/
├── app/
│   ├── Http/Controllers/VisitorController.php   # Form handling, list, export, delete
│   └── Models/Visitor.php                       # Eloquent model
├── config/
│   └── content.php                              # Konten bilingual (landing + form + data)
├── database/
│   ├── migrations/..._create_visitors_table.php # Schema visitors
│   └── schema_mysql.sql                         # Dump skema (referensi)
├── public/
│   └── images/                                  # Aset gambar
├── resources/
│   ├── css/app.css                              # Tailwind + custom styles
│   ├── js/app.js                                # Alpine + reveal + scrollspy
│   └── views/
│       ├── landing.blade.php                    # Halaman utama (static)
│       ├── visitor_form.blade.php               # Form Daftar Kunjungan
│       ├── visitor_data.blade.php               # Data Pengunjung + search/pagination
│       └── partials/                            # Section landing page
├── routes/
│   └── web.php                                  # 5 route: home + visitor (form/store/index/export/delete)
└── ...
```

## Routes

| Method     | URL                       | Nama                  | Fungsi                                   |
|------------|---------------------------|-----------------------|------------------------------------------|
| `GET`      | `/`                       | `home`                | Landing page (ID/EN via `?lang=`)        |
| `GET`      | `/visitor-form`           | `visitor.form`        | Tampilkan form Daftar Kunjungan          |
| `POST`     | `/visitor-form`           | `visitor.store`       | Simpan kunjungan (validasi 2-100/email)  |
| `GET`      | `/visitor-data`           | `visitor.index`       | List + search (`?q=`) + pagination (10/page) |
| `GET`      | `/visitor-data/export`    | `visitor.export`      | Download `.xlsx` (mengikuti filter `?q=`)|
| `DELETE`   | `/visitor-data`           | `visitor.destroy_all` | Hapus semua data                         |

## Fitur

### Landing Page (static)
- 9 section persis seperti versi React: Hero, Philosophy, Ingredients,
  Techniques, Tasting, Serving, Experience, Nutrition, Ethics + Footer.
- Bilingual ID/EN via `?lang=en`.
- Scrollspy navbar, reveal-on-scroll, sticky transparent navbar, mobile menu,
  scroll-to-top.
- Tombol **"Daftar Kunjungan"** / **"Register Visit"** di navbar (desktop + mobile).
- Toast flash sukses setelah form berhasil di-submit.

### Form Daftar Kunjungan (`/visitor-form`)
- Field: **Nama Lengkap**, **Domisili**, **Email** (semua wajib).
- Validasi server-side (Laravel):
  - `nama_lengkap`: 2-100 karakter
  - `domisili`: 2-100 karakter
  - `email`: format valid, max 150 karakter
- Pesan error bilingual menempel di tiap field (border merah).
- CSRF protection.
- Setelah submit sukses → redirect ke landing page dengan toast.

### Data Pengunjung (`/visitor-data`)
- Tabel responsif (desktop) + card view (mobile).
- **Search** by nama / domisili / email.
- **Pagination** 10 per halaman, dengan navigasi prev/next + nomor halaman.
- **Export ke Excel** (`.xlsx`) — menghormati filter pencarian aktif.
- **Hapus Semua** dengan confirm dialog.
- Empty state berbeda untuk "belum ada data" vs "hasil pencarian kosong".
- Format tanggal `DD MMM YYYY, HH:mm` (locale ID/EN).

## Cara Menjalankan (Lokal)

### Prasyarat
- PHP 8.2+ dengan ekstensi: `mbstring`, `xml`, `curl`, `zip`, `bcmath`, `gd`, `mysql`/`pdo_mysql`
- Composer 2.x
- Node.js 18+ & npm/yarn
- **MySQL 5.7+ atau MariaDB 10.3+**

### Setup MySQL
```bash
# Login sebagai root MySQL
mysql -u root -p

CREATE DATABASE nasi_jamblang CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
CREATE USER 'laravel'@'localhost' IDENTIFIED BY 'laravel_password';
GRANT ALL PRIVILEGES ON nasi_jamblang.* TO 'laravel'@'localhost';
FLUSH PRIVILEGES;
exit;
```

### Setup Laravel
```bash
cd laravel-app

# 1. Install dependency PHP
composer install

# 2. Buat & isi .env
cp .env.example .env
php artisan key:generate

# Edit .env, sesuaikan dengan kredensial MySQL Anda:
#   DB_CONNECTION=mysql
#   DB_HOST=127.0.0.1
#   DB_PORT=3306
#   DB_DATABASE=nasi_jamblang
#   DB_USERNAME=laravel
#   DB_PASSWORD=laravel_password

# 3. Jalankan migration (membuat tabel visitors)
php artisan migrate

# 4. Install & build asset frontend
yarn install
yarn build           # untuk produksi
# atau: yarn dev    (hot-reload dev mode, jalankan di terminal terpisah)

# 5. Jalankan server Laravel
php artisan serve
```

Buka:
- Landing: <http://localhost:8000>
- Form: <http://localhost:8000/visitor-form>
- Data: <http://localhost:8000/visitor-data>

Versi Inggris: tambahkan `?lang=en` di URL mana pun.

## Deployment

Karena ini aplikasi PHP, **tidak kompatibel dengan platform Emergent**. Deploy
ke hosting PHP biasa (shared hosting, VPS, Laravel Forge, Cloudways, dll):

```bash
# Di server produksi:
composer install --no-dev --optimize-autoloader
yarn install && yarn build
php artisan migrate --force
php artisan config:cache route:cache view:cache
```

Pastikan file `.env` produksi punya `APP_ENV=production`, `APP_DEBUG=false`,
dan kredensial MySQL yang benar.

## Pemetaan dari Versi React → Laravel

| Versi React (lama)                            | Versi Laravel (baru)                                    |
|------------------------------------------------|----------------------------------------------------------|
| `frontend/src/pages/Landing.jsx`               | `resources/views/landing.blade.php` + 11 partials        |
| `frontend/src/pages/VisitorForm.jsx`           | `resources/views/visitor_form.blade.php` + controller    |
| `frontend/src/pages/VisitorData.jsx`           | `resources/views/visitor_data.blade.php` + controller    |
| `localStorage` (browser-only)                  | **MySQL** via Eloquent `Visitor` model + migration       |
| `react-hook-form` + `zod` validation           | Laravel `$request->validate()`                           |
| `xlsx` (SheetJS) di browser                    | `phpoffice/phpspreadsheet` di server                     |
| Pagination JS                                  | Laravel `paginate(10)` + Blade pagination               |
| `frontend/src/data/content.js`                 | `config/content.php` (landing + visitor_form + visitor_data) |
| `lucide-react`                                 | Lucide CDN (`window.lucide.createIcons()`)               |
| `framer-motion` `Reveal`                       | `.reveal` class + IntersectionObserver                   |
| React `useState`                               | Alpine.js `x-data`                                       |
| `react-router-dom`                             | Laravel routing                                          |
| `backend/server.py` (FastAPI)                  | — _(dihapus, fungsinya dipindah ke Laravel controllers)_ |
