# 📚 Sistem Informasi Perpustakaan

Sistem Informasi Perpustakaan merupakan aplikasi berbasis **Laravel** yang dibuat sebagai **Proyek Akhir Mata Kuliah Web Programming 2**. Aplikasi ini bertujuan untuk memudahkan pengelolaan data perpustakaan, mulai dari data buku, anggota, hingga proses peminjaman dan pengembalian buku.

## ✨ Fitur

* Login dan autentikasi pengguna
* Dashboard admin
* Manajemen data buku (Tambah, Ubah, Hapus, Lihat)
* Manajemen kategori buku
* Manajemen data anggota
* Manajemen peminjaman buku
* Manajemen pengembalian buku
* Pencarian data buku
* Validasi data menggunakan Laravel
* Tampilan responsif menggunakan Bootstrap

## 🛠️ Teknologi yang Digunakan

* PHP 8.x
* Laravel 11
* MySQL
* Bootstrap 5
* HTML5
* CSS3
* JavaScript

## 📋 Persyaratan Sistem

Pastikan perangkat telah terpasang:

* PHP 8.x atau lebih baru
* Composer
* MySQL
* Node.js dan npm (opsional untuk menjalankan Vite)
* Git

## 🚀 Cara Instalasi

1. Clone repository.

```bash
git clone <url-repository>
```

2. Masuk ke folder project.

```bash
cd nama-project
```

3. Install dependency.

```bash
composer install
```

4. Salin file environment.

```bash
cp .env.example .env
```

5. Generate application key.

```bash
php artisan key:generate
```

6. Atur konfigurasi database pada file `.env`.

```env
DB_DATABASE=perpustakaan
DB_USERNAME=root
DB_PASSWORD=
```

7. Jalankan migrasi database.

```bash
php artisan migrate
```

Jika tersedia seeder:

```bash
php artisan db:seed
```

8. Install dependency frontend.

```bash
npm install
npm run dev
```

9. Jalankan aplikasi.

```bash
php artisan serve
```

Aplikasi dapat diakses melalui:

```
http://127.0.0.1:8000
```

## 📁 Struktur Project

```
app/
bootstrap/
config/
database/
public/
resources/
routes/
storage/
tests/
```

## 📷 Tampilan Aplikasi

Tambahkan screenshot berikut pada repository:

* Halaman Login
* Dashboard
* Data Buku
* Data Anggota
* Peminjaman Buku
* Pengembalian Buku

## 👨‍💻 Pengembang

**Nama:** Nabila Tsurayya

**Mata Kuliah:** Web Programming 2

**Framework:** Laravel

## 📄 Lisensi

Project ini dibuat untuk keperluan akademik sebagai Proyek Akhir Mata Kuliah Web Programming 2.
