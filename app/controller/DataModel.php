<?php
namespace app\controller;
//引用model 设置别名
use app\model\User as UserModel;

use think\facade\Db;

use think\Request;
class DataModel{
    public function index()
    {
      return  UserModel::select();
    }
    //新增数据
    public function insert()
    {
      
      // $user->username = '新增数据';
      // $user->password = '123';
      // $user->gender = '男';
      // $user->email = 'libai@163.com';
      // $user->price = 100;
      // $user->details = '123';
      // $user->uid = 1011;
      // $user->save();
      // $dataList = [
      //   "username" => '李白',
      //   "password" => '123',
      //   "gender" => '男',
      //   "email" => 'libai@163.com',
      //   "price" => 100,
      //   "details" => '123',
      //   "uid" => 1011,
      // ];
      // // allowField()方法，允许要写入的字段，其它字段就无法写入了
      // $user->allowField(['username','password','details'])->save($dataList);
      // echo $user->id;

     
      
      $user = UserModel::create([
        'username' => '李白',
        'password' => '123',
        'gender' => '男',
        'email' => 'libai@163.com',
        'price' => 100,
        'details' => '123',
        'uid' => 1011
        ], ['username', 'password', 'details'], false);
    }

    //删除
    public function dele()
    {
      //删除
      // $user = UserModel::find(320);
      // echo ($user->delete());

      // destory() 批量删除
      // $user = UserModel::destroy(318);
      // $user = UserModel::destroy([315,316,317]);

      //通过条件删除
      // $user = UserModel::where('id','>',300)->delete();

      //通过闭包删除
      $user = UserModel::destroy(function($query){
        $query->where('id','>',70);
      });
      echo ($user);
    }

    // 跟新 修改
    public function update()
    {
      // 1 使用 find()方法获取数据，然后通过 save()方法保存修改，返回布尔值；
      // $user = UserModel::find(29);
      // $user->username = '小明';
      // $user->email = '666';
      // $user->save();

      //2 where find修改
      // $user = UserModel::where('username','李白')->find();
      // $user->username = '李白';
      // $user->email = 'libai@163.com';
      // 但如果你想强制更新数据，即使数据一样，那么可以使用 force()方法
      // $user->force()->save();
      // 使用 allowField()方法，允许要更新的字段，其它字段就无法写入了；
      // $user->allowField(['username','email'])->save(...)
      // $user =new UserModel;
      // 通过 saveAll()方法，可以批量修改数据，返回被修改的数据集合；
      // $list = [
      //   ['id'=>26, 'username'=>'李白', 'email'=>'libai@163.com'],
      //   ['id'=>27, 'username'=>'李白', 'email'=>'libai@163.com'],
      //   ['id'=>28, 'username'=>'李白', 'email'=>'libai@163.com']
      //   ];
      //   // 批量更新 saveAll()只能通过主键 id 进行更新
      //   $user->saveAll($list);

      UserModel::update([
        'id'=>29,
        'username'=>'小红'
      ]);
    }

    //数据 查询
    public function select()
    { 
      // 使用 find()方法，通过主键(id)查询到想要的数据；
      // $user = UserModel::find(29);
      // return json($user);
    
      // 也可以使用 where()方法进行条件筛选查询数据；
      // $user = UserModel::where('username','小红')->find();
      // return json($user);

      // 此时，可以后使用 isEmpty()方法来判断，是否为空模型；
      // $user = UserModel::findOrEmpty(1111);
      //   if ($user->isEmpty()) {
      //   echo '空模型，无数据！';
      //  }

      // 使用 select([])方式，查询多条指定 id 的字段，不指定就是所有字段；
      // $user = UserModel::select([19,20,21]);
      //   foreach ($user as $key=>$obj) {
      //   echo $obj->username;
      //   echo '<br />';
      // }
      // echo  UserModel::where('id', 79)->value('username');
      // echo UserModel::whereIn('id',[26,27,28])->column('username','id');


      // 模型支持聚合查询：max、min、sum、count、avg 等；
      // echo UserModel::count('price');

      // 使用 chunk()方法可以分批处理数据，数据库查询时讲过，防止一次性开销过大；
      // UserModel::chunk(5, function ($users) {
      //   foreach($users as $user) {
      //   echo $user->username;
      //   }
      //   echo '<br>------<br>';
      //   });
      // 可以利用游标查询功能，可以大幅度减少海量数据的内存开销，它利用了 PHP 生
      // 成器特性。每次查询只读一行，然后再读取时，自动定位到下一行继续读取；
      // foreach (UserModel::where('status', 1)->cursor() as $user) {
      //   echo $user->username;
      //   echo '<br>------<br>';
      //   }
      UserModel::where('username','小红')->find();
    }
    //获取器
    public function getAttr()
    {
      $user = UserModel::withAttr('status',function($value){
        return $value*10;
      })->find(19);
      return $user;
    }

    public function scope()
    {
      //调用模型范围查询
      // $result = UserModel::scope('male')->select();
      $result = UserModel::male()->select();
      return json($result);
    }
    
    // 类型转换
    public function typec()
    {
      $user = UserModel::find(20);
      var_dump((boolean)$user->status);
      var_dump((int)$user->price);
    }
    public function request(Request $request)
    {
      echo '请求参数：';
      // return json($request->param('name'));
      Db::name('user')->insert(['username'=>$request->param('name'),"password"=>'123456','details'=>'789']);
    }
    //json 
    public function json()
    {
         $data = [
        'username' => '辉夜',
        'password' => '123',
        'gender' => '女',
        'email' => 'huiye@163.com',
        'price' => 90,
        'details' => '123',
        'uid' => 1011,
        'status' => 1,
        'list' => ['username'=>'辉夜', 'gender'=>'女',
        'email'=>'huiye@163.com'],
      ];
      // 插入json类型字段
      // Db::name('user')->json(['list'])->insert($data);
      //查找
      // $res = Db::name('user')->json(['list'])->where('id','31')->select();
      //修改json类型
      // $datas['list'] = ['username'=>'辉夜1', 'gender'=>'女1',
      // 'email'=>'huiye@163.com'];
      // $res = Db::name('user')->json(['list'])->where('id','31')->update($datas);

      //修改json其中一个属性
      // $datas['list->username'] ='辉夜2';
      // $res = Db::name('user')->json(['list'])->where('id','31')->update($datas);
      // return json($res);
      // UserModel::create($data);
      // $user = UserModel::find(32);
      // $user->list->username = '辉夜44';
      // $user->save();
      // return json(UserModel::where('list->username','辉夜')->select());

      // $res = UserModel::destroy(19);
      UserModel::find()->destroy(19);
      // return json($res);
    }
   
}