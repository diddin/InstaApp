# 📸 InstaApp

InstaApp adalah aplikasi sederhana seperti Instagram yang dibangun menggunakan Laravel.  
Kamu bisa membuat akun, upload gambar, memberi like, dan komentar di postingan pengguna lain.

---

## 🚀 Fitur

- ✅ Autentikasi (register & login) — menggunakan Laravel Breeze
- 🖼️ Post gambar dengan caption
- ❤️ Like & 💬 komentar di setiap post
- 🔒 Hak akses untuk edit/hapus post & komentar
- 🌐 API versi v1 untuk frontend atau aplikasi mobile

---

## 📦 Teknologi

- Laravel 10
- Breeze (Blade + Alpine.js)
- TailwindCSS
- REST API (versi v1)
- GitHub Actions (CI/CD)

---

## 🛠️ Cara Menjalankan

```bash
git clone https://github.com/namamu/InstaApp.git
cd InstaApp
composer install
cp .env.example .env
php artisan key:generate
php artisan migrate
php artisan serve
```

Pastikan database sudah dikonfigurasi di `.env`.

---

## 🔐 API Authentication

Menggunakan Laravel Sanctum untuk login dan akses API:
- Endpoint: `POST /api/login`
- Header: `Authorization: Bearer {token}`

---

## 🌍 API Endpoint Contoh

- `GET /api/posts` — Lihat semua postingan
- `POST /api/posts` — Buat post baru
- `GET /api/posts/{id}` — Detail post
- `POST /api/posts/{id}/like` — Like atau unlike post
- `POST /api/posts/{id}/comments` — Tambah komentar
- `DELETE /api/posts/{id}/comments/{commentId}` — Hapus komentar

---

## ⚙️ CI/CD

Project ini otomatis ter-*deploy* ke staging & production saat push ke branch:
- `develop` → Staging
- `main` → Production

Menggunakan GitHub Actions dengan SSH deploy.

---

## 🙏 Terima Kasih

InstaApp adalah proyek latihan pribadi — silakan fork dan eksplorasi sendiri!  
Terinspirasi dari UI sederhana Instagram, tapi versi ringan dan Laravel-native.

---

<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com)**
- **[Tighten Co.](https://tighten.co)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Redberry](https://redberry.international/laravel-development)**
- **[Active Logic](https://activelogic.com)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
