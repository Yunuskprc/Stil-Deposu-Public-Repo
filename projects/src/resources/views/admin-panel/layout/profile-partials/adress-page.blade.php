<div class="h-75 usersInfoDiv">
    <div class="row">
        <div class="col-1 mt-3"></div>
        <div class="col-10 mt-3 d-flex align-items-center" style="height: 60px; border-bottom:0.1px solid #e6e6e6;">
            <h5 class="ms-3 mb-0">Adres Bilgileri</h5>
            <a href="#" class="text-decoration-none ms-auto" style="color: black;opacity:0.8;" id="addAddressLink">
                <h6 class="mb-0">+ Adres Ekle</h6>
            </a>
        </div>
    </div>

    <div class="container">
        <div class="row mt-3">
            <div class="col-1"></div>

            <div class="col-10">
                <div class="row g-3">
                    @php
                        $addresses = json_decode($userInfo->adress);
                    @endphp

                    @if ($addresses)
                        @foreach ($addresses as $index => $address)
                            <div class="col-md-4">
                                <div class="cardAdress">
                                    <div class="adressTitle mt-1 mb-1 ms-3 me-3">
                                        {{ $address->addressName }}
                                    </div>
                                    <div class="adressBody mt-1 mb-1 ms-3 me-3">
                                        <div class="col mt-2" style="font-size: 13px">
                                            {{ $address->name }} {{ $address->surname }}
                                        </div>
                                        <div class="col mt-1" style="font-size: 12px">
                                            {{ $address->street }}
                                        </div>
                                        <div class="col mt-1" style="font-size: 12px">
                                            {{ $address->addressDetails }}
                                        </div>
                                        <div class="col mt-1" style="font-size: 12px">
                                            {{ $address->city }}
                                        </div>
                                        <div class="col mt-1" style="font-size: 12px">
                                            {{ $address->phoneNumber }}
                                        </div>
                                        <div class="col mt-4" style="font-size: 12px">
                                            <div class="d-flex justify-content-between">
                                                <a onclick="deleteAddress(event)" class="delete-address"
                                                    data-id="{{ $index }}" data-url="{{route('seller.ppd.profile.deleteAdress')}}"
                                                    style="text-decoration: none; color:#272744; cursor: pointer;">
                                                    <i class="fa-solid fa-trash me-1"></i>
                                                    Adresi
                                                    Sil
                                                </a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div>
                <div class="col-1"></div>
            </div>
        </div>
    </div>
</div>



<div class="modal fade" id="addressModal" tabindex="-1" aria-labelledby="addressModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addressModalLabel">Yeni Adres Ekle</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form id="addressForm">
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
                        <button type="submit" class="btn newAdressBtn" style="width:150px"
                            id="saveButton">Kaydet</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
