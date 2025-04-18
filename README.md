<p align="center">
  <img src="https://via.placeholder.com/150" alt="JTI SIMPEN Logo" width="150"/>
</p>

# JTI SIMPEN - Sistem Informasi Manajemen Kompensasi

<p align="center">
  <strong>Sistem berbasis web untuk mempermudah pengelolaan kompensasi di Jurusan Teknologi Informasi, Politeknik Negeri Malang.</strong>
</p>

<p align="center">
  JTI SIMPEN dirancang untuk membantu mahasiswa mengajukan kompensasi, memilih pekerjaan, dan memvalidasi tugas dengan efisien. Sistem ini mendukung tiga tipe pengguna: <b>admin</b>, <b>dosen</b>, dan <b>mahasiswa</b>.
</p>

---

## 📋 Fitur Utama

- **Pengajuan Kompensasi**: *Mahasiswa* dapat mengajukan kompensasi melalui antarmuka web yang ramah pengguna.
- **Manajemen Pekerjaan**: *Dosen* dapat menambahkan dan mengelola daftar pekerjaan.
- **Validasi Pekerjaan**: *Admin* memiliki wewenang untuk memvalidasi pekerjaan yang diselesaikan.
- **Dashboard Admin**: Alat terpusat untuk mengelola semua data sistem.
- **Monitoring Mobile**: Aplikasi mobile untuk memantau status pekerjaan (khusus untuk pengguna tertentu).
- **Keamanan**: Sistem otentikasi untuk akses yang aman dan terlindungi.

---

## 🛠 Teknologi yang Digunakan

| Kategori         | Teknologi                     |
|------------------|-------------------------------|
| **Backend**      | Laravel (PHP Framework)       |
| **Frontend**     | HTML, CSS, JavaScript         |
| **Database**     | MySQL                        |
| **API**          | RESTful API                  |
| **Testing**      | Cypress (Automated Testing)   |
| **Desain**       | UI/UX untuk Web & Mobile      |
| **Alat Lain**    | StarUML, Visual Paradigm, IDE |

---

## 🚀 Prasyarat

Untuk menjalankan proyek ini, pastikan Anda memiliki:
- **PHP** >= 7.4
- **Composer** untuk dependensi PHP
- **MySQL** untuk database
- **Node.js** (opsional, untuk pengujian Cypress)
- **Git** untuk kloning repositori

---

## ⚙️ Cara Menjalankan Proyek

Ikuti langkah-langkah berikut untuk menjalankan aplikasi di lingkungan lokal:

1. **Kloning Repositori**  
   ```bash
   git clone https://github.com/rozaqi02/JTI_SIMPEN.git

Masuk ke Direktori Proyek  
bash

cd JTI_SIMPEN

Instal Dependensi  
bash

composer install

Konfigurasi Lingkungan  
Salin file .env.example menjadi .env:  
bash

cp .env.example .env

Edit file .env untuk mengatur koneksi database:  

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nama_database
DB_USERNAME=nama_pengguna
DB_PASSWORD=kata_sandi

Generate Application Key  
bash

php artisan key:generate

Jalankan Migrasi Database  
bash

php artisan migrate

Jalankan Server Lokal  
bash

php artisan serve

Akses aplikasi di http://localhost:8000.

(Opsional) Pengujian dengan Cypress  
Instal dependensi frontend:  
bash

npm install

Jalankan Cypress:  
bash

npx cypress open

 Struktur Proyek
plaintext

JTI_SIMPEN/
├── app/                # Logika aplikasi (Controllers, Models)
├── database/           # Migrasi dan seeder database
├── public/             # File statis (CSS, JS, gambar)
├── resources/          # Views (Blade templates) dan aset frontend
├── routes/             # Definisi rute web dan API
├── tests/              # Skrip pengujian (termasuk Cypress)
├── .env.example        # Contoh file konfigurasi
├── composer.json       # Dependensi PHP
├── package.json        # Dependensi Node.js (untuk Cypress)
└── README.md           # Dokumentasi ini

 Dokumentasi Proyek
Proyek ini dikembangkan melalui tahapan berikut:
Analisis Kebutuhan: Wawancara dengan stakeholder dan studi peraturan kompensasi JTI.

Perancangan: Pembuatan use case diagram, activity diagram, ERD, dan mockup UI/UX.

Pengembangan: Implementasi backend (Laravel), frontend, database, dan API.

Pengujian: Pengujian fungsional dan otomatis menggunakan Cypress.

Penyempurnaan: Perbaikan berdasarkan hasil pengujian.

Pelatihan Pengguna: Pelatihan untuk pengguna dan pembuatan dokumentasi.

Implementasi: Penerapan sistem ke lingkungan produksi.

 Tantangan dan Solusi
Tantangan: Pengalaman tim yang terbatas dalam proyek berskala besar.
Solusi: Kolaborasi dengan dosen pembimbing dan pembagian tugas yang jelas.  

Tantangan: Skenario pengujian awal kurang mendetail.
Solusi: Menyusun skenario pengujian untuk setiap fitur aplikasi.

 Kontribusi
Proyek ini dikembangkan sebagai bagian dari mata kuliah berbasis proyek di Politeknik Negeri Malang. Kontribusi tim meliputi:
Analisis dan Desain: Merancang sistem berdasarkan kebutuhan pengguna.

Pengembangan: Membuat backend, frontend, dan API.

Pengujian: Memastikan fungsionalitas melalui pengujian manual dan otomatis.

Dokumentasi: Menyusun panduan pengguna dan laporan proyek.

Ingin berkontribusi? Silakan buat pull request atau hubungi saya melalui GitHub.
 Lisensi
Proyek ini dilisensikan di bawah MIT License (LICENSE). Silakan gunakan sesuai ketentuan.
 Kontak
Untuk pertanyaan atau saran, hubungi saya melalui:  
GitHub: rozaqi02  

Email: abrorrozaqi@gmail.com
