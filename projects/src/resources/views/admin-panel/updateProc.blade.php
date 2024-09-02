<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
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

        .img-container {
            width: 100%;
            height: 100px;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        .img-container img {
            width: auto;
            height: 100%;
            object-fit: cover;
        }
        .desc {
            overflow: hidden;
            text-overflow: ellipsis;
            white-space: nowrap;
            max-width: 100%;
        }
        .modal-dialog {
            max-width: 1200px;
        }
        .modal-content {
            display: flex;
            width: 100%;
        }
        .modal-body {
            display: flex;
            height: 60vh;
            /* Adjust height as needed */
            max-height: 70vh;
            /* Adjust the max height as needed */
            overflow-y: auto;
            /* Enable vertical scrolling */
        }
        .modal-img-container,
        .modal-info-container {
            flex: 1;
            margin: 1%;
        }
        .carousel-item img {
            height: 400px;
            /* Fixed height */
            width: auto;
            /* Adjust width automatically */
            object-fit: contain;
            /* Ensures the image fits within the height while maintaining aspect ratio */
        }

        .showDetail{
            text-decoration: none;
            color:#272744;
            opacity: 0.9;
        }

        .showDetail:hover{
            color: #f37a1b;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        @include('admin-panel.layout.sidebar')
    </div>
        <main class="main-content" style="background: #fffefe;">
            <div class="container mt-4">
                <div class="row">
                    <h1>Tüm Ürünler</h1>
                    <hr>
                </div>
                <div class="row mt-5 ms-0">
                    @foreach ($products as $product)
                        @if ($product->active_sales == 1)
                            <div class="col-2 mt-4"
                                style="height:250px; background:#ffffff; border-radius:8px; margin-right:10px; border:1px solid #e7e6e7;border-radius:5px;"
                                data-product='@json($product)'>
                                <div class="mt-1 img-container">
                                    <img src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $product['product_detail']['file_names'][0], now()->addMinutes(60)) }}"
                                        alt="{{ $product['product_detail']['proc_name'] }}">
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center">
                                    <h5 class="mt-3 text-center" style="color: #272744">
                                        {{ $product['product_detail']['proc_name'] }}</h5>
                                </div>
                                <div style="color:#272744">
                                    <p class="desc" style="font-size: 12px">
                                        {{ Str::limit($product['product_detail']['proc_desc'], 80, '...') }}</p>
                                </div>
                                <div class="d-flex flex-column align-items-center justify-content-center w-100 mt-4">
                                    <a class="showDetail" href="#">Görüntüle</a>
                                </div>
                            </div>
                        @else
                            <form id="activatedProcForm">
                                <div class="col-2 mt-4"
                                    style="height:250px; background:#ffffff; border-radius:8px; margin-right:10px; opacity: 0.6;"
                                    data-product='@json($product)'>
                                    <div class="mt-1 img-container">
                                        <img src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $product['product_detail']['file_names'][0], now()->addMinutes(60)) }}"
                                            alt="{{ $product['product_detail']['proc_name'] }}">
                                    </div>
                                    <div class="d-flex flex-column align-items-center justify-content-center">
                                        <h5 class="mt-3 text-center" style="color: #272744">
                                            {{ $product['product_detail']['proc_name'] }}</h5>
                                    </div>
                                    <div style="color:#272744">
                                        <p class="desc" style="font-size: 12px">
                                            {{ Str::limit($product['product_detail']['proc_desc'], 80, '...') }}</p>
                                    </div>
                                    <div
                                        class="d-flex flex-column align-items-center justify-content-center w-100 mt-4">
                                        <a id="activatedProcA" href=""
                                            style="text-decoration: none; color:#272744;">Ürünü Aktif Et</a>
                                    </div>
                                </div>
                                <input id="activatedProcInput" type="text" hidden value="{{ $product->product_id }}">
                            </form>
                        @endif
                    @endforeach
                </div>
            </div>
        </main>


    <!-- Modal -->
    <div class="modal fade" id="productModal" tabindex="-1" aria-labelledby="productModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="productModalLabel">Ürün Detayları</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="modal-img-container">
                        <!-- Carousel for images -->
                        <div id="productCarousel" class="carousel slide">
                            <div class="carousel-inner" id="carouselInner">
                                <!-- Slides will be added dynamically here -->
                            </div>
                            <button class="carousel-control-prev" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Önceki</span>
                            </button>
                            <button class="carousel-control-next" type="button" data-bs-target="#productCarousel"
                                data-bs-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="visually-hidden">Sonraki</span>
                            </button>
                        </div>
                    </div>
                    <form id="ProductDetailForm">
                        <input type="hidden" id="product_id" name="id"> <!--  product ID yi tutan gizli input-->
                        <div class="modal-info-container" id="modalProductDetails">
                            <!-- product_detail ögeleri burada saklanacak -->
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Kapat</button>
                    <button type="button" class="btn btn-primary" id="updateProduct">Güncelle</button>
                    <button type="button" class="btn btn-danger" id="deleteProduct">Satışı Durdur</button>
                </div>
            </div>
        </div>
    </div>

    <script src="/assets/jquery/dist/jquery.min.js"></script>
    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>

    <script>
        const translations = {
            male: 'Cinsiyet',
            size: 'Beden',
            color: 'Renk',
            price: 'Fiyat',
            stock: 'Stok',
            person_count: 'Kişi Sayısı',
            material: 'Materyal',
            type: 'Tip',
            formType: 'Form Tipi',
            skinType: 'Deri Tipi',
            bindType: 'Bağlama Şekli',
            proc_name: 'Ürün Adı',
            proc_desc: 'Ürün Açıklaması'
        };
        $(document).ready(function() {
            $('a.showDetail').on('click', function(e) {
                e.preventDefault();
                var product = $(this).closest('.col-2').data('product');
                var detailsContainer = $('#modalProductDetails');
                detailsContainer.empty();
                $.each(product.product_detail, function(key, value) {
                    if (key !== 'file_names') {
                        var label = translations[key] || key;
                        var detailHtml = `
                        <div class="mb-3">
                            <h4>${label}</h4>
                            <input id="${key}" type="text" class="form-control" value="${value}">
                        </div>
                    `;
                        detailsContainer.append(detailHtml);
                    }
                });
                $('#product_id').val(product.product_id);
                var carouselInner = $('#carouselInner');
                carouselInner.empty();
                if (product.product_detail.file_names.length === 0) {
                    carouselInner.html('<p>Bu ürüne ait resim bulunamadı.</p>');
                } else {
                    product.product_detail.file_names.forEach((fileName, index) => {
                        $.ajax({
                            url: '/temporary-url',
                            type: 'GET',
                            data: {
                                file: fileName
                            },
                            success: function(response) {
                                var isActive = index === 0 ? ' active' : '';
                                var url = response.url;
                                var slide = `
                                <div class="carousel-item${isActive}">
                                    <img src="${url}" class="d-block w-100" alt="Product Image">
                                </div>
                            `;
                                carouselInner.append(slide);
                            }
                        });
                    });
                }
                $('#productModal').modal('show');
            });
            $('#deleteProduct').on('click', function() {
                var productId = $('#product_id').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData();
                formData.append('product_id', productId);
                fetch('{{ route('seller.ppd.product.deleteProc') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Ürünün Satışı durduruldu.');
                            $('#productModal').modal('hide');
                            location.reload();
                        } else {
                            toastr.error('Ürün satışı durdurulamadı.');
                        }
                    })
                    .catch(error => {
                        toastr.error('Ürün satıştan çıkarılırken bir hata oluştu.');
                    });
            });
            $('#updateProduct').on('click', function() {
                var productId = $('#product_id').val();
                var csrfToken = $('meta[name="csrf-token"]').attr('content');
                var formData = new FormData();
                formData.append('product_id', productId);
                $('#ProductDetailForm').find('input[type="text"]').each(function() {
                    var name = $(this).attr('id');
                    var value = $(this).val();
                    formData.append(name, value);
                });
                fetch('{{ route('seller.ppd.product.updateProc') }}', {
                        method: 'POST',
                        headers: {
                            'X-CSRF-TOKEN': csrfToken
                        },
                        body: formData
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            toastr.success('Ürün başarıyla güncellendi.');
                            $('#productModal').modal('hide');
                            location.reload();
                        } else {
                            toastr.error('Ürün güncellenemedi.');
                        }
                    })
                    .catch(error => {
                        toastr.error('Ürün güncellenirken bir hata oluştu.');
                    });
            });
        });
    </script>

    <script>
        $('#activatedProcA').on('click', function() {
            var product_id = $('#activatedProcInput').val();
            var csrfToken = $('meta[name="csrf-token"]').attr('content');
            var formData = new FormData();
            formData.append('product_id', product_id);
            console.log(product_id);
            fetch('{{ route('seller.ppd.product.activetedProc') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Ürün başarılı bir şekilde aktif edildi');
                        location.reload();
                    } else {
                        toastr.error('Ürün aktif edilemedi');
                    }
                })
                .catch(error => {
                    toastr.error('Ürün aktif bir hata oluştu.');
                });
        })
    </script>

    <script>
        var products = @json($products);
        console.log(products);
    </script>

</body>

</html>
