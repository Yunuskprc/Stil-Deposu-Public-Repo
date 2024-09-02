<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8">Devam Eden Siparişlerim</h4>
    </div>
</div>


<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv">
        <div class="row">
            @if (!$waitingSoldProducts->isEmpty())

                @foreach ($waitingSoldProducts as $waitProduct)
                    @php
                        $productDetail = $waitProduct->products[0]['product'];
                    @endphp
                    <div class="row mb-4">
                        <div class="col-2">
                            <img src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $productDetail['product_detail']['file_names'][0], now()->addMinutes(60)) }}"
                                style="width: 110px; height: auto; object-fit: cover; display: block;">
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <span style="font-size: 18px; opacity:0.9; font-weight: 600;">
                                    {{ $productDetail['brand_name'] ?? 'Bilinmeyen Marka' }}
                                </span>
                                <span style="font-size: 16px; opacity:0.8; font-weight: 500; margin-left:5px">
                                    {{ $productDetail['product_detail']['proc_name'] ?? 'Bilinmeyen Ürün' }}
                                </span>
                            </div>
                            <div class="col-12 mt-3">
                                <span style="font-size: 15px; opacity:0.8;">
                                    Tahmini kargoya teslim: 24 saat içinde
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                @foreach ($productDetail['product_detail'] as $key => $value)
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
                            <span style="font-size: 20px; opacity:0.8; color:black">
                                {{ $waitProduct->products[0]['count'] }}
                            </span>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-1" style="display: block; align-items: flex-start;">
                            <div class="col-12 mt-4">
                                <span name="productPrice" style="font-size: 20px; opacity:0.8; color:#f37a1b">
                                    {{ $productDetail['product_detail']['price'] * $waitProduct->products[0]['count'] }}
                                    TL
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <span style="font-size: 20px;color:black;opacity:0.8">
                        Geçmiş Siparişiniz Yok
                    </span>
                </div>
            @endif

        </div>
    </div>
</div>



<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8">Geçmiş Siparişlerim</h4>
    </div>
</div>


<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv">
        <div class="row">
            @if (!$soldProducts->isEmpty())

                @foreach ($soldProducts as $soldProduct)
                    @php
                        $productDetail = $soldProduct->products[0]['product'];
                    @endphp
                    <div class="row mb-4">
                        <div class="col-2">
                            <img src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $productDetail['product_detail']['file_names'][0], now()->addMinutes(60)) }}"
                                style="width: 110px; height: auto; object-fit: cover; display: block;">
                        </div>
                        <div class="col-6">
                            <div class="col-12">
                                <span style="font-size: 18px; opacity:0.9; font-weight: 600;">
                                    {{ $productDetail['brand_name'] ?? 'Bilinmeyen Marka' }}
                                </span>
                                <span style="font-size: 16px; opacity:0.8; font-weight: 500; margin-left:5px">
                                    {{ $productDetail['product_detail']['proc_name'] ?? 'Bilinmeyen Ürün' }}
                                </span>
                            </div>
                            <div class="col-12 mt-3">
                                <span style="font-size: 15px; opacity:0.8;">
                                    Tahmini kargoya teslim: 24 saat içinde
                                </span>
                            </div>
                            <div class="col-12 mt-2">
                                @foreach ($productDetail['product_detail'] as $key => $value)
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
                            <span style="font-size: 20px; opacity:0.8; color:black">
                                {{ $soldProduct->products[0]['count'] }}
                            </span>
                        </div>
                        <div class="col-1"></div>
                        <div class="col-1" style="display: block; align-items: flex-start;">
                            <div class="col-12 mt-4">
                                <span name="productPrice" style="font-size: 20px; opacity:0.8; color:#f37a1b">
                                    {{ $productDetail['product_detail']['price'] * $soldProduct->products[0]['count'] }}
                                    TL
                                </span>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="w-100 h-100 d-flex justify-content-center align-items-center">
                    <span style="font-size: 20px;color:black;opacity:0.8">
                        Devam Eden Siparişiniz Yok
                    </span>
                </div>
            @endif

        </div>
    </div>
</div>

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
