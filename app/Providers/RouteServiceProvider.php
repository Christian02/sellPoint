<?php

namespace App\Providers;

use Illuminate\Support\Facades\Route;
use Illuminate\Foundation\Support\Providers\RouteServiceProvider as ServiceProvider;

class RouteServiceProvider extends ServiceProvider
{
    /**
     * This namespace is applied to your controller routes.
     *
     * In addition, it is set as the URL generator's root namespace.
     *
     * @var string
     */
    protected $namespace = 'App\Http\Controllers';

    /**
     * Define your route model bindings, pattern filters, etc.
     *
     * @return void
     */
    public function boot()
    {
        //

        parent::boot();
    }

    /**
     * Define the routes for the application.
     *
     * @return void
     */
    public function map()
    {
        $this->mapWebRoutes();

        $this->mapApiRoutes();

        //
    }

    /**
     * Define the "web" routes for the application.
     *
     * These routes all receive session state, CSRF protection, etc.
     *
     * @return void
     */
    protected function mapWebRoutes()
    {
        
        Route::group([
            'middleware' => 'web',
            'namespace' => $this->namespace,
        ], function ($router) {
            require base_path('routes/web.php');

            Route::get('/',['as' => 'login','uses' => 'AuthController@login']);
            Route::post('/home',['as'=>'home', 'uses' =>'AuthController@handleLogin']);
            Route::get('/logout',['as'=>'logout','uses'=>'AuthController@logout']);
            
            Route::get('/home', array( 'as' => 'home', 'uses' => 'AuthController@home' ));
            Route::get('/createUser',['as'=>'createUser','uses'=>'UsersController@create']);
            Route::post('/storeUser',['as'=>'storeUser','uses'=>'UsersController@store']);    
            Route::get('/create',['middleware'=>'auth','as'=>'create','uses'=>'ProductController@create']);
            


            Route::get('/list-sales',$arrayName = array('as' =>'list-sales' ,'uses'=>'SalesController@index' ));
            
            Route::get('/list-products',$arrayName = array('as' =>'list-products' ,'uses'=>'ProductController@index' ));
            /*
            Route::resource('users','UsersController',['only'=>['create','store']]);
            Route::resource('products','ProductController',['only'=>['create','store']]);
            */
            Route::post('/store',['uses'=>'ProductController@store']);
            Route::post('/storeSale',['uses'=>'SalesController@store']);
            Route::post('/fillTable',['uses'=>'SalesController@fillTable']);
            Route::post('/getChange',['uses'=>'SalesController@getChange']);
            Route::post('/editSale',['uses'=>'SalesController@edit']);
            Route::post('/updateSale',['uses'=>'SalesController@update']);
            Route::post('/deleteSale',['uses'=>'SalesController@destroy']);

            Route::post('/editProduct',['uses'=>'ProductController@edit']);
            Route::post('/updateProduct',['uses'=>'ProductController@update']);
            Route::post('/deleteProduct/{id}',['uses'=>'ProductController@destroy']);


            Route::get('/reports',$arrayName = array('as' =>'reports' ,'uses'=>'ReportsController@index' ));
            Route::get('/reports-getSaleTable',$arrayName = array('as' =>'reportsgetSaleTable' ,'uses'=>'ReportsController@listSalesTable' ));
            Route::get('/reportsByMonthChart',array('as'=>'reportsByMonthChart','uses'=>'ReportsController@salesPerMonthChart'));

            
            Route::get('/purchases',array('as'=>'purchases','uses'=>'PurchasesController@index'));
            Route::get('/purchasesGetProducts',array('as'=>'purchasesGetProducts','uses'=>'PurchasesController@getProducts'));
            
            Route::get('/purchasesAdd/{id}',array('as'=>'purchasesAdd','uses'=> 'PurchasesController@loadProduct'));
            Route::get('/purchasesShow/{id}',array('as'=>'purchasesShow','uses'=> 'PurchasesController@show'));
            Route::post('/purchasesStore',array('as'=>'purchasesStore','uses'=>'PurchasesController@store'));
            
            Route::post('/purchasesUpdate/{id}',array('as'=>'purchasesUpdate','uses'=> 'PurchasesController@update'));
            Route::delete('/purchasesDelete/{id}',array('as'=>'purchasesDelete','uses'=> 'PurchasesController@destroy'));
            Route::get('/purchasesApp',function(){
                return view('purchases.list');
            });
            /*
            Route::post('/purchasesStore',array('as'=>'purchasesStore','uses'=>'PurchasesController@store'));
            Route::post('/purchasesUpdate/{id}',array('as'=>'purchasesUpdate','uses'=> 'PurchasesController@update'));
            Route::delete('/purchasesDelete/{id}',array('as'=>'purchasesDelete','uses'=> 'PurchasesController@destroy'));
            */
        });
        


    }

    /**
     * Define the "api" routes for the application.
     *
     * These routes are typically stateless.
     *
     * @return void
     */
    protected function mapApiRoutes()
    {
        Route::group([
            'middleware' => 'api',
            'namespace' => $this->namespace,
            'prefix' => 'api',
        ], function ($router) {
            require base_path('routes/api.php');
        });
    }
}
