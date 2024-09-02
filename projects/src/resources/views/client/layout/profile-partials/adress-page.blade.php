<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8">Adres Bilgilerim</h4>
        <a href="#" id="addAddressLink" class="btn btn-link ms-auto"
            style="opacity: 0.8; text-decoration:none; color:inherit;" onclick="openModal()">
            <h5>+ Adres Ekle</h5>
        </a>
    </div>
</div>

<div class="row mt-5">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv">
        <div class="row d-flex align-items-center">
            <h6 class="ms-5" style="color: #f37a1b;opacity:0.8">Adreslerim</h6>
        </div>

        <div class="row">


            @if ($userInfo->adress)
                @php
                    $addresses = json_decode($userInfo->adress);
                @endphp
                @foreach ($addresses as $index => $address)
                    <div class="adressCart mt-2 ms-3">
                        <div class="adressHeader d-flex align-items-center">
                            <span style="font-size: 14px;opacity:0.8">{{ $address->addressName }}</span>
                        </div>
                        <div class="adressBody">
                            <span class="long-text"> {{ $address->name }} {{ $address->surname }}</span>
                            <span class="long-text"> {{ $address->street }}</span>
                            <span class="long-text"> {{ $address->addressDetails }} </span>
                            <span class="long-text"> {{ $address->city }}</span>
                            <span class="long-text"> {{ $address->phoneNumber }}</span>
                            <span class="mt-4" style="font-size: 14px">
                                <a href="#" onclick="deleteDebitOrAddress(event)" data-id="{{ $index }}"
                                    data-key="adress"><i class="fa-solid fa-trash-can"></i> Adresi Sil</a>
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif


        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Yeni Adres Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="modalForm" data-key="adress">
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="name" class="form-label">Ad</label>
                            <input type="text" class="form-control" id="name" name="name" required>
                        </div>
                        <div class="col-md-6">
                            <label for="surname" class="form-label">Soyad</label>
                            <input type="text" class="form-control" id="surname" name="surname" required>
                        </div>
                    </div>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="city" class="form-label">Şehir</label>
                            <input type="text" class="form-control" id="city" name="city" required>
                        </div>
                        <div class="col-md-6">
                            <label for="street" class="form-label">Mahalle</label>
                            <input type="text" class="form-control" id="street" name="street" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label for="addressDetails" class="form-label">Adres Detayları</label>
                        <textarea class="form-control" id="addressDetails" name="addressDetails" rows="3" required></textarea>
                    </div>
                    <div class="mb-3">
                        <label for="phoneNumber" class="form-label">Telefon Numarası</label>
                        <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" required>
                    </div>
                    <div class="mb-3">
                        <label for="addressName" class="form-label">Adres Adı</label>
                        <input type="text" class="form-control" id="addressName" name="addressName" required>
                    </div>
                    <div class="mb-3 d-flex justify-content-center mt-4">
                        <button type="button" class="btn newAdressBtn" style="width:150px"
                            onclick="addDebitOrAdress()">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
