<?php

use App\Http\Controllers\Backend\AdminAuthController;
use App\Http\Controllers\Backend\AdminController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\FrontendController;
use Illuminate\Support\Facades\Route;


Route::get('/', [FrontendController::class, 'index']);
Route::get('/shop', [FrontendController::class, 'shopProducts']);
Route::get('/return-process', [FrontendController::class, 'returnProcess']);
Route::get('/product-details', [FrontendController::class, 'productDetails']);
Route::get('/type-products/{type}', [FrontendController::class, 'typeProducts']);
Route::get('/view-cart-products', [FrontendController::class, 'viewCart']);
Route::get('/checkout', [FrontendController::class, 'checkOut']);

// Policy...
Route::get('/privacy-policy', [FrontendController::class, 'privacyPolicy']);
Route::get('/terms-conditions', [FrontendController::class, 'termsCondition']);
Route::get('/refund-policy', [FrontendController::class, 'refundPolicy']);
Route::get('/payment-policy', [FrontendController::class, 'paymentPolicy']);
Route::get('/about-us', [FrontendController::class, 'aboutUs']);
Route::get('/contact-us', [FrontendController::class, 'contactUs']);


//Admin Auth Routes..
Route::get('/admin/login', [AdminAuthController::class, 'loginForm']);
Route::get('/admin/logout', [AdminAuthController::class, 'logoutAdmin']);


Auth::routes();
Route::get('/admin/dashboard', [AdminController::class, 'adminDashboard']);

//Category routes...
Route::get('/admin/category/create', [CategoryController::class, 'categoryCreate']);
Route::post('/admin/category/store', [CategoryController::class, 'categoryStore']);
Route::get('/admin/category/list', [CategoryController::class, 'categoryList']);
Route::get('/admin/category/delete/{id}', [CategoryController::class, 'categoryDelete']);
Route::get('/admin/category/edit/{id}', [CategoryController::class, 'categoryEdit']);
Route::post('/admin/category/update/{id}', [CategoryController::class, 'categoryUpdate']);

//SubCategory Routes...
Route::get('/admin/sub-category/create', [SubCategoryController::class, 'subCategoryCreate']);
Route::post('/admin/sub-category/store', [SubCategoryController::class, 'subCategoryStore']);
Route::get('/admin/sub-category/list', [SubCategoryController::class, 'subCategoryList']);
Route::get('/admin/sub-category/delete/{id}', [SubCategoryController::class, 'subCategoryDelete']);
Route::get('/admin/sub-category/edit/{id}', [SubCategoryController::class, 'subCategoryEdit']);
Route::post('/admin/sub-category/update/{id}', [SubCategoryController::class, 'subCategoryUpdate']);

//Product Routes...
Route::get('/admin/product/create', [ProductController::class, 'productCreate']);
Route::post('/admin/product/store', [ProductController::class, 'productStore']);
Route::get('/admin/product/list', [ProductController::class, 'productList']);
Route::get('/admin/product/delete/{id}', [ProductController::class, 'productDelete']);
Route::get('/admin/product/edit/{id}', [ProductController::class, 'productEdit']);
Route::post('/admin/product/update/{id}', [ProductController::class, 'productUpdate']);