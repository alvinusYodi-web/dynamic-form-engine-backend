# Dynamic Form Engine - Backend

Backend API untuk Dynamic Form Engine yang dibangun menggunakan **Laravel** dan **MySQL**.

Aplikasi ini membaca struktur form dari file JSON, menyimpannya ke database dalam bentuk relational data, kemudian menyediakan API yang digunakan oleh frontend untuk menampilkan form secara dinamis dan menyimpan jawaban pengguna.

## Technology Stack

* PHP
* Laravel
* MySQL
* Composer
* REST API

## Development Environment

Project ini dikembangkan dan diuji menggunakan:

* **Laragon**
* PHP
* MySQL

Namun, project juga dapat dijalankan menggunakan **XAMPP** atau local PHP environment lainnya selama PHP, Composer, dan MySQL tersedia.

> **Recommended:** Laragon atau XAMPP pada Windows.

---

# Application Flow

Alur backend aplikasi:

```text
form.json
    │
    ▼
FormImporter
    │
    ▼
MySQL Database
    │
    ▼
Laravel API
    │
    ├── GET  /api/form
    │
    └── POST /api/form
            │
            ▼
      Form Submission
            │
            ▼
        MySQL Database
```

### 1. Form Definition

Struktur form berasal dari:

```text
storage/app/feeds/form.json
```

File JSON berisi informasi seperti:

* Section
* Payload / field
* Field type
* Description
* Options

Contoh jenis field yang didukung:

* Text
* Long Text
* Radio Button
* Checkbox

### 2. Import JSON

JSON tidak langsung digunakan oleh frontend.

File JSON terlebih dahulu diproses oleh `FormImporter`.

Import dilakukan menggunakan Artisan command:

```bash
php artisan form:import
```

Command tersebut akan membaca:

```text
storage/app/feeds/form.json
```

kemudian menyimpan struktur form ke database.

### 3. Database

Struktur form disimpan secara relational ke beberapa tabel:

```text
sections
    │
    └── payloads
            │
            └── options
```

Sedangkan jawaban pengguna disimpan melalui:

```text
risk_events
    │
    └── answers
            │
            └── answer_options
```

Database juga menggunakan index pada beberapa foreign key untuk membantu performa query.

### 4. API

Setelah form berhasil diimport, Laravel menyediakan API:

```http
GET /api/form
```

Digunakan untuk mengambil struktur form dari database.

Untuk menyimpan jawaban:

```http
POST /api/form
```

Jawaban pengguna kemudian disimpan ke database.

---

# Requirements

Pastikan komputer memiliki:

* PHP 8.x
* Composer
* MySQL
* Git

## Recommended Environment

Project ini dikembangkan menggunakan **Laragon**.

Laragon direkomendasikan karena menyediakan environment PHP dan MySQL yang mudah digunakan pada Windows.

## Alternative Environment

Project juga dapat dijalankan menggunakan **XAMPP**.

Jika menggunakan XAMPP, pastikan:

* Apache berjalan
* MySQL berjalan
* PHP tersedia
* Composer tersedia

Lokasi folder project dapat berbeda tergantung environment yang digunakan.

**Tidak ada path tertentu yang diwajibkan oleh aplikasi.**

Contoh Laragon:

```text
C:\laragon\www\dynamic-form-engine-backend
```

Contoh XAMPP:

```text
C:\xampp\htdocs\dynamic-form-engine-backend
```

---

# Installation

## 1. Clone Repository

Clone repository:

```bash
git clone https://github.com/alvinusYodi-web/dynamic-form-engine-backend.git
```

Masuk ke project:

```bash
cd dynamic-form-engine-backend
```

---

## 2. Install Dependencies

Install dependency Laravel:

```bash
composer install
```

---

## 3. Environment Configuration

Copy:

```text
.env.example
```

menjadi:

```text
.env
```

Jika menggunakan terminal yang mendukung `cp`:

```bash
cp .env.example .env
```

Pada Windows, file tersebut juga dapat disalin secara manual.

Kemudian sesuaikan konfigurasi database pada `.env`:

```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=dynamic_form_engine_db
DB_USERNAME=root
DB_PASSWORD=
```

Sesuaikan username dan password dengan konfigurasi MySQL pada komputer masing-masing.

---

# Database Setup

Buat database MySQL:

```text
dynamic_form_engine
```

Database dapat dibuat melalui:

* Laragon
* phpMyAdmin
* MySQL Workbench
* MySQL client
* Database management tool lainnya

Kemudian jalankan migration:

```bash
php artisan migrate
```

Migration akan membuat tabel yang dibutuhkan aplikasi.

---

# Import Form Definition

Setelah migration selesai, import struktur form dari JSON:

```bash
php artisan form:import
```

Command tersebut akan membaca:

```text
storage/app/feeds/form.json
```

dan memasukkan data form ke database.

Jika berhasil:

```text
Form berhasil diimport.
```

---

# Running the Backend

Backend dapat dijalankan menggunakan Laravel development server:

```bash
php artisan serve
```

Default URL:

```text
http://127.0.0.1:8000
```

API tersedia di:

```text
http://127.0.0.1:8000/api/form
```

## Using Laragon

Jika menggunakan Laragon, project dapat ditempatkan pada:

```text
C:\laragon\www\
```

Laragon dapat menyediakan local virtual host untuk project Laravel.

Contoh:

```text
http://dynamic-form-engine-backend.test
```

URL tersebut bergantung pada konfigurasi Laragon di komputer pengguna.

## Using XAMPP

Jika menggunakan XAMPP, project dapat ditempatkan pada:

```text
C:\xampp\htdocs\
```

Backend juga dapat dijalankan menggunakan:

```bash
php artisan serve
```

sehingga tidak bergantung pada konfigurasi virtual host Apache.

---

# API Documentation

## Get Form

### Endpoint

```http
GET /api/form
```

### Description

Mengambil seluruh struktur form yang sudah diimport ke database.

Response berisi:

```text
Section
 └── Payload
      └── Options
```

Endpoint ini digunakan oleh frontend untuk melakukan dynamic form rendering.

---

## Submit Form

### Endpoint

```http
POST /api/form
```

### Request

```json
{
  "answers": [
    {
      "payload_id": "1617779435-k7j8-6aai-ma0ye5989",
      "value": "Kesalahan prosedur dalam proses operasional."
    }
  ]
}
```

Untuk radio button:

```json
{
  "answers": [
    {
      "payload_id": "1617779234-f0oy-phln-ppl0u1qx5",
      "option_ids": [
        "1617779275-lt0k-zexz-uol8cts7s"
      ]
    }
  ]
}
```

Untuk checkbox:

```json
{
  "answers": [
    {
      "payload_id": "1617779535-70rw-phgu-z775zzpti",
      "option_ids": [
        "1617779587-p21t-cv59-eoh4ses9b",
        "1617779627-v64i-uu1g-oo8n3j93v"
      ]
    }
  ]
}
```

---

# Database Design

Database menggunakan relational structure.

### Form Definition

```text
sections
    │
    └── payloads
            │
            └── options
```

### Form Answers

```text
risk_events
    │
    └── answers
            │
            └── answer_options
                    │
                    └── options
```

### Main Tables

| Table            | Purpose                          |
| ---------------- | -------------------------------- |
| `sections`       | Menyimpan section form           |
| `payloads`       | Menyimpan field form             |
| `options`        | Menyimpan pilihan field          |
| `risk_events`    | Menyimpan satu submission form   |
| `answers`        | Menyimpan jawaban field          |
| `answer_options` | Menyimpan pilihan radio/checkbox |

---

# Reset Database

Untuk development/testing, database dapat di-reset menggunakan:

```bash
php artisan migrate:fresh
```

Kemudian import kembali form:

```bash
php artisan form:import
```

Atau langsung:

```bash
php artisan migrate:fresh
php artisan form:import
```

> **Warning:** `migrate:fresh` akan menghapus seluruh tabel dan data pada database yang digunakan. Jangan gunakan pada production database.

---

# Project Structure

```text
dynamic-form-engine-backend/
│
├── app/
│   ├── Console/
│   │   └── Commands/
│   │       └── ImportForm.php
│   │
│   ├── Http/
│   │   ├── Controllers/
│   │   │   └── FormController.php
│   │   └── Requests/
│   │       └── StoreFormRequest.php
│   │
│   ├── Models/
│   │   ├── Answer.php
│   │   ├── Option.php
│   │   ├── Payload.php
│   │   ├── RiskEvent.php
│   │   └── Section.php
│   │
│   └── Services/
│       └── FormImporter.php
│
├── database/
│   └── migrations/
│
├── routes/
│   └── api.php
│
├── storage/
│   └── app/
│       └── feeds/
│           └── form.json
│
├── .env.example
├── artisan
├── composer.json
└── README.md
```

---

# Form Import Command

Form definition dapat diperbarui dengan mengganti file:

```text
storage/app/feeds/form.json
```

kemudian menjalankan:

```bash
php artisan form:import
```

Importer menggunakan `updateOrCreate`, sehingga data form dapat diperbarui berdasarkan ID yang terdapat pada JSON.

---

# Development Notes

Project ini menggunakan pendekatan dynamic form.

Backend tidak menyimpan setiap field form sebagai kolom database khusus.

Sebagai contoh, field baru seperti:

```text
Nama Pelapor
```

dapat ditambahkan ke JSON dan diimport ke database tanpa perlu membuat migration baru untuk field tersebut.

Frontend kemudian dapat mengambil field tersebut melalui API dan melakukan rendering berdasarkan `type`.

Pendekatan ini memungkinkan struktur form berubah tanpa mengubah struktur database setiap kali terdapat field baru.

---

# Related Repository

Frontend repository:

```text
<FRONTEND_REPOSITORY_URL>
```

Frontend menggunakan API yang disediakan oleh backend ini.

---

# License

This project was developed as part of a Software Engineer Test.
