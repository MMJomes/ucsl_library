<?php

use App\Http\Controllers\stduent\StdClassController;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;


Route::prefix('admin')->group(function () {
    Auth::routes();
});


Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('lang/{lang}', [App\Http\Controllers\Localization\LocalizationController::class, 'index'])->name('lang.switch');
Route::middleware('globalSetting')->group(function () {
    Route::namespace('App\Http\Controllers\Backend')->middleware(['auth'])->prefix('admin')->as('backend.')->group(function () {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');
        Route::resource('roles', RolesController::class);
        // Route::resource('admins', AdminsController::class);
        Route::get('admin', 'AdminsController@index')->name('admins.index');
        Route::get('admin/create', 'AdminsController@create')->name('admins.create');
        Route::post('admin/store', 'AdminsController@store')->name('admins.store');
        Route::get('admin/show/{slug}', 'AdminsController@show')->name('admins.show');
        Route::get('admin/edit/{slug}', 'AdminsController@edit')->name('admins.edit');
        Route::put('admin/update/{slug}', 'AdminsController@update')->name('admins.update');
        Route::delete('admin/destroy/{slug}', 'AdminsController@destroy')->name('admins.destroy');
        Route::post('admin/mass/destroy', 'AdminsController@mass_destroy')->name('admins.mass.destroy');
        // Route::get('category/edit/{slug}', 'EventCategoryController@edit')->name('category.edit');

        Route::get('profile', 'AdminsController@profile')->name('profile');


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

        //Category excel
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

        //Author excel
        Route::get('author/authormultilecreate', 'AuthorController@multilecreate')->name('author.authormultilecreate');
        Route::get('author/template', 'AuthorController@template')->name('author.template');
        Route::post('author/upload', 'AuthorController@importData')->name('author.upload');


        //global settings
        Route::get('settings', 'SettingController@index')->name('settings.index');
        Route::post('settings/update', 'SettingController@update')->name('settings.update');







        //language switch routes...
        Route::post("changeLanguage", 'DashboardController@changeLanguage')->name('language');
    });

    Route::namespace('App\Http\Controllers\Stduent')->middleware(['auth'])->prefix('admin')->as('stduent.')->group(function () {
        //stdclass
        Route::get('stdclass', 'StdClassController@index')->name('stdclass.index');
        Route::get('stdclass/create', 'StdClassController@create')->name('stdclass.create');
        Route::post('stdclass/store', 'StdClassController@store')->name('stdclass.store');
        Route::get('stdclass/edit/{id}', 'StdClassController@edit')->name('stdclass.edit');
        Route::put('stdclass/update/{id}', 'StdClassController@update')->name('stdclass.update');
        Route::get('stdclass/show/{id}', 'StdClassController@show')->name('stdclass.show');
        Route::delete('stdclass/destroy/{id}', 'StdClassController@destroy')->name('stdclass.destroy');
        Route::post('stdclass/mass/destroy', 'StdClassController@mass_destroy')->name('stdclass.mass.destroy');

        //stduent
        Route::get('stduent', 'StduentController@index')->name('stduents.index');
        Route::get('stduent/create', 'StduentController@create')->name('stduents.create');
        Route::post('stduent/store', 'StduentController@store')->name('stduents.store');
        Route::get('stduent/edit/{id}', 'StduentController@edit')->name('stduents.edit');
        Route::put('stduent/update/{id}', 'StduentController@update')->name('stduents.update');
        Route::get('stduent/show/{id}', 'StduentController@show')->name('stduents.show');
        Route::delete('stduent/destroy/{id}', 'StduentController@destroy')->name('stduents.destroy');
        Route::post('stduent/mass/destroy', 'StduentController@mass_destroy')->name('stduents.mass.destroy');
        Route::get('stduent/approve/{slug}', 'StduentController@approve')->name('stduents.approve');
        Route::post('stduent/mass/approve', 'StduentController@mass_approve')->name('stduents.mass.approve');
        Route::get('stduent/excel/export', 'StduentController@excelexport')->name('stduents.excel.excelexport');

        //Book Rents
        Route::get('bookrent', 'BookRentController@index')->name('bookRent.index');
        Route::get('bookrent/create', 'BookRentController@create')->name('bookRent.create');
        Route::post('bookrent/store', 'BookRentController@store')->name('bookRent.store');
        Route::get('bookrent/edit/{id}', 'BookRentController@edit')->name('bookRent.edit');
        Route::put('bookrent/update/{id}', 'BookRentController@update')->name('bookRent.update');
        Route::get('bookrent/show/{id}', 'BookRentController@show')->name('bookRent.show');
        Route::delete('bookrent/destroy/{id}', 'BookRentController@destroy')->name('bookRent.destroy');
        Route::post('bookrent/mass/destroy', 'BookRentController@mass_destroy')->name('bookRent.mass.destroy');
        Route::get('bookrent/approve/{slug}', 'BookRentController@approve')->name('bookRent.approve');


        //PreBook Request Book
        Route::get('preRequestBook', 'PreRequestController@index')->name('preRequestBooks.index');
        Route::get('preRequestBook/create', 'PreRequestController@create')->name('preRequestBooks.create');
        Route::post('preRequestBookstore', 'PreRequestController@store')->name('preRequestBooks.store');
        Route::get('preRequestBookedit/{id}', 'PreRequestController@edit')->name('preRequestBooks.edit');
        Route::put('preRequestBookupdate/{id}', 'PreRequestController@update')->name('preRequestBooks.update');
        Route::get('preRequestBook/show/{id}', 'PreRequestController@show')->name('preRequestBooks.show');
        Route::delete('preRequestBook/destroy/{id}', 'PreRequestController@destroy')->name('preRequestBooks.destroy');
        Route::post('preRequestBook/mass/destroy', 'PreRequestController@mass_destroy')->name('preRequestBooks.mass.destroy');
        Route::get('preRequestBook/approve/{slug}', 'PreRequestController@approve')->name('preRequestBooks.approve');
        Route::post('preRequestBook/mass/approve', 'PreRequestController@mass_approve')->name('preRequestBooks.mass.approve');
    });

    Route::namespace('App\Http\Controllers\Teacher')->middleware(['auth'])->prefix('admin')->as('staff.')->group(function () {
        //stdclass
        Route::get('stfclass', 'DepartementController@index')->name('stfClass.index');
        Route::get('stfclass/create', 'DepartementController@create')->name('stfClass.create');
        Route::post('stfclass/store', 'DepartementController@store')->name('stfClass.store');
        Route::get('stfclass/edit/{id}', 'DepartementController@edit')->name('stfClass.edit');
        Route::put('stfclass/update/{id}', 'DepartementController@update')->name('stfClass.update');
        Route::get('stfclass/show/{id}', 'DepartementController@show')->name('stfClass.show');
        Route::delete('stfclass/destroy/{id}', 'DepartementController@destroy')->name('stfClass.destroy');
        Route::post('stfclass/mass/destroy', 'DepartementController@mass_destroy')->name('stfClass.mass.destroy');

        //Staff
        Route::get('staff', 'TeacherController@index')->name('staffs.index');
        Route::get('staff/create', 'TeacherController@create')->name('staffs.create');
        Route::post('staff/store', 'TeacherController@store')->name('staffs.store');
        Route::get('staff/edit/{id}', 'TeacherController@edit')->name('staffs.edit');
        Route::put('staff/update/{id}', 'TeacherController@update')->name('staffs.update');
        Route::get('staff/show/{id}', 'TeacherController@show')->name('staffs.show');
        Route::delete('staff/destroy/{id}', 'TeacherController@destroy')->name('staffs.destroy');
        Route::post('staff/mass/destroy', 'TeacherController@mass_destroy')->name('staffs.mass.destroy');
        Route::get('staff/approve/{slug}', 'TeacherController@approve')->name('staffs.approve');
        Route::post('staff/mass/approve', 'TeacherController@mass_approve')->name('staffs.mass.approve');
        Route::get('staff/excel/export', 'TeacherController@excelexport')->name('staffs.excel.excelexport');


        //Book Rents
        Route::get('rentbystaff', 'TeacherrentController@index')->name('rentbyStaff.index');
        Route::get('rentbystaff/create', 'TeacherrentController@create')->name('rentbyStaff.create');
        Route::post('rentbystaff/store', 'TeacherrentController@store')->name('rentbyStaff.store');
        Route::get('rentbystaff/edit/{id}', 'TeacherrentController@edit')->name('rentbyStaff.edit');
        Route::put('rentbystaff/update/{id}', 'TeacherrentController@update')->name('rentbyStaff.update');
        Route::get('rentbystaff/show/{id}', 'TeacherrentController@show')->name('rentbyStaff.show');
        Route::delete('rentbystaff/destroy/{id}', 'TeacherrentController@destroy')->name('rentbyStaff.destroy');
        Route::post('rentbystaff/mass/destroy', 'TeacherrentController@mass_destroy')->name('rentbyStaff.mass.destroy');
        Route::get('rentbystaff/approve/{slug}', 'TeacherrentController@approve')->name('rentbyStaff.approve');

        //PreBook Request By Staff Book
        Route::get('requestbyStaff', 'StaffPreRequestController@index')->name('requestbyStaffs.index');
        Route::get('requestbyStaff/create', 'StaffPreRequestController@create')->name('requestbyStaffs.create');
        Route::post('requestbyStaffstore', 'StaffPreRequestController@store')->name('requestbyStaffs.store');
        Route::get('requestbyStaffedit/{id}', 'StaffPreRequestController@edit')->name('requestbyStaffs.edit');
        Route::put('requestbyStaffupdate/{id}', 'StaffPreRequestController@update')->name('requestbyStaffs.update');
        Route::get('requestbyStaff/show/{id}', 'StaffPreRequestController@show')->name('requestbyStaffs.show');
        Route::delete('requestbyStaff/destroy/{id}', 'StaffPreRequestController@destroy')->name('requestbyStaffs.destroy');
        Route::post('requestbyStaff/mass/destroy', 'StaffPreRequestController@mass_destroy')->name('requestbyStaffs.mass.destroy');
        Route::get('requestbyStaff/approve/{slug}', 'StaffPreRequestController@approve')->name('requestbyStaffs.approve');
        Route::post('requestbyStaff/mass/approve', 'StaffPreRequestController@mass_approve')->name('requestbyStaffs.mass.approve');
    });


    Route::namespace('App\Http\Controllers\Frontend')->prefix('')->group(function () {
        //Route::get('/', 'MemberDashboardController@index')->name('user');
        Route::post('login', 'Auth\MemberAuthController@loginAction')->name('member.login');
        Route::post('reg', 'Auth\MemberAuthController@regAction')->name('member.reg');
        Route::get('/', 'Auth\MemberAuthController@login')->name('member.index');
        Route::get('login', 'Auth\MemberAuthController@login')->name('member.index');
        Route::get('register', 'Auth\MemberAuthController@register')->name('member.register');
    });


    Route::namespace('App\Http\Controllers\stduent')->prefix('')->group(function () {
        // Route::resource('stdclass', StdClassController::class);
        // Route::post('stdclass/mass/destroy', 'StdClassController@mass_destroy')->name('stdclass.mass.destroy');
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
