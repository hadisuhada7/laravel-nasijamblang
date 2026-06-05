# PRD — Konversi Landing Page Nasi Jamblang ke Laravel 11

## Original Problem Statement
> Saya memiliki landing page dengan menggunakan phyton, bisakan ubah struktur nya menjadi menggunakan laravel

Sumber: https://github.com/hadisuhada7/gastronominasijamblang.git
Target: Laravel 11 (PHP 8.2+), static landing page (tanpa database).

## Architecture
- **Framework**: Laravel 11
- **PHP**: 8.2.31
- **Templating**: Blade (1 layout `landing.blade.php` + 11 partial section)
- **Konten**: `config/content.php` (PHP array bilingual ID/EN)
- **Styling**: Tailwind CSS 3.4 + custom CSS (mereplikasi palet & font versi React)
- **Interaktivitas**: Alpine.js (mobile menu, navbar scroll state, scroll-to-top)
- **Animasi reveal-on-scroll**: IntersectionObserver vanilla JS (`.reveal` class)
- **Scrollspy**: IntersectionObserver di `resources/js/app.js`
- **Ikon**: Lucide via CDN
- **Font**: Cormorant Garamond + Manrope (Google Fonts)
- **Build**: Vite

Lokasi proyek: `/app/laravel-app/`

## What's Been Implemented (Jun 5, 2026)
- [x] Bootstrap proyek Laravel 11 + instalasi PHP/Composer di environment
- [x] Konfigurasi `config/content.php` bilingual (ID/EN) mirror dari `data/content.js`
- [x] 9 section blade partials: hero, philosophy, ingredients, techniques, tasting, serving, experience, nutrition, ethics + footer
- [x] Navbar fixed dengan scrollspy + transparent→solid saat scroll
- [x] Mobile menu (Alpine.js)
- [x] Language toggle via query string `?lang=id|en`
- [x] Reveal-on-scroll animation menggantikan framer-motion
- [x] Scroll-to-top button
- [x] Semua `data-testid` versi React dipertahankan
- [x] Aset gambar dipindah ke `public/images/`
- [x] Build production berhasil (vite build)
- [x] Verifikasi visual screenshot: hero, philosophy, techniques, ethics — semua render identik dengan versi React
- [x] HTTP 200 untuk `/` (ID) dan `/?lang=en` (EN)
- [x] README.md dengan instruksi setup & deployment

## Personas
- **Owner / Pengelola situs**: butuh landing page elegan untuk mempromosikan kuliner Nasi Jamblang Cirebon, lebih nyaman pakai stack PHP/Laravel untuk hosting tradisional.
- **Pengunjung**: ingin membaca tentang sejarah, bahan, teknik, dan etika kuliner Nasi Jamblang dalam Bahasa Indonesia atau Inggris.

## Core Requirements (Static)
1. Visual identik dengan versi React (warna, font, layout, animasi).
2. Bilingual ID/EN.
3. Tanpa database (static).
4. Berjalan di stack Laravel/PHP standard.

## Catatan Deployment
Aplikasi ini **TIDAK DAPAT di-deploy via tombol Deploy Emergent** karena Emergent menggunakan stack Python/Node. User harus deploy ke hosting PHP (shared hosting, VPS, Laravel Forge, Cloudways, dll).

## Prioritized Backlog (jika ingin lanjut)
- **P1** — Re-integrasi fitur "Daftar Kunjungan" / "Visitor Data" (butuh database MySQL/PostgreSQL/SQLite).
- **P2** — Setup `php artisan optimize` & caching untuk produksi.
- **P2** — SEO meta tags lanjutan (Open Graph, Twitter Card, JSON-LD Restaurant schema).
- **P3** — Sitemap.xml dinamis + robots.txt.
- **P3** — Form kontak dengan email notification.
- **P3** — Dark mode toggle.

## Next Tasks
- User download `/app/laravel-app/` dan jalankan `composer install && yarn install && yarn build && php artisan serve` di mesin lokal.
- (Opsional) Tambahkan fitur dinamis bila diminta.
