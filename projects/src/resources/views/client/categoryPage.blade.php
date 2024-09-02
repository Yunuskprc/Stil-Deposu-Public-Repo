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
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container-fluid d-flex">
        <div class="col-3">
            <div class="row">
                <div class="col-1 h-100" style="background:#ffffff">
                    <!-- Content for the first div -->
                </div>
                <div class="col">
                    @include('client.layout.filterCards.selectedCategory')
                    @include('client.layout.filterCards.brand')

                    @include('client.layout.filterCards.color')
                    @include('client.layout.filterCards.curtainTip')
                    @include('client.layout.filterCards.formType')
                    @include('client.layout.filterCards.MakeFormTypeUp')
                    @include('client.layout.filterCards.male')
                    @include('client.layout.filterCards.price')
                    @include('client.layout.filterCards.size')
                    @include('client.layout.filterCards.skinType')
                    @include('client.layout.filterCards.material')
                    @include('client.layout.filterCards.bindType')
                </div>
            </div>
        </div>

        <div name="Article" class="col-9">
            <div class="row mt-2" id="mainArticle">
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
                    Ürün Bulunamadı
                @endif


            </div>
        </div>
    </main>

    @include('client.layout.footer')

    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script></script>

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


            function getOtherFilter() {
                var category_id = @json($categories->category_id);

                document.getElementById('color').style.display = 'none';
                document.getElementById('curtainTip').style.display = 'none';
                document.getElementById('formType').style.display = 'none';
                document.getElementById('MakeFormTypeUp').style.display = 'none';
                document.getElementById('male').style.display = 'none';
                document.getElementById('price').style.display = 'none';
                document.getElementById('size').style.display = 'none';
                document.getElementById('skinType').style.display = 'none';
                document.getElementById('material').style.display = 'none';
                document.getElementById('bindType').style.display = 'none';

                if (category_id >= 1 && category_id <= 8) {
                    document.getElementById('size').style.display = 'block';
                    document.getElementById('male').style.display = 'block';
                } else if (category_id >= 14 && category_id <= 15) {
                    document.getElementById('size').style.display = 'block';
                    document.getElementById('male').style.display = 'block';

                } else if (category_id >= 25 && category_id <= 29) {
                    if (category_id == 25) {
                        document.getElementById('curtainTip').style.display = 'block';
                    }
                } else if (category_id >= 30 && category_id <= 41) {
                    document.getElementById('MakeFormTypeUp').style.display = 'block';
                } else if (category_id >= 42 && category_id <= 51) {
                    document.getElementById('skinType').style.display = 'block';
                    document.getElementById('formType').style.display = 'block';
                } else if (category_id >= 59 && category_id <= 64) {
                    document.getElementById('male').style.display = 'block';
                    document.getElementById('material').style.display = 'block';
                    document.getElementById('bindType').style.display = 'block'
                } else if (category_id >= 65 && category_id <= 69) {
                    document.getElementById('size').style.display = 'block';
                    document.getElementById('male').style.display = 'block';
                }

                document.getElementById('price').style.display = 'block';
                document.getElementById('color').style.display = 'block';

            }


            function applyFilters() {
                const mainDiv = document.getElementById('mainArticle');
                mainDiv.style.opacity = '0.1';
                const formData = new FormData();
                const checkboxes = document.querySelectorAll('input[type="checkbox"]');
                const category = document.querySelector('#bodyDiv input');
                formData.append(category.dataset.key, category.dataset.value);
                checkboxes.forEach(checkbox => {
                    if (checkbox.checked) {
                        formData.append(checkbox.dataset.key, checkbox.dataset.value);
                    }
                });


                const priceMin = document.querySelector('#priceMin').value;
                const priceMax = document.querySelector('#priceMax').value;
                formData.append('priceMin', priceMin);
                formData.append('priceMax', priceMax);

                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                fetch('{{ route('filter.get.brands.product') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken,
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            const products = data.data;
                            updateProductList(products);

                        } else {
                            toastr.error(data.message);
                        }
                    })
                    .catch(error => {
                        toastr.error('Bir hata oluştu.');
                        console.error('Error:', error);
                    });
            }



            function updateProductList(products) {
                const productContainer = document.getElementById('mainArticle');
                productContainer.innerHTML = '';

                if (products.length === 0) {
                    productContainer.innerHTML = 'Ürün Bulunamadı';
                    return;
                }

                let html = '';

                const fetchPromises = products.map(product => {
                    const url = `{{ route('user.show.product.cart', ':id') }}`.replace(':id', product
                        .product_id);

                    return fetch(url)
                        .then(response => response.text())
                        .then(data => {
                            html += data;
                        })
                        .catch(error => {
                            console.error('Image URL Fetch Error:', error);
                            toastr.error('Bir hata oluştu.');
                        });
                });

                Promise.all(fetchPromises)
                    .then(() => {
                        productContainer.innerHTML = html;
                        addEventListenersToProducts();
                        const mainDiv = document.getElementById('mainArticle');
                        mainDiv.style.opacity = '1';
                    });


            }



            document.querySelectorAll('input[type="checkbox"]').forEach(checkbox => {
                checkbox.addEventListener('change', applyFilters);
            });

            getOtherFilter();
        });
    </script>


    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function addFollowProduct(product_id) {
            var formData = new FormData();
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


        function addEventListenersToProducts() {
            const links = document.querySelectorAll('#follow-link');
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
        }
    </script>

</body>

</html>
