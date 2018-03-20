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
    $user = \App\User::find(1);
    $orders = $user->sentorders;
    //$order = \App\Model\Order::find(1);
    //$user = $order->sender;
    print_r($user->toArray());
    //print_r($user);
    /*
    $newOrder = new \App\Model\Order([
        'seller_id' => 1,
        'sender_address' => '地点' . mt_rand(0, 100),
        'sender_tel' => '158690' . mt_rand(10000, 99999),
        'receiver_address' => '地点' . mt_rand(0, 100),
        'receiver_tel' => '158690' . mt_rand(10000, 99999),
        'reward_for_carrier' => mt_rand(50, 100),
    ]);
    $user->sentorders()->save($newOrder);
    */
    /*
    $orders = $user->sentorders;
    print_r($orders);
    */
    
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
        $type = 'user';
        $response = $client->request('POST', "/{$type}/login", [ 
            'form_params' => array_merge($data, [
                'username' => 'DreamLive',
                'email' => '1113704512@163.com',
                'password' => 'yu19960815',
                'password_confirmation' => 'yu19960815',
                'name' => 'Stone_Koishi',
            ]),
            'headers' => [
            ],
            'cookies' => $jar,
        ]);
        $response = $client->request('POST', "/{$type}/modifypassword", [ 
            'form_params' => array_merge($data, [
                'username' => 'root',
                'email' => '1113704512@163.com',
                'password' => '19960815',
                'password_confirmation' => '19960815',
                'name' => 'Stone_Koishi',
            ]),
            'headers' => [
            ],
            'cookies' => $jar,
        ]);
        
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
    $router->post('modifypassword', 'ProfileController@modifyPassword');
});

Route::group(['prefix' => 'seller', 'namespace' => 'Seller'], function ($router) {
    $router->post('login', 'LoginController@login')->middleware('auth.ajax.redirect:seller');
    $router->post('logout', 'LoginController@logout');
    $router->post('register', 'RegisterController@register');
    $router->get('profile', 'ProfileController@getProfile');
    $router->post('modifypassword', 'ProfileController@modifyPassword');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function ($router) {
    $router->post('login', 'LoginController@login')->middleware('auth.ajax.redirect:admin');
    $router->post('logout', 'LoginController@logout');
    $router->get('profile', 'ProfileController@getProfile');
    $router->post('modifypassword', 'ProfileController@modifyPassword');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
