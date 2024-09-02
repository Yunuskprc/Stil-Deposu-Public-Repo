    <div class="modal fade" id="mailVerificationModal" tabindex="-1" aria-labelledby="mailVerificationModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="mailVerificationModalLabel">Mail Doğrulama</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Kapat"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="emailAddress" class="form-label">E-posta Adresi</label>
                        <input type="email" class="form-control" id="emailAddress" value="{{ $user->mail_adress }}"
                            readonly>
                    </div>
                    <button id="btngenerateMailCode" type="button" class="btn btn-primary" onclick="sendVerificationCode()" data-url="{{route('seller.ppd.profile.generateMailVerifyCode')}}">Doğrulama Kodu
                        Gönder</button>
                    <div class="mt-3" id="verificationCodeSection" style="display: none;">
                        <label for="verificationCode" class="form-label">Doğrulama Kodu</label>
                        <input type="text" class="form-control" id="verificationCode">
                        <button id="btnmailVerifyCehck" type="button" class="btn btn-success mt-2" onclick="checkVerificationCode()" data-ur="{{route('seller.ppd.profile.checkMailVerifyCode')}}">Kontrol
                            Et</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

