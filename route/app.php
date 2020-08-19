<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006~2018 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
use think\facade\Route;

Route::get('think', function () {
    return 'hello,ThinkPHP6!';
});
//控制所有ID为数字
Route::pattern(['id'=>'\d+']);

Route::get('hello/:name', 'index/hello');
//可以忽略ID
Route::rule('det/[:id]','address/details');
//多参数传参
Route::rule('user/[:name]/[:age]','address/manyParam');

//完整行时
Route::rule('user/[:name]/[:age]','app\controller\address/manyParam');

// 路由可以通过::redirect()方法实现重定向跳转，第三参数为状态码；
Route::redirect('redirect', 'http://localhost/', 302);

//多级控制及
// Route::rule('db','group.team/red')->ext('html');
 //ext检测后缀
Route::rule('db','group.team/red')->ext('html|shtml');

//https 方法作用是检测是否为 https 请求，结合 ext 强制 html 如下
Route::rule('db','group.team/red')->ext('html|shtml')->https();

// domain 方法作用是检测当前的域名是否匹配，完整域名和子域名均可；
Route::rule('ds/:id', 'Address/details')->domain('localhost');
Route::rule('ds/:id', 'Address/details')->domain('news.abc.com');

//ajax/pjax/json 方法作用是检测当前的页面是否是以上请求方式；
Route::rule('ds/:id', 'Address/details')->ajax();

// filter 方法作用是对额外参数进行检测，额外参数可表单提交；
Route::rule('details/:id', 'address/details')->filter(['id'=>5, 'type'=>1]);

// . append 方法作用是追加额外参数，这个额外参数并不需要通过 URL 传递；
Route::rule('details/:id', 'address/details')->append(['status'=>1]);

// 如果你想统一配置多个参数，方便管理，可以使用 option 方法数组配置；
Route::rule('ds/:id', 'Address/details')->option([
    'ext' => 'html',
    'https' => true
    ]);