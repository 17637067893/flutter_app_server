<?php
namespace app\controller\flutter;

use app\BaseController;
use think\facade\Db;
use think\facade\Request;

class Flutter extends BaseController{
		public function test(){
			return '测试';
		}
	public function index(){ 
		 $swiper = Db::name('flutter_home')->select();
		 $tabs = Db::name('flutter_tabs')->order('id')->select();
		 $recommendList = Db::name('flutter_goods')->select();
		 $res=array("statusCode"=>200,
		 'swiper'=>$swiper,
		 'tabs'=>$tabs,
		 'recommendList'=>$recommendList
		 );
		 return json($res);
	}
	public function hotGoods(){
		 // $list_rows = request()->param('list_rows');
		$page =  request()->param('page');
		// echo $list_rows;
		// echo $page;
		$hotGoods = Db::name('flutter_goods')->order('id')->paginate([
			'list_rows'=>4,
			'current_page' => $page,
		]);
		$res = [
			'hotGoods'=>$hotGoods
		];
		return json($res);
	}
	public function childTabs(){
		$id=  request()->param('id');
		$res1 = Db::name('flutter_child_tabs')->where('tabs_id',$id)->select();
		$res2 = [
			'child_tab'=>$res1
		];
		return json($res2);
	}
	public function goodsList(){
		$parentId = request()->param('parentId');
		$id =  request()->param('id');
		if($parentId){
			$res1 = Db::name('flutter_goods')->where('tabs_id',$parentId)->order('id')->select();
			return json($res1);
		}else{
			$res1 = Db::name('flutter_goods')->where('child_tabs_id',$id)->order('id')->select();
			return json($res1);
		};
	}
	public function goodsInfo(){
		$id =  request()->param('id');
		$res = Db::name('flutter_goods')->where('id',$id)->find();
		$res2 = [
			'goodsInfo'=>$res
		];
		return json($res2);
	}
}