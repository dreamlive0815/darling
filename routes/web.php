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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/test', function() {
    $client = new \GuzzleHttp\Client();
    try{
    $response = $client->request('POST', 'http://laravel/index.php', [ 'form_params' => [
        'X-CSRF-TOKEN' => csrf_token(),
        
    ]]);
    print_r( $response );
    }catch(\GuzzleHttp\Exception\RequestException $e) {
        
        if ($e->hasResponse()) {
            print_r( $e->getResponse() );
        }
    }
    
});

Route::group(['prefix' => 'user', 'namespace' => 'User'], function ($router) {
    $router->get('login', 'LoginController@login');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
