<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TekshiruvController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\DatatablesController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});
Route::get('/redirects',[HomeController::class,'redirects']);

Auth::routes();



 
    Route::get('/sotuv/home', [HomeController::class, 'sotuvHome'])->name('shome')->middleware('utype');
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    Route::get('/admin/home', [HomeController::class, 'adminHome'])->name('ahome')->middleware('utype');
    Route::get('/operator/home', [HomeController::class, 'operatorHome'])->name('ohome')->middleware('utype');

// Tekshiruv Bo'limi
Route::group(['middleware'=>['rolecontrol']],function(){
    Route::get('/tekshiruv/home', [HomeController::class, 'tekshirHome'])->name('thome')->middleware('utype');
    // Route::get('/tekshiruv/add_products',[TekshiruvController::class,'add_products'])->name('add_products');
    Route::post('/tekshiruv/filial_ajax',[TekshiruvController::class,'filial_ajax'])->name('filial_ajax');
    Route::post('/tekshiruv/filial_name_send',[TekshiruvController::class,'filial_name_send'])->name('tekshiruv.filial_name_send');
    Route::get('/tekshiruv/filial_change',[TekshiruvController::class,'filial_change'])->name('tekshiruv.filial_change');
    Route::get('/tekshiruv/getproduct',[TekshiruvController::class,'getProduct'])->name('tekshiruv.getproducts');

    // ***********Add Tovar Ajaxesess*****************
    Route::get('/tekshiruv/tur_brend_ajax',[TekshiruvController::class,'tur_brend_ajax'])->name('tekshiruv.tur_brend_ajax');
    Route::get('/tekshiruv/old_tur_brend_ajax',[TekshiruvController::class,'old_tur_brend_ajax'])->name('tekshiruv.old_tur_brend_ajax');
    Route::get('/tekshiruv/old_tur_new_brend_ajax',[TekshiruvController::class,'old_tur_new_brend_ajax'])->name('tekshiruv.old_tur_new_brend_ajax');
    Route::get('/tekshiruv/new_tur_new_brend_ajax',[TekshiruvController::class,'new_tur_new_brend_ajax'])->name('tekshiruv.new_tur_new_brend_ajax');
    Route::get('/tekshiruv/qoshilgan_tovar_insert_ajax',[TekshiruvController::class,'qoshilgan_tovar_insert_ajax'])->name('tekshiruv.qoshilgan_tovar_insert_ajax');
    Route::get('/tekshiruv/filial_tovar_insert_ajax',[TekshiruvController::class,'filial_tovar_insert_ajax'])->name('tekshiruv.filial_tovar_insert_ajax');
    Route::get('/tekshiruv/delete_add_tovar_row_ajax',[TekshiruvController::class,'delete_add_tovar_row_ajax'])->name('tekshiruv.delete_add_tovar_row_ajax');
    
    Route::get('register', function () {
        return view('auth.register');
    });


    Route::get('/datatable',[DatatablesController::class,'getIndex'])->name('datatables.data');

    Route::get('/datatable_ajax',[DatatablesController::class,'getUsers'])->name('datatables.getusers');
});

Route::get('/logout', [LoginController::class,'logout'])->name('logoutrote');
