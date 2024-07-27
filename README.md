# News App

## Deskripsi
News App adalah aplikasi web untuk menampilkan berita terkini.

## Prasyarat
- PHP >= 8.1
- Composer >= 2.x.x
- Node.js >= 20.xx.x
- NPM => 10.2.3
- PostgreSQL => 14.12

## Instalasi

### Clone Repository
Clone repository ini ke direktori lokal Anda:

```bash

git clone https://github.com/mnasdar/Tickets.git

cd news-app

```

### Instal Dependensi
Instal dependensi PHP menggunakan Composer:

```bash
composer install
```

Instal dependensi Node.js menggunakan npm:
```bash
npm install
```

### Konfigurasi Environment
Salin file .env.example ke .env dan sesuaikan konfigurasi environment Anda:

```bash
cp .env.example .env
```

### Konfigurasi Postgresql
pastikan anda telah membuat ```database``` di postgresq. Masuk ke file .env dan sesuaikan konfigurasi database Anda:

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=tickets
DB_USERNAME=root
DB_PASSWORD=
```

### Generate Key Laravel
Buat key baru project laravel:
```bash
php artisan key:generate
```

### Konfigurasi file static
buat penyimpanan gambar news:
```bash
php artisan storage:link
```

### Migrasi inisial laravel
menjalankan semua migrasi awal project laravel:

```bash
php artisan migrate

```

### Insert data awal
memasukan data awal ke project laravel:

```bash
php artisan db:seed

```

### Build Assets
Build aset menggunakan Vite:

```bash
npm run build
```

### Jalankan Server
Jalankan server pengembangan Laravel::

```bash
php artisan serve
```
