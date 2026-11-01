# Changelog - VISAwork

Semua perubahan penting pada proyek VISAwork dicatat dalam dokumen ini.

## [v1.0.0] - 2026-11-01

### Frontend & UI/UX
- Font System: Migrasi dari font Poppins ke Inter untuk tampilan finansial dan enterprise yang lebih presisi serta profesional.
- Hero Section:
  - Menyesuaikan padding dan spacing Hero Section agar elemen "Kelola Keuangan" posisinya lebih pas di tengah pandangan mata.
  - Memperbaiki line-break pada judul utama agar tidak menggantung.
  - Menghapus titik indikator pada badge status pengembangan versi aplikasi.
  - Menghapus border kaku pada container preview gambar dan menggantinya dengan border bersih serta tata letak responsif.
- Landing Page & Navigasi:
  - Menyempurnakan visual hierarchy, tombol CTA, serta menyelaraskan navigasi dengan sistem autentikasi dan menu standar aplikasi keuangan (Fitur, Solusi, Harga, Panduan, Perusahaan).
  - Menambahkan fitur pilihan bahasa (Indonesia dan English US) secara manual untuk fleksibilitas pengguna.
  - Menambahkan area/placeholder gambar pada bagian Fitur Utama, Keunggulan, dan Tentang Perusahaan.

### Autentikasi & Backend
- Laravel Breeze Integration: Mengintegrasikan Laravel Breeze untuk sistem autentikasi bawaan (Register, Login, Logout, dan Profile Management).
- Database Fixes:
  - Mengubah struktur kolom id pada tabel users dari CHAR(36) (UUID) menjadi BIGINT UNSIGNED AUTO_INCREMENT untuk menyelesaikan konflik QueryException.
  - Menyelesaikan masalah skema Foreign Key yang tidak kompatibel pada tabel relasi goals.
- Database Dump: Menambahkan file database.sql ke dalam repositori untuk mempermudah sinkronisasi data awal antar kolaborator.