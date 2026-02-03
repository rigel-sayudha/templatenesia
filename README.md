# Templatenesia

Templatenesia adalah template toko online (e-commerce) berbasis Laravel yang dirancang untuk mempercepat pengembangan situs penjualan produk digital maupun fisik. Template ini sudah menyertakan fitur dasar seperti manajemen produk, kategori, metode pembayaran, order, serta integrasi notifikasi dan email.

## Fitur utama
- Manajemen produk, kategori, testimonial, FAQ, dan voucher
- Sistem pemesanan dan notifikasi (email / WhatsApp channel)
- Halaman checkout dan integrasi payment gateway (contoh: Midtrans)
- Panel admin sederhana menggunakan Filament
- Seeder dan migrasi untuk data contoh

## Persyaratan
- PHP 8.1+ (atau sesuai konfigurasi project)
- Composer
- Database MySQL / MariaDB / PostgreSQL

## Instalasi singkat
1. Clone repository:

```bash
git clone https://github.com/rigel-sayudha/templatenesia.git
cd templatenesia
```

2. Install dependensi:

```bash
composer install
npm install
npm run build   # atau npm run dev untuk development
```

3. Salin file `.env` dan atur konfigurasi database serta kredensial lain:

```bash
cp .env.example .env
php artisan key:generate
```

4. Jalankan migrasi dan seeder (opsional):

```bash
php artisan migrate --seed
```

5. Jalankan server lokal:

```bash
php artisan serve
```

6. Akses aplikasi di `http://127.0.0.1:8000`

## Konfigurasi tambahan
- Atur kredensial layanan di `config/services.php` dan `.env` (contoh: Midtrans, WhatsApp service)
- Periksa file `database/seeders` untuk data contoh dan akun admin

## Kontribusi
Perbaikan dan pengembangan fitur sangat dipersilakan. Silakan buat issue atau pull request ke repository utama.

## Lisensi
Project ini menggunakan lisensi MIT — lihat `LICENSE` jika tersedia.

---
_README singkat dibuat otomatis. Ubah bagian konfigurasi/fitur sesuai kebutuhan proyek Anda._
