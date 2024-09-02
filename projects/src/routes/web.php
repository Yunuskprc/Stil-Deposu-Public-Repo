<?php

use App\Http\Controllers\SellerShowController;
use App\Http\Controllers\SellerPPDController;
use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\SellerImageController;
use App\Http\Controllers\MailController;
use App\Http\Controllers\UserFilterController;
use App\Http\Controllers\UserPPDController;
use App\Http\Controllers\UserShowController;




Route::get('/login', [AuthController::class, 'showLogin'])->name('showLogin');
Route::post('/login', [AuthController::class, 'login'])->name('login');
Route::get('/register', [AuthController::class, 'showRegister'])->name('showRegister');
Route::post('/register', [AuthController::class, 'register'])->name('register');


Route::prefix('seller')->middleware(['check.role'])->group(function () {
    Route::prefix('show')->group(function(){
        Route::get('/', [SellerShowController::class, 'index'])->name('seller.show.dashboard');
        Route::get('/updateProduct',[SellerShowController::class,'updateProc'])->name('seller.show.updateProc');
        Route::get('/profile',[SellerShowController::class,'profile'])->name('seller.show.profile');
        Route::get('/profile/{url}',[SellerShowController::class,'getProfileContent'])->name('seller.show.getProfilePage.getContent');
        Route::get('/salesFollow',[SellerShowController::class,'salesFollow'])->name('seller.show.salesFollow');
    });

    Route::prefix('')->group(function(){
        Route::post('/addProc', [SellerPPDController::class, 'addProc'])->name('seller.ppd.product.addProc');
        Route::post('/updateProc', [SellerPPDController::class,'updateProc'])->name('seller.ppd.product.updateProc');
        Route::post('/deleteProc', [SellerPPDController::class, 'deletedProc'])->name('seller.ppd.product.deleteProc');
        Route::post('/activatedProc',[SellerPPDController::class, 'activatedProc'])->name('seller.ppd.product.activetedProc');
        Route::post('/logout', [AuthController::class, 'logOut'])->name('seller.logOut');
        Route::post('/userinfoupdate',[SellerPPDController::class, 'updateProfileInfo'])->name('seller.ppd.profile.updateProfileInfo');
        Route::post('/updatepassword',[SellerPPDController::class, 'updatePassword'])->name('seller.ppd.profile.updatePassword');
        Route::post('/addAdress',[SellerPPDController::class, 'addAdress'])->name('seller.ppd.profile.addAdres');
        Route::post('/deleteAdress',[SellerPPDController::class, 'deleteAdress'])->name('seller.ppd.profile.deleteAdress');
        Route::post('/addDebitCard',[SellerPPDController::class, 'addDebitCard'])->name('seller.ppd.profile.addDebitCard');
        Route::post('/deleteDebitCard',[SellerPPDController::class, 'deleteDebitCard'])->name('seller.ppd.profile.deleteDebitCard');
        Route::post('/add-cardImage',[SellerImageController::class, 'addCardImage'])->name('seller.ppd.profile.addCardImage');
        Route::post('/add-logo',[SellerImageController::class, 'addLogo'])->name('seller.ppd.profile.addLogo');
        Route::post('/delete-cardImage',[SellerImageController::class, 'deleteCardImage'])->name('seller.ppd.profile.deleteCardImage');
        Route::post('/delete-logo',[SellerImageController::class, 'deleteLogo'])->name('seller.ppd.profile.deleteLogo');
        Route::post('/generate-verify-code', [MailController::class, 'generateCode'])->name('seller.ppd.profile.generateMailVerifyCode');
        Route::post('/check-verify-code', [MailController::class, 'checkCode'])->name('seller.ppd.profile.checkMailVerifyCode');

        //
        Route::post('/waiting-sales-complate',[SellerPPDController::class, 'waitingSalesComplate'])->name('seller.ppd.sales.waiting-sales-complate');
        Route::post('/get-sales-detail',[SellerPPDController::class, 'getSoldSalesDetail'])->name('seller.ppd.sales.get-sold-sales-detail');
    });
});


Route::prefix('')->group(function(){
    Route::get('/', [UserShowController::class, 'index'])->name('user.show.home');
    Route::get('/brands/{brands_name}',[UserShowController::class, 'getBrandDetail'])->name('user.show.getBrandPage');
    Route::get('/productDetail/{product_id}', [UserShowController::class, 'getProductDetail'])->name('user.show.productsDetail');
    Route::get('/category/{category}', [UserShowController::class, 'getCategoryPage'])->name('user.show.CategoryPage');
    Route::get('/product/getProduct/{product_id}',[UserShowController::class, 'getProductCart'])->name('user.show.product.cart');
    Route::get('/search',[UserShowController::class,'getSearchPage'])->name('user.show.search');

    Route::post('/brands-filter-product', [UserFilterController::class, 'brandsProductFilter'])->name('filter.get.brands.product');


    Route::middleware(['check.user'])->group(function(){
        Route::get('/user/show/profile',[UserShowController::class,'getProfile'])->name('user.show.getProfilePage');
        Route::get('/user/show/profile/{url}',[UserShowController::class,'getProfileContent'])->name('user.show.getProfilePage.getContent');
        Route::get('/user/show/basket',[UserShowController::class,'getBasket'])->name('user.show.getBasketPage');
        Route::get('/user/show/basket/final-basket',[UserShowController::class,'getFinalizeBasket'])->name('user.show.basket.final-basket');
        Route::get('/user/show/favori-products',[UserShowController::class,'getFavaoriProducts'])->name('user.show.getFavoriProductsPage');


        Route::post('/user/add-comment', [UserPPDController::class,'addComment'])->name('user.ppd.add.comment');
        Route::post('/user/add-basket-product',[UserPPDController::class,'addBasketProduct'])->name('user.ppd.add.basketProduct');
        Route::post('user/add-follow-product',[UserPPDController::class,'addFollowProduct'])->name('user.ppd.add.followProduct');
        Route::post('/userinfoupdate',[SellerPPDController::class, 'updateProfileInfo'])->name('user.ppd.updateProfileInfo');
        Route::post('/updatepassword',[SellerPPDController::class, 'updatePassword'])->name('user.ppd.updatePassword');
        Route::post('/add-adress',[SellerPPDController::class,'addAdress'])->name('user.ppd.addAdress');
        Route::post('/delete-adress',[SellerPPDController::class,'deleteAdress'])->name('user.ppd.deleteAdress');
        Route::post('/add-debit',[SellerPPDController::class,'addDebitCard'])->name('user.ppd.addDebit');
        Route::post('/delete-debit',[SellerPPDController::class,'deleteDebitCard'])->name('user.ppd.deleteDebit');
        Route::post('/user/delete-comment',[UserPPDController::class,'deleteComment'])->name('user.ppd.deleteComment');
        Route::post('/user/basket/add_product-or-less_product', [UserPPDController::class, 'addOrLessProductOnBasket'])->name('user.ppd.basket.add-less-product');
        Route::post('/user/basket/delete-product',[UserPPDController::class, 'deleteProductOnBasket'])->name('user.ppd.basket.delete-product');
        Route::post('/user/basket/change-active-for-product',[UserPPDController::class, 'changeActiveProductOnBasket'])->name('user.ppd.basket.change-active');
        Route::post('/user/basket/complate-basket',[UserPPDController::class,'complateBasket'])->name('user.ppd.basket.complate-basket');
        // sepeti tamamla -> sipariş maili gönderilmeli kullanıcıya ve seller'a -> seller'a sipariş onayı gitmeli sipariş onaylanmalı
        // sipariş onaylayınca seller siparişi kargoya verme kontrolü olmalı -> seller kargoya verince user'a bildirim gitmeli.

    });
});




Route::get('/temporary-url', function (Request $request) {
    $fileName = $request->query('file');
    $temporaryUrl = Storage::disk('s3')->temporaryUrl('productImages/' . $fileName, now()->addMinutes(60));
    return response()->json(['url' => $temporaryUrl]);
})->name('image.showImage');




Route::get('/test-email-template', [MailController::class, 'showTestEmailTemplate']);
