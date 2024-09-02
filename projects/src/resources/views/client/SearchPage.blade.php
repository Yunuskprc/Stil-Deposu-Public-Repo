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
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>

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

    <main class="container">
        @if ($searchProductName && count($searchProductName) > 0)
            <div class="row mt-2 ms-5">
                <div class="col-12">
                    <h4 class="header">
                        Ürünler
                    </h4>
                </div>
                @foreach ($searchProductName as $product)
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
            </div>
        @endif

        @if ($searchCategoryName && count($searchCategoryName) > 0)
            <div class="row mt-5"></div>

            <div class="row mt-5 ms-5">
                <div class="col-12">
                    <h4 class="header">
                        Kategoriler
                    </h4>
                </div>
                <div class="row mt-2"></div>
                @foreach ($searchCategoryName as $category)
                    <div class="col-4 mainBrandsCard me-2">
                        <a href="{{ route('user.show.CategoryPage', ['category' => $category['category_name']]) }}"
                            markaAd="{{ $category['brands_name'] }}">
                            <h2>{{ $category['category_name'] }}</h2>
                        </a>
                    </div>
                @endforeach
            </div>
        @endif

        @if ($searchBrandName && count($searchBrandName) > 0)
            <div class="row mt-5"></div>
            <div class="row mt-5 ms-5">
                <div class="col-12">
                    <h4 class="header">
                        Markalar
                    </h4>
                </div>
                <div class="row mt-2"></div>
                @foreach ($searchBrandName as $brand)
                    @if ($brand['cardImageURI'] != null)
                        <div class="col-4 d-flex justify-content-center align-items-center me-2"
                            style="height: 220px; width:400px">
                            <a href="{{ route('user.show.getBrandPage', ['brands_name' => $brand['brands_name']]) }}"
                                markaAd="{{ $brand['brands_name'] }}">
                                <img src="{{ Storage::disk('s3')->temporaryUrl('brandsImages/' . $brand['cardImageURI'], now()->addMinutes(60)) }}"
                                    width="400" height="200">
                            </a>
                        </div>
                    @else
                        <div class="col-4 mainBrandsCard me-2">
                            <a href="{{ route('user.show.getBrandPage', ['brands_name' => $brand['brands_name']]) }}"
                                markaAd="{{ $brand['brands_name'] }}">
                                <h2>{{ $brand['brands_name'] }}</h2>
                            </a>
                        </div>
                    @endif
                @endforeach
            </div>

        @endif


        @if (
            !($searchBrandName && count($searchBrandName)) > 0 &&
                !($searchCategoryName && count($searchCategoryName) > 0) &&
                !($searchProductName && count($searchProductName) > 0))
            <div class="d-flex justify-content-center align-items-center" style="height: 100%;">
                <h5 style="opacity: 0.8">Ürün, Kategori, Marka bulunamadı</h5>
            </div>
        @endif

        <div class="row mt-5"></div>
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
    </script>

</body>

</html>
