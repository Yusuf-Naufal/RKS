
# MEMBUAT MULTI USER 

Project ini mempelajari tentang penggunakan Middleware untuk membatasi beberapa akses dari users 

Anda dapat mendownload file diatas dan membuat database baru bernama 'rks' untuk dapat menggunakakan project diatas


**berikut ini langkah - langkah pembuatan project :** 



## Installation

Membuat Project baru dengan menggunakan composer

```bash
  composer create-project laravel/laravel <nama_folder>
```
    
## Konfigurasi awal

ubah file '.env'

```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE= <nama_database>
DB_USERNAME=root
DB_PASSWORD=
```

_*Hilangkan tanda '#' pada awal line, **hanya pada bagian ini saja yang diganti**_



## Membuat Database

Membuat Database baru dengan nama sesuai dengan yang diatas pada PHPMyAdmin


## Migration 

Melakukan migration untuk membuat tabel pada database baru, dengan cara : 

- Buka terminal pada Visual Studio Code (ctrl + shift + ` )
- ketikan sintax berikut 
    ```bash
    php artisan migrate
    ```
## Role

Menambahkan Field `Role` pada tabel `users`, dengan cara : 

- Masuk kedalam tabel `users`
- Masuk ke Tabs Structure 
- Dibawah Structure tabel terdapat `add` tabel, isikan 1 dan `after email`
- Isikan **nama kolom** `role`, **tipe** `Varchar`, **panjang** `50`
- Klik Ok
## Seeder

Menambahkan data pada tabel `users` dengan cara : 

- Masuk kedalam file 'database/seeders/DatabaseSeeder.php', kemudian ubah line berikut :
``` 
    User::factory()->create([
                'name' => '<nama_pengguna>',
                'email' => '<email_pengguna>',
                'role' => '<dosen/mahasiswa/admin>'
            ]);
```

- Masuk kedalam file 'database/factories/UserFactory.php', Ubah line berikut :
```
    return [
                'name' => fake()->name(),
                'email' => fake()->unique()->safeEmail(),
                'email_verified_at' => now(),
                'password' => static::$password ??= Hash::make('<password>'), //UBAH INI SAJA
                'remember_token' => Str::random(10),
            ];
        }
```

- Lakukan perintah seeder 
``` 
    php artisan db:seed
```

- Data Berhasil ditambahkan
**jika anda ingin menambah data melalui seeder lagi, ulangi langkah - langkah diatas**



## Migration 

Melakukan migration untuk membuat tabel pada database baru, dengan cara : 

- Buka terminal pada Visual Studio Code (ctrl + shift + ` )
- ketikan sintax berikut 
    ```bash
    php artisan migrate
    ```
## View

Membuat beberapa View pada pada folder 'resource/view' (buat didalam folder view)

- **View Login**

    membuat file view baru dengan nama 'login.blade.php'

    ```
        <!DOCTYPE html>
        <html lang="en">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>Login</title>
            <link rel="stylesheet" href="styles.css">

            <style>
                body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            margin: 0;
            background-color: #f3f4f6;
            font-family: 'Arial', sans-serif;
            }

            .login-container {
                display: flex;
                justify-content: center;
                align-items: center;
                width: 100%;
                height: 100%;
            }

            .login-box {
                background-color: #ffffff;
                padding: 20px 40px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 400px;
                width: 100%;
            }

            .login-box h2 {
                margin-bottom: 20px;
                color: #333333;
            }

            .form-group {
                margin-bottom: 15px;
                text-align: left;
            }

            .form-group label {
                display: block;
                margin-bottom: 5px;
                color: #666666;
            }

            .form-group input {
                width: 100%;
                padding: 10px;
                border: 1px solid #cccccc;
                border-radius: 5px;
                box-sizing: border-box;
            }

            .login-button {
                width: 100%;
                padding: 10px;
                background-color: #007bff;
                border: none;
                border-radius: 5px;
                color: #ffffff;
                font-size: 16px;
                cursor: pointer;
            }

            .login-button:hover {
                background-color: #0056b3;
            }

            .signup-link {
                margin-top: 15px;
                color: #666666;
            }

            .signup-link a {
                color: #007bff;
                text-decoration: none;
            }

            .signup-link a:hover {
                text-decoration: underline;
            }

                </style>
        </head>
        <body>
            <div class="login-container">
                 <div class="login-box">
                    <h2>Sign in to your account</h2>
                    <form action="/login" method="POST">
                        @csrf
                        <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" placeholder="name@company.com" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" placeholder="••••••••" required>
                            </div>
                            <button type="submit" class="login-button">Login</button>
                            <p class="signup-link">
                                Punya Akun? <a href="/signup">Sign up</a>
                            </p>
                    </form>
                </div>
            </div>
        </body>
    </html>

    ```

- Membuat **Component**

    membuat    `component` untuk navbar pada terminal

    ```
     php artisan make:component Navbar
    ```

    kemudian isikan sintak berikut : 
    
    _resource/view/component/navbar.blade.php_
    ```
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <a class="navbar-brand" href="/dashboard">MultiUser</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="/home">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/dosen">Dosen</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/mahasiswa">Mahasiswa</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/matkul">Matkul</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="/jurusan">Jurusan</a>
                    </li>
                </ul>
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="/logout">
                            <i class="fas fa-sign-out-alt"></i> Logout
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <div class="container">
    ```

- **View Dashboard**

    Membuat file view baru bernama 'dashboard.blade.php'

    _resource/view/component/dashboard.blade.php_
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dashboard</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Welcome to the Dashboard</h1>
            <p>Use the navigation bar to access different sections.</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```


- **View Dosen**

    Membuat file view baru bernama 'dosen.blade.php'

    _resource/view/component/dosen.blade.php_
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Dosen</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Halaman Dosen</h1>
            <p>Halaman Ini hanya bisa di akses oleh pihak Dosen dan Admin</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```

- **View Mahasiswa**

    Membuat file view baru bernama 'mahasiswa.blade.php'

    _resource/view/component/mahasiswa.blade.php_
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mahasiswa</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Welcome to the Mahasiswa</h1>
            <p>Halaman Ini hanya bisa di akses oleh pihak Mahasiswa dan Admin</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```

- **View Mata Kuliah**

    Membuat file view baru bernama 'matkul.blade.php'

    _resource/view/component/matkul.blade.php_
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Mata Kuliah</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Welcome to the Mata Kuliah</h1>
            <p>Halaman Ini hanya bisa diakses oleh Mahasiswa dan Admin</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```

- **View Jurusan**

    Membuat file view baru bernama 'jurusan.blade.php'

    _resource/view/component/jurusan.blade.php_
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Jurusan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Welcome to the Jurusan</h1>
            <p>Halaman Ini hanya bisa di akses oleh pihak Admin dan Dosen</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```

- **View Home**
    
    Membuat file view baru bernama 'home.blade.php'

    resource/view/component/home.blade.php
    ```
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Home</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
        <style>
            body {
                font-family: 'Arial', sans-serif;
            }
            .navbar {
                margin-bottom: 20px;
            }
            .container {
                padding-top: 20px;
            }
        </style>
    </head>
    <body>
        
        <x-navbar></x-navbar>

            <h1>Welcome to the Home</h1>
            <p>Halaman Ini Bisa diakses oleh semua role</p>
    

        <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.10.2/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.min.js"></script>
    </body>
    </html>

    ```

    


## Controller

Membuat Controller bernama `AuthController` dengan cara 
```
php artisan make:controller AuthController
```
_file yang sudah dibuat terletak di **app/Http/Controller/**_.  

Masukkan sintak berikut kedalam file

```
<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function index(){
        return view('login'); 
    }
    public function login(Request $request){
        $data = $request->only('email','password');
        if(Auth::attempt($data)){
            return redirect('/dashboard');
        }
        return back();
    }

    public function logout(Request $request){
       Auth::logout(); 
       $request->session()->invalidate();
       return redirect('/login');
    }
}

```

## Middleware

Membuat Middleware bernama `Akses` dengan cara : 
```
php artisan make:middleware Akses
```
_file yang sudah dibuat terletak di **app/Http/Middleware/**_

Masukkan sintak berikut kedalam file 
```
<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Akses
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    
    //UBAH BAGIAN INI
    public function handle(Request $request, Closure $next,$role): Response 
    {
        if(auth()->user()->role == $role){
             return $next($request);
        } 
        return abort(401);
    }
}

```

Ubah File `app.php` pada folder boostrap

_boostrap/app/php_
```
<?php

use App\Http\Middleware\Akses;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    
    //  BAGIAN INI SAJA YANG DIUBAH
    ->withMiddleware(function (Middleware $middleware) {
        
        $middleware->alias([
            'role'=>Akses::class,
        ]);
        
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();

```


## Route

Menambahkan Route untuk mengakses halaman, terdapat pada folder 
'routes/web.php'. isikan sintax berikut : 
```
<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

//UNTUK FORM LOGIN
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::post('/login', [AuthController::class, 'login']); 

//UNTUK LOGOUT
Route::get('/logout', [AuthController::class, 'logout'])->name('logout');

//UNTUK PEMBATASAN AKSES HALAMAN (MEWAJIBKAN LOGIN TERLEBIH DAHULU)
Route::middleware('auth')->group(function (){

    Route::get('/home', function () {
    return view('home');
    });

    Route::get('/dashboard', function () {
    return view('dashboard');
    });

    //PEMBATASAN AKSES HALAMAN UNTUK USERS MAHASISWA DAN ADMIN
    Route::middleware('role:mahasiswa,admin')->group (function (){
        Route::get('/mahasiswa', function () {
        return view('mahasiswa');
        });

        Route::get('/matkul', function () {
        return view('matkul');
        });

    });

    //PEMBATASAN AKSES HALAMAN UNTUK USERS DOSEN DAN ADMIN
    Route::middleware('role:dosen,admin')->group (function (){
        Route::get('/dosen', function () {
        return view('dosen');
        });

        Route::get('/jurusan', function () {
        return view('jurusan');
        });

    });
});
```
## Serve

Menjalankan project dengan 
```
php artisan serve
```

