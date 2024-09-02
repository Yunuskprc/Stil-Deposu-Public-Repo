<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stil Deposu</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/client/style.css">
    <link rel="stylesheet" href="/assets/css/client/productStyle.css">
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/client/index.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">

    <style>
        html,
        body {
            height: 100%;
        }

        body {
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1;
        }

        .footer {
            background: #fefeff;
            height: 170px;
            border-top: 1px solid #eeefee;
        }

        .header {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container w-100 h-100">

        <div class="row mt-5">
            <h4 class="ms-5" style="color:#f37a1b;opacity:0.7">Favorileri Ürünlerim</h4>
        </div>

        <div class="row mt-3 ms-4">
            @if ($products != null)
                @foreach ($products as $product)
                    @php
                        $imageUrl = Storage::disk('s3')->temporaryUrl(
                            'productImages/' . $product->product_detail['file_names'][0],
                            now()->addMinutes(60),
                        );
                    @endphp
                    @include('client.layout.productCard', [
                        'product' => $product,
                        'imageUrl' => $imageUrl,
                    ])
                @endforeach
            @else
                Beğenilen ürün yok!
            @endif
        </div>
    </main>


    @include('client.layout.footer')

    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var links = document.querySelectorAll('#follow-link');
            const imgs = document.querySelectorAll('#follow-img');

            links.forEach((link, index) => {

                var img = imgs[index];
                link.addEventListener('mouseover', function() {
                    if (img) {
                        img.src = '/images/like24px.png';
                    }
                });


                link.addEventListener('mouseout', function() {
                    if (img) {
                        img.src = '/images/unlike24px.png';
                    }
                });

            });
        });


        function addFollowProduct(product_id) {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            var formData = new FormData();
            var product_id = product_id
            formData.append('product_id', product_id);
            fetch('{{ route('user.ppd.add.followProduct') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message)
                        window.location.reload();
                    } else {
                        toastr.error(data.message);
                        if (data.message === 'Lütfen Giriş Yapın') {
                            window.location.href = "/login"
                        }

                    }
                })
                .catch(error => {
                    console.error('Hata:', error);
                });
        }
    </script>




</body>

</html>
