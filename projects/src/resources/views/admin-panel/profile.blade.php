<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport"
        content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Dashboard</title>
    <link rel="stylesheet" href="/assets/bootstrap/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="/assets/css/admin-panel/style.css">
    <link rel="stylesheet" href="/assets/toastr/build/toastr.min.css">
    <script src="https://kit.fontawesome.com/8f624e6537.js" crossorigin="anonymous"></script>
    <script src="/assets/js/admin-panel/index.js"></script>
    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">
    <style>
        body {
            margin: 0;
            display: flex;
            height: 100vh;
            overflow: hidden;
        }

        .sidebar {
            position: fixed;
            top: 0;
            left: 0;
            width: 16%;
            height: 100vh;
            background: #272744;
            border-right: 1px solid #444575;
        }

        .main-content {
            margin-left: 16%;
            padding: 20px;
            background: #fffefe;
            height: 100vh;
            overflow-y: auto;
            flex: 1;
        }


        .bodyDivProfile a {
            text-decoration: none;
            font-size: 16px;
            margin-bottom: 5px;
            color: #272744;
            opacity: 0.9;
        }

        .bodyDivProfile a:hover {
            color: #f27a1a;
        }
    </style>
</head>

<body>
    <div class="sidebar">
        @include('admin-panel.layout.sidebar')
    </div>


    <main class="main-content">
        <div class="container mt-4" style="height: 840px;">
            <div id="contentPage" class="row h-100">
                <div class="col-2" style="height:100%">
                    <div class="headDivProfile mt-3">
                        <h5> Hesabım & Yardım </h5>
                    </div>
                    <div class="bodyDivProfile">
                        <a href="#" id="contentTagA" style="margin-top: 5px;" data-url="user-info-page">Kullanıcı
                            Bilgileri</a>
                        <a href="#" id="contentTagA" data-url="adress-page" style="">Adres Bilgileri</a>
                        <a href="#" id="contentTagA" data-url="debit-cart-page" style="">Kayıtlı
                            Kartlar</a>
                    </div>

                    <div class="headDivProfile mt-3">
                        <h5>Marka Fotoğrafları</h5>
                    </div>
                    <div class="bodyDivProfile">
                        <a href="#" id="contentTagA" data-url="image-delete-upload-page"
                            style="margin-top: 5px;">Yükle-Sil-Güncelle</a>
                    </div>

                    <div class="headDivProfile mt-3">
                        <h5>Mail Doğrulama</h5>
                    </div>
                    <div class="bodyDivProfile">
                        @if ($userInfo->mail_verify == 0)
                            <a href="#" style="margin-top: 5px" data-bs-toggle="modal"
                                data-bs-target="#mailVerificationModal">Mail Doğrulama</a>
                        @else
                            <a href="#" style="margin-top: 5px;" onclick="showToast()">Mail Doğrulama</a>
                        @endif
                    </div>
                </div>


                <!-- Buraya include lar eklenecek -->
                <div id="contentProfile" class="col-9 contentProfile" style="height:100%">
                    @include('admin-panel.layout.profile-partials.user-info-page')
                </div>


            </div>
        </div>
    </main>




    @include('admin-panel.layout.profile-partials.mail-verify-modal')

    <script src="/assets/jquery/dist/jquery.min.js"></script>
    <script src="/assets/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>
    <script src="/assets/js/admin-panel/profile.js"></script>
    <script>
        var csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        var userInfo = @json($userInfo);
        initializeUserInfoPageLoaded(userInfo);

        document.addEventListener('DOMContentLoaded', function() {
            const links = document.querySelectorAll('#contentTagA');
            links.forEach(link => {
                link.addEventListener('click', function(e) {
                    e.preventDefault();
                    const url = this.getAttribute('data-url');
                    const endpoint =
                        `{{ route('seller.show.getProfilePage.getContent', ['url' => ':url']) }}`
                        .replace(':url', url);

                    console.log(url, endpoint)
                    fetch(endpoint, {
                            method: 'GET',
                            headers: {
                                'X-CSRF-TOKEN': csrfToken,
                            }
                        })
                        .then(response => response.text())
                        .then(html => {

                            const contentPage = document.getElementById('contentProfile');
                            contentPage.innerHTML = "";
                            contentPage.innerHTML = html;
                            const userInfo = @json($userInfo);


                            if (url == "user-info-page") {
                                initializeUserInfoPageLoaded(userInfo);
                            } else if (url == "adress-page") {
                                const route = "{{ route('seller.ppd.profile.addAdres') }}";
                                initializeAdressPageLoaded(route,userInfo);
                            } else if (url == "debit-cart-page") {
                                const route = "{{ route('seller.ppd.profile.addDebitCard') }}";
                                initializeDebitCardPageLoaded(route, userInfo);
                            } else if (url == "image-delete-upload-page") {
                                const routes = {
                                    addCardImage: "{{ route('seller.ppd.profile.addCardImage') }}",
                                    deleteCardImage: "{{ route('seller.ppd.profile.deleteCardImage') }}",
                                    addLogo: "{{ route('seller.ppd.profile.addLogo') }}",
                                    deleteLogo: "{{ route('seller.ppd.profile.deleteLogo') }}"
                                };
                                initializeImagePageLoaded(routes, userInfo);
                            }


                        })
                        .catch(error => console.error('Error loading content:', error));
                })
            });
        });
    </script>

</body>

</html>
