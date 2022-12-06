<?php

use App\Http\Controllers\Backend\AuthorController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;

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

// Route::get('/', function () {
//     return view('welcome');
// });


Route::prefix('admin')->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', [App\Http\Controllers\Localization\LocalizationController::class, 'index'])->name('lang.switch');
Route::middleware('globalSetting')->group(function () {
    Route::namespace('App\Http\Controllers\Backend')->middleware(['auth'])->prefix('admin')->as('backend.')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
        Route::resource('roles', RolesController::class);
        Route::resource('admins', AdminsController::class);
        Route::get('profile', 'AdminsController@show')->name('profile');

        //memberList
        Route::get('memberLists', 'MemberController@index')->name('memberLists.index');
        Route::get('memberLists/create', 'MemberController@create')->name('memberLists.create');
        Route::post('memberLists/store', 'MemberController@store')->name('memberLists.store');
        Route::get('memberLists/edit/{slug}', 'MemberController@edit')->name('memberLists.edit');
        Route::post('memberLists/update/{slug}', 'MemberController@update')->name('memberLists.update');
        Route::get('memberLists/show/{slug}', 'MemberController@show')->name('memberLists.show');
        Route::delete('memberLists/destroy/{slug}', 'MemberController@destroy')->name('memberLists.destroy');
        Route::post('memberLists/mass/destroy', 'MemberController@mass_destroy')->name('memberLists.mass.destroy');
        Route::get('memberLists/approve/{slug}', 'MemberController@approve')->name('memberLists.approve');
        Route::post('memberLists/mass/approve', 'MemberController@mass_approve')->name('memberLists.mass.approve');
        Route::get('memberLists/excel/export', 'MemberController@excelexport')->name('memberLists.excel.excelexport');
        //Category Route
        Route::get('category', 'EventCategoryController@index')->name('category.index');
        Route::get('category/create', 'EventCategoryController@create')->name('category.create');
        Route::post('category/store', 'EventCategoryController@store')->name('category.store');
        Route::get('category/edit/{slug}', 'EventCategoryController@edit')->name('category.edit');
        Route::post('category/update/{slug}', 'EventCategoryController@update')->name('category.update');
        Route::get('category/show/{slug}', 'EventCategoryController@show')->name('category.show');
        Route::delete('category/destroy/{slug}', 'EventCategoryController@destroy')->name('category.destroy');
        Route::post('category/mass/destroy', 'EventCategoryController@mass_destroy')->name('category.mass.destroy');
        Route::get('category/approve/{slug}', 'EventCategoryController@approve')->name('category.approve');
        Route::post('category/mass/approve', 'EventCategoryController@mass_approve')->name('category.mass.approve');
        Route::get('category/excel/export', 'EventCategoryController@excelexport')->name('category.excel.excelexport');

        //excel
        Route::get('category/categorymultilecreate', 'EventCategoryController@multilecreate')->name('category.categorymultilecreate');
        Route::get('category/template', 'EventCategoryController@template')->name('category.template');
        Route::post('category/upload', 'EventCategoryController@importData')->name('category.upload');


        //Books Route
        Route::get('book', 'BooksController@index')->name('book.index');
        Route::get('book/create', 'BooksController@create')->name('book.create');
        Route::post('book/store', 'BooksController@store')->name('book.store');
        Route::get('book/edit/{slug}', 'BooksController@edit')->name('book.edit');
        Route::put('book/update/{slug}', 'BooksController@update')->name('book.update');
        Route::get('book/show/{slug}', 'BooksController@show')->name('book.show');
        Route::delete('book/destroy/{slug}', 'BooksController@destroy')->name('book.destroy');
        Route::post('book/mass/destroy', 'BooksController@mass_destroy')->name('book.mass.destroy');
        Route::get('book/approve/{slug}', 'BooksController@approve')->name('book.approve');
        Route::post('book/mass/approve', 'BooksController@mass_approve')->name('book.mass.approve');
        Route::get('book/excel/export', 'BooksController@excelexport')->name('book.excel.excelexport');

        //for Book excel
        Route::get('book/bookmultilecreate', 'BooksController@multilecreate')->name('book.bookmultilecreate');
        Route::get('book/template', 'BooksController@template')->name('book.template');
        Route::post('book/upload', 'BooksController@importData')->name('book.upload');



        //Author Route
        Route::get('author', 'AuthorController@index')->name('author.index');
        Route::get('author/create', 'AuthorController@create')->name('author.create');
        Route::post('author/store', 'AuthorController@store')->name('author.store');
        Route::get('author/edit/{slug}', 'AuthorController@edit')->name('author.edit');
        Route::put('author/update/{slug}', 'AuthorController@update')->name('author.update');
        Route::get('author/show/{slug}', 'AuthorController@show')->name('author.show');
        Route::delete('author/destroy/{slug}', 'AuthorController@destroy')->name('author.destroy');
        Route::post('author/mass/destroy', 'AuthorController@mass_destroy')->name('author.mass.destroy');
        Route::get('author/approve/{slug}', 'AuthorController@approve')->name('author.approve');
        Route::post('author/mass/approve', 'AuthorController@mass_approve')->name('author.mass.approve');
        Route::get('author/excel/export', 'AuthorController@excelexport')->name('author.excel.excelexport');

        //excel
        Route::get('author/authormultilecreate', 'AuthorController@multilecreate')->name('author.authormultilecreate');
        Route::get('author/template', 'AuthorController@template')->name('author.template');
        Route::post('author/upload', 'AuthorController@importData')->name('author.upload');



        //excel
        Route::get('memberLists/multilecreate', 'MemberController@multilecreate')->name('memberLists.multilecreate');
        Route::get('memberLists/template', 'MemberController@template')->name('memberLists.template');
        Route::post('memberLists/upload', 'MemberController@importData')->name('memberLists.upload');

        //bizcategory
        Route::get('biztype', 'BizTypeController@index')->name('biztype.index');
        Route::get('biztype/create', 'BizTypeController@create')->name('biztype.create');
        Route::post('biztype/store', 'BizTypeController@store')->name('biztype.store');
        Route::get('biztype/edit/{slug}', 'BizTypeController@edit')->name('biztype.edit');
        Route::get('biztype/show/{slug}', 'BizTypeController@show')->name('biztype.show');
        Route::put('biztype/update/{slug}', 'BizTypeController@update')->name('biztype.update');
        Route::delete('biztype/destroy/{slug}', 'BizTypeController@destroy')->name('biztype.destroy');
        Route::post('biztype/mass/destroy', 'BizTypeController@mass_destroy')->name('biztype.mass.destroy');


        //MainBusiness
        Route::get('mainbusiness', 'MainBusinessController@index')->name('mainbusiness.index');
        Route::get('usermainbusiness/{slug}', 'MainBusinessController@mainbusinessById')->name('mainbusiness.mybusiness');
        Route::get('mainbusiness/create/{slug}', 'MainBusinessController@create')->name('mainbusiness.create');
        Route::post('mainbusiness/store', 'MainBusinessController@store')->name('mainbusiness.store');
        Route::get('mainbusiness/edit/{slug}', 'MainBusinessController@edit')->name('mainbusiness.edit');
        Route::get('mainbusiness/show/{slug}', 'MainBusinessController@show')->name('mainbusiness.show');
        Route::put('mainbusiness/update/{slug}', 'MainBusinessController@update')->name('mainbusiness.update');
        Route::delete('mainbusiness/destroy/{slug}', 'MainBusinessController@destroy')->name('mainbusiness.destroy');
        Route::post('mainbusiness/mass/destroy/', 'MainBusinessController@mass_destroy')->name('mainbusiness.mass.destroy');

        //SideBusiness
        Route::get('sidebusiness', 'SideBusinessController@index')->name('sidebusiness.index');
        Route::get('mysidebusiness/{slug}', 'SideBusinessController@mainbusinessById')->name('sidebusiness.mysidebusiness');
        Route::get('sidebusiness/create/{slug}', 'SideBusinessController@create')->name('sidebusiness.create');
        Route::post('sidebusiness/store', 'SideBusinessController@store')->name('sidebusiness.store');
        Route::get('sidebusiness/edit/{slug}', 'SideBusinessController@edit')->name('sidebusiness.edit');
        Route::get('sidebusiness/show/{slug}', 'SideBusinessController@show')->name('sidebusiness.show');
        Route::put('sidebusiness/update/{slug}', 'SideBusinessController@update')->name('sidebusiness.update');
        Route::delete('sidebusiness/destroy/{slug}', 'SideBusinessController@destroy')->name('sidebusiness.destroy');
        Route::post('sidebusiness/mass/destroy/', 'SideBusinessController@mass_destroy')->name('sidebusiness.mass.destroy');


        //global settings
        Route::get('settings', 'SettingController@index')->name('settings.index');
        Route::post('settings/update', 'SettingController@update')->name('settings.update');


        //EventCategory
        Route::resource('eventcategory', EventCategoryController::class);
        Route::post('eventcategory/mass/destroy', 'EventCategoryController@mass_destroy')->name('eventcategory.mass.destroy');



        //Event
        Route::resource('event', EventController::class);
        Route::post('event/mass/destroy', 'EventController@mass_destroy')->name('event.mass.destroy');





        //language switch routes...
        Route::post("changeLanguage", 'DashboardController@changeLanguage')->name('language');
    });


    // Route::middleware(['member'])->group(function () {
    //     Route::get('/', '\App\Http\Controllers\Frontend\MemberDashboardController@index')->name('user');
    //     Route::namespace('App\Http\Controllers\Frontend')->middleware(['member'])->prefix('')->group(function () {
    // });
    // });
    Route::namespace('App\Http\Controllers\Frontend')->prefix('')->group(function () {
        //Route::get('/', 'MemberDashboardController@index')->name('user');
        Route::post('login', 'Auth\MemberAuthController@loginAction')->name('member.login');
        Route::get('/', 'Auth\MemberAuthController@login')->name('member.index');
        Route::get('login', 'Auth\MemberAuthController@login')->name('member.index');
    });


    Route::prefix('user')->as('user.')->namespace('App\Http\Controllers\Frontend')->group(function () {
        Route::get('login', 'Auth\MemberAuthController@login')->name('member.index');
        Route::get('/', 'MemberDashboardController@index')->name('user');
        Route::middleware('member')->group(function () {
            Route::get('/', 'MemberDashboardController@index')->name('user');
            Route::get('login', 'Auth\MemberAuthController@login')->name('member.index');
            Route::get('password/reset', 'Auth\MemberAuthController@passwordReset')->name('password.reset');
        });
    });
});
