# Changelog - VISAwork

Semua perubahan penting pada proyek VISAwork akan dicatat di dokumen ini.

## [v0.1.0-alpha] - 2026-10-28

### 🎨 Frontend & UI/UX
- Font System: Migrasi dari font Poppins ke Inter untuk tampilan finansial/enterprise yang lebih presisi dan profesional.
- Hero Section:
  - Menyesuaikan *padding/spacing* Hero Section agar elemen "Kelola Keuangan" posisinya lebih pas di tengah pandangan mata.
  - Memperbaiki *line-break* pada judul utama agar tidak menggantung.
  - Menghapus titik indikator (*bullet dot*) pada badge status `Tahap Pengembangan v0.1.0`.
  - Menghapus border kaku pada container preview gambar dan menggantinya dengan *soft drop-shadow* yang elegan.
- **Landing Page**: Menyempurnakan visual hierarchy, tombol CTA (*Call to Action*), serta menyelaraskan navigasi dengan sistem autentikasi.

### 🔐 Autentikasi & Backend
- **Laravel Breeze Integration**: Mengintegrasikan Laravel Breeze untuk sistem autentikasi bawaan (Register, Login, Logout, dan Profile Management).
- **Database Fixes**:
  - Mengubah struktur kolom `id` pada tabel `users` dari `CHAR(36)` (UUID) menjadi `BIGINT UNSIGNED AUTO_INCREMENT` untuk menyelesaikan konflik `QueryException (1364 Field 'id' doesn't have a default value)`.
  - Menyelesaikan masalah skema *Foreign Key* yang tidak cocok (*incompatible*) pada tabel relasi `goals`.
- **Database Dump**: Menambahkan file `database.sql` ke dalam repositori untuk mempermudah sinkronisasi data awal antar kolaborator.