<!DOCTYPE html>
<html lang="tr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Stil Deposu</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/client/style.css">
    <link rel="stylesheet" href="/assets/css/client/productStyle.css">
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.1.3/js/bootstrap.bundle.min.js"></script>

    <script src="/assets/js/client/index.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">

    <style>
        html,
        body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        body {
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }

        main {
            flex-grow: 1;
        }

        .footer {
            background: #fefeff;
            height: 170px;
            border-top: 1px solid #eeefee;
            position: relative;
        }

        #content-area {
            overflow-y: auto;
            min-height: calc(100vh - 170px);
            /* Footer'ın yüksekliğini hesaba katın */
        }

        .header {
            opacity: 0.8;
        }
    </style>
</head>

<body>
    @include('client.layout.navbar')

    <main class="container">
        <div class="row h-100">
            <div class="col-3" style="height: 100vh;">
                <div class="row mt-5">
                    <div class="col-2"></div>
                    <div class="col-8 profileNavbarScopeDiv d-flex justify-content-center align-items-center"
                        style="height: 70px">
                        <h6 style="opacity: 0.8">Yunus Emre Köprücü</h6>
                    </div>
                </div>

                <div class="row mt-5">
                    <div class="col-2"></div>
                    <div class="col-8 profileNavbarScopeDiv" style="height:220px;">
                        <div class="profile-header w-100">
                            <h5 class="ms-2" style="opacity: 0.8">Hesabım & Yardım</h5>
                            <hr width="100%" color="#e7e6e7">
                        </div>
                        <div class="profile-body w-100 mt-1 ms-2">
                            <div class="col-12">
                                <a href="#" class="load-content" data-url="user-info-page"><i
                                        class="fa-solid fa-user"></i>
                                    <span class="ms-2">Kullanıcı Bilgilerim</span></a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="#" class="load-content" data-url="adress-page"><i
                                        class="fa-solid fa-map-location-dot"></i>
                                    <span class="ms-2">Adres Bilgilerim</span></a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="#" class="load-content" data-url="debit-cart-page"><i
                                        class="fa-regular fa-credit-card"></i>
                                    <span class="ms-2">Ödeme Bilgilerim</span></a>
                            </div>
                        </div>
                    </div>
                </div>



                <div class="row mt-5">
                    <div class="col-2"></div>
                    <div class="col-8 profileNavbarScopeDiv" style="height:220px;">
                        <div class="profile-header mt-3 w-100">
                            <h5 class="ms-2" style="opacity: 0.8">Siparişlerim</h5>
                            <hr width="100%" color="#e7e6e7">
                        </div>
                        <div class="profile-body w-100 mt-1 ms-2">
                            <div class="col-12">
                                <a href="#" class="load-content" data-url="order-page"><i
                                        class="fa-solid fa-basket-shopping"></i><span class="ms-2">Tüm
                                        Siparişlerim</span></a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="#" class="load-content" data-url="comment-page"><i
                                        class="fa-solid fa-message"></i><span
                                        class="ms-2">Değerlendirmelerim</span></a>
                            </div>
                            <div class="col-12 mt-3">
                                <a href="#" class="load-content" data-url="notification-page"><i
                                        class="fa-regular fa-bell"></i><span class="ms-2">Bildirimler</span></a>
                            </div>

                        </div>
                    </div>
                </div>

            </div>
            <div class="col-9" id="content-area" style="min-height: 100vh; overflow-y: auto;">
                @include('client.layout.profile-partials.user-info-page')
            </div>

            <div class="row mt-5"></div>
            <div class="row mt-5"></div>
        </div>
    </main>


    @include('client.layout.footer')

    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        const selectElementDay = document.getElementById('daySelect');
        for (let i = 1; i <= 31; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            selectElementDay.appendChild(option);
        }

        const selectElementYear = document.getElementById('yearSelect');
        for (let i = 1940; i <= 2010; i++) {
            const option = document.createElement('option');
            option.value = i;
            option.textContent = i;
            selectElementYear.appendChild(option);
        }

        const selectElementMonth = document.getElementById('monthSelect');

        const userInfo = @json($userInfo);
        const birthDate = new Date(userInfo.birth_date);

        if (birthDate) {
            document.getElementById('daySelect').value = birthDate.getDate();
            document.getElementById('monthSelect').value = birthDate.getMonth() + 1; // Months are 0-based
            document.getElementById('yearSelect').value = birthDate.getFullYear();
        }



        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('.load-content');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const endpoint =
                        `{{ route('user.show.getProfilePage.getContent', ['url' => ':url']) }}`
                        .replace(':url', url);

                    fetch(endpoint, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            }

                        })
                        .then(response => response.text())
                        .then(html => {
                            document.getElementById('content-area').innerHTML = html;
                        })
                        .catch(error => console.error('Error loading content:', error));
                })
            });
        });
    </script>


    <script>
        function openModal() {
            var addressModal = new bootstrap.Modal(document.getElementById('modal'));
            addressModal.show();
        }
    </script>
</body>

</html>
