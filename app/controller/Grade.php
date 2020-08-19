<?php
namespace app\controller;
use app\model\User as UserModel;
use app\model\Profile as ProfileModel;

class Grade{
    public function index()
    {  
        // 正向
    //    $user = UserModel::find(20);
    //    return json($user->profile);

       //反向
    //    $profile = ProfileModel::find(1);
    //    return json($profile->user);

       //关联修改  profile
    //    $user = UserModel::find(19);
    //    $user->profile->save(['hobby'=>'不喜欢吃青椒']);

       // 关联增加数据 profile
    //    $user = UserModel::find(19);
    //    $user->profile()->save(['hobby'=>'增加数据']);

    //hasOne() 也能模拟belongsTo()进行查询
    //   $user = UserModel::hasWhere('profile',['id'=>'2'])->find();
    //   return json($user->profile);
    //    $user = UserModel::where('id',19)->find();
        // 可以进行数据筛选
    //    return json($user->profile->where('id','>',38));
      
       // 使用 has()方法，查询关联附表的主表内容 比如大于等于 2 条的主表记录
    //    return UserModel::has('profile','>=',2)->select();

    //    使用 hasWhere()方法，查询关联附表筛选后记录
    // return  json(UserModel::hasWhere('profile',['status'=>1])->select());
     

    //关联附表增加多条数据
    //  return $user->profile->saveAll([
    //      [],
    //      []
    //  ])


     //关联删除 删除主表数据时，关联的附表数据也被删除
    //  $user = UserModel::with('profile')->find(20);
    //  $user->together(['profile'])->delete();
     

    //关联预载入
    //查询多条记录的关联
        // $list = UserModel::select([19, 24, 21]);

        //预载入方式  如果你有主表关联了多个附表，都想要进行预载入，可以传入多个模型方法即可；
        // $list = UserModel::with(['profile','book'])->select([19, 24, 21]);
        //     foreach ($list as $user) {
        //        return  var_dump($user->profile.$user->book);
        //     }
    
        
        // $user = UserModel::field('id,username')->with(['profile'=>function ($query) {
        //     $query->field('user_id, hobby');
        //     }])->select([19,24,21]);
        //     foreach($user as $list){
        //         dump($list->profile->toArray());
        //     }

        //关联统计与输出  
        // 主表每条数据关联多少附表记录
        // $list = UserModel::withCount(['profile'])->select([19, 24, 21]);
        // foreach($list as $user){
        //     echo $user->profile_count;
        //     echo "<br>";
        // }
       
       //统计 withMax()、withMin()、withSum()、withAvg()等；
        // $list = UserModel::withSum(['profile'],'status')->select([19, 24, 21]);
        // foreach($list as $user){
        //     echo $user->profile_sum;
        //     echo "<br>";
        // }

    }    

    //多对多查询
    public function many()
    {   
        //查询
        //主表数据
        // $user = UserModel::find(19);
        //获取角色
        // $roles = $user->roles;
        //输出角色
        // return json($roles);


        //新增 没有的角色
        $user = UserModel::find(21);
        // $user->roles()->save(['type'=>'测试角色1']);
        // $user->roles()->saveAll([['type'=>'测试角色2'],['type'=>'测试角色3']]);

        //新增已有的角色 中间表 新增
        // $user->roles()->save(4);
        // $user->roles()->saveAll([1,2,3]);

        //删除中间表数据
        $user->roles()->detach([1]);
    }
}