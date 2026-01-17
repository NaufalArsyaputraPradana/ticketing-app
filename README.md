# BengTix - Ticketing App

<p align="center">
  <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo">
</p>

<p align="center">
  <strong>Sistem Pemesanan Tiket Event Berbasis Web</strong><br>
  <em>Beli tiket, auto asik! 🚀</em>
</p>

<p align="center">
  <img src="https://img.shields.io/badge/Laravel-11.x-FF2D20?style=for-the-badge&logo=laravel&logoColor=white" alt="Laravel">
  <img src="https://img.shields.io/badge/PHP-8.2+-777BB4?style=for-the-badge&logo=php&logoColor=white" alt="PHP">
  <img src="https://img.shields.io/badge/MySQL-8.0-4479A1?style=for-the-badge&logo=mysql&logoColor=white" alt="MySQL">
  <img src="https://img.shields.io/badge/TailwindCSS-3.x-06B6D4?style=for-the-badge&logo=tailwindcss&logoColor=white" alt="Tailwind">
  <img src="https://img.shields.io/badge/DaisyUI-5.x-5A0EF8?style=for-the-badge" alt="DaisyUI">
</p>

---

## Informasi Project

| Keterangan | Detail |
|-----------|--------|
| **Nama** | Naufal Arsyaputra Pradana |
| **NIM** | A11.2022.14606 |
| **Program Studi** | Teknik Informatika |
| **Fakultas** | Ilmu Komputer |
| **Universitas** | Universitas Dian Nuswantoro |
| **Mata Kuliah** | Bimbingan Karir - Skema Web Developer |
| **Tahun Akademik** | 2025 |

---

## Tentang Project

**BengTix** adalah aplikasi web sistem pemesanan tiket event yang dikembangkan menggunakan framework **Laravel 11** dengan konsep modern web development. Aplikasi ini memungkinkan pengguna untuk mencari, memfilter, dan memesan tiket berbagai event seperti konser musik, festival, pameran seni, kompetisi olahraga, dan acara lainnya dengan mudah dan aman.

### Tujuan Pengembangan

Sistem ini dikembangkan untuk:
- Memahami alur bisnis sistem ticketing event secara menyeluruh
- Menerapkan konsep **CRUD (Create, Read, Update, Delete)** dalam pengelolaan data
- Mengimplementasikan arsitektur **MVC (Model-View-Controller)** Laravel
- Menguasai **Role-Based Access Control** untuk keamanan aplikasi
- Mempelajari **Database Relationships** (One-to-Many, Many-to-Many)
- Menerapkan **Transaction Management** untuk pembelian tiket
- Menggunakan **Eloquent ORM** untuk query optimization

### Fitur Utama

#### Keamanan & Autentikasi
- **Role-Based Access Control** - Sistem autentikasi dengan 2 role (Admin & User)
- **Middleware Protection** - Proteksi route admin dan user
- **Session Management** - Pengelolaan sesi login yang aman
- **CSRF Protection** - Keamanan dari serangan Cross-Site Request Forgery

#### Ticketing Features
- **Multi-Ticket Types** - Support tiket Regular dan Premium
- **Stock Management** - Real-time stock tracking
- **Transaction Lock** - Mencegah overselling dengan database locking
- **Order History** - Pencatatan lengkap riwayat pembelian
- **Detailed Invoice** - Tampilan detail pesanan yang informatif

#### Content Management
- **Image Upload System** - Upload dan manajemen gambar event
- **File Validation** - Validasi format dan ukuran file
- **Auto Image Optimization** - Kompresi otomatis untuk performa
- **Fallback Images** - Default image jika gambar error

#### Admin Dashboard
- **Event Management** - CRUD lengkap untuk event
- **Category Management** - Pengelolaan kategori event
- **Ticket Configuration** - Pengaturan harga dan stok tiket
- **Transaction Monitoring** - Monitoring semua transaksi pembelian

---

## Teknologi yang Digunakan

### Backend Stack
```
├── Laravel 11.x         → PHP Framework dengan Eloquent ORM
├── PHP 8.2+             → Programming Language
├── MySQL 8.0            → Relational Database Management System
├── Laravel Breeze       → Authentication Scaffolding
└── Composer             → PHP Dependency Manager
```

### Frontend Stack
```
├── Blade Template       → Laravel Template Engine
├── Tailwind CSS 3.x     → Utility-first CSS Framework
├── DaisyUI v5           → Tailwind CSS Component Library
├── Alpine.js            → Lightweight JavaScript Framework
├── Vite 5.x             → Frontend Build Tool & Development Server
└── SweetAlert2          → Beautiful Alert Dialogs
```

### Development Tools
```
├── Composer             → PHP Dependency Manager
├── NPM/Node.js          → JavaScript Package Manager
├── Git                  → Version Control System
├── VS Code              → Code Editor (Recommended)
└── Laravel Debugbar     → Debugging Tool (Development)
```

---

## Skema Database

### Entity Relationship Diagram (ERD)

```
┌─────────────┐       ┌──────────────┐       ┌─────────────┐
│    users    │──────<│    events    │>──────│ categories  │
│             │ 1:N   │              │ N:1   │             │
│ • id        │       │ • id         │       │ • id        │
│ • name      │       │ • judul      │       │ • nama      │
│ • email     │       │ • deskripsi  │       └─────────────┘
│ • password  │       │ • waktu      │
│ • role      │       │ • lokasi     │
└─────────────┘       │ • gambar     │
       │              │ • category_id│
       │ 1:N          │ • user_id    │
       │              └──────────────┘
       │                     │ 1:N
       │                     ▼
       │              ┌──────────────┐
       │              │   tickets    │
       │              │              │
       │              │ • id         │
       │              │ • event_id   │
       │              │ • type       │
       │              │ • harga      │
       │              │ • stok       │
       │              └──────────────┘
       │                     │
       │ 1:N                 │ 1:N
       ▼                     ▼
┌─────────────┐       ┌──────────────────┐
│   orders    │──────<│ detail_orders    │
│             │ 1:N   │                  │
│ • id        │       │ • id             │
│ • user_id   │       │ • order_id       │
│ • event_id  │       │ • ticket_id      │
│ • order_date│       │ • jumlah         │
│ • total_harga       │ • subtotal       │
└─────────────┘       └──────────────────┘
```

### Struktur Tabel Detail

#### Tabel: `users`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| name | VARCHAR(255) | Nama lengkap user |
| email | VARCHAR(255) UNIQUE | Email user (untuk login) |
| password | VARCHAR(255) | Password ter-hash |
| role | ENUM('admin','user') | Role user |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

#### Tabel: `categories`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| nama | VARCHAR(255) UNIQUE | Nama kategori |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

#### Tabel: `events`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| judul | VARCHAR(255) | Judul event |
| deskripsi | TEXT | Deskripsi lengkap event |
| waktu | DATETIME | Waktu pelaksanaan event |
| lokasi | VARCHAR(255) | Lokasi event |
| gambar | VARCHAR(255) | Nama file gambar |
| category_id | BIGINT (FK) | Foreign Key ke categories |
| user_id | BIGINT (FK) | Foreign Key ke users (creator) |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

#### Tabel: `tickets`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| event_id | BIGINT (FK) | Foreign Key ke events |
| type | ENUM('reguler','premium') | Tipe tiket |
| harga | DECIMAL(10,2) | Harga tiket |
| stok | INTEGER | Jumlah stok tersedia |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

#### Tabel: `orders`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| user_id | BIGINT (FK) | Foreign Key ke users |
| event_id | BIGINT (FK) | Foreign Key ke events |
| order_date | DATETIME | Tanggal pemesanan |
| total_harga | DECIMAL(10,2) | Total harga pesanan |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

#### Tabel: `detail_orders`
| Field | Type | Description |
|-------|------|-------------|
| id | BIGINT (PK) | Primary Key |
| order_id | BIGINT (FK) | Foreign Key ke orders |
| ticket_id | BIGINT (FK) | Foreign Key ke tickets |
| jumlah | INTEGER | Jumlah tiket dibeli |
| subtotal | DECIMAL(10,2) | Subtotal per item |
| created_at | TIMESTAMP | Tanggal dibuat |
| updated_at | TIMESTAMP | Tanggal diupdate |

### Relasi Database

```
users (1) ──────────── (N) events
users (1) ──────────── (N) orders
categories (1) ──────── (N) events
events (1) ──────────── (N) tickets
events (1) ──────────── (N) orders
orders (1) ──────────── (N) detail_orders
tickets (1) ──────────── (N) detail_orders
```

---

## Instalasi dan Setup

### Prasyarat

| Software | Versi Minimum | Download Link |
|----------|---------------|---------------|
| **PHP** | 8.2 atau lebih tinggi | [php.net](https://www.php.net/downloads) |
| **Composer** | 2.6+ | [getcomposer.org](https://getcomposer.org/) |
| **Node.js** | 18.x atau lebih tinggi | [nodejs.org](https://nodejs.org/) |
| **NPM** | 9.x+ (bundled with Node.js) | - |
| **MySQL** | 8.0+ | [mysql.com](https://www.mysql.com/) |
| **XAMPP** | 8.2.x (optional) | [apachefriends.org](https://www.apachefriends.org/) |

### Langkah Instalasi

#### 1️⃣ Clone Repository

```bash
git clone https://github.com/NaufalArsyaputraPradana/ticketing-app.git
cd ticketing-app
```

#### 2️⃣ Install Dependencies PHP

```bash
composer install
```

> **Note**: Proses ini akan menginstall semua package Laravel yang dibutuhkan termasuk Laravel Breeze untuk authentication.

#### 3️⃣ Install Dependencies JavaScript

```bash
npm install
```

> **Note**: Menginstall Tailwind CSS, DaisyUI, Vite, dan package frontend lainnya.

#### 4️⃣ Setup Environment File

```bash
# Windows (PowerShell)
Copy-Item .env.example .env

# Linux/Mac
cp .env.example .env
```

Kemudian generate application key:

```bash
php artisan key:generate
```

#### 5️⃣ Konfigurasi Database

**Menggunakan MySQL**

1. Buat database baru di MySQL:
```sql
CREATE DATABASE ticketing_app CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
```

2. Edit file `.env`:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=ticketing_app
DB_USERNAME=root
DB_PASSWORD=
```

#### 6️⃣ Migrasi & Seeding Database

```bash
# Jalankan migrasi untuk membuat tabel
php artisan migrate

# Isi database dengan data dummy
php artisan db:seed
```

> **Data Seeder**:
> - **Admin**: email: `admin@gmail.com` | password: `admin123`
> - **User**: email: `user@gmail.com` | password: `user123`
> - 4 Categories (Konser, Festival, Pameran, Olahraga)
> - 10 Events dengan gambar
> - Tiket Regular & Premium untuk setiap event
> - Sample orders

**Atau jalankan sekaligus (Fresh Migration + Seed)**:

```bash
php artisan migrate:fresh --seed
```

#### 7️⃣ Create Storage Link

```bash
php artisan storage:link
```

> Membuat symbolic link dari `public/storage` ke `storage/app/public`

#### 8️⃣ Build Frontend Assets

```bash
# Development mode (with hot reload)
npm run dev

# Production build
npm run build
```

#### 9️⃣ Jalankan Development Server

Buka terminal baru dan jalankan:

```bash
php artisan serve
```

Aplikasi akan berjalan di: **http://127.0.0.1:8000**

---

## Cara Menggunakan Aplikasi

### Akses Admin

1. Buka browser dan akses: `http://127.0.0.1:8000`
2. Klik **Login** di navigation bar
3. Login dengan kredensial admin:
   ```
   Email: admin@gmail.com
   Password: password
   ```
4. Setelah login, Anda akan diarahkan ke **Admin Dashboard**

### Akses User

1. **Login User**:
   ```
   Email: user@gmail.com
   Password: password
   ```

2. **Browse & Order Tiket**:
   - Browse event di homepage
   - Filter berdasarkan kategori
   - Klik event untuk melihat detail
   - Pilih jumlah tiket (Regular/Premium)
   - Klik **Checkout**
   - Konfirmasi pesanan

3. **Cek Riwayat Pesanan**:
   - Klik **Pesanan Saya** di navigation
   - Lihat daftar pesanan
   - Klik **Lihat Detail** untuk invoice lengkap

---

## Struktur Folder Project

```
ticketing-app/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Admin/
│   │   │   │   ├── CategoryController.php
│   │   │   │   ├── DashboardController.php
│   │   │   │   ├── EventController.php
│   │   │   │   ├── HistoriesController.php
│   │   │   │   └── TicketController.php
│   │   │   ├── User/
│   │   │   │   ├── EventController.php
│   │   │   │   ├── HomeController.php
│   │   │   │   └── OrderController.php
│   │   │   └── ProfileController.php
│   │   ├── Middleware/
│   │   │   └── AdminMiddleware.php
│   │   └── Requests/
│   └── Models/
│       ├── Category.php
│       ├── DetailOrder.php
│       ├── Event.php
│       ├── Order.php
│       ├── Ticket.php
│       └── User.php
├── database/
│   ├── migrations/
│   ├── seeders/
│   │   ├── CategorySeeder.php
│   │   ├── EventSeeder.php
│   │   ├── OrderSeeder.php
│   │   ├── TicketSeeder.php
│   │   └── UserSeeder.php
│   └── database.sqlite
├── public/
│   ├── images/
│   │   └── events/        # Upload event images
│   └── assets/
│       └── images/        # Static assets
├── resources/
│   ├── views/
│   │   ├── admin/
│   │   │   ├── category/
│   │   │   ├── dashboard.blade.php
│   │   │   ├── event/
│   │   │   ├── history/
│   │   │   └── ticket/
│   │   ├── auth/
│   │   ├── components/
│   │   │   ├── admin/
│   │   │   │   └── sidebar.blade.php
│   │   │   ├── layouts/
│   │   │   │   ├── admin.blade.php
│   │   │   │   └── app.blade.php
│   │   │   └── user/
│   │   │       ├── category-pill.blade.php
│   │   │       ├── event-card.blade.php
│   │   │       └── navigation.blade.php
│   │   ├── events/
│   │   │   └── show.blade.php
│   │   ├── home.blade.php
│   │   ├── orders/
│   │   │   ├── index.blade.php
│   │   │   └── show.blade.php
│   │   └── profile/
│   ├── css/
│   │   └── app.css
│   └── js/
│       ├── app.js
│       └── bootstrap.js
├── routes/
│   ├── web.php
│   └── auth.php
├── .env.example
├── composer.json
├── package.json
├── tailwind.config.js
├── vite.config.js
└── README.md
```

---

## Role & Permission

| Role | Akses | Deskripsi |
|------|-------|-----------|
| **Admin** | `/admin/*` | Full access ke dashboard admin, CRUD categories, events, tickets, dan view history transaksi |
| **User** | `/`, `/events/*`, `/orders/*` | Browse events, order tickets, view order history |
| **Guest** | `/`, `/events/*` | Browse events only (read-only), harus login untuk order |

---

## License

Proyek ini dikembangkan untuk keperluan akademik di Universitas Dian Nuswantoro.

---

## Developer Contact

**Naufal Arsyaputra Pradana**
- NIM: A11.2022.14606
- Email: 111202214606@mhs.dinus.ac.id
- GitHub: https://github.com/NaufalArsyaputraPradana/ticketing-app

---

## References & Learning Resources

### Module Notion
- [WBK 2025 - Ticketing App](https://www.notion.so/WBK-2025-Ticketing-App-2e08d8819df1801a8409dbe948fc17f9)

### Laravel Official Documentation
- [Laravel 11 Docs](https://laravel.com/docs/11.x)
- [Eloquent ORM](https://laravel.com/docs/11.x/eloquent)
- [Blade Templates](https://laravel.com/docs/11.x/blade)
- [Laravel Breeze](https://laravel.com/docs/11.x/starter-kits#breeze)

### Frontend Resources
- [Tailwind CSS Docs](https://tailwindcss.com/docs)
- [DaisyUI Components](https://daisyui.com/components/)
- [Alpine.js](https://alpinejs.dev/)

---

<p align="center">
  <strong> BengTix - Beli tiket, auto asik!</strong><br>
  <sub>Developed by Naufal Arsyaputra Pradana</sub><br>
  <sub>© 2026 Universitas Dian Nuswantoro</sub>
</p>

---
