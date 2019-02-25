<?php

use app\Http\Handlers\RouteExceptionHandlers;
use Pecee\SimpleRouter\SimpleRouter as Route;

/**
 * Created by PhpStorm.
 * User: Faks
 * GitHub: https://github.com/Faks
 *
 * @category PHP
 * @package  Custom_OOP_MVC
 * @author   Oskars Germovs <solumdesignum@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT Licence
 * @link     http://pear.php.net/package/PHP_CodeSniffer
 * Date: 2019.02.19.
 * Time: 12:35
 */

//Route::csrfVerifier(new CsrfVerifier());
Route::group(['namespace' => 'App\Http\Controllers', 'exceptionHandler' => RouteExceptionHandlers::class], function () {
    Route::get('/', 'HomeController@index');
    Route::post('/store', 'HomeController@store');
    
    Route::get('/forgot', 'ForgotController@index');
    Route::post('/forgot/store', 'ForgotController@store');
    
    Route::get('/dashboard', 'DashboardController@index');
    
    Route::get('/logout', function () {
        session()->flush();
        return redirect('/');
    });
    
    //Dashboard Listing
    Route::get('/dashboard', 'DashboardController@index');
    
    //User Edit
    Route::get('/dashboard/user/edit/{id}', 'DashboardController@edit');
    Route::post('/dashboard/user/store', 'DashboardController@store');
    Route::get('/dashboard/user/destroy/{id}', 'DashboardController@destroy');
    
    //Attributes Listing
    Route::get('/dashboard/attributes', 'AttributesController@index');
    //Attribute View
    Route::get('/dashboard/attribute/show/{id}', 'AttributesController@show');
    //Attribute Create
    Route::get('/dashboard/attribute/create', 'AttributesController@create');
    Route::post('/dashboard/attribute/store', 'AttributesController@store');
    //Attribute Edit
    Route::get('/dashboard/attribute/edit/{id}', 'AttributesController@show');
    Route::post('/dashboard/attribute/update/{id}', 'AttributesController@update');
    //Attribute Destroy
    Route::get('/dashboard/attribute/destroy/{id}', 'AttributesController@destroy');
    
    //Attributes Assign Listing
    Route::get('/dashboard/attributes/assign', 'AttributesAssignController@index');
    //Attribute Assign View
    Route::get('/dashboard/attribute/assign/show/{id}', 'AttributesAssignController@show');
    //Attribute Assign Create
    Route::get('/dashboard/attribute/assign/create', 'AttributesAssignController@create');
    Route::post('/dashboard/attribute/assign/store', 'AttributesAssignController@store');
    //Attribute Assign Edit
    Route::get('/dashboard/attribute/assign/edit/{id}', 'AttributesAssignController@show');
    Route::post('/dashboard/attribute/assign/update/{id}', 'AttributesAssignController@update');
    //Attribute Assign Destroy
    Route::get('/dashboard/attribute/assign/destroy/{id}', 'AttributesAssignController@destroy');
});