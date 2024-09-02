<aside class="sidebar">
    <div class="d-flex flex-column h-100">
        <div class="row mt-4"></div>
        <div class="mt-4 mb-4 d-flex align-items-center ms-5">
            <img src="/images/SDadminLogo.png" style="width: 40px; height: auto; margin-right: 10px;" alt="Logo">
            <h3 style="color: #ffffff; margin: 0; font-size: 24px; line-height: 1.2;">Stil Deposu</h3>
        </div>
        <div class="row mt-5"></div>
        <a class="btn btn w-100 mt-2 mb-2 text-white ms-5" href="{{ route('seller.show.dashboard') }}"
            style="display: flex; align-items: center;">
            <i class="fa-solid fa-plus" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Ürün Ekle</h5>
        </a>
        <a class="btn btn w-100 mt-4 mb-2 text-white ms-5 " href="{{ route('seller.show.updateProc') }}"
            style="display: flex; align-items: center;">
            <i class="fa-solid fa-arrow-up-from-bracket" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Ürün Güncelle</h5>
        </a>
        <a class="btn btn w-100 mt-4 mb-2 text-white ms-5" href="{{ route('seller.show.salesFollow') }}"
            style="display: flex; align-items: center;">
            <i class="fa-solid fa-truck" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Satış Takip</h5>
        </a>
        <a class="btn btn w-100  mt-4 mb-2 text-white ms-5" style="display: flex; align-items: center;">
            <i class="fa-solid fa-chart-line" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Analiz</h5>
        </a>
        <a class="btn btn w-100  mt-4 mb-2 text-white ms-5" style="display: flex; align-items: center;">
            <i class="fa-solid fa-bell" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Bildirimler</h5>
        </a>
        <a class="btn btn w-100  mt-4 mb-2 text-white ms-5" href="{{ route('seller.show.profile') }}"
            style="display: flex; align-items: center;">
            <i class="fa-solid fa-user" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Satıcı Hesabı</h5>
        </a>
        <a class="btn btn w-100  mt-4 mb-2 text-white ms-5" style="display: flex; align-items: center;">
            <i class="fa-solid fa-gear" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Ayarlar</h5>
        </a>

        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-5"></div>
        <div class="row mt-4"></div>

        <button id="logOutBtn" type="submit" class="btn btn w-100 mb-2 text-white ms-5" onclick="logOut()"
            style="display: flex; align-items: center;">
            <i class="fa-solid fa-right-from-bracket" style="margin-right: 10px;"></i>
            <h5 style="margin: 0;">Çıkış Yap</h5>
        </button>
    </div>
</aside>
