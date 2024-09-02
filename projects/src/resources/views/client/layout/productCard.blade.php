<div class="mainProductCards">
    <a href="{{ route('user.show.productsDetail', ['product_id' => $product->product_id]) }}"
        style="width: 100%;height:100%; text-decoration:none; cursor: pointer;">
        <div class="imgClass">
            <img src="{{ $imageUrl }}" alt=""
                style="width: 195px; height:210px; object-fit: contain; object-position: center;">
        </div>
        <div class="content">
            <div class="title mt-2 ms-1">
                <h6 style="font-size: 13px">
                    {{ $product->brand_name }}
                    <span style="opacity: 0.8; font-size:12px">
                        {{ $product->product_detail['proc_name'] }}
                    </span>
                </h6>
            </div>
            <div class="body">
                <h6 style="color: #f37a1b">{{ $product->product_detail['price'] }} TL</h6>
            </div>
        </div>
        <div class="like">
            @if ($product->isFollowed)
                <a id="follow-link" onclick="addFollowProduct({{ $product->product_id }})" class="btn">
                    <img id="follow-img" src="/images/like24px.png" alt="" width="24px">
                </a>
            @else
                <a id="follow-link" onclick="addFollowProduct({{ $product->product_id }})" class="btn">
                    <img id="follow-img" src="/images/unlike24px.png" alt="" width="24px">
                </a>
            @endif
        </div>
    </a>
</div>
