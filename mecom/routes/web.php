<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\VendorController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\OrderController;
use App\Http\Controllers\Backend\ReturnController;
use App\Http\Controllers\Backend\VendorOrderController;
use App\Http\Middleware\RedirectIfAuthenticated;
use App\Http\Controllers\Backend\VendorProductController;
use App\Http\Controllers\Backend\SliderController;
use App\Http\Controllers\Backend\BannerController;
use App\Http\Controllers\Frontend\IndexController;
use App\Http\Controllers\Frontend\CartController;
use App\Http\Controllers\User\WishlistController; 
use App\Http\Controllers\User\CheckoutController; 
use App\Http\Controllers\User\CashController;
use App\Http\Controllers\User\AllUserController;
use App\Http\Controllers\User\ReviewController;

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

// Route::get('/', function () {
//     return view('frontend.index');
// });

Route::get('/',[IndexController::class, 'Index']);

Route::middleware(['auth'])->group(function(){
    Route::get('/dashboard',[UserController::class, 'UserDashboard'])-> name('dashboard');
    Route::post('/user/profile/store',[UserController::class, 'UserProfileStore'])-> name('user.profile.store');
    Route::get('/user/logout',[UserController::class, 'UserLogout'])-> name('user.logout');
    Route::post('/user/update/password',[UserController::class, 'UserUpdatePassword'])-> name('user.update.password');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

///Admin Dashboard
require __DIR__.'/auth.php';
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::get('/admin/dashboard',[AdminController::class, 'AdminDashboard'])-> name('admin.dashboard');
    Route::get('/admin/logout',[AdminController::class, 'AdminDestroy'])-> name('admin.logout');
    Route::get('/admin/profile',[AdminController::class, 'AdminProfile'])-> name('admin.profile');
    Route::post('/admin/profile/store',[AdminController::class, 'AdminProfileStore'])-> name('admin.profile.store');
    Route::get('/admin/change/password',[AdminController::class, 'AdminChangePassword'])-> name('admin.change.password');
    Route::post('/admin/update/password',[AdminController::class, 'AdminUpdatePassword'])-> name('update.password');
});

///Vendor Dashboard
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::get('/vendor/dashboard',[VendorController::class, 'VendorDashboard'])-> name('vendor.dashboard');
    Route::get('/vendor/logout',[VendorController::class, 'VendorDestroy'])-> name('vendor.logout');
    Route::get('/vendor/profile',[VendorController::class, 'VendorProfile'])-> name('vendor.profile');
    Route::post('/vendor/profile/store',[VendorController::class, 'VendorProfileStore'])-> name('vendor.profile.store');
    Route::get('/vendor/change/password',[VendorController::class, 'VendorChangePassword'])-> name('vendor.change.password');
    Route::post('/vendor/update/password',[VendorController::class, 'VendorUpdatePassword'])-> name('vendor.update.password');

    Route::controller(VendorProductController::class)->group(function(){
        Route::get('vendor/all/product', 'VendorAllProduct')->name('vendor.all.product');
        Route::get('vendor/add/product', 'VendorAddProduct')->name('vendor.add.product');
        Route::get('/vendor/subcategory/ajax/{category_id}', 'VendorGetSubcategory');
        Route::post('/vendor/store/product', 'VendorStoreProduct')->name('vendor.store.product');
        Route::get('/vendor/edit/product/{id}', 'VendorEditProduct')->name('vendor.edit.product');
        Route::post('/vendor/update/product' , 'VendorUpdateProduct')->name('vendor.update.product');
        Route::post('/vendor/update/product/thambnail' , 'VendorUpdateProductThumbnail')->name('vendor.update.product.thumbnail');
        Route::post('/vendor/update/product/multiimage' , 'VendorUpdateProductMultiimage')->name('vendor.update.product.multiimage');
        Route::get('/vendor/product/multiimg/delete/{id}' , 'VendorMultiImageDelete')->name('vendor.product.multiimg.delete');
        Route::get('/vendor/product/inactive/{id}' , 'VendorProductInactive')->name('vendor.product.inactive');
        Route::get('/vendor/product/active/{id}' , 'VendorProductActive')->name('vendor.product.active');
        Route::get('/vendor/delete/product/{id}' , 'VendorProductDelete')->name('vendor.delete.product');
    });

    Route::controller(VendorOrderController::class)->group(function(){
        Route::get('/vendor/order', 'VendorOrder')->name('vendor.order');
        Route::get('/vendor/return/order' , 'VendorReturnOrder')->name('vendor.return.order');
        Route::get('/vendor/complete/return/order' , 'VendorCompleteReturnOrder')->name('vendor.complete.return.order');
        Route::get('/vendor/order/details/{order_id}' , 'VendorOrderDetails')->name('vendor.order.details');
    });

    Route::controller(ReviewController::class)->group(function(){
        Route::get('vendor/all/review' , 'VendorAllReview')->name('vendor.all.review');     
    });

});

// end Vendor group middleware

Route::get('/admin/login',[AdminController::class, 'AdminLogin'])->middleware(RedirectIfAuthenticated::class);
Route::get('/vendor/login',[VendorController::class, 'VendorLogin'])->name('vendor.login')->middleware(RedirectIfAuthenticated::class);

Route::get('/become/vendor',[VendorController::class, 'BecomeVendor'])->name('become.vendor');
Route::post('/vendor/register',[VendorController::class, 'VendorRegister'])->name('vendor.register');

Route::middleware(['auth', 'role:admin'])->group(function(){
    //Brand All Route
    Route::controller(BrandController::class)->group(function(){
        Route::get('/all/brand', 'AllBrand')->name('all.brand');
        Route::get('/add/brand', 'AddBrand')->name('add.brand');
        Route::post('/store/brand', 'StoreBrand')->name('store.brand');
        Route::get('/edit/brand/{id}', 'EditBrand')->name('edit.brand');
        Route::post('/update/brand', 'UpdateBrand')->name('update.brand');
        Route::get('/delete/brand/{id}', 'DeleteBrand')->name('delete.brand');
    });

    Route::controller(CategoryController::class)->group(function(){
        Route::get('/all/category', 'AllCategory')->name('all.category');
        Route::get('/add/category', 'AddCategory')->name('add.category');
        Route::post('/store/category', 'StoreCategory')->name('store.category');
        Route::get('/edit/category/{id}', 'EditCategory')->name('edit.category');
        Route::post('/update/category', 'UpdateCategory')->name('update.category');
        Route::get('/delete/category/{id}', 'DeleteCategory')->name('delete.category');
    });

    Route::controller(SubcategoryController::class)->group(function(){
        Route::get('/all/subcategory', 'AllSubCategory')->name('all.subcategory');
        Route::get('/add/subcategory', 'AddSubCategory')->name('add.subcategory');
        Route::post('/store/subcategory', 'StoreSubCategory')->name('store.subcategory');
        Route::get('/edit/subcategory/{id}', 'EditSubCategory')->name('edit.subcategory');
        Route::post('/update/subcategory', 'UpdateSubCategory')->name('update.subcategory');
        Route::get('/delete/subcategory/{id}', 'DeleteSubCategory')->name('delete.subcategory');
        Route::get('/subcategory/ajax/{category_id}', 'GetSubcategory');
    });

    Route::controller(AdminController::class)->group(function(){
        Route::get('/inactive/vendor', 'InactiveVendor')->name('inactive.vendor');
        Route::get('/active/vendor', 'ActiveVendor')->name('active.vendor');
        Route::get('/inactive/vendor/details/{id}', 'InactiveVendorDetails')->name('inactive.vendor.details');
        Route::post('/active/vendor/approve', 'ActiveVendorApprove')->name('active.vendor.approve');
        Route::get('/active/vendor/details/{id}', 'ActiveVendorDetails')->name('active.vendor.details');
        Route::post('/inactive/vendor/approve', 'InactiveVendorApprove')->name('inactive.vendor.approve');
    });

    //Product All Route
    Route::controller(ProductController::class)->group(function(){
        Route::get('/all/products', 'AllProduct')->name('all.product');
        Route::get('/add/products', 'AddProduct')->name('add.product');
        Route::post('/store/products', 'StoreProduct')->name('store.product');
        Route::get('/edit/products/{id}', 'EditProduct')->name('edit.product');
        Route::post('/update/products', 'UpdateProduct')->name('update.product');
        Route::post('/update/products/thumbnail', 'UpdateProductThumbnail')->name('update.product.thumbnail');
        Route::post('/update/products/multiimage', 'UpdateProductMultiimage')->name('update.product.multiimage');
        Route::get('/product/multiimg/delete/{id}', 'MultiImageDelete')->name('product.multiimg.delete');
        Route::get('/product/inactive/{id}', 'ProductInactive')->name('product.inactive');
        Route::get('/product/active/{id}', 'ProductActive')->name('product.active');
        Route::get('/delete/product/{id}', 'ProductDelete')->name('delete.product');
        Route::get('/product/stock', 'ProductStock')->name('product.stock');
    });

    Route::controller(SliderController::class)->group(function(){
        Route::get('/all/slider', 'AllSlider')->name('all.slider');
        Route::get('/add/slider', 'AddSlider')->name('add.slider');
        Route::post('/store/slider', 'StoreSlider')->name('store.slider');
        Route::get('/edit/slider/{id}', 'EditSlider')->name('edit.slider');
        Route::post('/update/slider', 'UpdateSlider')->name('update.slider');
        Route::get('/delete/slider/{id}', 'DeleteSlider')->name('delete.slider');
    });

    Route::controller(BannerController::class)->group(function(){
        Route::get('/all/banner', 'AllBanner')->name('all.banner');
        Route::get('/add/banner', 'AddBanner')->name('add.banner');
        Route::post('/store/banner', 'StoreBanner')->name('store.banner');
        Route::get('/edit/banner/{id}', 'EditBanner')->name('edit.banner');
        Route::post('/update/banner', 'UpdateBanner')->name('update.banner');
        Route::get('/delete/banner/{id}', 'DeleteBanner')->name('delete.banner');
    });

    Route::controller(OrderController::class)->group(function(){
        Route::get('/pending/order' , 'PendingOrder')->name('pending.order');
        Route::get('/admin/order/details/{order_id}' , 'AdminOrderDetails')->name('admin.order.details');
        Route::get('admin/confirmed/order' , 'AdminConfirmedOrder')->name('admin.confirmed.order');
        Route::get('admin/processing/order' , 'AdminProcessingOrder')->name('admin.processing.order');
        Route::get('admin/delivered/order' , 'AdminDeliveredOrder')->name('admin.delivered.order');  
        Route::get('/pending/confirm/{order_id}' , 'PendingToConfirm')->name('pending-confirm');
        Route::get('/confirm/processing/{order_id}' , 'ConfirmToProcess')->name('confirm-processing');
        Route::get('/processing/delivered/{order_id}' , 'ProcessToDelivered')->name('processing-delivered');
    });

    Route::controller(ReturnController::class)->group(function(){
        Route::get('/return/request' , 'ReturnRequest')->name('return.request');
        Route::get('/return/request/approved/{order_id}' , 'ReturnRequestApproved')->name('return.request.approved');
        Route::get('/complete/return/request' , 'CompleteReturnRequest')->name('complete.return.request');
    });
});

Route::controller(ReviewController::class)->group(function(){
    Route::post('/store/review' , 'StoreReview')->name('store.review');     
});

///Frontend Product Details All Route
Route::get('/product/details/{id}/{slug}', [IndexController::class,'ProductDetails']);
Route::get('/vendor/details/{id}', [IndexController::class,'VendorDetails'])->name('vendor.details');
Route::get('/vendor/all', [IndexController::class,'VendorAll'])->name('vendor.all');
Route::get('/product/view/modal/{id}', [IndexController::class,'ProductViewAjax']);
Route::get('/product/category/{id}/{slug}', [IndexController::class,'CatWiseProduct']);
Route::get('/product/subcategory/{id}/{slug}', [IndexController::class, 'SubCatWiseProduct']);
//Add to cart store data
Route::post('/cart/data/store/{id}', [CartController::class, 'AddToCart']);

Route::get('/product/mini/cart', [CartController::class, 'AddMiniCart']);
Route::get('/minicart/product/remove/{rowId}', [CartController::class, 'RemoveMiniCart']);
Route::post('/dcart/data/store/{id}', [CartController::class, 'AddToCartDetails']);
Route::post('/add-to-wishlist/{product_id}', [WishlistController::class, 'AddToWishList']);
Route::get('/checkout', [CartController::class, 'CheckoutCreate'])->name('checkout');

Route::controller(CartController::class)->group(function(){
    Route::get('/mycart' , 'MyCart')->name('mycart');
    Route::get('/get-cart-product' , 'GetCartProduct');
    Route::get('/cart-remove/{rowId}' , 'CartRemove');

    Route::get('/cart-decrement/{rowId}' , 'CartDecrement');
    Route::get('/cart-increment/{rowId}' , 'CartIncrement');
}); 

Route::controller(ReviewController::class)->group(function(){
    Route::get('/pending/review' , 'PendingReview')->name('pending.review');
    Route::get('/review/approve/{id}' , 'ReviewApprove')->name('review.approve');
    Route::get('/publish/review' , 'PublishReview')->name('publish.review'); 
    Route::get('/review/delete/{id}' , 'ReviewDelete')->name('review.delete'); 
});
   


Route::middleware(['auth','role:user'])->group(function() {

    // Wishlist All Route 
    Route::controller(WishlistController::class)->group(function(){
       Route::get('/wishlist' , 'AllWishlist')->name('wishlist');
       Route::get('/get-wishlist-product' , 'GetWishlistProduct');
       Route::get('/wishlist-remove/{id}' , 'WishlistRemove'); 
    }); 

    Route::controller(CheckoutController::class)->group(function(){
        Route::post('/checkout/store' , 'CheckoutStore')->name('checkout.store');
    });

    Route::controller(CashController::class)->group(function(){
        Route::post('/cash/order' , 'CashOrder')->name('cash.order');
    }); 

    Route::controller(AllUserController::class)->group(function(){
        Route::get('/user/account/page' , 'UserAccount')->name('user.account.page');
        Route::get('/user/track/order' , 'UserTrackOrder')->name('user.track.order');
        Route::get('/user/change/password' , 'UserChangePassword')->name('user.change.password');
        Route::get('/user/order/page' , 'UserOrderPage')->name('user.order.page');
        Route::get('/user/order_details/{order_id}' , 'UserOrderDetails');
        Route::post('/return/order/{order_id}' , 'ReturnOrder')->name('return.order');
        Route::get('/return/order/page' , 'ReturnOrderPage')->name('return.order.page');
        Route::get('/user/invoice_download/{order_id}' , 'UserOrderInvoice');
        Route::post('/order/tracking' , 'OrderTracking')->name('order.tracking');
    });

});  

