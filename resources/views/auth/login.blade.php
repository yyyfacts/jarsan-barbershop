@extends('layouts.app')
@section('title', 'Login Member')
@section('content')
<div class="d-flex align-items-center justify-content-center py-5" style="min-height: 90vh;">
    <div class="container" style="max-width: 450px;">
        <div class="p-5 shadow-lg bg-dark border border-warning" data-aos="fade-up">
            <h2 class="text-gold fw-bold mb-5 text-center">AUTHENTICATE</h2>

            @if($errors->any())
            <div class="alert alert-danger rounded-0 border-0 mb-4">{{ $errors->first() }}</div>
            @endif

            <form action="{{ route('login.process') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label class="fw-bold text-gold small" style="letter-spacing: 2px;">EMAIL ADDRESS</label>
                    <input type="email" name="email"
                        class="form-control bg-transparent border-0 border-bottom border-warning text-white rounded-0 px-0"
                        placeholder="gentleman@example.com" required style="box-shadow: none;">
                </div>
                <div class="mb-4">
                    <label class="fw-bold text-gold small" style="letter-spacing: 2px;">PASSWORD</label>
                    <input type="password" name="password"
                        class="form-control bg-transparent border-0 border-bottom border-warning text-white rounded-0 px-0"
                        placeholder="••••••••" required style="box-shadow: none;">
                </div>
                <button type="submit" class="btn btn-gold-luxury w-100 py-3 mt-4">LOGIN ACCESS</button>
            </form>

            <p class="text-center text-white mt-5 small">
                Belum terdaftar? <a href="/register"
                    class="text-gold fw-bold text-decoration-none border-bottom border-warning">Daftar Sekarang</a>
            </p>
        </div>
    </div>
</div>
@endsection