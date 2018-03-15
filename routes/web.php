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

Route::get('/my', function () {
    
});

Route::get('/', function () {
    return view('welcome');
});

Route::get('/token', function () {
    return ['_token' => csrf_token()];
});

Route::get('/test', function() {
    $jar = new \GuzzleHttp\Cookie\CookieJar();
    $client = new \GuzzleHttp\Client(['base_uri' => env('APP_URL'), 'cookies' => $jar]);
    try{
        $response = $client->request('GET', '/token');
        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);
        $response = $client->request('POST', '/user/register', [ 
            'form_params' => array_merge($data, [
               'email' => '995928339@163.com',
               'password' => 'yu19960815',
               'password_confirmation' => 'yu19960815',
               'name' => 'DreamLive0815',
            ]),
            'headers' => [
            ],
            'cookies' => $jar,
        ]);
        //$response = $client->request('GET', '/user/profile');
    }catch(\GuzzleHttp\Exception\RequestException $e) {
        
        if ($e->hasResponse()) {
            $response = $e->getResponse();
        }
    }
    $body = $response->getBody();
    $content = $body->getContents();
    $data = json_decode($content, true);
    print_r( $data ? $data : $content );
    if($data)
    {
        $msg = json_decode($data['message'], true);
        print_r($msg);
    }

    
});

Route::group(['prefix' => 'user', 'namespace' => 'User'], function ($router) {
    $router->post('login', 'LoginController@login')->middleware('auth.ajax.redirect');
    $router->post('logout', 'LoginController@logout');
    $router->post('register', 'RegisterController@register');
    $router->get('profile', 'ProfileController@getProfile');
});

Route::group(['prefix' => 'seller', 'namespace' => 'Seller'], function ($router) {
    $router->post('login', 'LoginController@login')->middleware('auth.ajax.redirect:seller');
    $router->post('logout', 'LoginController@logout');
    $router->get('profile', 'ProfileController@getProfile');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
