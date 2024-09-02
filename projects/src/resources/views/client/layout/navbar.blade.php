<nav style="background: transparent">
    <div class="container">
        <div class="row w-100 mt-4">
            <div class="col-3">
                <a href="{{ route('user.show.home') }}" style="text-decoration: none; color:black; opacity:0.9">
                    <h1>Stil Deposu</h1>
                </a>
            </div>
            <div class="col-6 mt-2">
                <div class="w-100 d-flex align-items-center">
                    <form action="{{ route('user.show.search') }}" method="GET" class="d-flex w-100">
                        <div class="col-10">
                            <input type="text" name="search_key" class="form-control border-0" id="search_key"
                                style="padding-left: 0; background: transparent"
                                placeholder="Aradığınız ürün, kategori veya markayı yazın">
                        </div>
                        <div class="col-1 ms-4 btn">
                            <button type="submit" class="navHeaderButton"
                                style="border: none; background-color: #ffffff;">
                                <i class="fa-solid fa-magnifying-glass"></i>
                            </button>
                        </div>
                    </form>
                </div>

            </div>
            <div class="col-3 mt-3">
                <div class="w-100 d-flex align-items-center">
                    <div class="col-4">
                        <a href="{{ route('user.show.getProfilePage') }}" class="navHeaderButton"><i
                                class="fa-solid fa-user"></i> Hesabım</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('user.show.getFavoriProductsPage') }}" class="navHeaderButton"><i
                                class="fa-solid fa-heart"></i> Favoriler</a>
                    </div>
                    <div class="col-4">
                        <a href="{{ route('user.show.getBasketPage') }}" class="navHeaderButton"><i
                                class="fa-solid fa-cart-shopping"></i> Sepetim</a>
                    </div>
                </div>
            </div>


        </div>
        <div class="row w-100 mt-3" style="background: transparent">
            <div class="col d-flex justify-content-center">
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Giyim
                    </a>
                    <ul class="row dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Elbise']) }}">Elbise</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Tişört']) }}">Tişört</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Gömlek']) }}">Gömlek</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Pantolon']) }}">Pantolon</a>
                        </li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Şort']) }}">Şort</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Mont']) }}">Mont</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Ceket']) }}">Ceket</a></li>
                        <li class="col-4"><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Sweatshirt']) }}">Sweatshirt</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Mutfak
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yemek Takımı']) }}">Yemek
                                Takımı</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Bıçak & Çatal & Kaşık']) }}">Bıçak
                                &
                                Çatal & Kaşık</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Bardaklar']) }}">Bardaklar</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Tabaklar']) }}">Tabaklar</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Tencere & Tava']) }}">Tencere
                                &
                                Tava</a></li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Banyo
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Havlu']) }}">Havlu</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Bornoz']) }}">Bornoz</a></li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Ev Dekorasyon
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Tablo']) }}">Tablo</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Duvar Saati']) }}">Duvar
                                Saati</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Ayna']) }}">Ayna</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Dekoratif Ürünler']) }}">Dekoratif
                                Ürünler</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Avize']) }}">Avize</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Lamba']) }}">Lamba</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Abajur']) }}">Abajur</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Halı & Kilim']) }}">Halı &
                                Kilim</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Ev Tekstil
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Perde']) }}">Perde</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Nevresim Takımı']) }}">Nevresim
                                Takımı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yastık']) }}">Yastık</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yorgan']) }}">Yorgan</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Battaniye']) }}">Battaniye</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Makyaj
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Göz Makyajı']) }}">Göz
                                Makyajı</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Ten Makyajı']) }}">Ten
                                Makyajı</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Dudak Makyajı']) }}">Dudak
                                Makyajı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Oje & Aseton']) }}">Oje &
                                Aseton</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Fondöten']) }}">Fondöten</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Ruj']) }}">Ruj</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Dudak Kalemli']) }}">Dudak
                                Kalemli</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Maskara']) }}">Maskara</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Eyeliner']) }}">Eyeliner</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Göz Kalemleri']) }}">Göz
                                Kalemleri</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Allık']) }}">Allık</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Kapatıcılar']) }}">Kapatıcılar</a>
                        </li>
                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Cilt Bakımı
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yüz Kremi']) }}">Yüz
                                Kremi</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yüz Temizleme']) }}">Yüz
                                Temizleme</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yüz Maskesi']) }}">Yüz
                                Maskesi</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Göz Bakımı']) }}">Göz
                                Bakımı</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Güneş Kremi']) }}">Güneş
                                Kremi</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'El Ayak Bakımı']) }}">El Ayak
                                Bakımı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Tonikler']) }}">Tonikler</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Nemlendiriciler']) }}">Nemlendiriciler</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Yüz Maskeleri']) }}">Yüz
                                Maskeleri</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Peeling']) }}">Peeling</a>
                        </li>

                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Kişisel Bakım
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Şampuan']) }}">Şampuan</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Duş Jelleri']) }}">Duş
                                Jelleri</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Banyo Sabunları']) }}">Banyo
                                Sabunları</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Vücut Spreyleri']) }}">Vücut
                                Spreyleri</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Parfüm']) }}">Parfüm</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Deodorant']) }}">Deodorant</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Ağız Bakım']) }}">Ağız
                                Bakım</a>
                        </li>

                    </ul>
                </div>
                <div class="dropdown mx-3">
                    <a href="#" class="navCategory dropdown-toggle" id="dropdownMenuButton1"
                        data-bs-toggle="dropdown" aria-expanded="false">
                        Ayakkabı Çanta
                    </a>
                    <ul class="dropdown-menu " aria-labelledby="dropdownMenuButton1">
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Spor Ayakkabı']) }}">Spor
                                Ayakkabı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Günlük Ayakkabı']) }}">Günlük
                                Ayakkabı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Bot & Çizme']) }}">Bot &
                                Çizme</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Sneaker']) }}">Sneaker</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Topuklu Ayakkabı']) }}">Topuklu
                                Ayakkabı</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Terlik']) }}">Terlik</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Kol Çantası']) }}">Kol
                                Çantası</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Sırt Çantası']) }}">Sırt
                                Çantası</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Cüzdan']) }}">Cüzdan</a></li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Bel Çantası']) }}">Bel
                                Çantası</a>
                        </li>
                        <li><a class="dropdown-item"
                                href="{{ route('user.show.CategoryPage', ['category' => 'Valiz']) }}">Valiz</a></li>
                    </ul>
                </div>
            </div>
        </div>

        <hr>
    </div>
</nav>
