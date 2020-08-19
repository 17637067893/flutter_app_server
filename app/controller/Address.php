<?php 
namespace app\controller;

class Address{
    public function index()
    {
        echo 'Address';
    }

    public function details($id = '9999')
    {
        echo 'id' . $id;
    }

    public function manyParam($name = '小明',$age = '60')
    {
        echo '姓名 ' . $name .'<br>'.'年龄 '.$age;
    }
}