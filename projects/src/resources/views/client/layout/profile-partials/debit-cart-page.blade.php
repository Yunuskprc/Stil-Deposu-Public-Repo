<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8">Ödeme Bilgilerim</h4>
        <a href="#" id="debitCartLink" class="btn btn-link ms-auto"
            style="opacity: 0.8; text-decoration:none; color:inherit;" onclick="openModal()">
            <h5>+ Kart Ekle</h5>
        </a>
    </div>
</div>

<div class="row mt-5">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv">
        <div class="row d-flex align-items-center">
            <h6 class="ms-5" style="color: #f37a1b;opacity:0.8">Kartlarım</h6>
        </div>

        <div class="row">


            @if ($userInfo->cards)
                @php
                    $cards = json_decode($userInfo->cards);
                @endphp
                @foreach ($cards as $index => $card)
                    <div class="debitCard mt-2 ms-3">
                        <div class="debitCardHeader d-flex align-items-center">
                            <span style="font-size: 14px;opacity:0.8">{{ $card->cart_name }}</span>
                            <span style="font-size: 14px;opacity:0.8; margin-left: auto;"> <a href="#"
                                    onclick="deleteDebitOrAddress(event)" data-id="{{ $index }}"
                                    data-key="debit"><i class="fa-solid fa-trash-can"></i>
                                    Kartı Sil</a></span>
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
                                <img class="mt-3" width="50px" height="50px" src="{{ $card->cart_type }}"
                                    alt="">
                            </div>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>
    </div>
</div>


<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Yeni Kart Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" data-key="debit">
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
                            onclick="addDebitOrAdress()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
