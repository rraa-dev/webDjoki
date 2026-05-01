# 🎮 Djoki - Jasa Joki Rank Mobile Legends

Aplikasi web dashboard untuk manajemen jasa joki rank Mobile Legends. Dibangun dengan Laravel 10, JWT Authentication, dan Tailwind CSS 3.

## 📋 Fitur

### Autentikasi & Otorisasi
- ✅ Register - Pendaftaran akun baru
- ✅ Login - Masuk ke dashboard
- ✅ Logout - Keluar dari sistem
- ✅ JWT Authentication untuk API
- ✅ Session Authentication untuk Web Dashboard
- ✅ Role-based Access Control (Admin & User)
- ✅ Admin Middleware untuk proteksi routes

### Manajemen Data (CRUD)
- ✅ **Customers** - Kelola data pelanggan (Admin only)
- ✅ **Heroes** - Kelola data hero Mobile Legends (Admin only)
- ✅ **Orders** - Kelola pesanan joki rank (Admin only, berelasi dengan Customers & Heroes)

### Teknologi
- **Backend**: Laravel 10
- **Authentication**: JWT (tymon/jwt-auth) untuk API + Session untuk Web
- **Frontend**: Native Laravel Blade + Tailwind CSS 3
- **Database**: MySQL dengan UUID sebagai identifier
- **Data Identifier**: UUID + Slug untuk setiap tabel utama

## 👥 Role & Permissions

### Admin
- Akses penuh ke semua fitur CRUD (Customers, Heroes, Orders)
- Dapat membuat, membaca, mengupdate, dan menghapus data
- Dashboard dengan statistik lengkap
- **Default Credentials**: 
  - Email: `admin@djoki.com`
  - Password: `admin123`

### User (Regular)
- Hanya dapat melihat dashboard
- Tidak memiliki akses ke fitur CRUD
- View read-only untuk statistik umum
- **Default Credentials**: 
  - Email: `user@djoki.com`
  - Password: `user123`

> **Note**: Untuk keamanan, segera ubah password default setelah instalasi pertama!

## 🗃️ Struktur Database

### Tabel Users
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | BIGINT | Primary Key (auto increment) |
| name | VARCHAR | Nama user |
| email | VARCHAR | Email (unique) |
| password | VARCHAR | Password (hashed) |
| role | ENUM | admin, user (default: user) |

### Tabel Customers
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | UUID | Primary Key |
| slug | VARCHAR | Identifier unik (unique) |
| name | VARCHAR | Nama pelanggan |
| email | VARCHAR | Email (unique) |
| phone | VARCHAR | Nomor telepon |

### Tabel Heroes
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | UUID | Primary Key |
| slug | VARCHAR | Identifier unik (unique) |
| name | VARCHAR | Nama hero |
| role | VARCHAR | Role hero (Tank, Fighter, Assassin, dll) |
| difficulty | ENUM | Easy, Medium, Hard |

### Tabel Orders
| Kolom | Tipe | Keterangan |
|-------|------|------------|
| id | UUID | Primary Key |
| slug | VARCHAR | Identifier unik (unique) |
| customer_id | UUID | Foreign Key ke Customers |
| hero_id | UUID | Foreign Key ke Heroes |
| current_rank | VARCHAR | Rank saat ini |
| target_rank | VARCHAR | Rank tujuan |
| price | INTEGER | Harga joki |
| status | ENUM | Pending, In Progress, Completed, Cancelled |

### Relasi Database
```
Customers (1) ──────── (N) Orders (N) ──────── (1) Heroes
```
- Satu **Customer** dapat memiliki banyak **Orders**
- Satu **Hero** dapat digunakan di banyak **Orders**
- Cascade delete: Jika Customer/Hero dihapus, Orders terkait juga dihapus

## 🚀 Cara Instalasi

### Prasyarat
- PHP >= 8.1
- Composer
- Node.js >= 16 & NPM
- MySQL / MariaDB
- Git

### Langkah-langkah

#### 1. Clone Repository
```bash
git clone <repository-url>
cd djoki-store
```

#### 2. Install Dependencies PHP
```bash
composer install
```

#### 3. Install Dependencies JavaScript
```bash
npm install
```

#### 4. Setup Environment
```bash
# Copy file environment
cp .env.example .env

# Generate application key
php artisan key:generate

# Generate JWT secret
php artisan jwt:secret
```

#### 5. Konfigurasi Database
Edit file `.env` dan sesuaikan konfigurasi database:
```env
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=djoki-store
DB_USERNAME=root
DB_PASSWORD=
```

#### 6. Jalankan Migration & Seeder
```bash
# Buat database terlebih dahulu di MySQL
# CREATE DATABASE djoki_store;

# Jalankan migration
php artisan migrate

# Jalankan seeder untuk membuat akun admin & user default
php artisan db:seed --class=AdminSeeder
```

**Akun Default yang Dibuat**:
- **Admin**: admin@djoki.com / admin123
- **User**: user@djoki.com / user123

#### 7. Build Assets (Tailwind CSS)
```bash
# Development
npm run dev

# Production
npm run build
```

#### 8. Jalankan Server
```bash
php artisan serve
```

Aplikasi akan berjalan di: `http://127.0.0.1:8000`

## 🔐 Penggunaan

### Web Dashboard - Flow Lengkap

#### Langkah 1: Login dengan Akun Default

**Untuk Admin (Akses Penuh)**:
1. Buka browser dan akses `http://127.0.0.1:8000`
2. Klik tombol **"Masuk"** di landing page
3. Login dengan kredensial admin:
   - Email: `admin@djoki.com`
   - Password: `admin123`
4. Setelah login, Anda akan masuk ke Dashboard dengan akses penuh ke semua fitur CRUD

**Untuk User (View Only)**:
1. Login dengan kredensial user:
   - Email: `user@djoki.com`
   - Password: `user123`
2. User hanya dapat melihat dashboard tanpa akses ke fitur CRUD

> **Atau Daftar Akun Baru**: Klik **"Daftar Gratis"** untuk membuat akun baru (role: user)

#### Langkah 2: Tambah Data Hero (Admin Only)
1. Dari Dashboard, klik menu **"Heroes"** di sidebar
2. Klik tombol **"+ Tambah Hero"**
3. Isi form:
   - Nama Hero (contoh: Fanny, Gusion, Lancelot)
   - Role (Tank, Fighter, Assassin, Mage, Marksman, Support)
   - Difficulty (Easy, Medium, Hard)
4. Klik **"Simpan"**
5. Ulangi untuk menambah hero lain

#### Langkah 3: Tambah Data Customer (Admin Only)
1. Klik menu **"Customers"** di sidebar
2. Klik tombol **"+ Tambah Customer"**
3. Isi form:
   - Nama Customer
   - Email (harus unique)
   - Nomor Telepon
4. Klik **"Simpan"**
5. Ulangi untuk menambah customer lain

#### Langkah 4: Buat Order (Admin Only)
1. Klik menu **"Orders"** di sidebar
2. Klik tombol **"+ Tambah Order"**
3. Isi form:
   - Pilih Customer (dari dropdown)
   - Pilih Hero (dari dropdown)
   - Current Rank (contoh: Epic III)
   - Target Rank (contoh: Legend I)
   - Price (contoh: 100000)
   - Status (Pending, In Progress, Completed, Cancelled)
4. Klik **"Simpan"**

#### Navigasi Dashboard
- **Dashboard**: Lihat statistik dan ringkasan
- **Customers** (Admin only): Kelola data pelanggan
- **Heroes** (Admin only): Kelola data hero Mobile Legends
- **Orders** (Admin only): Kelola pesanan joki rank
- **Logout**: Keluar dari sistem

#### Perbedaan Admin vs User
| Fitur | Admin | User |
|-------|-------|------|
| Dashboard Stats | ✅ Full | ✅ Limited |
| CRUD Customers | ✅ Yes | ❌ No |
| CRUD Heroes | ✅ Yes | ❌ No |
| CRUD Orders | ✅ Yes | ❌ No |
| Menu Sidebar | ✅ Full Menu | ⚠️ Dashboard Only |
| Create/Edit/Delete | ✅ Yes | ❌ No |

### REST API
API menggunakan JWT Authentication. Berikut langkah penggunaannya:

#### 1. Register (Mendapatkan Token)
```bash
POST /api/register
Content-Type: application/json

{
    "name": "Admin Djoki",
    "email": "admin@djoki.com",
    "password": "password123"
}
```

#### 2. Login (Mendapatkan Token)
```bash
POST /api/login
Content-Type: application/json

{
    "email": "admin@djoki.com",
    "password": "password123"
}
```
Response akan berisi `token` yang digunakan untuk request selanjutnya.

#### 3. Gunakan Token
Untuk semua endpoint yang memerlukan autentikasi, tambahkan header:
```
Authorization: Bearer <your-token>
```

## 📡 API Endpoints

### Authentication
| Method | Endpoint | Deskripsi | Auth |
|--------|----------|-----------|------|
| POST | `/api/register` | Register user baru | ❌ |
| POST | `/api/login` | Login & dapatkan token | ❌ |
| POST | `/api/logout` | Logout & invalidate token | ✅ |
| GET | `/api/me` | Get user info | ✅ |

### Customers
| Method | Endpoint | Deskripsi | Auth |
|--------|----------|-----------|------|
| GET | `/api/customers` | Get all customers | ✅ |
| POST | `/api/customers` | Create customer | ✅ |
| GET | `/api/customers/{id}` | Get single customer | ✅ |
| PUT | `/api/customers/{id}` | Update customer | ✅ |
| DELETE | `/api/customers/{id}` | Delete customer | ✅ |

### Heroes
| Method | Endpoint | Deskripsi | Auth |
|--------|----------|-----------|------|
| GET | `/api/heroes` | Get all heroes | ✅ |
| POST | `/api/heroes` | Create hero | ✅ |
| GET | `/api/heroes/{id}` | Get single hero | ✅ |
| PUT | `/api/heroes/{id}` | Update hero | ✅ |
| DELETE | `/api/heroes/{id}` | Delete hero | ✅ |

### Orders
| Method | Endpoint | Deskripsi | Auth |
|--------|----------|-----------|------|
| GET | `/api/orders` | Get all orders | ✅ |
| POST | `/api/orders` | Create order | ✅ |
| GET | `/api/orders/{id}` | Get single order | ✅ |
| PUT | `/api/orders/{id}` | Update order | ✅ |
| DELETE | `/api/orders/{id}` | Delete order | ✅ |

## 🧪 Testing dengan Postman

1. Import file `postman_api.json` ke Postman
2. Jalankan request **Register** atau **Login** untuk mendapatkan token
3. Token akan otomatis tersimpan di collection variable `token`
4. Semua request yang memerlukan auth akan otomatis menggunakan token

## 📁 Struktur Folder

```
djoki-store/
├── app/
│   ├── Http/
│   │   ├── Controllers/
│   │   │   ├── Auth/              # Auth controllers (web)
│   │   │   ├── Web/               # Web controllers (dashboard)
│   │   │   ├── AuthController.php # API auth controller
│   │   │   ├── CustomerController.php
│   │   │   ├── HeroController.php
│   │   │   └── OrderController.php
│   │   └── Middleware/
│   └── Models/
│       ├── Customer.php
│       ├── Hero.php
│       ├── Order.php
│       └── User.php
├── config/
│   ├── auth.php                   # Auth configuration (web + api guards)
│   └── jwt.php                    # JWT configuration
├── database/
│   └── migrations/
├── resources/
│   ├── css/
│   │   └── app.css               # Tailwind CSS
│   ├── js/
│   └── views/
│       ├── auth/                  # Login & Register views
│       ├── customers/             # Customer CRUD views
│       ├── dashboard/             # Dashboard view
│       ├── heroes/                # Hero CRUD views
│       ├── layouts/               # Main layout
│       └── orders/                # Order CRUD views
├── routes/
│   ├── api.php                    # API routes (JWT protected)
│   └── web.php                    # Web routes (Session protected)
├── postman_api.json               # Postman collection
├── tailwind.config.js             # Tailwind configuration
└── vite.config.js                 # Vite configuration
```

## ⚠️ Troubleshooting

### Error 419 - Page Expired
Pastikan konfigurasi `config/auth.php` memiliki default guard `web`:
```php
'defaults' => [
    'guard' => 'web',
    'passwords' => 'users',
],
```

### JWT Token Invalid
Regenerate JWT secret:
```bash
php artisan jwt:secret
```

### Tailwind CSS Tidak Muncul
Build ulang assets:
```bash
npm run build
```

### Database Error
Pastikan database sudah dibuat dan konfigurasi `.env` sudah benar:
```bash
php artisan migrate:fresh
```

## 📝 Catatan Penting

1. **UUID vs Slug**: Setiap tabel utama memiliki UUID sebagai primary key dan Slug sebagai identifier yang human-readable
2. **Cascade Delete**: Menghapus Customer atau Hero akan menghapus semua Orders terkait
3. **Dual Authentication**: Web menggunakan Session, API menggunakan JWT
4. **Status Order**: Pending → In Progress → Completed / Cancelled

## 👨‍💻 Teknologi yang Digunakan

- **Laravel 10** - PHP Framework
- **JWT Auth (tymon/jwt-auth)** - API Authentication
- **Tailwind CSS 3** - Styling
- **Vite** - Asset Bundler
- **MySQL** - Database
- **Laravel UI** - Auth Scaffolding

## 📄 License

MIT License

---

**Djoki** - Jasa Joki Rank Mobile Legends © 2024

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).




<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## About Laravel

Laravel is a web application framework with expressive, elegant syntax. We believe development must be an enjoyable and creative experience to be truly fulfilling. Laravel takes the pain out of development by easing common tasks used in many web projects, such as:

- [Simple, fast routing engine](https://laravel.com/docs/routing).
- [Powerful dependency injection container](https://laravel.com/docs/container).
- Multiple back-ends for [session](https://laravel.com/docs/session) and [cache](https://laravel.com/docs/cache) storage.
- Expressive, intuitive [database ORM](https://laravel.com/docs/eloquent).
- Database agnostic [schema migrations](https://laravel.com/docs/migrations).
- [Robust background job processing](https://laravel.com/docs/queues).
- [Real-time event broadcasting](https://laravel.com/docs/broadcasting).

Laravel is accessible, powerful, and provides tools required for large, robust applications.

## Learning Laravel

Laravel has the most extensive and thorough [documentation](https://laravel.com/docs) and video tutorial library of all modern web application frameworks, making it a breeze to get started with the framework.

You may also try the [Laravel Bootcamp](https://bootcamp.laravel.com), where you will be guided through building a modern Laravel application from scratch.

If you don't feel like reading, [Laracasts](https://laracasts.com) can help. Laracasts contains thousands of video tutorials on a range of topics including Laravel, modern PHP, unit testing, and JavaScript. Boost your skills by digging into our comprehensive video library.

## Laravel Sponsors

We would like to extend our thanks to the following sponsors for funding Laravel development. If you are interested in becoming a sponsor, please visit the [Laravel Partners program](https://partners.laravel.com).

### Premium Partners

- **[Vehikl](https://vehikl.com/)**
- **[Tighten Co.](https://tighten.co)**
- **[WebReinvent](https://webreinvent.com/)**
- **[Kirschbaum Development Group](https://kirschbaumdevelopment.com)**
- **[64 Robots](https://64robots.com)**
- **[Curotec](https://www.curotec.com/services/technologies/laravel/)**
- **[Cyber-Duck](https://cyber-duck.co.uk)**
- **[DevSquad](https://devsquad.com/hire-laravel-developers)**
- **[Jump24](https://jump24.co.uk)**
- **[Redberry](https://redberry.international/laravel/)**
- **[Active Logic](https://activelogic.com)**
- **[byte5](https://byte5.de)**
- **[OP.GG](https://op.gg)**

## Contributing

Thank you for considering contributing to the Laravel framework! The contribution guide can be found in the [Laravel documentation](https://laravel.com/docs/contributions).

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
