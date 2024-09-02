<div class="h-75 usersInfoDiv" style="border-top-right-radius:0px; border-bottom-right-radius:0px">
    <div class="col mt-4 ms-5" style="font-size: 26px">
        Üyelik Bilgilerim
    </div>
    <form id="sellerInfoUpdateForm">
        <div class="row">
            <div class="col-5 mt-5 ms-3">
                <h6 class="input-label">Ad</h6>
                <input type="text" name="name" class="form-control mt-1"
                    placeholder="{{ $user->name ?? 'Adınız:' }}" value="{{ $user->name ?? 'Adınız:' }}">
            </div>
            <div class="col-6 mt-5 ms-3">
                <h6 class="input-label">Soyad</h6>
                <input type="text" name="surname" class="form-control mt-1"
                    placeholder="{{ $user->surname ?? 'Soyadınız' }}" value="{{ $user->surname ?? 'Soyadınız' }}">
            </div>
        </div>

        <div class="row">
            <div class="col-11 mt-4 ms-3">
                <h6 class="input-label">Email</h6>
                <input type="email" name="email" class="form-control mt-1"
                    placeholder="{{ $user->mail_adress ?? 'Email Adresiniz' }}"
                    value="{{ $user->mail_adress ?? 'Email Adresiniz' }}">
            </div>
        </div>

        <div class="row">
            <div class="col-11 mt-4 ms-3">
                <h6 class="input-label" style="margin-bottom: 0.5rem;">Telefon Numarası</h6>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <input type="text" name="phone_prefix" class="form-control" value="+90" readonly
                        style="width: 100px; box-sizing: border-box;">
                    <input type="text" name="phone_number" class="form-control"
                        placeholder="{{ $user->phone_number ?? 'Telefon Numaranız' }}"
                        value="{{ $user->phone_number ?? 'Telefon Numaranız' }}"
                        style="width: 350px; box-sizing: border-box;">
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-11 mt-4 ms-3">
                <h6 class="input-label" style="margin-bottom: 0.5rem;">Doğum Tarihiniz</h6>
                <div style="display: flex; align-items: center; gap: 0.5rem;">
                    <select id="daySelect" name="day" class="form-select"
                        style="width: 100px; box-sizing: border-box;">
                    </select>
                    <select id="monthSelect" name="month" class="form-select"
                        style="width: 200px; box-sizing: border-box;">
                        <option value="1">Ocak</option>
                        <option value="2">Şubat</option>
                        <option value="3">Mart</option>
                        <option value="4">Nisan</option>
                        <option value="5">Mayıs</option>
                        <option value="6">Haziran</option>
                        <option value="7">Temmuz</option>
                        <option value="8">Ağustos</option>
                        <option value="9">Eylül</option>
                        <option value="10">Ekim</option>
                        <option value="11">Kasım</option>
                        <option value="12">Aralık</option>
                    </select>
                    <select id="yearSelect" name="year" class="form-select"
                        style="width: 200px; box-sizing: border-box;">
                    </select>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-11 mt-5 ms-3 d-flex justify-content-center">
                <button id="userInfoUpdateBtn" type="button" class="btn btn-success w-50"
                    onclick="sellerProfileInfoUpdate()"
                    data-url="{{ route('seller.ppd.profile.updateProfileInfo') }}">Güncelle</button>
            </div>
        </div>
    </form>
</div>
<div class="h-75 usersInfoDiv" style="border-left: 0px; border-top-left-radius:0px; border-bottom-left-radius:0px">
    <div class="col mt-4 ms-5" style="font-size: 26px">
        Şifre Güncelleme
    </div>
    <form id="sellerPaswordUpdate">
        <div class="row">
            <div class="col-10 mt-5 ms-3">
                <h6 class="input-label">Şuanki Şifre</h6>
                <input name="oldPassword" type="password" class="form-control mt-1" placeholder="Şifre">
            </div>
        </div>

        <div class="row">
            <div class="col-10 mt-4 ms-3">
                <h6 class="input-label">Yeni Şifre</h6>
                <input name="newPassword" type="password" class="form-control mt-1" placeholder="Şifre">
                <h6 class="ms-1 mt-1" style="font-size: 12px">Yeni şifreniz minimum 6 karakter
                    olmalıdır.</h6>
            </div>
        </div>

        <div class="row">
            <div class="col-10 mt-4 ms-3">
                <h6 class="input-label">Yeni Şifre Tekrar</h6>
                <input name="newPasswordRep" type="password" class="form-control mt-1" placeholder="Şifre">
            </div>
        </div>

        <div class="row">
            <div class="col-11 mt-5 ms-3 d-flex justify-content-center">
                <button id="passwordUpdateBtn" type="button" class="btn btn-success w-50"
                    onclick="sellerPasswordUpdate()" data-url="{{ route('seller.ppd.profile.updatePassword') }}">Güncelle</button>
            </div>
        </div>
    </form>
</div>
