<?php
namespace app\controller;

use app\BaseController;
use think\facade\Config;
use think\facade\Env;

class Index extends BaseController
{
    public function index()
    {
        return 'Index.php';
    }

    public function hello($name = 'ThinkPHP6')
    {
        return 'hello,' . $name;
    }
    public function config()
    {
        // return Env::get(name:'database.hostname');
        return Config::get('database.hostname');
        echo "777";
    }
}
