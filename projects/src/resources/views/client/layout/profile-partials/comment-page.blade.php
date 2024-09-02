<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8">Tüm Değerlendirmeler</h4>
        </a>
    </div>
</div>


<div class="row mt-5">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv">
        <div class="row d-flex align-items-center">
            <h6 class="ms-5" style="color: #f37a1b;opacity:0.8">Değerlendirmelerim</h6>
        </div>

        <div class="row">
            @foreach ($comments as $comment)
                <div class="commentDiv mt-3 ms-5">
                    <div class="commentImg">
                        <img width="80px"
                            src="{{ Storage::disk('s3')->temporaryUrl('productImages/' . $comment->product->product_detail['file_names'][0], now()->addMinutes(60)) }}"
                            alt="">
                    </div>
                    <div class="commentMain">
                        <div class="commentHeader">
                            <span style="opacity: 0.9;font-size:15px">{{ $comment->product->brand_name }} - <span
                                    style="opacity: 0.8; font-size:14px">{{ $comment->product->product_detail['proc_name'] }}</span></span>
                        </div>
                        <div class="commentBody">
                            <div class="col-7">
                                <div class="col-12" style="font-size: 13px;opacity:0.8">
                                    {{ $comment->comment }}
                                </div>
                                <div class="col-12" style="font-size: 13px;opacity:0.8">
                                    {{ $comment->created_at->format('d-m-Y H:i:s') }}</div>
                            </div>
                            <div class="col-3 ps-3">
                                <div class="rating">
                                    <ul class="rating" data-rating="{{ $comment->commentRate }}">
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                        <li class="rating__item"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="col-2">
                                <a href="#" class="commentBodyDeleteCommentA"
                                    onclick="deleteDebitOrAddress(event)" data-id="{{ $comment->comment_id }}"
                                    data-key="comment"><i class="fa-solid fa-trash-can"></i>
                                    Yorumu Sil</a>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>
