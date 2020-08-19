<?php
namespace app\model;
use think\Model;
use think\model\concern\SoftDelete;

class User extends Model{
    // 指定一下 模型对应的表
    // protected $name="user";
     
    // 在模型定义中，可以设置其它的数据表；
    // protected $table = 'tp_one';
    //设置主键
    // protected $pk = 'uid';

    // 初始化
    // protected static function init(){
        //第一次执行的执行
        // echo '初始化';
    // }
   //修改器
//    public function getStatusAttr($value,$data)        
//    {  
    //    dump($data);
    //    $statusList = ['-1'=>'A','0'=>'B','1'=>'C','2'=>'D'];
    //   echo $statusList[$value];
//    }
    
     //模型范围查询

    //  public function scopeMale($query)
    //  {
    //      $query->where('gender','男')->field('id,username,gender')->limit(3);
    //  }

     //开启自动写入时间
    //  protected $autoWriteTimestamp = true;
    // 设置只读字段
    // protected $readonly = ['username','email'];

    //设置json字段 
    // protected $json = ['list'];

    //开启软删除
    // use SoftDelete;
    // protected $deleteTime = 'delete_time';

    // protected static function onAfterRead($query)
    // {
    // echo '执行了查询方法';
    // }
    // protected static function onBeforeUpdate($query)
    // {
    // echo '准备修改中...';
    // }
    // protected static function onAfterUpdate($query)
    // {
    // echo '修改完毕...';
    // }

    public function profile()
    {   
        //hasOne 表示一对一关联，参数一表示附表，参数二外键，默认 user_id  查出一条数据
        // return $this->hasOne(Profile::class,'user_id');

        //hasMany 表示一对多关联  查出多条数据
        return $this->hasMany(Profile::class);   
    }
    public function Book()
    {   
        //hasOne 表示一对一关联，参数一表示附表，参数二外键，默认 user_id  查出一条数据
        // return $this->hasOne(Profile::class,'user_id');

        //hasMany 表示一对多关联  查出多条数据
        return $this->hasMany(Book::class);   
    }

    public function roles()
    {
        return $this->belongsToMany(Role::class,Access::class);
    }
}   