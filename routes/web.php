<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
Route::group(['middleware' => 'auth'], function () {
    //super admin
    Route::resource('roles','Backend\RoleController');
    Route::post('/role_permissions','Backend\RoleController@role_permissions');
    Route::resource('permissions','Backend\PermissionController')->except('show');
    Route::resource('admins','Backend\AdminController')->except('show');
    //admin and super admin
    Route::get('/dashboard','Backend\DashboardController@index');
    Route::get('/users','Backend\UserController@index');
    Route::delete('/users/{id}','Backend\UserController@destroy');
    Route::get('/albums','Backend\AlbumController@index');
    Route::delete('/albums/{id}','Backend\AlbumController@destroy');
    Route::get('/setting','Backend\SettingController@index');
    //login user
    Route::resource('album','Frontend\AlbumController')->except('show');
    Route::get('/publicalbum','Frontend\AlbumController@publicalbum');
    Route::get('/privatealbum','Frontend\AlbumController@privatealbum');
    Route::get('/mymorealbum','Frontend\AlbumController@morealbum')->name('myalbum.more');
    Route::get('/publicmorealbum','Frontend\AlbumController@publicmorealbum')->name('publicalbum.more');
    Route::get('/privatemorealbum','Frontend\AlbumController@privatemorealbum')->name('privatealbum.more');
    Route::delete('/image/{id}','Frontend\AlbumController@image')->name('image');
    Route::get('/profile-setting','Frontend\SettingController@setting');
    //public setting
    Route::post('/change-password','Backend\SettingController@post_change_password');
    Route::post('/profile-setting','Backend\SettingController@post_profile_setting');
});
//all public albums
Route::get('/','Frontend\PageController@albums');
Route::get('/morealbum','Frontend\PageController@morealbum')->name('album.more');
Route::get('/getgallery/{id}','Frontend\PageController@getgallery')->name('gallery');
//admin login
Route::get('/admin/login','Auth\LoginController@admin');
Route::post('/admin/login','Auth\LoginController@loginadmin')->name('admin.login');
//user login
Auth::routes();
