<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Request;

class Flutter extends BaseController{
	
	public function index(){ 
		// echo "flutter";
		 $user = Db::name('flutter_tabs')->select();
		 echo $user;
		 // echo "flutter 项目接口";
	}
}