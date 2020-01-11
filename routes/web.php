<?php

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



Route::get('/','Auth\LoginController@showLoginForm');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('employee','EmployeeController@index')->name('employee.index');
Route::any('employee/create','EmployeeController@create')->name('employee.create');
Route::get('employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
Route::get('employee/delete/{id}','EmployeeController@delete')->name('employee.delete');

Route::get('supplier','SupplierController@index')->name('supplier.index');
Route::any('supplier/create','SupplierController@create')->name('supplier.create');

Route::get('customer','CustomerController@index')->name('customer.index');
Route::any('customer/create','CustomerController@create')->name('customer.create');

//
Route::group(['prefix'=>'salary','as'=>'salary.'],function (){
    Route::any('add/advanced/','SalaryController@addAdvanced')->name('advanced.add');
    Route::get('all/advanced/','SalaryController@allAdvancedSalary')->name('advanced.all');
    Route::get('pay','SalaryController@paySalary')->name('pay');
});

Route::group(['prefix'=>'category','as'=>'category.'],function (){
    Route::get('list','CategoryController@index')->name('index');
    Route::any('create','CategoryController@create')->name('create');
    Route::get('edit/{id}','CategoryController@edit')->name('edit');
    Route::get('active/{id}','CategoryController@active')->name('active');
    Route::get('inactive/{id}','CategoryController@inactive')->name('inactive');
    Route::get('delete/{id}','CategoryController@delete')->name('delete');


});


