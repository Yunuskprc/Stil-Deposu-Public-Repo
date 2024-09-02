<!DOCTYPE html>
<html>

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
    <script src="/assets/js/admin-panel/addProduct.js"></script>

    <link rel="icon" type="image/png" sizes="32x32" href="/images/logo.png">

    <style>
        .sidebar {
            min-height: 100vh;
            background: #272744;
            width: 16%;
            border-right: 1px solid #444575;
        }

        .main-content {
            flex: 1;
            padding: 20px;
        }
    </style>


</head>

<body>
    <div class="d-flex">

        @include('admin-panel.layout.sidebar')

        <main class="main-content" style="background: #fffefe;">
            <div class="container" id="addProcMainDiv">
                <form id="addProcForm" enctype="multipart/form-data">
                    @csrf
                    <div class="row mt-5"></div>
                    <div class="row mt-5"></div>
                    <div class="row">
                        <div class="col d-flex align-items-center">
                            <h3 class="mt-3">Kategori Seç:</h3>
                            <select onchange="categoryOnChanged()" id="category_id" name="category_id"
                                class="form-control w-50 ms-3 mt-3" aria-label="Default select example">
                                <option value="0">Bir kategori seçin</option>
                                <option value="1" selected>Elbise</option>
                                <option value="2">Tişört</option>
                                <option value="3">Gömlek</option>
                                <option value="4">Pantolon</option>
                                <option value="5">Şort</option>
                                <option value="6">Mont</option>
                                <option value="7">Ceket</option>
                                <option value="8">Sweatshirt</option>
                                <option value="9">Yemek Takımı</option>
                                <option value="10">Bıçak & Çatal & Kaşık</option>
                                <option value="11">Bardaklar</option>
                                <option value="12">Tabaklar</option>
                                <option value="13">Tencere & Tava</option>
                                <option value="14">Havlu</option>
                                <option value="15">Bornoz</option>
                                <option value="16">Tablo</option>
                                <option value="17">Duvar Saati</option>
                                <option value="18">Ayna</option>
                                <option value="19">Dekoratif Ürünler</option>
                                <option value="20">Avize</option>
                                <option value="21">Lamba</option>
                                <option value="22">Abajur</option>
                                <option value="23">Halı & Kilim</option>
                                <option value="25">Perde</option>
                                <option value="26">Nevresim Takımı</option>
                                <option value="27">Yastık</option>
                                <option value="28">Yorgan</option>
                                <option value="29">Battaniye</option>
                                <option value="30">Göz Makyajı</option>
                                <option value="31">Ten Makyajı</option>
                                <option value="32">Dudak Makyajı</option>
                                <option value="33">Oje & Aseton</option>
                                <option value="34">Fondöten</option>
                                <option value="35">Ruj</option>
                                <option value="36">Dudak Kalemi</option>
                                <option value="37">Maskara</option>
                                <option value="38">Eyeliner</option>
                                <option value="39">Göz Kalemleri</option>
                                <option value="40">Allık</option>
                                <option value="41">Kapatıcılar</option>
                                <option value="42">Yüz Kremi</option>
                                <option value="43">Yüz Temizleme</option>
                                <option value="44">Yüz Maskesi</option>
                                <option value="45">Göz Bakımı</option>
                                <option value="46">Güneş Kremi</option>
                                <option value="47">El Ayak Bakımı</option>
                                <option value="48">Tonikler</option>
                                <option value="49">Nemlendiriciler</option>
                                <option value="50">Yüz Maskeleri</option>
                                <option value="51">Peeling</option>
                                <option value="52">Şampuan</option>
                                <option value="53">Duş Jelleri</option>
                                <option value="54">Banyo Sabunları</option>
                                <option value="55">Vücut Spreyleri</option>
                                <option value="56">Parfüm</option>
                                <option value="57">Deodorant</option>
                                <option value="58">Ağız Bakımı</option>
                                <option value="59">Spor Ayakkabı</option>
                                <option value="60">Günlük Ayakkabı</option>
                                <option value="61">Bot & Çizme</option>
                                <option value="62">Sneaker</option>
                                <option value="63">Topuklu Ayakkabı</option>
                                <option value="64">Terlik</option>
                                <option value="65">Kol Çantası</option>
                                <option value="66">Sırt Çantası</option>
                                <option value="67">Cüzdan</option>
                                <option value="68">Bel Çantası</option>
                                <option value="69">Valiz</option>
                            </select>
                        </div>
                    </div>
                    <div class="container" id="mainContent">
                    </div>
                    <div class="container" id="buttonsDiv" name="buttonsDiv" style="display: none">
                        <div class="row mt-5">
                            <div class="col-6">
                            </div>
                            <div class="col-6">
                                <div class="d-flex justify-content-start">
                                    <button type="button" class="btn btn-danger d-flex align-items-center me-2"
                                        id="clearButton" onclick="clearTagsText()"
                                        style="display: flex; align-items: center;">
                                        <h5 class="ms-3 mt-1">Temizle</h5>
                                        <i class="fa-solid fa-trash ms-2 mt-0" aria-hidden="true"></i>
                                    </button>
                                    <button type="submit" class="btn btn-success d-flex align-items-center"
                                        id="submitButton" style="display: flex; align-items: center;">
                                        <h5 class="ms-3 mt-1">Kaydet</h5>
                                        <i class="fa-solid fa-check ms-2 mt-0" aria-hidden="true"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row mt-5"></div>
                </form>
            </div>
        </main>
    </div>

    <script src="/assets/jquery/dist/jquery.min.js"></script>
    <script src="/assets/toastr/build/toastr.min.js"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            categoryOnChanged();
        });

        /**
         * Submits the form data via POST request to add a new product and displays a success or error message.
         *
         * @param {Event} event - The submit event triggered by the form.
         */
        document.getElementById('addProcForm').addEventListener('submit', function(event) {
            event.preventDefault();
            const formData = new FormData(this);
            const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('{{route('seller.ppd.product.addProc')}}', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'X-CSRF-TOKEN': token
                    }
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        toastr.success('Ürün başarıyla eklendi!', 'Başarılı');
                    } else {
                        toastr.error('Ürün eklenirken bir hata oluştu: ' + data.message, 'Hata');
                    }
                })
                .catch(error => {
                    console.error('Hata:', error);
                    toastr.error('Ürün eklenirken bir hata oluştu.');
                });
        });
    </script>


</body>

</html>
