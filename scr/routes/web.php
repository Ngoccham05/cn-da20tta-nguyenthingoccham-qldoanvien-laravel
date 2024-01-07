<?php

use Illuminate\Support\Facades\Route;


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
Route::get('/', 'App\Http\Controllers\LoginController@loginpage')->name('loginpage');
Route::get('/logout', 'App\Http\Controllers\LoginController@logout');
Route::post('/home', 'App\Http\Controllers\LoginController@home');

Route::middleware('checklogin')->group(function(){
    Route::prefix('admin')->group(function (){
        Route::get('/home', 'App\Http\Controllers\AdminController@home');
        Route::post('/bdloc', 'App\Http\Controllers\AdminController@bdloc');

        Route::get('/bieumau', 'App\Http\Controllers\AdminController@bieumau');
        Route::post('/thembm', 'App\Http\Controllers\AdminController@thembm');
        Route::post('/suabm', 'App\Http\Controllers\AdminController@suabm');
        Route::delete('/xoabm', 'App\Http\Controllers\AdminController@xoabm');

        Route::get('/chuyennganh', 'App\Http\Controllers\AdminController@chuyennganh');
        Route::post('/themnganh', 'App\Http\Controllers\AdminController@themnganh');
        Route::post('/suanganh', 'App\Http\Controllers\AdminController@suanganh');
        Route::delete('/xoanganh', 'App\Http\Controllers\AdminController@xoanganh');

        Route::get('/chucvu', 'App\Http\Controllers\AdminController@chucvu');
        Route::post('/themchucvu', 'App\Http\Controllers\AdminController@themchucvu');
        Route::post('/suachucvu', 'App\Http\Controllers\AdminController@suachucvu');
        Route::delete('/xoachucvu', 'App\Http\Controllers\AdminController@xoachucvu');

        Route::get('/loaicd', 'App\Http\Controllers\AdminController@loaicd');
        Route::post('/themloaicd', 'App\Http\Controllers\AdminController@themloaicd');
        Route::post('/sualoaicd', 'App\Http\Controllers\AdminController@sualoaicd');
        Route::delete('/xoaloaicd', 'App\Http\Controllers\AdminController@xoaloaicd');

        Route::get('/loaidv', 'App\Http\Controllers\AdminController@loaidv');
        Route::post('/themloaidv', 'App\Http\Controllers\AdminController@themloaidv');
        Route::post('/sualoaidv', 'App\Http\Controllers\AdminController@sualoaidv');
        Route::delete('/xoaloaidv', 'App\Http\Controllers\AdminController@xoaloaidv');

        Route::get('/chidoan', 'App\Http\Controllers\AdminController@chidoan');
        Route::post('/themcd', 'App\Http\Controllers\AdminController@themcd');
        Route::post('/suacd', 'App\Http\Controllers\AdminController@suacd');
        Route::delete('/xoacd', 'App\Http\Controllers\AdminController@xoacd');

        Route::get('/dotdg', 'App\Http\Controllers\AdminController@dotdg');
        Route::post('/themdot', 'App\Http\Controllers\AdminController@themdot');
        Route::post('/suadot', 'App\Http\Controllers\AdminController@suadot');
        Route::delete('/xoadot', 'App\Http\Controllers\AdminController@xoadot');

        Route::get('/doanvien', 'App\Http\Controllers\AdminController@doanvien');
        Route::post('/themdv', 'App\Http\Controllers\AdminController@themdv');
        Route::post('/suadv', 'App\Http\Controllers\AdminController@suadv');
        Route::delete('/xoadv', 'App\Http\Controllers\AdminController@xoadv');

        Route::get('/taikhoan', 'App\Http\Controllers\AdminController@taikhoan');
        Route::post('/resetpass', 'App\Http\Controllers\AdminController@resetpass');
        Route::post('/doitt/{username}', 'App\Http\Controllers\AdminController@doitt');

        Route::get('/hoatdong', 'App\Http\Controllers\AdminController@hoatdong');
        Route::post('/themhoatdong', 'App\Http\Controllers\AdminController@themhoatdong');
        Route::post('/suahoatdong', 'App\Http\Controllers\AdminController@suahoatdong');
        Route::delete('/xoahoatdong', 'App\Http\Controllers\AdminController@xoahoatdong');

        Route::get('/thamgia', 'App\Http\Controllers\AdminController@thamgia');
        Route::post('/themdvtg', 'App\Http\Controllers\AdminController@themdvtg');
        Route::delete('/xoadvtg', 'App\Http\Controllers\AdminController@xoadvtg');

        Route::get('/danhgiacd', 'App\Http\Controllers\AdminController@danhgiacd');
        Route::post('/themdgcd', 'App\Http\Controllers\AdminController@themdgcd');
        Route::post('/suadgcd', 'App\Http\Controllers\AdminController@suadgcd');
        Route::delete('/xoadgcd', 'App\Http\Controllers\AdminController@xoadgcd');

        Route::get('/danhgiadv', 'App\Http\Controllers\AdminController@danhgiadv');
        Route::post('/themdgdv', 'App\Http\Controllers\AdminController@themdgdv');
        Route::post('/suadgdv', 'App\Http\Controllers\AdminController@suadgdv');
        Route::delete('/xoadgdv', 'App\Http\Controllers\AdminController@xoadgdv');

        Route::get('/tieuchi', 'App\Http\Controllers\AdminController@tieuchi');
        Route::post('/themtc', 'App\Http\Controllers\AdminController@themtc');
        Route::post('/suatc', 'App\Http\Controllers\AdminController@suatc');
        Route::delete('/xoatc', 'App\Http\Controllers\AdminController@xoatc');
    });

    Route::prefix('ktcn')->group(function (){
        Route::get('/', 'App\Http\Controllers\DoanvienController@trangchu');
        Route::get('/ttcanhan', 'App\Http\Controllers\DoanvienController@ttcanhan');
        Route::post('/suatt', 'App\Http\Controllers\DoanvienController@suatt');
        Route::post('/doimk', 'App\Http\Controllers\DoanvienController@doimk');

        Route::get('/hoatdong', 'App\Http\Controllers\DoanvienController@hoatdong');
        Route::post('/themhoatdong', 'App\Http\Controllers\DoanvienController@themhoatdong');
        Route::post('/suahoatdong', 'App\Http\Controllers\DoanvienController@suahoatdong');
        Route::delete('/xoahoatdong', 'App\Http\Controllers\DoanvienController@xoahoatdong');

        Route::get('/thamgia', 'App\Http\Controllers\DoanvienController@thamgia');
        Route::post('/themdvtg', 'App\Http\Controllers\DoanvienController@themdvtg');
        Route::delete('/xoadvtg', 'App\Http\Controllers\DoanvienController@xoadvtg');

        Route::get('/chidoan', 'App\Http\Controllers\DoanvienController@chidoan');
        Route::post('/themcd', 'App\Http\Controllers\DoanvienController@themcd');
        Route::post('/suacd', 'App\Http\Controllers\DoanvienController@suacd');
        Route::delete('/xoacd', 'App\Http\Controllers\DoanvienController@xoacd');

        Route::get('/dvchidoan', 'App\Http\Controllers\DoanvienController@dvchidoan');

        Route::get('/doanvien', 'App\Http\Controllers\DoanvienController@doanvien');
        Route::post('/themdv', 'App\Http\Controllers\DoanvienController@themdv');
        Route::post('/suadv', 'App\Http\Controllers\DoanvienController@suadv');
        Route::delete('/xoadv', 'App\Http\Controllers\DoansvienController@xoadv');

        Route::get('/dotdg', 'App\Http\Controllers\DoanvienController@dotdg');
        Route::post('/themdot', 'App\Http\Controllers\DoanvienController@themdot');
        Route::post('/suadot', 'App\Http\Controllers\DoanvienController@suadot');
        Route::delete('/xoadot', 'App\Http\Controllers\DoanvienController@xoadot');

        Route::get('/bieumau', 'App\Http\Controllers\DoanvienController@bieumau');
        Route::post('/thembm', 'App\Http\Controllers\DoanvienController@thembm');
        Route::post('/suabm', 'App\Http\Controllers\DoanvienController@suabm');
        Route::delete('/xoabm', 'App\Http\Controllers\DoanvienController@xoabm');

        Route::get('/tieuchi', 'App\Http\Controllers\DoanvienController@tieuchi');
        Route::post('/themtc', 'App\Http\Controllers\DoanvienController@themtc');
        Route::post('/suatc', 'App\Http\Controllers\DoanvienController@suatc');
        Route::delete('/xoatc', 'App\Http\Controllers\DoanvienController@xoatc');

        Route::get('/dvdanhgia', 'App\Http\Controllers\DoanvienController@dvdanhgia');
        Route::post('/tcdat', 'App\Http\Controllers\DoanvienController@tcdat');

        Route::get('/danhgiadv', 'App\Http\Controllers\DoanvienController@danhgiadv');
        Route::get('/dgcanhan', 'App\Http\Controllers\DoanvienController@dgcanhan');
        Route::post('/bchdanhgia', 'App\Http\Controllers\DoanvienController@bchdanhgia');

        Route::get('/ketquadv', 'App\Http\Controllers\DoanvienController@ketquadv');
        Route::get('/ketquacd', 'App\Http\Controllers\DoanvienController@ketquacd');

        Route::get('/cddanhgia', 'App\Http\Controllers\DoanvienController@cddanhgia');
        Route::post('/cddg', 'App\Http\Controllers\DoanvienController@cddg');
        Route::get('/danhgiacd', 'App\Http\Controllers\DoanvienController@danhgiacd');
        Route::get('/dgchidoan', 'App\Http\Controllers\DoanvienController@dgchidoan');

        Route::get('/xuatdv', 'App\Http\Controllers\ImExController@xuatdv');
        Route::post('/nhapdv', 'App\Http\Controllers\ImExController@nhapdv');
    });
});
