<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailCategoryController;
use App\Http\Controllers\OrderController;

Route::get('/', [PagesController::class, 'index']);

Route::get('/payment', [PagesController::class, 'payment']);

Route::get('/order', [OrderController::class, 'order']);

Route::get('/admin', [PagesController::class, 'admin_loggin']);

Route::get('/admin_home', [PagesController::class, 'admin_index']);

Route::post('/logginAdmin', [AccountController::class, 'adminLoggin']);

Route::get('/admin/loggout', [AccountController::class, 'admin_logout']);

Route::get('/collections/{id}/{page}', [PagesController::class, 'collections']);

Route::get('/account/register', [PagesController::class, 'register']);

Route::get('/product/{id}', [PagesController::class, 'detail_product']);

Route::get('/HienThiSLSP/{id}/{size}', [ProductController::class, 'getAmountProductBySize']);

Route::get('/addMyCart/{id}/{qty}/{size}', [ProductController::class, 'addMyCart']);

Route::get('/fixSizeItemCart/{id}/{size}', [ProductController::class, 'fixSizeItemCart']);

Route::get('/fixAmountItemCart/{id}/{amount}', [ProductController::class, 'fixAmountItemCart']);

Route::get('/ResetAmountProductCart/{id}/{size}/{index}', [ProductController::class, 'ResetAmountProductCart']);

Route::get('/resetCartMini', [ProductController::class, 'resetCartMini']);

Route::get('/cart', [PagesController::class, 'cart']);

Route::get('/account', [PagesController::class, 'account']);

Route::get('/account/addresses', [PagesController::class, 'addresses']);

Route::get('/account/password', [PagesController::class, 'password']);

Route::get('/delItemCart/{index}', [ProductController::class, 'delItemCart']);

Route::post('/save_account', [AccountController::class, 'addAccount']);

Route::post('/loggin_account', [AccountController::class, 'Loggin']);

Route::post('/save_address', [AccountController::class, 'addAddress']);

Route::post('/save_password', [AccountController::class, 'savePassword']);

Route::get('/select_address/{city}/{district}/{ward}/{address}/{phone}', [AccountController::class, 'updateAddress']);

Route::get('/delete_address/{city}/{district}/{ward}/{address}/{phone}', [AccountController::class, 'deleteAddress']);

Route::get('/selectCity/{city}', [AccountController::class, 'selectCity']);

Route::get('/selectDistrict/{district}/{city}', [AccountController::class, 'selectDistrict']);

Route::get('/account/logout', [AccountController::class, 'logout']);

Route::get('/admin/list_category', [PagesController::class, 'admin_listCategory']);

Route::get('/admin/create_category', [PagesController::class, 'admin_createCategory']);

Route::post('/create_category', [CategoryController::class, 'create_category']);

Route::post('/install_category', [CategoryController::class, 'install_category']);

Route::post('/install_product1', [ProductController::class, 'install_product1']);

Route::post('/install_product2', [ProductController::class, 'install_product2']);

Route::post('/install_product3', [ProductController::class, 'install_product3']);

Route::post('/create_product', [ProductController::class, 'create_product']);

Route::get('/admin/install_category/{id}', [PagesController::class, 'admin_installCategory']);

Route::get('/delete_category/{id}', [CategoryController::class, 'delete_category']);

Route::get('/delete_product/{id}', [ProductController::class, 'delete_product']);

Route::get('/delDetailCategory/{idCategory}/{idDetailCategory}', [DetailCategoryController::class, 'delDetailCategory']);

Route::get('/admin/list_product', [PagesController::class, 'admin_listProduct']);

Route::get('/admin/install_product/{id}', [PagesController::class, 'admin_installProduct']);

Route::get('/admin/create_product', [PagesController::class, 'admin_createProduct']);

Route::get('/MainSub/{id}/{image}', [ProductController::class, 'admin_setImageProduct_MainSub']);

Route::get('/SubMain/{id}/{image}', [ProductController::class, 'admin_setImageProduct_SubMain']);

Route::get('/TurnOffMain/{id}/{image}', [ProductController::class, 'admin_setImageProduct_TurnOffMain']);

Route::get('/TurnOffSub/{id}/{image}', [ProductController::class, 'admin_setImageProduct_TurnOffSub']);

Route::get('/TurnOnSub/{id}/{image}', [ProductController::class, 'admin_setImageProduct_TurnOnSub']);

Route::get('/DeleteMain/{id}', [ProductController::class, 'admin_setImageProduct_DeleteMain']);

Route::get('/DeleteSub/{id}/{image}', [ProductController::class, 'admin_setImageProduct_DeleteSub']);

Route::get('/admin/order', [PagesController::class, 'admin_order']);

Route::get('/admin/order_detail/{id}', [PagesController::class, 'admin_OrderDetail']);

Route::get('/update_status/{status}/{id}', [OrderController::class, 'update_status']);

Route::get('/account/orders', [PagesController::class, 'order']);

Route::get('/account/order_detail/{id}', [PagesController::class, 'order_detail']);

Route::get('/cancel_order/{id}', [OrderController::class, 'cancel_order']);