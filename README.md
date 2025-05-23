# Frontend UAS 230302053

Repositori ini merupakan bagian dari tugas akhir mata kuliah Pemrograman Web. Proyek ini adalah aplikasi web berbasis Laravel yang menggunakan Vite untuk manajemen aset frontend.

## 📦 Teknologi yang Digunakan

- **Laravel** – Framework PHP untuk backend
- **Vite** – Bundler modern untuk frontend
- **Node.js & npm** – Untuk manajemen dependensi frontend
- **Composer** – Untuk manajemen dependensi PHP
- **Bootstrap** – Framework CSS untuk desain antarmuka

## ⚙️ Persyaratan Sistem

Pastikan Anda telah menginstal:

- PHP 8.1 atau lebih baru
- Composer
- Node.js v16 atau lebih baru
- npm (biasanya terinstal bersama Node.js)
- MySQL atau MariaDB

## 🚀 Langkah Menjalankan Proyek

### 1. Kloning Repositori

```bash
git clone https://github.com/Arfilal/frontend-uas-230302053.git
cd frontend-uas-230302053
```

### 2. Instal Dependensi Backend (PHP)

```bash
composer install
```

### 3. Instal Dependensi Frontend (Node.js)

```bash
npm install
```

### 4. Salin dan Konfigurasi File Environment

```bash
cp .env.example .env
```

Edit file `.env` dan sesuaikan konfigurasi database Anda:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=nama_pengguna
DB_PASSWORD=kata_sandi
```

### 5. Generate Application Key

```bash
php artisan key:generate
```

### 6. Migrasi dan Seed Database

```bash
php artisan migrate
```

*(Opsional jika tersedia seeder)*

```bash
php artisan db:seed
```

### 7. Jalankan Server Backend

```bash
php artisan serve
```

Akses di `http://127.0.0.1:8000`.

### 8. Jalankan Vite untuk Frontend

Buka terminal baru dan jalankan:

```bash
npm run dev
```

## 📁 Struktur Proyek

- `app/` – Logika aplikasi Laravel
- `resources/` – File Blade dan aset frontend
- `routes/` – Definisi rute aplikasi
- `public/` – Direktori publik untuk akses web
- `vite.config.js` – Konfigurasi Vite

## 🧪 Testing

*(Jika tersedia)*

```bash
php artisan test
```

## 📄 Lisensi

Proyek ini menggunakan lisensi MIT. Lihat file `LICENSE` untuk informasi lebih lanjut.
