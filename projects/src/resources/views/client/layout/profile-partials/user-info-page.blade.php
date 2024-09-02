<div class="row mt-5"></div>
<div class="row mt-2">
    <div class="col-1"></div>
    <div class="col-10 profileNavbarScopeDiv d-flex align-items-center" style="height: 70px">
        <h4 class="ms-5" style="opacity: 0.8"> Kullanıcı Bilgilerim</h4>
    </div>
</div>

<div class="row mt-5">
    <div class="col-1"></div>
    <div class="col-5 profileNavbarScopeDiv">
        <div class="row d-flex align-items-center">
            <h6 class="ms-5" style="color: #f37a1b;opacity:0.8">Üyelik Bilgilerim</h6>
        </div>
        <form id="profileUpdateForm" action="" method="post">
            <div class="row mt-4">
                <div class="col-5">
                    <h6 class="input-label" style="opacity: 0.8">Ad</h6>
                    <input type="text" name="name" class="form-control mt-1"
                        placeholder="{{ $user->name ?? 'Adınız:' }}" value="{{ $user->name ?? 'Adınız:' }}"
                        style="opacity: 0.8">
                </div>
                <div class="col-6 ms-3">
                    <h6 class="input-label" style="opacity: 0.8">Soyad</h6>
                    <input type="text" name="surname" class="form-control mt-1"
                        placeholder="{{ $user->surname ?? 'Soyadınız' }}" value="{{ $user->surname ?? 'Soyadınız' }}"
                        style="opacity: 0.8">
                </div>
            </div>
            <div class="row mt-3">
                <div class="col-11">
                    <h6 class="input-label" style="opacity: 0.8">Email</h6>
                    <input type="email" name="email" class="form-control mt-1"
                        placeholder="{{ $user->mail_adress ?? 'Email Adresiniz' }}"
                        value="{{ $user->mail_adress ?? 'Email Adresiniz' }}" style="opacity: 0.8">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-11">
                    <h6 class="input-label" style="margin-bottom: 0.5rem; opacity:0.8">Telefon Numarası</h6>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <input type="text" name="phone_prefix" class="form-control" value="+90" readonly
                            style="width: 100px; box-sizing: border-box;  opacity:0.8">
                        <input type="text" name="phone_number" class="form-control"
                            placeholder="{{ $user->phone_number ?? 'Telefon Numaranız' }}"
                            value="{{ $user->phone_number ?? 'Telefon Numaranız' }}"
                            style="width: 350px; box-sizing: border-box;  opacity:0.8">
                    </div>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-11">
                    <h6 class="input-label" style="margin-bottom: 0.5rem; opacity:0.8 ">Doğum Tarihiniz</h6>
                    <div style="display: flex; align-items: center; gap: 0.5rem;">
                        <select id="daySelect" name="day" class="form-select"
                            style="width: 100px; box-sizing: border-box; opacity:0.8">
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

            <div class="row mt-4">
                <div class="col-11 d-flex justify-content-center">
                    <button id="userInfoUpdateBtn" type="button" class="btn btn-success w-50"
                        onclick="sellerProfileInfoUpdate()">Güncelle</button>
                </div>
            </div>
            <div class="row mt-4"></div>
        </form>
    </div>

    <div class="col-5 profileNavbarScopeDiv ms-1">
        <div class="row d-flex align-items-center">
            <h6 class="ms-5" style="color: #f37a1b;opacity:0.8">Şifre Güncelleme</h6>
        </div>

        <form id="passwordUpdateForm" action="" method="post">

            <div class="row mt-4">
                <div class="col-10">
                    <h6 class="input-label" style="opacity: 0.8">Mevcut Şifre</h6>
                    <input name="oldPassword" type="password" class="form-control mt-1" placeholder="Şifre"
                        style="opacity: 0.8">
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-10">
                    <h6 class="input-label" style="opacity: 0.8">Yeni Şifre</h6>
                    <input name="newPassword" type="password" class="form-control mt-1" placeholder="Şifre"
                        style="opacity: 0.8">
                    <h6 class="ms-1 mt-1" style="font-size: 12px;opacity:0.7">Yeni şifreniz minimum 6 karakter
                        olmalıdır.</h6>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-10">
                    <h6 class="input-label" style="opacity: 0.8">Yeni Şifre Tekrar</h6>
                    <input name="newPasswordRep" type="password" class="form-control mt-1" placeholder="Şifre"
                        style="opacity: 0.8">
                </div>
            </div>

            <div class="row mt-4">
                <div class="col-11 d-flex justify-content-center">
                    <button id="passwordUpdateBtn" type="button" class="btn btn-success w-50"
                        onclick="sellerPasswordUpdate()">Güncelle</button>
                </div>
            </div>
        </form>
        <div class="row mt-4"></div>
    </div>

</div>


<script>
    var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

    function sellerProfileInfoUpdate() {
        const profileForm = document.getElementById('profileUpdateForm');
        const formData = new FormData(profileForm);

        fetch('{{ route('user.ppd.updateProfileInfo') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                toastr.error('Bir hata oluştu.');
                console.error('Error:', error);
            });
    }

    function sellerPasswordUpdate() {
        const profileForm = document.getElementById('passwordUpdateForm');
        const formData = new FormData(profileForm);

        fetch('{{ route('user.ppd.updatePassword') }}', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': csrfToken
                },
                body: formData
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    toastr.success(data.message);
                    location.reload();
                } else {
                    toastr.error(data.message);
                }
            })
            .catch(error => {
                toastr.error('Bir hata oluştu.');
                console.error('Error:', error);
            });
    }
</script>
