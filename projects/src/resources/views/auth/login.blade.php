<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Login</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <style>
        .custom-nav {
            width: 100%;
            height: 60px;
            border-bottom: 5px solid #eaebeb; /* Alt border stil ve rengi */
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light custom-nav">
    <!-- Navbar içeriği buraya gelecek -->
</nav>

<div class="container" style="margin-top: 100px; margin-left:600px">
    <div class="card" style="width:600px;height:680px;">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <img src="/images/logo.png" alt="Logo" style="width: 150px">
                <h2 class="row justify-content-center align-items-center mt-3" style="color: #d02130">Stil Deposuna Hoşgeldiniz</h2>
            </div>

            @if (session('success'))
                <div class="alert alert-success mt-3">
                    {{ session('success') }}
                </div>
            @endif

            <div class="mt-5 ms-5" style="width:500px;">
                <form id="loginForm" method="POST" action="{{route('login')}}">
                    @csrf
                    <div class="form-group mt-5">
                        <label for="email" style="color: #d02130">Mail Adres</label>
                        <input id="email" type="email" class="form-control mt-2" name="email" value="{{ old('email') }}" required autofocus>
                    </div>

                    <div class="form-group mt-4">
                        <label for="password" style="color: #d02130">Şifre</label>
                        <input id="password" type="password" class="form-control mt-2" name="password" required>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-5">
                        <button type="submit" class="btn btn-primary" style="width: 150px;">Giriş Yap</button>
                    </div>

                    <div class="form-group d-flex justify-content-center mt-3">
                        <a href="{{ route('showRegister') }}" style="color: #d02130;text-decoration: none; font-weight: normal; font-size: large">Hesabınız yok mu? Kayıt olun</a>
                        @error('unSuccesLogin')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS ve Popper.js -->
<script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="/assets/jquery/dist/jquery.min.js"></script>
<script src="/assets/toastr/build/toastr.min.js"></script>

<script>
    $(document).ready(function() {
        @if(session('error'))
            toastr.error('{{ session('error') }}', 'Hata');
        @endif
    });
</script>
</body>
</html>
