<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Jarsan Barbershop - Premium Cut</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Poppins:wght@300;400;600&display=swap"
        rel="stylesheet">
    <style>
    body {
        background-color: #1a1a1a;
        color: #fff;
        font-family: 'Poppins', sans-serif;
        height: 100vh;
        overflow: hidden;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(rgba(0, 0, 0, 0.7), rgba(0, 0, 0, 0.7)),
        url('{{ asset("images/banner.webp") }}');
        background-size: cover;
        background-position: center;
    }

    .hero-content {
        text-align: center;
        z-index: 2;
    }

    h1 {
        font-family: 'Playfair Display', serif;
        font-size: 4rem;
        margin-bottom: 1rem;
        animation: fadeInDown 1s ease;
    }

    p {
        font-size: 1.2rem;
        color: #ccc;
        margin-bottom: 2rem;
        animation: fadeInUp 1.2s ease;
    }

    .btn-enter {
        background: transparent;
        border: 2px solid #fff;
        color: #fff;
        padding: 12px 40px;
        font-size: 1rem;
        border-radius: 50px;
        transition: all 0.3s ease;
        text-transform: uppercase;
        letter-spacing: 2px;
        text-decoration: none;
        animation: fadeInUp 1.5s ease;
    }

    .btn-enter:hover {
        background: #fff;
        color: #000;
        transform: scale(1.05);
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    </style>
</head>

<body>
    <div class="hero-content">
        <h1>Jarsan Barbershop</h1>
        <p>Gentleman's Grooming & Premium Styling</p>

        <div class="d-flex gap-3 justify-content-center">
            <a href="{{ url('/login') }}" class="btn-enter">Log In</a>
            <a href="{{ url('/') }}" class="btn-enter" style="background: #fff; color:#000; border:none;">Masuk Sebagai
                Tamu</a>
        </div>
    </div>
</body>

</html>