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
    Route::get('create','CategoryController@create')->name('create');
    Route::post('store','CategoryController@store')->name('store');
    Route::get('edit/{id}','CategoryController@edit')->name('edit');
    Route::post('update/','CategoryController@update')->name('update');
    Route::get('active/{id}','CategoryController@active')->name('active');
    Route::get('inactive/{id}','CategoryController@inactive')->name('inactive');
    Route::get('delete/{id}','CategoryController@delete')->name('delete');
});

Route::group(['prefix'=>'brand','as'=>'brand.'],function (){
    Route::get('list','BrandController@index')->name('index');
    Route::get('create','BrandController@create')->name('create');
    Route::post('store','BrandController@store')->name('store');
    Route::get('edit/{id}','BrandControllerr@edit')->name('edit');
    Route::post('update/','BrandController@update')->name('update');
    Route::get('active/{id}','BrandController@active')->name('active');
    Route::get('inactive/{id}','BrandController@inactive')->name('inactive');
    Route::delete('delete/{id}','BrandController@delete')->name('delete');
});
Route::group(['prefix'=>'unit','as'=>'unit.'],function (){
    Route::get('list','UnitController@index')->name('index');
    Route::get('create','UnitController@create')->name('create');
    Route::post('store','UnitController@store')->name('store');
    Route::get('edit/{id}','UnitController@edit')->name('edit');
    Route::post('update/','UnitController@update')->name('update');
    Route::get('active/{id}','UnitController@active')->name('active');
    Route::get('inactive/{id}','UnitController@inactive')->name('inactive');
    Route::delete('delete/{id}','UnitController@delete')->name('delete');
});
Route::group(['prefix'=>'product','as'=>'product.'],function (){
    Route::get('list','ProductController@index')->name('index');
    Route::get('create','ProductController@create')->name('create');
    Route::post('store','ProductController@store')->name('store');
    Route::get('edit/{id}','ProductController@edit')->name('edit');
    Route::post('update/','ProductController@update')->name('update');
    Route::get('active/{id}','ProductController@active')->name('active');
    Route::get('inactive/{id}','ProductController@inactive')->name('inactive');
    Route::delete('delete/{id}','ProductController@delete')->name('delete');
});
Route::group(['prefix'=>'expense','as'=>'expense.'],function (){
    Route::get('/','ExpenseController@index')->name('index');
    Route::post('store','ExpenseController@store')->name('store');
    Route::get('edit/{id}','ExpenseController@edit')->name('edit');
    Route::post('update/','ExpenseController@update')->name('update');
    Route::get('active/{id}','ExpenseController@active')->name('active');
    Route::get('inactive/{id}','ExpenseController@inactive')->name('inactive');
    Route::delete('delete/{id}','ExpenseController@delete')->name('delete');

    Route::get('/category','ExpenseCategory@index')->name('index');




});

Route::get('subcategory/show/{id}','ProductController@showSubcat');
//setting

Route::group(['prefix'=>'setting','as'=>'setting.'],function (){
    //Tax Rate
    Route::group(['prefix'=>'tax','as'=>'tax.'],function (){
        Route::get('list','TaxRateController@index')->name('index');
        Route::get('create','TaxRateController@create')->name('create');
        Route::post('store','TaxRateController@store')->name('store');
        Route::get('edit/{id}','TaxRateController@edit')->name('edit');
        Route::post('update/','TaxRateController@update')->name('update');
        Route::get('active/{id}','TaxRateController@active')->name('active');
        Route::get('inactive/{id}','TaxRateController@inactive')->name('inactive');
        Route::delete('delete/{id}','TaxRateController@delete')->name('delete');

    });
});


