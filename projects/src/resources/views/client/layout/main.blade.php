<main>
    <div class="container">
        <div class="row mt-3">
            <div class="col-5"></div>
            <div class="col-6">
                <div class="row w-100">
                    <h5 class="align-items-center" style="opacity: 0.8">En Çok Satan Ürünler</h5>
                </div>
            </div>
        </div>
        <div class="row mt-2">
            <div class="mainProductCards">
                <a style="width: 100%;height:100%; text-decoration:none; cursor: pointer;">
                    <div class="imgClass">
                        <img src="/images/logo.png" alt=""
                            style="width: 195px; height:210px; object-fit: contain; object-position: center;">
                    </div>
                    <div class="content">
                        <div class="title mt-2 ms-1">
                            <h6 style="font-size: 13px">
                                Marka Adı
                                <span style="opacity: 0.8; font-size:12px">
                                    Ürün Ad Ürün
                                    Adı Ürün Adı Ürün
                                    Adı Ürün Adı Ürün Adıı
                                </span>
                            </h6>
                        </div>
                        <div class="body">
                            <h6 style="color: #f37a1b">123 TL</h6>
                        </div>
                    </div>
                    <div class="like">
                        <a><i class="fa-regular fa-heart"></i></a>
                    </div>
                </a>
            </div>
            <div class="mainProductCards">
                <a style="width: 100%;height:100%; text-decoration:none; cursor: pointer;">
                    <div class="imgClass">
                        <img src="/images/pant1.png" alt=""
                            style="width: 195px; height:210px; object-fit: contain; object-position: center;">
                    </div>
                    <div class="content">
                        <div class="title mt-2 ms-1">
                            <h6 style="font-size: 13px">
                                Marka Adı
                                <span style="opacity: 0.8; font-size:12px">
                                    Ürün Ad Ürün
                                    Adı Ürün Adı Ürün
                                    Adı Ürün Adı Ürün Adıı
                                </span>
                            </h6>
                        </div>
                        <div class="body">
                            <h6 style="color: #f37a1b">123 TL</h6>
                        </div>
                    </div>
                    <div class="like">
                        <a><i class="fa-regular fa-heart"></i></a>

                    </div>
            </div>
        </div>
    </div>
    <div class="container mt-5">
        <div class="row">
            <div class="col-5"></div>
            <div class="col-6">
                <div class="row w-100">
                    <h5 class="align-items-center" style="opacity: 0.8">Markalar</h5>
                </div>
            </div>
        </div>

        <div class="row mt-2">

            @foreach ($brandsAttributes as $brand)
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


            <div class="row w-100" style="height: 50px"></div>
        </div>



    </div>

</main>


<script>
    document.querySelectorAll('.mainProductCards .like').forEach(function(likeButton) {
        likeButton.addEventListener('click', function() {
            this.classList.toggle('liked');
        });
    });
</script>
