<div class="h-75 usersInfoDiv" style="border-top-right-radius:0px; border-bottom-right-radius:0px">

    <div class="container">
        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10 d-flex justify-content-center" style="border-bottom:0.1px solid #e6e6e6;">
                <h5>Marka Fotoğrafları</h5>
            </div>
        </div>

        <div class="row mt-4">
            <div class="col-1"></div>
            <div class="col-10 d-flex justify-content-center">
                @if ($brands->cardImageURI)
                    <div>
                        <img src="{{ Storage::disk('s3')->temporaryUrl('brandsImages/' . $brands->cardImageURI, now()->addMinutes(60)) }}"
                            alt="" max-width="450px" style="border-radius: 1%;">
                    </div>
                    <div class="ms-5 d-flex flex-column align-items-center">
                        <h6>Marka Kart Fotoğrafı</h6>
                        <input type="file" id="fileInputCardImage" style="display:none" />
                        <button class="btn mt-4" data-action="delete" data-type="cardImage"
                            style="color: #e6e6e6; background:#921e1d; width:80px">Sil</button>
                    </div>
                @else
                    <div class="ms-5 d-flex flex-column align-items-center">
                        <h6>Marka Kart Fotoğrafı</h6>
                        <input type="file" id="fileInputCardImage" style="display:none" />
                        <button class="btn mt-3" data-action="add" data-type="cardImage"
                            style="color: #e6e6e6; background:#086704; width:80px">Ekle</button>
                    </div>
                @endif
            </div>
        </div>

        <div class="row" style="margin-top:100px">
            <div class="col-1"></div>
            <div class="col-10 d-flex justify-content-center">
                @if ($brands->logoURI)
                    <div>
                        <img src="{{ Storage::disk('s3')->temporaryUrl('brandsImages/' . $brands->logoURI, now()->addMinutes(60)) }}"
                            alt="" max-width="450px" style="border-radius: 1%;">
                    </div>
                    <div class="ms-5 d-flex flex-column align-items-center">
                        <h6>Marka Logo Fotoğrafı</h6>
                        <input type="file" id="fileInputLogo" style="display:none" />
                        <button class="btn mt-4" data-action="delete" data-type="logo"
                            style="color: #e6e6e6; background:#921e1d; width:80px">Sil</button>
                    </div>
                @else
                    <div class="ms-5 d-flex flex-column align-items-center">
                        <h6>Marka Logo Fotoğrafı</h6>
                        <input type="file" id="fileInputLogo" style="display:none" />
                        <button class="btn mt-3" data-action="add" data-type="logo"
                            style="color: #e6e6e6; background:#086704; width:80px">Ekle</button>
                    </div>
                @endif
            </div>
        </div>

    </div>
</div>
