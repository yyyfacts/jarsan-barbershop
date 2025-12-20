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

    .login-image {
        background: url('{{ asset('images/banner-login.webp') }}') center/cover no-repeat;
        min-height: 100%;
        position: relative;
    }

    .login-image::before {
        content: "";
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: rgba(0, 0, 0, 0.5);
    }

    .login-logo {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        text-align: center;
        z-index: 2;
    }

    .login-logo img {
        width: 150px;
        filter: brightness(1.2);
    }

    .form-section {
        padding: 3rem;
    }

    .btn-login {
        background-color: #000;
        color: white;
        border-radius: 10px;
    }

    .btn-login:hover {
        background-color: #333;
        color: white;
    }
    </style>
</head>

<body>
    <div class="login-container">
        <div class="login-card row g-0">
            <div class="col-md-6 login-image d-none d-md-block">
                <div class="login-logo">
                    {{-- Ganti logo di sini --}}
                    <img src="{{ asset('images/logo jarsan.png') }}" alt="Logo Jarsan">
                </div>
            </div>

            <div class="col-md-6 form-section d-flex flex-column justify-content-center">
                <h3 class="text-center mb-4 fw-bold">Selamat Datang</h3>

                @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show small" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                @if($errors->any())
                <div class="alert alert-danger alert-dismissible fade show small" role="alert">
                    <ul class="mb-0 ps-3">
                        @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                @endif

                <form action="{{ route('login.process') }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control p-2" placeholder="contoh@email.com"
                            value="{{ old('email') }}" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Kata Sandi</label>
                        <input type="password" name="password" class="form-control p-2" placeholder="********" required>
                    </div>
                    <div class="mb-3 form-check">
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label small" for="remember">Ingat Saya</label>
                    </div>
                    <button type="submit" class="btn btn-login w-100 py-2 fw-bold">Masuk</button>

                    <p class="text-center text-muted mt-4 small">
                        Belum punya akun? <a href="{{ route('register') }}"
                            class="text-decoration-none fw-bold text-dark">Daftar Sekarang</a>
                    </p>
                </form>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>