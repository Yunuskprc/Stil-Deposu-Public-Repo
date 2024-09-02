<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

    <style>
        html,
        body {
            margin: 0;
            padding: 0;
            height: 100%;
            width: 100%;
            background: linear-gradient(to bottom, #f4a740 50%, #fff 50%);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        main {
            width: 100%;
            max-width: 610px;
            min-height: 80%;
            background: #fff;
            padding: 20px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }
    </style>
</head>

<body>
    <main class="container">
        <div class="row d-flex align-items-center justify-content-center mt-5 ms-5">
            <div class="col text-center">
                <h2 style="color:#727273">Merhaba {{ $user->name }}</h2>
            </div>
        </div>
        <div class="row mt-2"></div>
        <div class="row mt-5 ms-3">
            <div class="col-12">
                <p>Yeni Müşteriler Yeni Gelirler!!!</p>
            </div>
            <div class="row mt-3">
                <div class="col-12">
                    <p>Merhaba {{ $user->name }} yeni siparişlerin var. Siparişleri incelemek için
                        <a class="ms-1" style="color: black; opacity:0.9" href="{{ route('showLogin') }}"> Tıkla</a>
                    </p>
                </div>
                <div class="row mt-3"></div>
            </div>
        </div>




    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
