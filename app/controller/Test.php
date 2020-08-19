<?php
namespace app\controller;

use app\BaseController;

class Test extends BaseController{
    public function index(){
         //获取方法名
        echo '方法名:' . $this->request->action();
        echo '<br />';
        echo "实际路径" . $this->app->getBasePath();
    }
    public function hello(){
        return 'hello';
    }
}