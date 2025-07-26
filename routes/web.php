<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\EvaraController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\SubCategoryController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductOfferController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\CustomerAuthController;
use App\Http\Controllers\WishListController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\FeatureController;
use App\Http\Controllers\CourierController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SslCommerzPaymentController;
use App\Http\Controllers\AdController;
use App\Http\Controllers\SettingController;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\PurchaseGuideController;
use App\Http\Controllers\ShippingPolicyController;
use App\Http\Controllers\ReturnPolicyController;
use App\Http\Controllers\PrivacyPolicyController;
use App\Http\Controllers\TermsConditionController;
use App\Http\Controllers\AboutUsController;
use App\Http\Controllers\ContactUsController;
use App\Http\Controllers\Vendor\VendorAuthController;
use App\Http\Controllers\Vendor\VendorProfileController;
use App\Http\Controllers\Vendor\VendorProductController;
use App\Http\Controllers\CouponController;
use App\Http\Controllers\CouponManageController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\Admin\HighlightController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\Admin\PopupController;
use App\Http\Controllers\Admin\TagController;
use App\Http\Controllers\Admin\NewsHeaderController;
use App\Http\Controllers\Admin\ConfigureController;
use App\Http\Controllers\AddressController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', [EvaraController::class,'index'])->name('home');
//Route::get('/product-category', [EvaraController::class,'category'])->name('product-category');
Route::get('/product-category/{slug}', [EvaraController::class,'category'])->name('product-category');
Route::get('/product-sub-category/{slug}', [EvaraController::class,'subCategory'])->name('product-sub-category');
Route::get('/product-brand/{slug}', [EvaraController::class,'productByBrand'])->name('product-brand');
Route::get('/brands', [EvaraController::class,'allBrands'])->name('all-brand');
Route::get('/product-all', [EvaraController::class,'allProduct'])->name('product-all');
Route::get('/filter',[EvaraController::class,'filter'])->name('product.filter');
Route::get('/search-products', [EvaraController::class, 'search'])->name('products.search');
Route::get('/load-more-products',[EvaraController::class,'loadMoreProducts'])->name('product.loadMore');
Route::get('/product-detail/{slug}', [EvaraController::class,'productDetails'])->name('product-detail');
//Route::post('/cart', [CartController::class,'addToCart'])->name('cart');
Route::resources(['cart' => CartController::class]);
Route::post('/cart/update-product',[CartController::class,'updateProduct'])->name('cart.update-product');
Route::get('/checkout',[CheckoutController::class,'index'])->name('checkout');
Route::get('/get-address-details',[CheckoutController::class,'getAddressDetails'])->name('checkout.address.details');
Route::post('/new-order',[CheckoutController::class,'newOrder'])->name('new-order');
Route::get('/complete-order',[CheckoutController::class,'completeOrder'])->name('complete-order');

// CustomerAuthController
Route::get('/login-register',[CustomerAuthController::class,'login'])->name('login-register');
Route::post('/login-check',[CustomerAuthController::class,'loginCheck'])->name('login-check');
Route::post('/new-customer',[CustomerAuthController::class,'newCustomer'])->name('new-customer');
Route::post('/new-customer-admin',[CustomerAuthController::class,'newCustomerAdmin'])->name('admin.new.customer');
Route::get('/customer-logout',[CustomerAuthController::class,'logout'])->name('customer-logout');

// CustomerAuthController  Dashboard
Route::middleware(['customer'])->group(function () {

    Route::get('/my-dashboard',[CustomerAuthController::class,'dashboard'])->name('customer.dashboard');
    // CustomerAuthController New Route
    Route::get('/customer-orders',[CustomerAuthController::class,'customerOrder'])->name('customer.orders');
    Route::get('/customer-orders-details/{id}',[CustomerAuthController::class,'orderDetails'])->name('customer-order-details');
    Route::get('/customer-cancel-orders',[CustomerAuthController::class,'customerCancelOrder'])->name('customer.cancel.orders');
    Route::get('/show-customer-order/{id}',[CustomerAuthController::class,'showCustomerOrder'])->name('show-customer-order');
    Route::get('/customer/invoice-show/{id}', [CustomerAuthController::class,'showCustomerInvoice'])->name('customer-invoice-show');
    Route::get('/customer/invoice-download/{id}', [CustomerAuthController::class,'showCustomerDownload'])->name('customer-invoice-download');
    Route::post('/editCustomer',[CustomerAuthController::class,'editCustomer'])->name('editCustomer');


    Route::get('/my-password', [CustomerAuthController::class, 'customerChangePassword'])->name('customer.password');
    Route::put('/my-password-change/{id}', [CustomerAuthController::class, 'customerPasswordChange'])->name('customer.password.change');

    Route::get('/my-account-details', [CustomerAuthController::class, 'accountDetail'])->name('customer.account.details');
    Route::put('/update-customer-info/{id}', [CustomerAuthController::class, 'updateCustomerInfo'])->name('update.customer.info');
    Route::get('/cart/delete-product/{id}',[CartController::class,'delete'])->name('cart.delete');
    Route::post('/cart/clear-product',[CartController::class,'clearCart'])->name('cart.clear');
    Route::post('/cart/update-Product/', [CartController::class, 'updateProduct'])->name('cart.update');
    Route::post('/cart/ajax-update-Product/', [CartController::class, 'ajaxUpdateProduct'])->name('ajax-update-Product');
});
/*
 // CustomerAuthController  Dashboard
Route::get('/my-dashboard',[CustomerAuthController::class,'dashboard'])->name('customer.dashboard');
*/
//Wishlist

Route::post('/cart-ad', [CartController::class,'cartAdd'])->name('cart.ad');
Route::get('get-cart-details', [CartController::class, 'getCartDetails'])->name('get-cart-details');



Route::get('/admin-login',[\App\Http\Controllers\AdminAuthController::class,'login'])->name('admin.login');
Route::post('/admin-login-confirm',[\App\Http\Controllers\AdminAuthController::class,'loginConfirm'])->name('admin.login.confirm');


/*ADMIN PANEL */
Route::middleware(['admin.auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index'])->name('dashboard');
    Route::resource('category', CategoryController::class);
    Route::resource('product', ProductController::class);
    Route::controller(ProductController::class)->group(function () {
        Route::post('/other-images-store', 'otherImagesStore')->name('admin.other.images.store');
        Route::put('/other-images-update/{id}', 'otherImagesUpdate')->name('admin.other.images.update');
        Route::delete('/other-images-destroy/{id}', 'otherImagesDestroy')->name('admin.other.images.destroy');
    });


    //Order Module

    Route::resource('order', OrderController::class);
    Route::get('/order/invoice-show/{id}', [OrderController::class,'showInvoice'])->name('order.invoice-show');

    Route::resource('user', UserController::class)->middleware('superAdmin');
    //Ad Module

    //Setting Module
    Route::controller(SettingController::class)->group(function(){
        Route::get('/setting','index')->name('admin.setting.index');
    });
    Route::resource('setting', SettingController::class);



    Route::controller(\App\Http\Controllers\CartController::class)->group(function () {
        Route::post('/add-to-cart-admin', 'addCartAdmin')->name('admin.add.cart');
        Route::put('/cart-admin-update/{id}', 'updateCartAdmin')->name('admin.update.cart');
        Route::delete('/cart-admin-destroy/{id}', 'delete')->name('admin.destroy.cart');
    });

    Route::controller(\App\Http\Controllers\ReportController::class)->group(function () {
        Route::get('/order-report', 'OrderReport')->name('admin.order.report');
        Route::get('/order-report-show', 'OrderReportShow')->name('admin.order.report.show');
        Route::get('/customer-report', 'customerReport')->name('admin.customer.report');
        Route::get('/customer-report-show', 'customerReportShow')->name('admin.customer.report.show');
    });

    Route::post('/logout', [\App\Http\Controllers\AdminAuthController::class, 'logout'])->name('logout');
    \Laravel\Fortify\Fortify::loginView(fn () => view('auth.login'));
    \Laravel\Fortify\Fortify::registerView(fn () => view('auth.register'));

});
