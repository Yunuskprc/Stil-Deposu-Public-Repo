<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/admin-panel/style.css">
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <script src="/assets/js/admin-panel/index.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">

    <style>
        body {
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 16%;
            height: 100vh;
            background: #272744;
            border-right: 1px solid #444575;
        }

        .main-content {
            margin-left: 16%;
            padding: 20px;
            background: #fffefe;
            height: 100vh;
            overflow-y: auto;
            flex: 1;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        @include('admin-panel.layout.sidebar')
    </div>

    <main class="main-content">
        <div class="container">
            <div class="row mt-3">
                <div class="col-12 ms-3">
                    <span style="font-size:28px; opacity:0.8; font-weight:600">
                        Devam Eden Satışlar
                    </span>
                </div>
                <div class="mt-3 col-12 d-flex align-items-center justify-content-center"
                    style=" border:2px solid #e7e6e7;border-radius:10px;  overflow-y: auto; min-height:100px">
                    <div style="width: 98%; height: 90%;">
                        <div class="row">
                            @if (count($waitingSales) > 0)
                                @foreach ($waitingSales as $sales)
                                    @if ($sales->is_completed == 0)
                                        <div class="col-12 mt-3" style="border: 1px solid #e7e6e7; border-radius:5px;">
                                            <div class="header w-100 mt-2">
                                                <span class="ms-1"
                                                    style="font-size: 20px;opacity:0.9">{{ $sales->user['name'] }}
                                                    {{ $sales->user['surname'] }}</span>
                                                <div class="d-flex">
                                                    <span class="mt-2" style="font-size: 16px;opacity:0.8">Mail
                                                        Adresi:
                                                        {{ $sales->user['mail_adress'] }}</span>
                                                    <span class="mt-2 ms-5" style="font-size: 16px;opacity:0.8">Telefon
                                                        Numarası:
                                                        {{ $sales->user['phone_number'] }}</span>
                                                </div>

                                            </div>
                                            <div class="body mt-5 w-100">
                                                <div class="col-12 ms-4">
                                                    <span style="font-size: 20px;opacity:0.9">Ürünler</span>
                                                </div>
                                                @php
                                                    $salesPrice = 0;
                                                @endphp
                                                @foreach ($sales->products as $product)
                                                    @php
                                                        $totalPrice =
                                                            $product['count'] *
                                                            $product['product']['product_detail']['price'];
                                                        $salesPrice += $totalPrice;
                                                    @endphp
                                                    <div class="col-12 d-flex">
                                                        <span class="mt-2"
                                                            style="font-size: 16px;opacity:0.8">Kategori:
                                                            {{ $product['product']['category_name'] }}</span>
                                                        <span class="mt-2 ms-5" style="font-size: 16px;opacity:0.8">Ürün
                                                            Adı:
                                                            {{ $product['product']['product_detail']['proc_name'] }}</span>
                                                        <span class="mt-2 ms-5"
                                                            style="font-size: 16px;opacity:0.8">Fiyat:
                                                            {{ $product['product']['product_detail']['price'] }}</span>
                                                        <span class="mt-2 ms-5"
                                                            style="font-size: 16px;opacity:0.8">Adet:
                                                            {{ $product['count'] }}</span>
                                                        <span class="mt-2 ms-5"
                                                            style="font-size: 16px;opacity:0.8">Toplam Fiyat:
                                                            {{ $totalPrice }} TL
                                                        </span>
                                                    </div>
                                                    <hr>
                                                @endforeach
                                                <div class="col-12 mt-5 ms-4">
                                                    <span style="font-size: 20px;opacity:0.9">Adress
                                                        Bilgileri</span>
                                                </div>
                                                <div class="col-12 d-flex">
                                                    <span class="mt-2" style="font-size: 16px;opacity:0.8">
                                                        {{ $sales->order_address['city'] }} -
                                                        {{ $sales->order_address['street'] }}
                                                    </span>
                                                    <span class="mt-2 ms-3" style="font-size: 16px;opacity:0.8">
                                                        {{ $sales->order_address['addressDetails'] }}
                                                    </span>
                                                    <span class="mt-2 ms-5" style="font-size: 16px;opacity:0.8">
                                                        {{ $sales->order_address['name'] }}
                                                        {{ $sales->order_address['surname'] }}
                                                    </span>
                                                    <span class="mt-2 ms-5" style="font-size: 16px;opacity:0.8">
                                                        {{ $sales->order_address['phoneNumber'] }}
                                                    </span>
                                                </div>
                                                <div class="row w-100 mt-5">
                                                    <div class="col-8">
                                                        <span style="font-size: 18px; opacity:0.8">
                                                            Toplam Sipariş Ücreti: {{ $salesPrice }} TL
                                                        </span>
                                                        <button class="ms-5" onclick="salesComplated(event)"
                                                            data-salesId="{{ $sales->waiting_id }}"
                                                            style="border:1px solid #e7e6e7; border-radius:5px; background-color:#ffffff; font-size: 16px; color:#444575; opacity:0.9; font-weight:500; padding:10px 20px;">
                                                            Ürünü Kargoya Ver
                                                        </button>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mt-5"></div>
                                        </div>
                                    @endif
                                @endforeach
                            @else
                                <div class="d-flex align-items-center justify-content-center mt-3">
                                    <p style="font-size: 23px;opacity:0.9">Bekleyen Siparişiniz Yok</p>
                                </div>
                            @endif
                            <div class="row mt-3"></div>
                        </div>
                    </div>
                </div>
            </div>



            <div class="row mt-5"></div>



            <div class="row mt-3">
                <div class="col-12 ms-3">
                    <span style="font-size:28px; opacity:0.8; font-weight:600">
                        Geçmiş Satışlar
                    </span>
                </div>
                <div class="mt-3 col-12 d-flex align-items-center justify-content-center"
                    style="height: 300px; border:2px solid #e7e6e7;border-radius:10px">
                    <div style="width: 98%; height: 90%;">
                        @if ($soldProducts->isNotEmpty())
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Sipariş Veren</th>
                                        <th>Adres</th>
                                        <th>Toplam Kazanç</th>
                                        <th>Tarih</th>
                                        <th>Detaylı Bilgi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($soldProducts as $index => $product)
                                        <tr>
                                            <td>{{ $index + 1 }}</td>
                                            <td>{{ $product->user['name'] }} {{ $product->user['surname'] }} </td>
                                            <td>{{ $product->order_address['city'] }} /
                                                {{ $product->order_address['street'] }}
                                            </td>
                                            <td>{{ $product->totalPrice }} TL</td>
                                            <td>{{ $product->created_at->format('d.m.Y H:i') }}</td>
                                            <td>
                                                <button type="button" class="btn btn-light" data-bs-toggle="modal"
                                                    data-bs-target="#productDetailModal"
                                                    data-sold_id="{{ $product->sold_product_id }}">
                                                    Detaylı Bilgi
                                                </button>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        @else
                            <p>Geçmiş satış bulunmamaktadır.</p>
                        @endif
                    </div>
                </div>
            </div>

        </div>
    </main>

    <div class="modal fade" id="productDetailModal" tabindex="-1" aria-labelledby="productDetailModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productDetailModalLabel">Detaylı Bilgi</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                </div>
            </div>
        </div>
    </div>


    <script src="/assets/jquery/dist/jquery.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>
    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>



    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        /**
         * Initializes event listeners for the product detail modal.
         *
         * This function sets up an event listener for when the DOM content is fully loaded.
         * It attaches an event listener to the product detail modal to handle the `show.bs.modal` event.
         * When the modal is about to be shown, it retrieves the `sold_product_id` from the button
         * that triggered the event, and sends a POST request to the server to fetch details about the sold products.
         * For each product, it sends a separate GET request to retrieve the image URL and then dynamically updates
         * the modal's content with the product details and images. If any errors occur during the fetch requests,
         * they are logged to the console. If the server responds with an error message indicating that the user
         * needs to log in, the user is redirected to the login page.
         *
         */
        document.addEventListener('DOMContentLoaded', function() {
            const productDetailModal = document.getElementById('productDetailModal');
            productDetailModal.addEventListener('show.bs.modal', function(event) {
                const button = event.relatedTarget;
                const sold_product_id = button.getAttribute('data-sold_id');
                const formData = new FormData();
                formData.append('sold_product_id', sold_product_id);

                fetch('{{ route('seller.ppd.sales.get-sold-sales-detail') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const products = data.returnData;


                            const modalBody = productDetailModal.querySelector('.modal-body');
                            modalBody.innerHTML = '';

                            products.forEach(product => {
                                const fileName = product.product_detail.file_names[0];

                                fetch('{{ route('image.showImage') }}?file=' +
                                        encodeURIComponent(fileName), {
                                            method: 'GET',
                                            headers: {
                                                'X-CSRF-TOKEN': csrfToken,
                                            },
                                        })
                                    .then(response => response.json())
                                    .then(imageData => {
                                        if (imageData.url) {
                                            console.log(imageData.url);
                                            const productCard = `
                                <div class="col-12 mt-2">
                                    <div class="row no-gutters">
                                        <div class="col-2 d-flex justify-content-center align-items-center">
                                            <img width="90px" style="height: auto; object-fit: cover;" src="${imageData.url}" alt="Product Image">
                                        </div>
                                        <div class="col-6">
                                            <div class="row mt-2">
                                                <span style="font-size: 16px; opacity: 0.8; font-weight:bold">
                                                    ${product.brand_name} - ${product.product_detail.proc_name}
                                                </span>
                                            </div>
                                            <div class="d-flex flex-wrap mt-3">
                                                ${Object.keys(product.product_detail).map(key => {
                                                    if (!['proc_name', 'proc_desc', 'stock', 'price', 'file_names'].includes(key)) {
                                                        return `<span style="font-size: 15px; opacity:0.8; margin-right: 15px; margin-bottom: 5px;">
                                                                                                                                                                                        ${getAttributeName(key)}: ${key === 'male' ? (product.product_detail.male == '0' ? 'Erkek' : 'Kadın') : product.product_detail[key]}
                                                                                                                                                                                    </span>`;
                                                    }
                                                    return '';
                                                }).join('')}
                                            </div>
                                        </div>
                                        <div class="col-1  d-flex justify-content-center align-items-center">
                                            <span style="opacity: 0.8; font-size:15px;">
                                                Adet: ${product.count}
                                            </span>
                                        </div>
                                        <div class="col-3 d-flex justify-content-center align-items-center">
                                            <span id="productPrice" name="productPrice" style="font-size: 16px; opacity: 0.8; font-weight:bold; color:#f37a1b">
                                                ${product.product_detail.price * product.count} TL
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            `;

                                            modalBody.insertAdjacentHTML('beforeend',
                                                productCard);
                                        } else {
                                            console.error('Geçici URL alınamadı.');
                                        }
                                    })
                                    .catch(error => {
                                        console.error('Geçici URL alma hatası:', error);
                                    });
                            });

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
            });
        });


        /**
         * This function takes a keyword (which represents a key from the `product_detail` object)
         * and returns its corresponding Turkish translation. If the keyword does not match any of the
         * predefined cases, the function returns the keyword with its first letter capitalized.
         * @name getAttributeName
         * @param {string} keyword - The key from the `product_detail` object that needs to be translated.
         * @returns {string} The Turkish translation of the keyword or the keyword with the first letter capitalized if no match is found.
         */
        function getAttributeName(keyword) {
            switch (keyword) {
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
                    return ucfirst(keyword);
            }
        }


        function ucfirst(string) {
            return string.charAt(0).toUpperCase() + string.slice(1);
        }


        /**
         * Marks a sale as completed and updates the server; reloads the page on success or redirects to login if needed.
         *
         * @function
         * @name salesComplated
         * @param {Event} event - The click event that triggers the function.
         */
        function salesComplated(event) {
            const targetButton = event.target;
            const waitingId = targetButton.getAttribute('data-salesId');

            const formData = new FormData();
            formData.append('waiting_id', waitingId);
            console.log(waitingId);

            fetch('{{ route('seller.ppd.sales.waiting-sales-complate') }}', {
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
