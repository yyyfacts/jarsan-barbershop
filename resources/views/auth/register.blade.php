<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Register</title>
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
      max-width: 450px;
      width: 100%;
      padding: 3rem 2.5rem;
    }

    .register-card h3 {
      font-weight: 700;
      margin-bottom: 1.5rem;
      color: #222;
    }

    .btn-register {
      background-color: #000;
      color: white;
      border-radius: 10px;
      transition: 0.3s;
    }

    .btn-register:hover {
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
  <div class="register-container">
    <div class="register-card" id="registerCard">
      <h3 class="text-center mb-3">Daftar</h3>
      <p class="text-center text-muted mb-4">Buat akun baru untuk reservasi di Jarsan Barbershop</p>

      <form action="{{ route('register.process') }}" method="POST">
        @csrf

        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap</label>
          <input type="text" class="form-control p-2" id="name" name="name" placeholder="Masukkan nama lengkap" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Alamat Email</label>
          <input type="email" class="form-control p-2" id="email" name="email" placeholder="contoh@email.com" required>
        </div>

        <div class="mb-3">
          <label for="phone" class="form-label">Nomor Telepon</label>
          <input type="text" class="form-control p-2" id="phone" name="phone" placeholder="08xxxxxxxxxx" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Kata Sandi</label>
          <input type="password" class="form-control p-2" id="password" name="password" placeholder="Masukkan kata sandi" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Kata Sandi</label>
          <input type="password" class="form-control p-2" id="password_confirmation" name="password_confirmation" placeholder="Ulangi kata sandi" required>
        </div>

        <button type="submit" class="btn btn-register w-100 py-2">Daftar</button>

        <p class="text-center mt-3 text-small">
          Sudah punya akun? <a href="{{ route('login') }}" class="text-decoration-none">Masuk di sini</a>
        </p>
      </form>
    </div>
  </div>

  <script>
    document.addEventListener("DOMContentLoaded", () => {
      const card = document.getElementById("registerCard");
      card.style.opacity = 0;
      card.style.transform = "translateY(30px)";
      setTimeout(() => {
        card.style.transition = "all 0.6s ease";
        card.style.opacity = 1;
        card.style.transform = "translateY(0)";
      }, 150);
    });
  </script>
</body>
</html>
