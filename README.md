Paham, ini sudah saya susun ulang agar jauh lebih rapi, enak dibaca, dan diberi jarak yang pas.

Saya juga sudah menambahkan penjelasan singkat di bagian awal (seperti membuka terminal sebelum melakukan *clone*), serta syarat aplikasi apa saja yang minimal harus sudah ter-install di laptop tanpa harus mengajarinya dari nol.

Berikut hasilnya:

🏢 **VISAwork - Financial Management Platform**

VISAwork adalah platform manajemen keuangan dan operasional usaha berbasis web yang dirancang dengan tampilan bersih, responsif, dan profesional (enterprise-grade).

🛠️ **Tech Stack & Environment**

* 🖥️ **Framework:** Laravel 13
* 🔐 **Authentication:** Laravel Breeze
* 🎨 **Styling:** Tailwind CSS (Font: Inter)
* 🗄️ **Database:** MySQL / MariaDB (via Laragon & HeidiSQL)
* ⚡ **Asset Bundler:** Vite

---

🚀 **Panduan Memulai (Setup Project)**

⚠️ **Persiapan Awal:**
Pastikan di komputer atau laptop kamu sudah ter-install aplikasi dasar seperti **Git**, **Composer**, **Node.js**, dan lokal server seperti **Laragon** atau **XAMPP**.

Jika sudah siap, ikuti langkah-langkah di bawah ini:

**1. Clone & Tarik Repositori**
Buka **Terminal**, **Git Bash**, atau **Command Prompt** (CMD). Arahkan ke folder tempat kamu biasa menyimpan project kodingan, lalu ketik perintah berikut:

`git clone https://github.com/ridwanpauji/VISAwork-999.git`
`cd VISAwork-999`
`git pull origin main`

**2. Install Dependensi PHP & Frontend**
Masih di dalam terminal yang sama, kamu perlu mengunduh semua *library* pendukung project ini.

Install library PHP (Laravel & Breeze):
`composer install`

Install & Build asset Tailwind CSS:
`npm install`
`npm run build`

**3. Konfigurasi Environment (.env)**
Sekarang kita perlu mengatur koneksi project ke komputermu. Ketik perintah ini di terminal:

`cp .env.example .env`
`php artisan key:generate`

Setelah itu, buka file `.env` di text editor kamu (misalnya VS Code). Cari bagian database, dan pastikan isinya seperti ini:

`DB_CONNECTION=mysql`
`DB_HOST=127.0.0.1`
`DB_PORT=3306`
`DB_DATABASE=visawork`
`DB_USERNAME=root`
`DB_PASSWORD=`

**4. Migration & Import Database**
Langkah selanjutnya adalah membuat struktur tabel di database. Jalankan perintah ini di terminal:

`php artisan migrate:fresh`

*(Opsional) Jika Ingin Menggunakan Data Akun Test:*
Agar tidak perlu buat akun dari awal, kamu bisa memasukkan data yang sudah ada:

* Buka aplikasi database kamu (HeidiSQL / phpMyAdmin).
* Pilih database bernama `visawork`.
* Klik menu **File**, lalu pilih **Run SQL file...** (atau tab Import di phpMyAdmin).
* Pilih file `database.sql` yang ada di dalam folder utama project ini.

**5. Jalankan Server Lokal**
Agar website bisa dibuka di browser, kamu harus menyalakan dua server secara bersamaan. Silakan buka **dua jendela terminal baru** yang mengarah ke folder project ini.

Terminal 1 (Untuk menjalankan Backend PHP):
`php artisan serve`

Terminal 2 (Untuk memuat perubahan desain / UI):
`npm run dev`

Terakhir, buka browser favoritmu dan ketik alamat ini: **http://localhost:8000**

---

✨ **Ringkasan Perubahan UI & Database**

* 🔤 **Typography:** Seluruh aplikasi menggunakan font *Inter* dari Google Fonts untuk pembacaan angka dan teks finansial yang lebih presisi.
* 🖼️ **Hero Section:** Spacing atas disesuaikan, pemotongan baris judul dibuat seimbang, badge status tanpa titik indikator, serta preview gambar menggunakan *soft drop-shadow* tanpa garis tepi yang kaku.
* 🗃️ **Database Architecture:** Kolom ID pada tabel users sudah diubah menggunakan format standar Laravel Breeze (`BIGINT UNSIGNED AUTO_INCREMENT`) untuk mencegah error ketidakcocokan tipe data saat membuat relasi antar tabel (Foreign Key).

---

🤝 **Workflow Kolaborasi Git (Wajib Bagi Tim)**

Agar progres kodingan dan isi database di semua laptop anggota tim selalu sama dan tidak bentrok, biasakan rutinitas berikut:

**A. Sebelum Mulai Koding (Setiap Awal Sesi):**
Buka terminal dan tarik update terbaru dari teman satu tim kamu:

`git pull origin main`
`composer install`
`npm install && npm run build`
`php artisan migrate`

**B. Setelah Selesai Koding / Update Fitur:**
Apakah kamu menambahkan tabel atau data penting di database hari ini? Jika iya, **wajib** export database `visawork` dari HeidiSQL, lalu simpan dengan nama `database.sql` di folder utama project (timpa file yang lama).

Setelah itu, simpan semua perubahan kodingan kamu dengan perintah:

`git add .`
`git commit -m "feat: penjelasan singkat tentang apa yang kamu kerjakan"`
`git push origin main`