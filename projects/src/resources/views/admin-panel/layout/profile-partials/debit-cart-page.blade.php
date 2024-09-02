<div class="h-75 usersInfoDiv">
    <div class="row">
        <div class="col-1 mt-3"></div>
        <div class="col-10 mt-3 d-flex align-items-center" style="height: 60px; border-bottom:0.1px solid #e6e6e6;">
            <h5 class="ms-3 mb-0">Kart Bilgileri</h5>
            <a href="#" class="text-decoration-none ms-auto" style="color: black;opacity:0.8" id="addAddressLink">
                <h6 class="mb-0">+ Kart Ekle</h6>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-1"></div>
            <div class="col-10">
                <div class="row g-3">
                    @php
                        $cards = json_decode($userInfo->cards);
                    @endphp

                    @if ($cards)
                        @foreach ($cards as $index => $card)
                            <div class="col-md-4">
                                <div class="cartDebit">
                                    <div class="cartTitle mt-1 mb-1 ms-3 me-3">
                                        {{ $card->cart_name }}
                                    </div>
                                    <div class="cartBody mt-1 mb-1 ms-3 me-3">
                                        <div class="col mt-2" style="font-size: 13px">
                                            {{ $card->cart_number }}
                                        </div>
                                        <div class="col mt-1" style="font-size: 12px">
                                            {{ $card->cart_skt_month }}/{{ $card->cart_skt_year }}
                                        </div>
                                        <div class="col mt-2" style="font-size: 12px">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a class="delete-address" data-id="{{ $index }}"
                                                    onclick="deleteCards(event)" data-url="{{route('seller.ppd.profile.deleteDebitCard')}}"
                                                    style="text-decoration: none; color:#272744; cursor: pointer;">
                                                    <i class="fa-solid fa-trash me-1"></i> Kartı
                                                    Sil
                                                </a>
                                                @if ($card->cart_type != '')
                                                    <img src="{{ $card->cart_type }}" alt="Kart Resmi"
                                                        style="width: 50px; height: 50px; object-fit: cover;">
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Yeni Kart Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addressForm">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Kart Adı</label>
                            <input type="text" class="form-control" id="cartName" name="cartName" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addressDetails" class="form-label">Kart Numarası</label>
                        <input type="text" class="form-control" id="cartNumber" name="cartNumber" required>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">SKT</label>
                            <div class="d-flex">
                                <input type="text" class="form-control w-50 me-2" id="sktMonth" name="sktMonth"
                                    placeholder="Ay" required>
                                <input type="text" class="form-control w-50" id="sktYear" name="sktYear"
                                    placeholder="Yıl" required>
                            </div>
                        </div>

                        <div class="col-md-6">
                            <label for="street" class="form-label">CVV</label>
                            <input type="text" class="form-control" id="cvv" name="cvv" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addressDetails" class="form-label">Kart Sahibinin Adı</label>
                        <input type="text" class="form-control" id="cartOwnerName" name="cartOwnerName" required>
                    </div>
                    <div class="mb-3">
                        <label for="addressDetails" class="form-label">Kart Tipi</label>
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
                        <button type="submit" class="btn newAdressBtn" style="width:150px"
                            id="saveButton">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
