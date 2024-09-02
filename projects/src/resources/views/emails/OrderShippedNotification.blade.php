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
                <p>Stil Deposunda'ndan yaptğınız siparişiniz kargoya verilmiştir!.</p>
            </div>
            <div class="col-12">
                <p>İşte Sipariş Detayları!.</p>
            </div>
        </div>
        <div class="row mt-3"></div>


        <div id="finish" class="row mt-5 w-100"
            style="border: 1px solid #e7e6e7; border-radius:5px;margin-left: 1px;">
            <div class="mt-4 ms-3 w-100" style="display: flex; align-items: center; justify-content: space-between;">
                <h4 style="opacity: 0.9; margin: 0;">Sipariş Özeti</h4>

            </div>
            <div class="row mt-5"></div>

            @php
                $totalPrice = 0;
            @endphp

            @if ($products)
                @php
                    $totalPrice = 0;
                @endphp
                @foreach ($products as $product)
                    @php
                        $totalPrice += $product['count'] * $product['product_detail']['price'];
                    @endphp
                    <div class="col-6 mt-2">
                        <span style="opacity: 0.8; font-size:15px"> {{ $product['brand_name'] }} -
                            {{ $product['product_detail']['proc_name'] }}
                        </span>
                    </div>
                    <div class="col-2 mt-2">
                        <span style="opacity: 0.8; font-size:15px;">
                            Adet: {{ $product['count'] }}
                        </span>
                    </div>
                    <div class="col-2 mt-2">
                        <span style="opacity: 0.8; font-size:15px;color:#f37a1b">
                            {{ $product['product_detail']['price'] * $product['count'] }} TL
                        </span>
                    </div>
                @endforeach
            @endif
            <div class="row mt-3">
                <div class="col-8">
                    <span style="opacity: 0.8; font-size:18px">Toplam Fiyat:</span>
                </div>
                <div class="col-2">
                    <span style="opacity: 0.8; font-size:18px" id="totalPriceInFinish">{{ $totalPrice }} TL</span>
                </div>
            </div>
            <div class="row mt-5"></div>
        </div>




        <div class="row mt-4 ms-3 w-100" style="display: flex; align-items: center; justify-content: space-between;">
            <h4 style="opacity: 0.9; margin: 0;">Adres Bilgileri</h4>

        </div>
        <div class="row mt-3">
            <div class="col-12">
                <div class="d-flex align-items-center">
                    <span style="opacity: 0.8; font-size: 15px;" id="streetCityInFinish"></span>
                    <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                        id="adressDetailInFinish">{{ $adress['addressDetails'] }} {{ $adress['street'] }}
                        {{ $adress['city'] }}</span>
                    <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                        id="nameSurnameInFinish">{{ $adress['name'] }} {{ $adress['surname'] }}</span>
                    <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                        id="phoneNumberInFinish">{{ $adress['phoneNumber'] }} </span>
                </div>
            </div>
        </div>


        <div class="row mt-4"></div>


        <div class="row mt-5"></div>
        </div>

        <div class="row mt-5"></div>


    </main>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/2.11.6/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
