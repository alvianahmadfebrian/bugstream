# BugStream - Sistem Manajemen Bug

BugStream adalah konsol pelacakan dan manajemen bug enterprise yang responsif dan berjalan secara real-time. Aplikasi ini dilengkapi dengan autentikasi multi-role, dashboard analitik terpadu, grafik distribusi prioritas yang dinamis, lini masa komentar, dan pengelolaan user admin (CRUD).

---

## 👥 Akun Login & Hak Akses

Semua akun menggunakan kata sandi yang sama: **`pisangkeju`**

| Peran (Role) | Nama / Username | Email | Deskripsi / Hak Akses |
| :--- | :--- | :--- | :--- |
| **Super Admin** | `masteryoda` | `yoda@jedi.com` | Akses penuh sistem: Pengelolaan akun pengguna (CRUD), dasbor statistik global, dan menugaskan ulang bug. |
| **Support Dev (QA)** | `obiwan` | `obiwan@jedi.com` | Melaporkan bug baru, melihat dasbor statistik khusus bug buatannya sendiri, dan melakukan pengujian ulang (*retest*) atau menutup bug. |
| **Developer** | `anakin` | `anakin@jedi.com` | Hanya dapat melihat daftar bug yang ditugaskan kepada dirinya; memperbarui status pengerjaan bug (Mulai Progress -> Selesai Diperbaiki). |

---

## 🚀 Panduan Instalasi

Ikuti langkah-langkah di bawah ini untuk memasang dan menjalankan proyek secara lokal.

### 📋 Prasyarat
Pastikan komputer Anda sudah terpasang:
- **PHP 8.2+** (dengan ekstensi SQLite aktif)
- **Composer**
- **Node.js & NPM**

### 💻 Langkah Pemasangan

1. **Kloning Repositori**
   ```bash
   git clone https://github.com/alvianahmadfebrian/bugstream.git
   cd bugstream
   ```

2. **Pasang Library PHP dan Javascript**
   ```bash
   composer install
   npm install
   ```

3. **Salin File Konfigurasi Environment**
   Salin file contoh konfigurasi ke file `.env` aktif:
   ```bash
   cp .env.example .env
   ```

4. **Buat Application Key**
   ```bash
   php artisan key:generate
   ```

5. **Buat Database SQLite Baru**
   Buat file database kosong di folder database:
   ```bash
   touch database/database.sqlite
   ```

6. **Jalankan Migrasi & Pengisian Akun Bawaan (Seeder)**
   Jalankan perintah ini untuk membangun tabel database dan membuat akun `masteryoda`, `obiwan`, dan `anakin`:
   ```bash
   php artisan migrate:fresh --seed
   ```

7. **Jalankan Server Lokal**
   Mulai server pengembangan Laravel:
   ```bash
   php artisan serve
   ```
   Buka peramban (browser) Anda dan akses alamat: `http://127.0.0.1:8000`

---

## 🧪 Menjalankan Pengujian Otomatis (Unit Testing)

Untuk menjalankan seluruh suite pengujian fitur (termasuk verifikasi pembatasan role, pembaruan profil, dan CRUD):
```bash
php artisan test
```
