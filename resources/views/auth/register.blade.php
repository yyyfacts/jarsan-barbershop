<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Akun - Jarsan Barbershop</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background-color: #f5f5f5;
        font-family: 'Poppins', sans-serif;
    }

    .register-container {
        min-height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .register-card {
        background-color: #fff;
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        max-width: 500px;
        width: 100%;
        padding: 2.5rem;
    }

    .btn-register {
        background-color: #000;
        color: white;
        border-radius: 10px;
    }

    .btn-register:hover {
        background-color: #333;
        color: white;
    }
    </style>
</head>

<body>
    <div class="register-container">
        <div class="register-card">
            <h3 class="text-center mb-3 fw-bold">Buat Akun Baru</h3>
            <p class="text-center text-muted mb-4 small">Daftar untuk melakukan reservasi online</p>

            <form action="{{ route('register.process') }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap</label>
                    <input type="text" name="name" class="form-control p-2" placeholder="Nama Anda" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Email</label>
                    <input type="email" name="email" class="form-control p-2" placeholder="contoh@email.com" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kata Sandi</label>
                    <input type="password" name="password" class="form-control p-2" placeholder="Minimal 6 karakter"
                        required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Kata Sandi</label>
                    <input type="password" name="password_confirmation" class="form-control p-2"
                        placeholder="Ulangi kata sandi" required>
                </div>
                <button type="submit" class="btn btn-register w-100 py-2 fw-bold">Daftar</button>

                <p class="text-center text-muted mt-3 small">
                    Sudah punya akun? <a href="{{ route('login') }}"
                        class="text-decoration-none fw-bold text-dark">Login di sini</a>
                </p>
            </form>
        </div>
    </div>
</body>

</html>