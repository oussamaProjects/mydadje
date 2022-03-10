<?php

use Illuminate\Support\Facades\Artisan;
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

Route::get('/', 'DashboardController@index');

Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('view:clear');
    return "Cache is cleared";
});

Auth::routes();

// dashboard
Route::get('dashboard', 'DashboardController@index');
Route::get('favorites/document/{id}', 'DashboardController@favoriteDocument');
Route::get('favorites/folder/{id}', 'DashboardController@favoriteFolder');

// users
Route::resource('users', 'UsersController');

// departments
Route::resource('departments', 'DepartmentsController');
Route::post('departments/linkDS', 'DepartmentsController@linkDS')->name('linkDS');
Route::patch('departments/linkDtoS/{id}', 'DepartmentsController@linkDtoS')->name('linkDtoS');
Route::get('departments/getDepartement/subs/{subs}/folder/{folder}', 'DepartmentsController@getDepartement')->name('getDepartement');
Route::resource('subsidiaries', 'SubsidiaryController');

Route::get('getDepartements/{subsidiary}', 'SharedDataController@getDepartements')->name('getSubsidiaryDepartement');

// categories
Route::resource('categories', 'CategoriesController');
Route::delete('categoriesDeleteMulti', 'CategoriesController@deleteMulti');

// folders
Route::resource('folders', 'FolderController');
Route::get('allFolders', 'FolderController@all');
Route::patch('folder/color/{id}', 'FolderController@changeColor');

Route::get('folder/{id}/child', 'FolderController@child');

// documents 
Route::resource('documents', 'DocumentsController');
Route::patch('documents/color/{id}', 'DocumentsController@changeColor');
Route::get('documents/download/{id}', 'DocumentsController@download');
Route::get('documents/open/{id}', 'DocumentsController@open');
Route::get('mydocuments', 'DocumentsController@mydocuments')->name('mydocuments');
Route::get('/trash', 'DocumentsController@trash');
Route::get('documents/restore/{id}', 'DocumentsController@restore');
Route::delete('documentsDeleteMulti', 'DocumentsController@deleteMulti');

Route::get('allDocuments', 'DocumentsController@all');
// search
Route::post('/search', 'DocumentsController@search');
Route::post('/folder-search', 'FolderController@search');

// sort
Route::post('/sort', 'DocumentsController@sort');

// shared
Route::resource('shared', 'ShareController');

// roles and permissions
Route::resource('roles', 'RolesController');

// profile
Route::resource('profile', 'ProfileController');
Route::patch('profile', 'ProfileController@changePassword');

// registration requests
Route::resource('requests', 'RequestsController');

// backup
Route::get('backup', 'BackupController@index');
Route::get('backup/create', 'BackupController@create');
Route::get('backup/download', 'BackupController@download');
Route::get('backup/delete', 'BackupController@delete');

// log
Route::get('logsList', 'LogController@log');
Route::get('logsdel', 'LogController@logdel');
