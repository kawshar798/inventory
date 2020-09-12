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

Route::group(['middleware' => 'auth'],function (){

    Route::get('employee','EmployeeController@index')->name('employee.index');
    Route::any('employee/create','EmployeeController@create')->name('employee.create');
    Route::get('employee/edit/{id}','EmployeeController@edit')->name('employee.edit');
    Route::get('employee/delete/{id}','EmployeeController@delete')->name('employee.delete');

    Route::get('supplier','SupplierController@index')->name('supplier.index');
    Route::any('supplier/create','SupplierController@create')->name('supplier.create');
    Route::get('edit/{id}','SupplierController@edit')->name('edit');
    Route::post('update/','SupplierController@update')->name('update');
    Route::any('supplier/active/{id}','SupplierController@active')->name('active');
    Route::any('supplier/inactive/{id}','SupplierController@inactive')->name('inactive');
    Route::delete('supplier/delete/{id}','SupplierController@delete')->name('delete');

    Route::get('customer','CustomerController@index')->name('customer.index');
    Route::any('customer/create','CustomerController@create')->name('customer.create');

    Route::group(['prefix'=>'salary','as'=>'salary.'],function (){
        Route::any('add/advanced/','SalaryController@addAdvanced')->name('advanced.add');
        Route::get('all/advanced/','SalaryController@allAdvancedSalary')->name('advanced.all');
        Route::get('pay','SalaryController@paySalary')->name('pay');
    });
    Route::any('add/customer','SalaryController@testAdd');

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

    Route::group(['prefix'=>'coupon','as'=>'coupon.'],function (){
        Route::get('/','CouponController@index')->name('index');
        Route::post('/create','CouponController@create')->name('create');
        Route::get('/delete/{id}','CouponController@delete')->name('delete');
    });
    Route::group(['prefix'=>'product','as'=>'product.'],function (){
        Route::get('list','ProductController@index')->name('index');
        Route::get('create','ProductController@create')->name('create');
        Route::post('store','ProductController@store')->name('store');
        Route::get('edit/{id}','ProductController@edit')->name('edit');
        Route::post('update/','ProductController@update')->name('update');
        Route::any('active/{id}','ProductController@active')->name('active');
        Route::any('inactive/{id}','ProductController@inactive')->name('inactive');
        //for product purchase
        Route::get('get/single/{id}','ProductController@getSingleProduct');
////    Route::get('products','ProductController@getProduct');
//    Route::any('print-barcode','ProductController@printBarcode')->name('print-barcode');
//    Route::post('/barcode/preview','ProductController@printgetBarcode');
    });
    Route::group(['prefix'=>'expense','as'=>'expense.'],function (){
        Route::get('/','ExpenseController@index')->name('index');
        Route::post('store','ExpenseController@store')->name('store');
        Route::get('edit/{id}','ExpenseController@edit')->name('edit');
        Route::post('update/','ExpenseController@update')->name('update');
        Route::get('active/{id}','ExpenseController@active')->name('active');
        Route::get('inactive/{id}','ExpenseController@inactive')->name('inactive');
        Route::delete('delete/{id}','ExpenseController@delete')->name('delete');
        Route::get('/category','ExpenseCategoryController@index')->name('category.index');
        Route::post('/category/store','ExpenseCategoryController@store')->name('create');
        Route::delete('/category/delete/{id}','ExpenseCategoryController@delete')->name('delete');
    });

    Route::group(['prefix'=>'pos','as'=>'pos.'],function (){
        Route::get('/','PosController@createPos')->name('create');
        Route::get('/get/product','PosController@getProduct');
        Route::get('single/product/{id} ','PosController@singleProduct');

    });

    Route::get('subcategory/show/{id}','ProductController@showSubcat');
//get all customer for pos
    Route::get('pos/all/customer','PosController@allCustomerList');
    Route::get('check/coupon-code/{id}','PosController@checkCouponCode');
    Route::group(['prefix'=>'purchase','as'=>'purchase.'],function (){
        Route::get('list','PurchaseController@index')->name('index');
        Route::get('create','PurchaseController@create')->name('create');
        Route::post('store','PurchaseController@store')->name('store');
        Route::get('edit/{id}','PurchaseController@edit')->name('edit');
        Route::get('show/{id}','PurchaseController@show')->name('show');
        Route::post('update/','PurchaseController@update')->name('update');
        Route::any('add/payment/','PurchaseController@addPayment')->name('add.payment');
        Route::get('view/payment/{id}','PurchaseController@viewPayment')->name('view.payment');
        Route::delete('delete/{id}','PurchaseController@delete')->name('delete');
    });

    Route::get('payment/delete/{id}','PaymentController@delete')->name('delete');
    Route::post('sale/store','SaleController@saleStore')->name('sale.store');
    Route::get('sale/invoice','SaleController@saleInvoice')->name('sale.invoice');


    Route::group(['prefix'=>'setting','as'=>'setting.'],function (){
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

});



