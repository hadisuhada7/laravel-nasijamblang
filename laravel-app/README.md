# Gastronomi Nasi Jamblang — Laravel 11 Edition

Landing page **Gastronomi Nasi Jamblang** yang sebelumnya dibangun dengan
**FastAPI + React** kini telah dikonversi ke **Laravel 11 (PHP 8.2+)** sebagai
**static landing page** (tidak menggunakan database).

## Tech Stack

| Layer        | Teknologi                                     |
|--------------|-----------------------------------------------|
| Framework    | Laravel 11                                    |
| PHP          | 8.2+                                          |
| Templating   | Blade                                         |
| Styling      | Tailwind CSS 3.4 + custom CSS                 |
| Interaksi    | Alpine.js (mobile menu, scroll, lang toggle)  |
| Animasi      | IntersectionObserver reveal-on-scroll         |
| Ikon         | Lucide (via CDN)                              |
| Font         | Cormorant Garamond + Manrope                  |
| Build tool   | Vite (laravel-vite-plugin)                    |

## Struktur Proyek

```
laravel-app/
├── app/                                    # (default Laravel app)
├── config/
│   └── content.php                         # Konten bilingual (ID/EN)
├── public/
│   └── images/                             # Aset gambar (daun jati, cumi, dll)
├── resources/
│   ├── css/app.css                         # Tailwind + custom styles
│   ├── js/app.js                           # Alpine + reveal + scrollspy
│   └── views/
│       ├── landing.blade.php               # Halaman utama
│       └── partials/
│           ├── navbar.blade.php
│           ├── hero.blade.php
│           ├── philosophy.blade.php
│           ├── ingredients.blade.php
│           ├── techniques.blade.php
│           ├── tasting.blade.php
│           ├── serving.blade.php
│           ├── experience.blade.php
│           ├── nutrition.blade.php
│           ├── ethics.blade.php
│           └── footer.blade.php
├── routes/
│   └── web.php                             # Route `/` dengan ?lang=id|en
├── tailwind.config.js
├── vite.config.js
├── composer.json
└── package.json
```

## Fitur

- 9 section persis seperti versi React: Hero, Philosophy, Ingredients,
  Techniques, Tasting, Serving, Experience, Nutrition, Ethics + Footer.
- **Bilingual (ID/EN)** via query string `?lang=en`.
- **Scrollspy navbar** — section aktif di-highlight saat scroll.
- **Reveal-on-scroll animation** (mengganti `framer-motion`).
- **Sticky transparent navbar** yang berubah saat di-scroll.
- **Mobile menu** dengan Alpine.js.
- **Scroll-to-top button** muncul setelah 400px scroll.
- Semua `data-testid` dari versi React dipertahankan.

## Cara Menjalankan (Lokal)

### Prasyarat
- PHP 8.2+
- Composer 2.x
- Node.js 18+ & npm/yarn

### Setup
```bash
cd laravel-app

# 1. Install dependency PHP
composer install

# 2. Buat file .env (sudah ada, copy dari .env.example bila perlu)
cp .env.example .env
php artisan key:generate

# 3. Install & build asset frontend
yarn install   # atau: npm install
yarn build     # produksi
# atau untuk dev dengan hot-reload:
#   yarn dev    (jalankan di terminal terpisah)

# 4. Jalankan server Laravel
php artisan serve
```

Buka <http://localhost:8000> di browser. Untuk versi Inggris:
<http://localhost:8000/?lang=en>

## Catatan Konfigurasi

- `SESSION_DRIVER=file` dan `CACHE_STORE=file` di `.env` agar tidak butuh
  database (proyek ini sepenuhnya static).
- Tidak ada migration / model / database yang dibutuhkan.

## Deployment

Karena ini aplikasi PHP, **tidak kompatibel dengan platform Emergent** (yang
menggunakan Python/Node). Deploy ke hosting PHP biasa (shared hosting, VPS,
Forge, Cloudways, dll). Pastikan jalankan `composer install --no-dev
--optimize-autoloader` dan `yarn build` saat deploy.

## Pemetaan dari Versi React → Laravel

| Versi React (lama)                  | Versi Laravel (baru)                       |
|-------------------------------------|--------------------------------------------|
| `frontend/src/pages/Landing.jsx`    | `resources/views/landing.blade.php` + partials |
| `frontend/src/data/content.js`      | `config/content.php`                       |
| `frontend/public/images/`           | `public/images/`                           |
| `lucide-react`                      | Lucide CDN (`window.lucide.createIcons()`) |
| `framer-motion` `Reveal`            | `.reveal` class + IntersectionObserver     |
| React `useState` (menu, scroll)     | Alpine.js `x-data`                         |
| `react-router-dom`                  | Laravel route                              |
| `backend/server.py` (FastAPI)       | — _(dihapus, tidak diperlukan)_            |
