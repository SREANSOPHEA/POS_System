<?php

use App\Http\Controllers\adminController;
use App\Http\Controllers\categoryController;
use App\Http\Controllers\currencyController;
use App\Http\Controllers\customerController;
use App\Http\Controllers\productController;
use App\Http\Controllers\saleController;
use App\Http\Controllers\supplierController;
use App\Http\Controllers\unitContoller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('admin.login');
})->name('login');
Route::get('/register', function () {
    return view('admin.register');
});
Route::post('/register-submit',[adminController::class,'register']);
Route::post('/login-submit',[adminController::class,'login']);

Route::middleware(['auth'])->group(function(){
    Route::get('/admin/logout',[adminController::class,'logout']);
    Route::get('/admin',[productController::class,'home']);

    /* Currency */
    Route::get('/admin/currency',[currencyController::class,'currency']);
    Route::post('/admin/currency_update_riel',[currencyController::class,'editRiel']);
    Route::post('/admin/currency_update_dollar',[currencyController::class,'editDollar']);

    /* Categories */
    Route::get('/admin/categories',[categoryController::class,'category']);
    Route::post('/admin/add-category',[categoryController::class,'addCategory']);
    Route::post('/admin/edit-category',[categoryController::class,'editCategory']);
    Route::get('/admin/delete-category/{id}',[categoryController::class,'deleteCategory']);

    /* Units */
    Route::get('/admin/units',[unitContoller::class,'unit']);
    Route::post('/admin/add-unit',[unitContoller::class,'addUnit']);
    Route::post('/admin/edit-unit',[unitContoller::class,'editUnit']);
    Route::get('/admin/delete-unit/{id}',[unitContoller::class,'deleteUnit']);

    /* Customer */
    Route::get('/admin/customer',[customerController::class,'customer']);
    Route::get('/admin/add-customer',[customerController::class,'addCustomer']);
    Route::post('/admin/add-customer-submit',[customerController::class,'addCustomerSubmit']);
    Route::get('/admin/edit-customer/{id}',[customerController::class,'editCustomer']);
    Route::post('/admin/edit-customer/{id}',[customerController::class,'editCustomerSubmit']);
    Route::get('/admin/delete-customer/{id}',[customerController::class,'deleteCustomer']);

    /* Product */
    Route::get('/admin/products',[productController::class,'product']);
    Route::get('/admin/add-product',[productController::class,'addProduct']);
    Route::post('/admin/add-product-submit',[productController::class,'addProductSubmit']);
    Route::post('/admin/product-detail',[productController::class,'productDetail']);
    Route::get('/admin/edit-product/{id}',[productController::class,'editProduct']);
    Route::post('/admin/edit-product-submit/{id}',[productController::class,'editProductSubmit']);
    Route::get('/admin/delete-product/{id}',[productController::class,'deleteProduct']);
    Route::get('/admin/stock',[productController::class,'stock']);

    /* Supplier */
    Route::get('/admin/supplier',[supplierController::class,'supplier']);
    Route::get('/admin/add-supplier',[supplierController::class,'addSupplier']);
    Route::post('/admin/add-supplier-submit',[supplierController::class,'addSupplierSubmit']);
    Route::get('/admin/supplier-detail/{id}',[supplierController::class,'supplierDetail']);
    Route::get('/admin/delete-supplier/{id}',[supplierController::class,'deleteSupplier']);
    Route::get('/admin/edit-product/{id}',[supplierController::class,'editSupplier']);
    Route::get('/admin/purchase',[supplierController::class,'purchase']);
    Route::get('/admin/purchase/{id}',[supplierController::class,'addPurchase']);
    Route::post('/admin/purchase-submit/{id}',[supplierController::class,'addPurchaseSubmit']);

    /* Sale */
    Route::get('/admin/sale',[saleController::class,'sale']);
    Route::post('/admin/sale-submit',[saleController::class,'addSale']);
    Route::post('/admin/sale-sendsubmit',[saleController::class,'SaleSubmit']);

    /* Invoice */
    Route::get('/admin/invoice-sale',[saleController::class,'invoiceSale']);
    Route::get('/admin/invoice-sale-detail/{sup_id}',[saleController::class,'invoiceSaleDetail']);
    Route::get('/admin/invoice-purchase',[saleController::class,'invoicePurchase']);
    Route::get('/admin/invoice-purchase-detail/{sup_id}',[saleController::class,'invoicePurchaseDetail']);

});