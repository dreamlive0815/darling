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

Route::get('/status', function () {
    return ['_token' => csrf_token()];
});

Route::get('/test', function() {
    $jar = new \GuzzleHttp\Cookie\CookieJar();
    $client = new \GuzzleHttp\Client(['base_uri' => env('APP_URL'), 'cookies' => $jar]);
    try{
        $response = $client->request('GET', '/status');
        $body = $response->getBody();
        $content = $body->getContents();
        $data = json_decode($content, true);
        $response = $client->request('POST', '/user/login', [ 
            'form_params' => array_merge($data, [
               'username' => '995928339@qq.com',
               'password' => 'yu19960815'
            ]),
            'headers' => [
            ],
            'cookies' => $jar,
        ]);
        //return $response->getBody();
    }catch(\GuzzleHttp\Exception\RequestException $e) {
        
        if ($e->hasResponse()) {
            $response = $e->getResponse();
            //return $response->getBody();
        }
    }
    $body = $response->getBody();
    $content = $body->getContents();
    $data = json_decode($content, true);
    print_r( $data ? $data : $content );


    
});

Route::group(['prefix' => 'user', 'namespace' => 'User'], function ($router) {
    $router->post('login', 'LoginController@login');
    $router->post('logout', 'LoginController@logout');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
