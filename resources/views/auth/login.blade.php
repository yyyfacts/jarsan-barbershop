<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Jarsan Barbershop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f5f5;
            font-family: 'Poppins', sans-serif;
        }

        .login-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            background-color: #fff;
            border-radius: 20px;
            overflow: hidden;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 900px;
            width: 100%;
        }

        /* Banner kiri */
        .login-image {
            position: relative;
            background: url('{{ asset('images/banner-login.webp') }}') center/cover no-repeat;
            min-height: 100%;
        }

        /* Overlay gelap */
        .login-image::before {
            content: "";
            position: absolute;
            top: 0; left: 0;
            width: 100%; height: 100%;
            background: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        /* Logo di tengah banner */
        .login-logo {
            position: absolute;
            top: 50%;
            left: 50%;
            z-index: 2;
            transform: translate(-50%, -50%);
            text-align: center;
        }

        .login-logo img {
            width: 150px;
            height: auto;
            filter: brightness(1.2);
        }

        .form-section {
            padding: 3rem;
        }

        .form-section h3 {
            font-weight: 700;
            margin-bottom: 1.5rem;
            color: #222;
        }

        .btn-login {
            background-color: #000;
            color: white;
            border-radius: 10px;
            transition: 0.3s;
        }

        .btn-login:hover {
            background-color: #ffffff;
            color: #000;
            border: 1px solid #000;
        }

        .text-small {
            font-size: 0.9rem;
        }

        /* Shadow hitam saat input di-fokus */
        .form-control:focus {
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
            border-color: #000;
            outline: none;
            transition: box-shadow 0.3s ease, border-color 0.3s ease;
        }
    </style>
</head>

<body>

<div class="login-container">
    <div class="login-card row g-0">

        <!-- Gambar kiri -->
        <div class="col-md-6 login-image d-none d-md-block">
            <div class="login-logo">
                <img src="{{ asset('images/logo jarsan.png') }}" alt="Logo Jarsan">
            </div>
        </div>

        <!-- Form kanan -->
        <div class="col-md-6 form-section d-flex flex-column justify-content-center">
            <h3 class="text-center mb-4">Login</h3>

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input 
                        type="email" 
                        name="email" 
                        id="email" 
                        class="form-control p-2" 
                        placeholder="Masukkan email" 
                        required>
                </div>

                <div class="mb-3">
                    <label for="password" class="form-label">Kata Sandi</label>
                    <input 
                        type="password" 
                        name="password" 
                        id="password" 
                        class="form-control p-2" 
                        placeholder="Masukkan kata sandi" 
                        required>
                </div>

                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div>
                        <input type="checkbox" id="remember" name="remember">
                        <label for="remember" class="text-small ms-1">Ingat Saya</label>
                    </div>
                    <a href="#" class="text-decoration-none text-small text-muted">Lupa Password?</a>
                </div>

                <button type="submit" class="btn btn-login w-100 py-2">Masuk</button>

                <p class="text-center text-muted mt-3 text-small">
                    Belum punya akun?
                    <a href="{{ route('register') }}" class="text-decoration-none">Daftar Sekarang</a>
                </p>
            </form>
        </div>
    </div>
</div>

<!-- Animasi fade-in form -->
<script>
    document.addEventListener("DOMContentLoaded", () => {
        const form = document.querySelector(".form-section");
        form.style.opacity = 0;
        form.style.transform = "translateY(20px)";
        setTimeout(() => {
            form.style.transition = "all 0.6s ease";
            form.style.opacity = 1;
            form.style.transform = "translateY(0)";
        }, 150);
    });
</script>

</body>
</html>
