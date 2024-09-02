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
    <link rel="stylesheet" href="{{ asset('assets/css/client/productStyle.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="{{ asset('assets/css/client/style.css') }}?v={{ time() }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

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

        .carousel-control-prev-icon,
        .carousel-control-next-icon {
            filter: brightness(0) invert(0.5);
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container">
        <div class="row mt-4">
            <div class="col-5">
                @if ($product)
                    <div id="carouselExample" class="carousel slide" data-bs-ride="carousel">
                        <div class="carousel-inner">
                            @foreach ($product->product_detail['file_names'] as $url)
                                <div class="carousel-item active">
                                    <img src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $url, now()->addMinutes(60)) }}"
                                        class="d-block w-100" style="height: 600px; object-fit: cover;" alt="...">
                                </div>
                            @endforeach
                        </div>
                        <button class="carousel-control-prev" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Previous</span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#carouselExample"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="visually-hidden">Next</span>
                        </button>

                    </div>
                @endif

            </div>
            <div class="col-1"></div>
            <div class="col-5">
                <div class="productHeader">
                    <h4><a href="">{{ $product->brand_name }}</a></h4>
                    <h5 class="mt-3"> {{ $product->product_detail['proc_name'] }}</h5>

                    <div class="comment">
                        <div class="commentDegree">
                            <h6>{{ $commentDegree }}</h6>
                        </div>

                        <div id="commentStar" class="commentStar">
                            @php
                                $roundedDegree = ceil($commentDegree * 2) / 2;
                            @endphp
                            <ul class="rating" data-rating="{{ $roundedDegree }}">
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                            </ul>
                        </div>

                        <div class="commentCount">
                            ({{ $commentCount }}) Değerlendirme
                        </div>
                    </div>

                    <div class="price">
                        <h4>{{ $product->product_detail['price'] }} TL</h4>
                    </div>
                    <hr width="100%">
                </div>
                <div class="productBody">
                    <div class="row" id="productBodyRow">
                        <!-- Buraya dinamik olarak ürün özellikleri eklenecek -->
                    </div>

                </div>
                <div class="productBuy">
                    <div class="row">
                        <div class="col-1"></div>
                        <div class="col-8 mt-2">
                            <!-- sepete ekle butonu -->
                            <a onclick="addBasketProduct()" class="btn productBuyBtn">Sepete Ekle</a>
                        </div>
                        <div class="col-2 ms-2">
                            <!-- like ekle butonu -->
                            @if ($product->isFollowed)
                                <a id="follow-link45" onclick="addFollowProduct({{ $product->product_id }})"
                                    class="btn">
                                    <img id="follow-img45" src="/images/like.png" alt="" width="45px">
                                </a>
                            @else
                                <a id="follow-link45" onclick="addFollowProduct({{ $product->product_id }})"
                                    class="btn">
                                    <img id="follow-img45" src="/images/unlike.png" alt="" width="45px">
                                </a>
                            @endif

                        </div>

                    </div>
                    <div class="row mt-4">
                        <div class="col-1"></div>
                        <div class="col-9">
                            <h6 style="opacity: 0.8">Şuan şipariş verirseniz 24 saate kadar kargoda! 🎉🎉</h6>
                        </div>
                    </div>
                    <hr width="100%">

                    <div class="row mt-4">
                        <div class="col-1"></div>
                        <div class="col-9">
                            <h6 style="opacity: 1">Ürünün Açıklaması:<span style="opacity: 0.9">
                                    {{ $product->product_detail['proc_desc'] }}
                                </span></h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>

        <!-- Benzer Kategori ürünleri -->
        <div class="row">
            <div class="col">
                <h3 style="opacity: 0.9">Benzer Ürünler</h3>
            </div>
        </div>
        <div class="row mt-2" id="mainArticle">
            @if ($sameProducts != null)
                @foreach ($sameProducts as $productOne)
                    @php
                        $imageUrl = Storage::disk('s3')->temporaryUrl(
                            'productImages/' . $productOne->product_detail['file_names'][0],
                            now()->addMinutes(60),
                        );
                    @endphp
                    @include('client.layout.productCard', [
                        'product' => $productOne,
                        'imageUrl' => $imageUrl,
                    ])
                @endforeach
            @endif
        </div>

        <!-- Marka Ürünleri-->
        <div class="row mt-5"></div>
        <div class="row mt-5">
            <div class="col">
                <h3 style="opacity: 0.9">{{ $product->brand->brands_name }} Ürünleri</h3>
            </div>
        </div>
        <div class="row mt-2" id="mainArticle">
            @if ($sameProducts != null)
                @foreach ($sameProductsBrand as $productTwo)
                    @php
                        $imageUrl = Storage::disk('s3')->temporaryUrl(
                            'productImages/' . $productTwo->product_detail['file_names'][0],
                            now()->addMinutes(60),
                        );
                    @endphp
                    @include('client.layout.productCard', [
                        'product' => $productTwo,
                        'imageUrl' => $imageUrl,
                    ])
                @endforeach
            @endif
        </div>



        <div class="row mt-5"></div>
        <div class="row mt-5"></div>

        <!-- Yorum Yapma alanı-->
        <div class="row mt-5">
            <div class="col-12">
                <div class="CommentHeader">
                    <h4>Ürüne Yorum Yap </h4>
                    <div class="row AddCommand">
                        <div class="col-10">
                            <textarea class="form-control" id="addCommentText" rows="6"
                                placeholder="Ürün hakkında görüşlerinizi yazınız."></textarea>
                        </div>
                        <div class="col-2">
                            @for ($i = 5; $i >= 1; $i--)
                                @php
                                    $margin = $i == 5 ? '0px' : '8px';
                                @endphp
                                <a id="addCommentwithRate" data-rate="{{ $i }}"
                                    onclick="addComment({{ $i }})"
                                    style="text-decoration: none;display: block; margin-top:{{ $margin }}"
                                    class="addComment">
                                    <ul class="rating" data-rating="{{ $i }}">
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                    </ul>
                                </a>
                            @endfor
                        </div>

                    </div>
                </div>
            </div>


            <!-- Ürün yorumları burada -->
            <div class="col mt-5">
                <h4>Ürün Yorumları </h4>
                @foreach ($comments as $comment)
                    <div class="Comments">

                        <div class="rating">
                            <ul class="rating" data-rating="{{ $comment->commentRate }}">
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                                <li class="rating__item"></li>
                            </ul>
                        </div>

                        <div class="header">
                            <h6>{{ $comment->user->name }} {{ $comment->user->surname }}</h6>
                            <h6 style="opacity: 0.8; margin-left:25px">{{ $comment->created_at->format('Y-m-d') }}
                            </h6>
                        </div>
                        <div class="contents">
                            <p>{{ $comment->comment }}</p>
                        </div>
                        <hr width="76%">
                    </div>
                @endforeach

            </div>
        </div>


        <div class="row mt-5"></div>
        <div class="row mt-5"></div>

    </main>

    @include('client.layout.footer')


    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var data = @json($product->product_detail);
            var product = @json($product);
            showProductAttribute(data, product);


            const link = document.getElementById('follow-link45');
            const img = document.getElementById('follow-img45');

            link.addEventListener('mouseover', function() {
                if (img) {
                    img.src = '/images/like.png';
                }
            });

            link.addEventListener('mouseout', function() {
                if (img) {
                    img.src = '/images/unlike.png';
                }
            });

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

    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        function addComment(rate) {
            var formData = new FormData();
            var comment = document.getElementById('addCommentText').value;
            var product_id = @json($product->product_id);
            formData.append('comment', comment);
            formData.append('commentRate', rate);
            formData.append('product_id', '{{ $product->product_id }}');

            fetch('{{ route('user.ppd.add.comment') }}', {
                    method: 'POST',
                    headers: {
                        'X-CSRF-TOKEN': csrfToken,
                    },
                    body: formData
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        console.log('Başarılı:', data.message);
                        toastr.success(data.message)
                    } else {
                        console.log('Başarısız:', data.message);
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


        function addBasketProduct() {
            var formData = new FormData();
            var product_id = @json($product->product_id);
            formData.append('product_id', product_id);
            fetch('{{ route('user.ppd.add.basketProduct') }}', {
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


        function addFollowProduct(product_id) {
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
