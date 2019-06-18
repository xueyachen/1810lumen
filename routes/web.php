<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});
//注册
$router->post('/reg','login\UserController@reg');
//登录
$router->post('/login','login\UserController@login');
//修改密码
$router->post('/updatepwd','login\UserController@updatepwd');
//查询天气
$router->post('/weather','login\UserController@weather');


$router->post('/form1','login\UserController@form_post1');

$router->post('/upload','login\UserController@upload');

$router->post('/encryption','login\UserController@encryption');
//接受对称加密
$router->post('/symm','login\UserController@symm');
//接受非对称加密
$router->post('/asymm','login\UserController@asymm');
//接受非对称加密2
$router->post('/asymm2','login\UserController@asymm2');
////接受客户端发送过来的 数据与签名
$router->post('/task','login\UserController@task');

//支付宝支付手机支付
$router->post('/alipay','login\UserController@alipay');

//注册
$router->post('/regapi','login\LoginController@regapi');
//登录
$router->post('/loginapi','login\LoginController@loginapi');
//首页
$router->get('/indexapi','login\LoginController@indexapi');





