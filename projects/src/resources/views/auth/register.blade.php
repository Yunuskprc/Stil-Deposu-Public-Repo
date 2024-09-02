<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
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

<div class="container d-flex justify-content-center align-items-center mt-0" style="height: 100vh;">
    <div class="card" style="width:600px; padding-top: 0px">
        <div class="card-body">
            <div class="row justify-content-center align-items-center">
                <img src="/images/logo.png" alt="Logo" style="width: 150px">
                <h2 class="row justify-content-center align-items-center mt-3" style="color: #d02130">Stil Deposuna Kayıt Olun</h2>
            </div>
            <div class="mt-4 ms-4" style="width:500px;">
                <form method="POST" action="{{ route('register') }}">
                    @csrf

                    <div class="row">
                        <div class="col">
                            <div class="form-group">
                                <label for="name" style="color: #d02130">Ad</label>
                                <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autofocus>
                                @error('name')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="surname" style="color: #d02130">Soyad</label>
                                <input id="surname" type="text" class="form-control @error('surname') is-invalid @enderror" name="surname" value="{{ old('surname') }}" required>
                                @error('surname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="form-group mt-3">
                        <label for="email" style="color: #d02130">Mail Adres</label>
                        <input id="mail_adress" type="email" class="form-control @error('mail_adress') is-invalid @enderror" name="mail_adress" value="{{ old('mail_adress') }}" required>
                        @error('mail_adress')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="row mt-3">
                        <div class="col">
                            <div class="form-group">
                                <label for="password" style="color: #d02130">Şifre</label>
                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required>
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="form-group">
                                <label for="password_confirmation" style="color: #d02130">Şifre Tekrar</label>
                                <input id="password_rep" type="password" class="form-control @error('password_rep') is-invalid @enderror" name="password_rep" required>
                                @error('password_rep')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                                @enderror
                            </div>
                        </div>
                    </div>


                    <div class="form-group mt-3">
                        <label for="phone" style="color: #d02130">Telefon Numarası</label>
                        <input id="phone_number" type="tel" class="form-control @error('phone_number') is-invalid @enderror" name="phone_number" value="{{ old('phone_number') }}" required>
                        @error('phone_number')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group mt-3">
                        <label for="role" style="color: #d02130">Rol</label>
                        <select id="role" class="form-control @error('role') is-invalid @enderror" name="role" required>
                            <option value="user">Kullanıcı Hesabı</option>
                            <option value="seller">Satıcı Hesabı</option>
                        </select>
                        @error('role')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div id="sellerNameField" class="form-group mt-3" style="display: none;">
                        <label for="brands_name" style="color: #d02130">Satıcı İsmi</label>
                        <input id="brands_name" type="text" class="form-control @error('brands_name') is-invalid @enderror" name="brands_name">
                        @error('brands_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group d-flex justify-content-center mt-4">
                        <button type="submit" class="btn btn-primary" style="width: 150px;">Kayıt Ol</button>
                        @error('registerUnSucces')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="form-group d-flex justify-content-center mt-3">
                        <a href="{{ route('showLogin') }}" style="color: #d02130; text-decoration: none; font-weight: normal; font-size: large">Zaten hesabınız var mı? Giriş yapın</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!-- Bootstrap JS ve Popper.js -->
<script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const roleSelect = document.getElementById('role');
        const sellerNameField = document.getElementById('sellerNameField');

        roleSelect.addEventListener('change', function() {
            if (this.value === 'seller') {
                sellerNameField.style.display = 'block';
            } else {
                sellerNameField.style.display = 'none';
            }
        });
    });
</script>
</body>
</html>
