<?php
namespace app\controller;

use think\db\Query;
use think\think;
use think\Request;
// use think\facade\Request;
use think\facade\Session;
use think\facade\Cookie;
class Rely{
    protected $request;

    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    public function index() 
        {   
            $data = request()->param('name');
            //第一种
            // return $this->request->param('query');
            //助手函数request()
            // echo request()->param('name');
            // echo request()->url();
            // echo request()->action();
            // . /s(字符串)、/d(整型)、/b(布尔)、/a(数组)、/f(浮点)；
            // input('param.id/d'); //设置强制转换
            // input('?get.id'); //判断 get 下的 id 是否存在
            // input('?post.name'); //判断 post 下的 name 是否存在
            // input('param.name'); //获取 param 下的 name 值

            // return response(request()->param('name'),202);
            // return response(request()->param('name'))->code(202);
            // return json($data,202);

            //重定向
            // return redirect('http://www.baidu.com');


            Session::set('obj.user','Mr.Lee');

            session('user','小明');
            echo session('?user');
            echo session('user');
            echo Session::get('obj.user');

           
            cookie('user', 'Mr.Lee66', 3600); //设置
            echo cookie('user');;
        }
}