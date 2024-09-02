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


        .countIsOne {
            width: 24px;
            height: 30px;
            border: 1px solid #e7e6e7;
            background-color: #fafafa;
            color: #e6e6e6;
        }

        .count {
            width: 45px;
            height: 30px;
            border: 1px solid #e7e6e7;
            background-color: #fefffe;
            color: #4a4a4a;
        }

        .countIsMoreOne {
            width: 24px;
            height: 30px;
            border: 1px solid #e7e6e7;
            background-color: #fafafa;
            color: #f37a1b;
        }


        .countIsOne:hover {
            background-color: #e6e6e6;
        }

        .countIsMoreOne:hover {
            background-color: #e6e6e6;
        }

        .deleteProduct {
            text-decoration: none;
            color: #4a4a4a;
            cursor: pointer;
        }

        .deleteProduct :hover {
            color: #f27a1a;
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container w-100 h-100">

        <div class="row mt-3">
            @php
                Log::info($basket);
            @endphp
            <h4 style="opacity: 0.9">Sepetim ({{count($basket->products)}})</h4>
        </div>
        <div class="row mt-4"></div>

        <div class="row">
            <div class="col-9">
                @if (!empty($basket->products))
                    @foreach ($basket->productsByBrand as $brandId => $products)
                        <div class="col-11 basketProduct mt-2">
                            <div class="basketHeader">
                                <h5 class="ms-3 mt-2">
                                    <span style="opacity: 0.7">Satıcı:</span>
                                    {{ $products[0]['product']['brand_name'] ?? 'Bilinmeyen Marka' }}
                                </h5>
                            </div>

                            @foreach ($products as $product)
                                <div class="basketBody ms-3">
                                    @php
                                        $productDetail = $product['product']['product_detail'] ?? [];
                                    @endphp
                                    <div class="col-1">
                                        @if ($product['is_active'] == 1)
                                            <input class="form-check-input" type="checkbox" name="productInput"
                                                style="margin-left: 18px" data-id="{{ $product['product_id'] }}"
                                                data-key="acitve" onchange="changeActiveForProduct(event)" checked>
                                        @else
                                            <input class="form-check-input" type="checkbox" name="productInput"
                                                style="margin-left: 18px" data-id="{{ $product['product_id'] }}"
                                                data-key="un_active" onchange="changeActiveForProduct(event)">
                                        @endif
                                    </div>
                                    <div class="col-2">
                                        <img src="/images/instagramLogo.png" height="90px" alt="">
                                    </div>
                                    <div class="col-6">
                                        <div class="col-12">
                                            <span style="font-size: 18px; opacity:0.9; font-weight: 600;">
                                                {{ $product['product']['brand_name'] ?? 'Bilinmeyen Marka' }}
                                            </span>
                                            <span
                                                style="font-size: 16px; opacity:0.8; font-weight: 500; margin-left:5px">
                                                {{ $productDetail['proc_name'] ?? 'Bilinmeyen Ürün' }}
                                            </span>
                                        </div>
                                        <div class="col-12 mt-3">
                                            <span style="font-size: 15px; opacity:0.8;">
                                                Tahmini kargoya teslim: 24 saat içinde
                                            </span>
                                        </div>
                                        <div class="col-12 mt-2">
                                            @foreach ($productDetail as $key => $value)
                                                @if (!in_array($key, ['proc_name', 'proc_desc', 'stock', 'price', 'file_names']))
                                                    <span style="font-size: 15px; opacity:0.8;" class="ms-1">
                                                        {{ getAttributeName($key) }}:
                                                        {{ $key === 'male' ? ($value == '0' ? 'Erkek' : 'Kadın') : $value }}
                                                    </span>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-1 d-flex align-items-center justify-content-center">
                                        @if ($product['count'] == 1)
                                            <button class="countIsOne" id="btnAddAndLessProduct"
                                                data-id="{{ $product['product']['product_id'] }}" data-key="less"
                                                style="border-top-left-radius: 5px; border-bottom-left-radius: 5px;"
                                                disabled>-</button>
                                        @else
                                            <button class="countIsMoreOne" id="btnAddAndLessProduct"
                                                data-id="{{ $product['product']['product_id'] }}" data-key="less"
                                                style="border-top-left-radius:
                                                5px; border-bottom-left-radius: 5px;"
                                                onclick="addOrLessProduct(event)">-</button>
                                        @endif
                                        <button class="count">{{ $product['count'] }} </button>
                                        <button class="countIsMoreOne" id="btnAddAndLessProduct"
                                            data-id="{{ $product['product']['product_id'] }}" data-key="add"
                                            style="border-top-right-radius: 5px;border-bottom-right-radius: 5px;"
                                            onclick="addOrLessProduct(event)">+</button>
                                    </div>
                                    <div class="col-1"></div>

                                    <div class="col-1" style="display: block; align-items: flex-start;">
                                        <div class="col-12 ms-2" style="margin-top: -65px">
                                            <a class="deleteProduct" data-id="{{ $product['product']['product_id'] }}"
                                                onclick="deleteProduct(event)">
                                                <span style="font-size: 15px; opacity:0.8;">
                                                    Sil <i class="fa-solid fa-trash-can mt-2"></i>
                                                </span>
                                            </a>
                                        </div>
                                        <div class="col-12 mt-4">
                                            <span name="productPrice"
                                                style="font-size: 20px; opacity:0.8; color:#f37a1b"
                                                data-isActive="{{ $product['is_active'] }}">
                                                {{ $productDetail['price'] * $product['count'] }} TL
                                            </span>
                                        </div>
                                    </div>
                                </div>
                                <hr width="100%" style="color: #e7e6e7">
                            @endforeach

                        </div>
                    @endforeach

                @endif
            </div>
            <div class="col-3">
                <div class="row">
                    <div class="col-12" style="border: 1px solid #e7e6e7; border-radius: 5px;">
                        <div class="row mt-4 ms-3">
                            <h4 style="opacity: 0.9">Sipariş Özeti</h4>
                        </div>
                        <div class="row mt-4">
                            <div class="col-6">
                                <h6 style="opacity: 0.8">Ürünün Toplamı</h6>
                            </div>
                            <div class="col-6 text-end">
                                <h6 id="allProductTotalPrice">7681.12 TL</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <h6 style="opacity: 0.8">Kargo Toplam</h6>
                            </div>
                            <div class="col-6 text-end">
                                <h6>40 TL</h6>
                            </div>
                        </div>
                        <div class="row mt-2">
                            <div class="col-6">
                                <h6 style="opacity: 0.8">Kargo İndirimi</h6>
                            </div>
                            <div class="col-6 text-end">
                                <h6>-40 TL</h6>
                            </div>
                        </div>
                        <div class="row mt-3 w-100">
                            <hr width="100%" class="ms-2">
                        </div>

                        <div class="row mt-2">
                            <div class="col-6">
                                <h5 style="opacity: 0.9">Toplam</h5>
                            </div>
                            <div class="col-6 text-end">
                                <h5 id="allProductTotalPriceEnd">20000 TL</h5>
                            </div>
                        </div>

                        <div class="row mt-3">
                            <div class="col-12">
                                <span style="font-size: 13px;opacity:0.9">
                                    🔥
                                    Sepetindeki ürünler son <span style="color: #f27a1a">3 günde 500+ adet </span>
                                    satıldı!
                                </span>
                            </div>
                        </div>
                        <div class="row mt-3"></div>
                    </div>
                </div>
                <div class="row mt-4">
                    <div class="col-12">
                        <form id="basketForm" action="{{ route('user.show.basket.final-basket') }}" method="get">
                            <a class="btn" onclick="sendBasketForm()"
                                style="text-decoration: none; background:#f8882c; color:#ffffff; cursor:pointer; width:100%; ">
                                <span style="font-size: 24px; margin-top:20px; margin-bottom:20px">Sepeti Onayla</span>

                            </a>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
    </main>


    @include('client.layout.footer')

    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    @php
        function getAttributeName($keyword)
        {
            switch ($keyword) {
                case 'size':
                    return 'Beden';
                case 'male':
                    return 'Cinsiyet';
                case 'person_count':
                    return 'Kişi Sayısı';
                case 'material':
                    return 'Materyal';
                case 'style':
                    return 'Tip';
                case 'formType':
                    return 'Form Tipi';
                case 'skinType':
                    return 'Cilt Tipi';
                case 'bindType':
                    return 'Bağlama Şekli';
                case 'color':
                    return 'Renk';
                default:
                    return ucfirst($keyword); // Fallback to capitalize the keyword
            }
        }
    @endphp

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const spans = document.querySelectorAll('span[name="productPrice"]');
            var totalPrice = 0;
            spans.forEach(span => {
                var isActive = span.getAttribute('data-isActive');
                if (isActive == 1) {
                    const priceText = span.innerText.trim();
                    const priceNumber = parseFloat(priceText.replace(' TL', '').replace(',', '.'));
                    totalPrice += priceNumber;
                }
            });

            document.getElementById('allProductTotalPrice').innerText = totalPrice + " TL";
            document.getElementById('allProductTotalPriceEnd').innerText = totalPrice + " TL";
        });


        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function sendBasketForm() {
            document.getElementById('basketForm').submit();
        }


        function changeActiveForProduct(event) {
            event.preventDefault();
            const targetButton = event.target;
            const product_id = targetButton.getAttribute('data-id');
            const type = targetButton.getAttribute('data-key');

            const formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('type', type);
            fetch('{{ route('user.ppd.basket.change-active') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message);
                        window.location.reload();
                    } else {
                        toastr.error(data.message);
                        if (data.message === 'Lütfen Giriş Yapın') {
                            window.location.href = "/login";
                        }
                    }
                })
                .catch(error => {
                    console.error('Hata:', error);
                });

        }



        function addOrLessProduct(event) {
            const targetButton = event.target;
            const product_id = targetButton.getAttribute('data-id');
            const type = targetButton.getAttribute('data-key');

            console.log(product_id, "  ", type);

            const formData = new FormData();
            formData.append('product_id', product_id);
            formData.append('type', type);

            fetch('{{ route('user.ppd.basket.add-less-product') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message);
                        window.location.reload();
                    } else {
                        toastr.error(data.message);
                        if (data.message === 'Lütfen Giriş Yapın') {
                            window.location.href = "/login";
                        }
                    }
                })
                .catch(error => {
                    console.error('Hata:', error);
                });
        }

        function deleteProduct(event) {
            event.preventDefault();

            const targetButton = event.currentTarget;
            const product_id = targetButton.getAttribute('data-id');

            const formData = new FormData();
            formData.append('product_id', product_id);

            fetch('{{ route('user.ppd.basket.delete-product') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success(data.message);
                        window.location.reload();
                    } else {
                        toastr.error(data.message);
                        if (data.message === 'Lütfen Giriş Yapın') {
                            window.location.href = "/login";
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
