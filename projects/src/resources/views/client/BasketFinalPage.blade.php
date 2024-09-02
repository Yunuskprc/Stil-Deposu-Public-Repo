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
            height: auto;
        }

        .footer {
            background: #fefeff;
            height: 170px;
            border-top: 1px solid #eeefee;
        }


        .btnComplateBasket {
            border: 1px solid rgb(20, 20, 20);
            border-radius: 5px;
            width: 300px;
            font-size: 24px;
            height: 60px;
            color: black;
            opacity: 0.8;
            background-color: #ffffff
        }

        .btnComplateBasket:hover {
            border: 1px solid #e7e6e7;
            background: #f27a1a;
            color: #ffffff;
        }

        .selectAdressBtn {
            text-decoration: none;
            cursor: pointer;
            color: black;
            opacity: 0.8;
        }

        .selectAdressBtn:hover {
            color: #f27a1a
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container w-100 h-100">


        <div class="row mt-4"></div>

        <div class="row">

            <!-- Products -->
            <div class="row mt-3 w-100" style="border: 1px solid #e7e6e7; border-radius:5px">
                <div class="row mt-4 ms-3">
                    <h4 style="opacity: 0.9">Sipariş Özeti</h4>
                </div>
                <div class="row mt-3"></div>
                @if ($basket)
                    @foreach ($basket->products as $index => $product)
                        @php
                            $product_detail = $product['product'];
                            $isLast = $index === count($basket->products) - 1;
                        @endphp
                        <div class="col-12 mt-2" style="{{ $isLast ? '' : 'border-bottom: solid 1px #e7e6e7;' }}">
                            <div class="row no-gutters">
                                <div class="col-2 d-flex justify-content-center align-items-center">
                                    <img width="90px" style="height: auto; object-fit: cover;"
                                        src="/images/instagramLogo.png" alt="">
                                </div>
                                <div class="col-6">
                                    <div class="row mt-2">
                                        <span style="font-size: 16px; opacity: 0.8; font-weight:bold">
                                            {{ $product_detail['brand_name'] }} -
                                            {{ $product_detail['product_detail']['proc_name'] }}
                                        </span>
                                    </div>
                                    <div class="d-flex flex-wrap mt-3">
                                        @foreach ($product_detail['product_detail'] as $key => $value)
                                            @if (!in_array($key, ['proc_name', 'proc_desc', 'stock', 'price', 'file_names']))
                                                <span
                                                    style="font-size: 15px; opacity:0.8; margin-right: 15px; margin-bottom: 5px;">
                                                    {{ getAttributeName($key) }}:
                                                    {{ $key === 'male' ? ($value == '0' ? 'Erkek' : 'Kadın') : $value }}
                                                </span>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-1  d-flex justify-content-center align-items-center">
                                    <span style="opacity: 0.8; font-size:15px;">
                                        Adet: {{ $product['count'] }}
                                    </span>
                                </div>
                                <div class="col-3 d-flex justify-content-center align-items-center">
                                    <span id="productPrice" name ="productPrice"
                                        style="font-size: 16px; opacity: 0.8; font-weight:bold; color:#f37a1b">
                                        {{ $product_detail['product_detail']['price'] * $product['count'] }} TL
                                    </span>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <div class="row mt-2 text-end mb-3">
                        <span style="font-size: 20px;opacity:0.8;">
                            Toplam Fiyat: <span id="totoalPrice" name="totalPrice"
                                style="color:#f37a1b; opacity:0.9"></span>
                        </span>
                    </div>
                @endif
            </div>


            <!-- Adress Select -->
            <div id="adress" class="row mt-5 w-100" style="border: 1px solid #e7e6e7; border-radius:5px">
                <div class="mt-4 ms-3 w-100"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <h4 style="opacity: 0.9; margin: 0;">Adres Bilgileri</h4>
                    <a href="#" id="addAddressLink"
                        style="opacity: 0.8; text-decoration: none; color: inherit; margin-left: auto;"
                        onclick="openModalForAdress()">
                        <h5 style="margin: 0;">+ Yeni Bir Adres Ekle</h5>
                    </a>
                </div>

                @php
                    $addresses = json_decode($user_info->adress, true);
                @endphp
                @if (!empty($addresses))
                    <div class="row mt-3">
                        @foreach ($addresses as $index => $address)
                            <div class="adressCart mt-2 ms-3" style="height:190px">
                                <div class="adressHeader d-flex align-items-center">
                                    <span style="font-size: 14px; opacity: 0.8">{{ $address['addressName'] }}</span>
                                    <span style="font-size: 14px; opacity: 0.9; margin-left: auto;">
                                        <a onclick="selectedAdress(event)" data-index="{{ $index }}"
                                            class="selectAdressBtn">Adresi
                                            Seç</a>
                                    </span>
                                </div>

                                <div class="adressBody">
                                    <span class="long-text"> {{ $address['name'] }} {{ $address['surname'] }}</span>
                                    <span class="long-text"> {{ $address['street'] }}</span>
                                    <span class="long-text"> {{ $address['addressDetails'] }} </span>
                                    <span class="long-text"> {{ $address['city'] }}</span>
                                    <span class="long-text"> {{ $address['phoneNumber'] }}</span>
                                </div>
                            </div>
                        @endforeach
                        <row class="mt-5"></row>
                    </div>
                @endif
            </div>


            <!-- debitCard Select -->
            <div id="debitCard" class="row mt-5 w-100"
                style="border: 1px solid #e7e6e7; border-radius:5px; display:none">
                <div class="mt-4 ms-3 w-100"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <h4 style="opacity: 0.9; margin: 0;">Ödeme Bilgileri</h4>
                    <a href="#" id="addAddressLink"
                        style="opacity: 0.8; text-decoration: none; color: inherit; margin-left: auto;"
                        onclick="openModalForDebitCard()">
                        <h5 style="margin: 0;">+ Yeni Bir Kart Ekle</h5>
                    </a>
                </div>

                @php
                    $cards = json_decode($user_info->cards);
                @endphp
                @if (!empty($cards))
                    <div class="row mt-3">
                        @foreach ($cards as $index => $card)
                            <div class="debitCard mt-2 ms-3">
                                <div class="debitCardHeader d-flex align-items-center">
                                    <span style="font-size: 14px;opacity:0.8">{{ $card->cart_name }}</span>
                                    <span style="font-size: 14px;opacity:0.8; margin-left: auto;">
                                        <a onclick="selectedDebitCard(event)" data-index="{{ $index }}"
                                            data-key="debit">Kartı Seç</a></span>
                                </div>
                                <div class="debitCardBody d-flex">
                                    @php
                                        $maskedCardNumber = substr_replace($card->cart_number, '******', 6, 6);
                                        $date = $card->cart_skt_month . '/' . $card->cart_skt_year;
                                    @endphp
                                    <div class="col-7 d-flex flex-column">
                                        <span class="mt-3">{{ $maskedCardNumber }}</span>
                                        <span class="mt-1">{{ $date }}</span>
                                    </div>
                                    <div class="col-1"></div>
                                    <div class="col-4 d-flex justify-content-end">
                                        <img class="mt-3" width="50px" height="50px"
                                            src="{{ $card->cart_type }}" alt="">
                                    </div>
                                </div>
                            </div>
                        @endforeach
                        <row class="mt-5"></row>
                    </div>
                @endif
            </div>


            <div id="finish" class="row mt-5 w-100"
                style="border: 1px solid #e7e6e7; border-radius:5px; display:none">
                <div class="mt-4 ms-3 w-100"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <h4 style="opacity: 0.9; margin: 0;">Sipariş Özeti</h4>

                </div>

                <div class="row mt-3">
                    @if ($basket)
                        @foreach ($basket->products as $index => $product)
                            @php
                                $product_detail = $product['product'];
                                $isLast = $index === count($basket->products) - 1;
                            @endphp
                            <div class="col-6 mt-2">
                                <span style="opacity: 0.8; font-size:15px"> {{ $product_detail['brand_name'] }} -
                                    {{ $product_detail['product_detail']['proc_name'] }}</span>
                            </div>
                            <div class="col-2 mt-2"><span style="opacity: 0.8; font-size:15px;">
                                    Adet: {{ $product['count'] }}
                                </span></div>
                            <div class="col-2 mt-2"> <span style="opacity: 0.8; font-size:15px;color:#f37a1b">
                                    {{ $product_detail['product_detail']['price'] * $product['count'] }} TL
                                </span></div>
                        @endforeach
                    @endif
                </div>
                <div class="row mt-3">
                    <div class="col-8">
                        <span style="opacity: 0.8; font-size:18px">Toplam Fiyat:</span>
                    </div>
                    <div class="col-2">
                        <span style="opacity: 0.8; font-size:18px" id="totalPriceInFinish"></span>
                    </div>
                </div>
                <div class="row mt-2">
                    <hr width="100%" style="color: #cecece">
                </div>


                <div class="row mt-4 ms-3 w-100"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <h4 style="opacity: 0.9; margin: 0;">Adres Bilgileri</h4>

                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <span style="opacity: 0.8; font-size: 15px;" id="streetCityInFinish"></span>
                            <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                                id="adressDetailInFinish"></span>
                            <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                                id="nameSurnameInFinish"></span>
                            <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                                id="phoneNumberInFinish"></span>
                        </div>
                    </div>
                </div>

                <div class="row mt-2">
                    <hr width="100%" style="color: #cecece">
                </div>


                <div class="row mt-4 ms-3 w-100"
                    style="display: flex; align-items: center; justify-content: space-between;">
                    <h4 style="opacity: 0.9; margin: 0;">Ödeme Bilgileri</h4>

                </div>
                <div class="row mt-3">
                    <div class="col-12">
                        <div class="d-flex align-items-center">
                            <span style="opacity: 0.8; font-size: 15px;" id="cartNumberInFinish"></span>
                            <span class="ms-4" style="opacity: 0.8; font-size: 15px;"
                                id="cartSSTNumberInFinish"></span>
                        </div>
                    </div>
                </div>
                <div class="row mt-2">
                    <hr width="100%" style="color: #cecece">
                </div>

                <div class="row mt-4"></div>

                <div class="row mt-3">
                    <div class="col-8"></div>
                    <div class="col-3">
                        <button onclick="complateBasket()" id="btnComplateBasket" class="btnComplateBasket">Sepeti
                            Tamamla</button>
                    </div>
                </div>


                <div class="row mt-5"></div>
            </div>

            <div class="row mt-5"></div>

        </div>

        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        @include('client.layout.footer')

    </main>






    <!-- Adres Modal'ı-->
    <div class="modal fade" id="adress-modal" tabindex="-1" aria-labelledby="addressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Yeni Adres Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modalFormAdress" data-key="adress">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="name" class="form-label">Ad</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="col-md-6">
                                <label for="surname" class="form-label">Soyad</label>
                                <input type="text" class="form-control" id="surname" name="surname" required>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="city" class="form-label">Şehir</label>
                                <input type="text" class="form-control" id="city" name="city" required>
                            </div>
                            <div class="col-md-6">
                                <label for="street" class="form-label">Mahalle</label>
                                <input type="text" class="form-control" id="street" name="street" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="addressDetails" class="form-label">Adres Detayları</label>
                            <textarea class="form-control" id="addressDetails" name="addressDetails" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="phoneNumber" class="form-label">Telefon Numarası</label>
                            <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                        </div>
                        <div class="mb-3">
                            <label for="addressName" class="form-label">Adres Adı</label>
                            <input type="text" class="form-control" id="addressName" name="addressName" required>
                        </div>
                        <div class="mb-3 d-flex justify-content-center mt-4">
                            <button type="submit" class="btn newAdressBtn" style="width:150px">Kaydet</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Debit Card Modal -->
    <div class="modal fade" id="debit-cart-modal" tabindex="-1" aria-labelledby="addressModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addressModalLabel">Yeni Kart Ekle</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="modalFormCard" data-key="debit">
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="cartName" class="form-label">Kart Adı</label>
                                <input type="text" class="form-control" id="cartName" name="cartName" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cartNumber" class="form-label">Kart Numarası</label>
                            <input type="text" class="form-control" id="cartNumber" name="cartNumber" required>
                        </div>
                        <div class="row mb-3">
                            <div class="col-md-6">
                                <label for="sktMonth" class="form-label">SKT</label>
                                <div class="d-flex">
                                    <input type="text" class="form-control w-50 me-2" id="sktMonth"
                                        name="sktMonth" placeholder="Ay" required>
                                    <input type="text" class="form-control w-50" id="sktYear" name="sktYear"
                                        placeholder="Yıl" required>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="cvv" class="form-label">CVV</label>
                                <input type="text" class="form-control" id="cvv" name="cvv" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="cartOwnerName" class="form-label">Kart Sahibinin Adı</label>
                            <input type="text" class="form-control" id="cartOwnerName" name="cartOwnerName"
                                required>
                        </div>
                        <div class="mb-3">
                            <label for="cartType" class="form-label">Kart Tipi</label>
                            <select class="form-control" name="cartType" id="cartType">
                                <option value="0" selected>Bir Banka Seçin</option>
                                <option value="1">Ziraat Bankası</option>
                                <option value="2">VakıfBank</option>
                                <option value="3">İş Bankası</option>
                                <option value="4">HalkBank</option>
                                <option value="5">Garanti BBVA</option>
                                <option value="6">Yapı Kredi</option>
                                <option value="7">Akbank</option>
                                <option value="8">QNB FinansBank</option>
                                <option value="10">Diğer</option>
                            </select>
                        </div>
                        <div class="mb-3 d-flex justify-content-center mt-4">
                            <button type="submit" class="btn newAdressBtn" style="width:150px">Kaydet</button>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>


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
                    return ucfirst($keyword);
            }
        }
    @endphp

    <script>
        function finishInputsTextAdd() {
            // adress
            document.getElementById('streetCityInFinish').innerText = selectedAddress['street'] + " / " + selectedAddress[
                'city'];
            document.getElementById('adressDetailInFinish').innerText = selectedAddress['addressDetails'];
            document.getElementById('nameSurnameInFinish').innerText = selectedAddress['name'] + " " + selectedAddress[
                'surname'];
            document.getElementById('phoneNumberInFinish').innerText = selectedAddress['phoneNumber'];

            const number = selectedDebitCardInfo['cart_number'];
            const maskedNumber = number.slice(0, 6) + '******' + number.slice(12);
            document.getElementById('cartNumberInFinish').innerText = "Kart Numarası: " + maskedNumber;
            document.getElementById('cartSSTNumberInFinish').innerText = "Kart Son Kullanma Tarihi: " +
                selectedDebitCardInfo['cart_skt_month'] + " / " +
                selectedDebitCardInfo['cart_skt_year'];

        }

        // Total price calculator
        document.addEventListener('DOMContentLoaded', function() {
            const priceSpans = document.querySelectorAll('span[name="productPrice"]');
            let totalPrice = 0;
            priceSpans.forEach(span => {
                const priceText = span.innerText.trim();
                const priceNumber = parseFloat(priceText.replace(' TL', '').replace(',', '.'));
                totalPrice += priceNumber;
            });

            const totalPriceSpan = document.getElementById('totoalPrice');
            const totalPriceInFinish = document.getElementById('totalPriceInFinish');
            totalPriceSpan.innerText = totalPrice + " TL";
            totalPriceInFinish.innerText = totalPrice + " TL";
        });

        var selectedAddress = [];
        var selectedDebitCardInfo = [];

        // Select already existing card
        function selectedDebitCard(event) {
            event.preventDefault();
            const targetButton = event.target;
            const cardIndex = targetButton.getAttribute('data-index');
            console.log(cardIndex);

            const debitCards = @json($cards);
            const index = parseInt(cardIndex);

            if (index >= 0 && index < debitCards.length) {
                const card = debitCards[index];
                selectedDebitCardInfo = {
                    cart_name: card['cart_name'],
                    cart_number: card['cart_number'],
                    cart_skt_month: card['cart_skt_month'],
                    cart_skt_year: card['cart_skt_year'],
                    cart_cvv: card['cart_cvv'],
                    cart_owner_name: card['cart_owner_name'],
                    cart_type: card['cart_type']
                };

                toastr.success(card['cart_name'] + ' ödeme kartı olarak seçildi!');
                finishInputsTextAdd();
                document.getElementById('finish').style.display = "block";
            } else {
                toastr.error('Kart Bulunamadı!');
            }
        }

        // Select existing address
        function selectedAdress(event) {
            event.preventDefault();
            const targetButton = event.target;
            const addressIndex = targetButton.getAttribute('data-index');
            console.log(addressIndex);

            const addresses = @json($addresses);
            const index = parseInt(addressIndex);

            if (index >= 0 && index < addresses.length) {
                const address = addresses[index];
                selectedAddress = {
                    'name': address['name'],
                    'surname': address['surname'],
                    'city': address['city'],
                    'street': address['street'],
                    'addressDetails': address['addressDetails'],
                    'phoneNumber': address['phoneNumber'],
                    'addressName': address['addressName'],
                };

                toastr.success(address['addressName'] + ' sipariş adresi olarak seçildi!');
                document.getElementById('debitCard').style.display = "block";
                document.getElementById('finish').style.display = "none";
            } else {
                toastr.error('Adres Bulunamadı!');
            }
        }

        // Select new address
        document.getElementById('modalFormAdress').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const address = {};

            formData.forEach((value, key) => {
                address[key] = value;
            });

            selectedAddress = {
                'name': address['name'],
                'surname': address['surname'],
                'city': address['city'],
                'street': address['street'],
                'addressDetails': address['addressDetails'],
                'phoneNumber': address['phoneNumber'],
                'addressName': address['addressName'],
            };
            toastr.success(address['addressName'] + ' sipariş adresi olarak seçildi!');
            var modal = bootstrap.Modal.getInstance(document.getElementById('adress-modal'));
            modal.hide();
            document.getElementById('debitCard').style.display = "block";
            document.getElementById('finish').style.display = "none";
        });

        document.getElementById('modalFormCard').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const card = {};

            formData.forEach((value, key) => {
                card[key] = value;
            });

            selectedDebitCardInfo = {
                cartName: card['cartName'],
                cartNumber: card['cartNumber'],
                sktMonth: card['sktMonth'],
                sktYear: card['sktYear'],
                cvv: card['cvv'],
                cartOwnerName: card['cartOwnerName'],
                cartType: card['cartType']
            };

            toastr.success(card['cartName'] + ' ödeme kartı olarak seçildi!');
            var modal = bootstrap.Modal.getInstance(document.getElementById('debit-cart-modal'));
            modal.hide();
            finishInputsTextAdd();
            document.getElementById('finish').style.display = "block";
        });
    </script>



    <script>
        function openModalForAdress() {
            var addressModal = new bootstrap.Modal(document.getElementById('adress-modal'));
            addressModal.show();
        }

        function openModalForDebitCard() {
            var addressModal = new bootstrap.Modal(document.getElementById('debit-cart-modal'));
            addressModal.show();
        }


        function complateBasket() {
            var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
            console.log('girdik')
            const formData = new FormData();
            const jsonSelectedDebitCardInfo = JSON.stringify(selectedDebitCardInfo);
            const jsonSelectedAddress = JSON.stringify(selectedAddress);

            formData.append('cards', jsonSelectedDebitCardInfo);
            formData.append('address', jsonSelectedAddress);

            fetch('{{ route('user.ppd.basket.complate-basket') }}', {
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
                        window.location.href = "/";
                    } else {
                        toastr.error(data.message);
                        if (data.message === 'Lütfen Giriş Yapın') {
                            window.location.href = "/login";
                        }

                        if (data.message === 'Hesabınızı doğrulamadan sipariş veremezsiniz!.') {
                            window.location.href = "/user/show/profile";
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
