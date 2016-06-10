<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::group(['middleware' => ['web']], function () {
    Route::get('/', 'AngularController@serveApp');

    Route::get('/unsupported-browser', 'AngularController@unsupported');
});

//public API routes
$api->group(['middleware' => ['api']], function ($api) {

    // Authentication Routes...
    $api->post('auth/login', 'Auth\AuthController@login');
    $api->post('auth/register', 'Auth\AuthController@register');

    // Password Reset Routes...
    $api->post('auth/password/email', 'Auth\PasswordResetController@sendResetLinkEmail');
    $api->get('auth/password/verify', 'Auth\PasswordResetController@verify');
    $api->post('auth/password/reset', 'Auth\PasswordResetController@reset');
});

//protected API routes with JWT (must be logged in)
$api->group(['middleware' => ['api', 'api.auth']], function ($api) {
    $api->get('user/single/{u_id}', 'UserController@getSingle')
        ->where('u_id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
    $api->get('user/list', 'UserController@getList');
    $api->post('user/new', 'Auth\AuthController@register');
    $api->post('user/edit/{u_id}', 'UserController@update');
    $api->post('user/delete/{u_id}', 'UserController@delete');

    $api->get('project/single/{p_id}', 'ProjectController@getSingle')
        ->where('p_id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
    $api->get('project/list', 'ProjectController@getList');
    $api->post('project/new', 'ProjectController@create');
    $api->post('project/edit/{p_id}', 'ProjectController@update');
    $api->post('project/delete/{p_id}', 'ProjectController@delete');

    $api->get('image/single/{i_id}', 'ImageController@getSingle')
        ->where('i_id', '[0-9a-f]{8}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{4}-[0-9a-f]{12}');
    $api->get('image/list', 'ImageController@getList');
    $api->post('image/new', 'ImageController@create');
    $api->post('image/edit/{i_id}', 'ImageController@update');
    $api->post('image/delete/{i_id}', 'ImageController@delete');
});
