<?php

namespace app\controller;

use think\facade\Request;
use think\facade\Filesystem;
use think\facade\Validate as FacadeValidate;

class Upload{
    public function index()
    {  
        $file = Request()->file('image');
        $info = [];
        // $info = Filesystem::disk('public')->putFileAs('topic', $file,'abc.jpg');
        
        // 上传规则
        $validate = FacadeValidate::rule([
            'image' => 'file|fileExt:jpg,png,gif'
        ]);

        //得到上传文件和规则比对
        $result = $validate->check([
            'image' => $file
            ]);


        if ($result) {
            $info = Filesystem::putFile('topic', $file);
            dump($info);
            } else {
            dump($validate->getError());
            }
        // foreach($files as $file){
        //     $info[] = Filesystem::putFile('topic',$file);
        //     dump($info);
        // }
    }
}