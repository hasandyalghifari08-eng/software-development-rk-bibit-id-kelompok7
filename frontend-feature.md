# Frontend Feature

- Nama: Haris Ardian Ramadhana
- Role: Front-End Developer
- Mata Kuliah: Software Development

## Peran

Bertanggung jawab atas tampilan dan interaksi antarmuka pengguna.

## Kontribusi

- Merancang struktur halaman dan layout UI
- Membuat komponen tampilan (HTML/CSS/JS)
- Mengintegrasikan tampilan dengan fitur backend

## Yang sudah dikerjakan

Halaman untuk pengunjung (folder public):
- Beranda (index.html)
- Katalog bibit dengan pencarian dan filter kategori (katalog.html)
- Detail bibit (detail.html)
- Tentang toko (tentang.html)
- Cara pemesanan dan penanganan (pemesanan.html)

Halaman untuk admin (folder admin):
- Login (login.php)
- Kelola bibit (admin.php)
- Form tambah/ubah bibit (admin-form.php)
- Info toko (admin-toko.php)

Fitur yang sudah jalan: status stok tersedia atau habis, tombol pesan lewat
WhatsApp, Shopee, dan TikTok Shop, serta tampilan yang rapi di layar HP
(sudah dicek mulai lebar 360 px).

## Teknologi

HTML, CSS, JavaScript, dan Bootstrap.

## Cara menjalankan

Buka folder public di VS Code, klik kanan index.html, lalu pilih
"Open with Live Server". Data sementara diambil dari folder data, jadi bisa
dicoba tanpa backend.

## Catatan integrasi

Untuk memakai data dari backend, ubah PAKAI_API di public/js/api.js menjadi true.
Mode ini harus dijalankan lewat XAMPP, bukan Live Server.

## Status

Implementasi tahap 1 untuk frontend sudah selesai. Tinggal menunggu backend
untuk tahap integrasi.