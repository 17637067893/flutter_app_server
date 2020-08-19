<?php
namespace app\controller;

use app\BaseController;
use think\facade\Db;
use think\facade\Request;
use app\model\User;
class DataBase extends BaseController{
    public function initialize()
    {
      Db::event('before_select',function($query){
        echo '执行before_select';
      });
      Db::event('before_find',function($query){
        echo '执行before_find';
      });
      Db::event('before_insert',function($query){
        echo '执行before_insert';
      });
      Db::event('after_update',function($query){
        echo "执行after_update";
      });
    }
    // 查询数据
    public function index(){   
        
        //    单条数据            数据库           表查询所有所有数据
        // $user= Db::connect('mysql')->table('user')->select();
        //根据id查询数据 find没有数据返回null
        // $user = Db::table('user')->where('age',"30")->find();

        //根据id查询数据findOrFail  没有数据返回空数组抛出异常
        // $user = Db::table('user')->where('age',"50")->findOrFail();

        //根据id查询数据findOrEmpty  没有数据返回空数组
        // $user = Db::table('user')->where('age',"50")->findOrEmpty();
        //返回查询的sql语句 
        // return Db::getLastSql();


        //数据集的查询  返回满足条件的所有数据
        // $user = Db::table('user')->where('age',30)->select();
        // 没有数据返回异常  selectOrFail
        // $user = Db::table('user')->where('age',50)->selectOrFail();
        //  select()->toArray()返回一个数组
        // $user = Db::table('user')->where('age',30)->select()->toArray();
        //当数据配置表前缀时 name可以忽略前缀
        // $user = Db::name('user')->where('age',30)->->toArray();

        //插叙字段的值
        // $user = Db::table('user')->where('id',2)->value('age');     30

        // 通过column()查询指定列的值,没有返回空
        // $res = Db::name('user')->column('age','id');

        //如果插叙数据过多 使用chunk()可以分批查询
        // Db::name('user')->chunk(3,function($user){
        //     foreach($user as $us){
        //         dump($us);
        //     }
        //     echo '分段';
        // });

        // 也可以使用游标查询 调用cursor()  然后foreach()便利结果
        //    $cursor = Db::table('user')->cursor();
        //    foreach($cursor as $user){
        //        dump($user);
        //    }

         $selectUser = Db::name('user');
        //  $res = $selectUser->where('age',30)->order('id','desc')->select();

        // return json($res);

        //多次调用同一个实例查询对象保留以前的结果 每次使用前要先removeOption()清理内容
        $data1 = $selectUser->order('id','desc')->select();
        $data2 = $selectUser->removeOption()->select();
        // return  json($data1);
        return json($data2);
        // return Db::getLastSql();
    }

     //数据新增
    public function insert(){
       $data=[
           'name'=>'乐乐',
           'age'=>30,
           'ad'=>666
       ];
        // strict(false) 抛弃不存在的字段继续新增s
        //    Db::name('user')->strict(false)->insert($data);
        //    $list = Db::name('user')->order('id','desc')->select();

        //inserGetId()返回新增数据的id
        //    $insertGetId= Db::name('user')->strict(false)->insertGetId($data);
        //    return json($insertGetId);

        //新增多条数据
        $dataList=[
            [
                'name'=>'豆豆',
                'age'=>45,
                'ad'=>666
            ],
            [
                'name'=>'程程',
                'age'=>66,
                'ad'=>666
            ]
        ];
        return Db::name('user')->strict(false)->insertAll($dataList);

        //save()存在主键新增数据不存在修改数据
    }   

    //数据的修改删除
    public function update()
     {   
        // 可以通过where('id','3')修改指定数据
        //Db::name('user')->where('id','3')->update(['name'=>'修改名字']);

         //如果update数据中还有主键Id可以省略where()条件
        // return Db::name('user')->update(['id'=>'12','name'=>'盖盖']);

        //修改字段时执行SQL函数操作，可以使用exp()方法实现;
        // function add($param){
        //     return $param;
        // };
        // return Db::name('user')->where('id','2')->exp('name','UPPER(name)')->update();

        //控制字段的增减  inc/dec
    //    return Db::name('user')->where('id','5')->inc('age')->update();
    //    return Db::name('user')->where('id','5')->dec('age',2)->update();

    //raw 控制多个字段的曾减

    // return Db::name('user')->where('id','3')->update([
    //     'age'=>Db::raw('age+10'),
    //     'number'=>Db::raw('number-2')
    // ]);

    //save()修改数据必须指定主键
    Db::name('user')->where('id',2)->save(['name'=>'不是乐乐']);
    }

    //数据的删除
    public function dele()
    {    
        //根据主键删除
        // return Db::name('user')->delete(38);
        //删除多条记录 
        // return Db::name('user')->delete([35,36,37]);

        //通过条件删除
        return Db::name('user')->where('name','uu')->delete();
    }

    //查询表达式
    public function selectExpress()
    {   
        //where('id','>','5')  可以 < ,  = , > ,>= , <=;
        // return Db::name('user')->where('id','>','5')->select();

        //in 查询
        // return Db::name('user')->where('id','in','10,20')->select();
        // return Db::name('user')->where('id','in',[10,15])->select();
        // return Db::name('user')->whereNotIn('id',[10,15])->select();

        //null 条件为null的
        // return Db::name('user')->where('number','null')->select();

        //between 
        // return Db::name('user')->where('id','between','10,25')->select();
        // return Db::name('user')->where('id','between',[10,20])->select();
        // return Db::name('user')->whereBetween('id',[10,20])->select();
        // return Db::name('user')->whereNotBetween('id',[10,20])->select();

        //区间查询
        // return Db::name('user')->where('name','like','贝%')->select();
       // return Db::name('user')->whereLike('name','贝%')->select();

        //数组模糊查询  多条件模糊
        // return Db::name('user')->where('name','like',['盖%','o%'],'or')->select();
        // return Db::name('user')->whereLike('name',['盖%','o%'],'or')->select();

        //反向查询 排除满足条件的
        // return Db::name('user')->whereNotLike('name',['盖%','o%'],'or')->select();

        //exp查询 如果所有插叙没有满足需要可以自己拼装
        return Db::name('user')->where('id','exp','In (10,11,12)')->select();
    }

    // 时间查询
    public function selectTime(){   // 可以 < , >, =, >= , <= 筛选时间
        // return Db::name("user")->where('create_time','=','2018-1-1')->select();

        // between 查询时间
        //  $res = Db::name('user')->where('create_time','between',['2018-1-1','2019-12-31'])->select();
        // return json($res);

        //   $res = Db::name('user')->whereBetween('create_time',['2018-1-1','2019-12-31'])->select();
        //   return json($res);

        //固定查询 年的时间
        //   $res = Db::name('user')->whereYear('create_time')->select();
        //   $res = Db::name('user')->whereYear('create_time','last year')->select();
        //   $res = Db::name('user')->whereYear('create_time','2016')->select();
        //   return json($res);

        //查询月份数据
        // $res = Db::name('user')->whereMonth('create_time')->select();

         //查询上月月份数据
        // $res = Db::name('user')->whereMonth('create_time','last month')->select();

         //查询上月月份数据
        // $res = Db::name('user')->whereMonth('create_time','2016-6')->select();
        // return json($res);


          //查询上某月数据             
        // $res = Db::name('user')->whereDay('create_time')->select();


        // $res = Db::name('user')->whereDay('create_time','2016-6-27')->select();
        // return json($res);

        //查询固定时间的 2 小时内
        // $res = Db::name('user')->whereTime('create_time','-2 hours')->select();
        // return json($res);

         //查询两个时间段有效期的数据，比如会员开始到结束的期间
        $res = Db::name('user')->whereBetweenTimeField('create_time','update_time')->select();
        return json($res);
    }

    // 聚合查询
    public function juhe()
    {  //获取数量
        // return Db::name('user')->count('id');
        //获取最大值的数据
        // $maxId =Db::name('user')->max('id');
        // max最大值  min最小值
        // return Db::name('user')->max('id',false);

        //求出字段的平均值
        // return Db::name('user')->avg('price');
        //求出字段的综合
        // return Db::name('user')->sum('id');
    }

    //子查询
    public function ziSelect()
    {   
        //  return Db::name('user')->fetchSql(false)->select();    返回查询结果

        //  return Db::name('user')->fetchSql(true)->select();     SELECT * FROM `tp_user`

        //  return Db::name('user')->buildSql(true);   ( SELECT * FROM `tp_user` )

        //子查询
        // $subQuery = Db::name('two')->field('uid')->where('gender',
        // '男')->buildSql(true);

        // $result = Db::name('one')->where('id','exp','IN'. $subQuery)->select();



        // $results = Db::name('one')->where('id', 'in', function ($query) {
        //     $query->name('two')->where('gender', '男')->field('uid');
        //     })->select();
        // return $results;

        //原生查询
        // $res = Db::query('select * from tp_user');
        // return json($res);
        // return Db::execute('update tp_user set username="孙悟空666" where id=29');

       // 链式查询
        //    $res = Db::name('book')->where('id','>','5')->select();
        //    return json($res);

        //关联数据组，通过键值对匹配查询
        //    $res = Db::name('user')->where([
        //        'gender'=>'男',
        //        'price'=> 100
        //    ])->select();
        //    return json($res);

        //关联数据组，通过键值对匹配查询多条件限制
        //    $res = Db::name('user')->where([
        //        ['gender','=','男'],
        //        ['price','=','100']
        //    ])->select();
        //    return json($res);
        
        //关联数据组，通过键值对匹配查询多条件限制
        // $map[] = ['gender','=','男'];
        // $map[] = ['price','in',[60,70,80]];
        // $map[] = ['password','=','123'];
        // $map[] = ['id','=','20'];
        // $res = Db::name('user')->where($map)->select();
        // return json($res);
        
        // $res = Db::name('user')->whereRaw('gender="男" and price in(60,70,80)')->select();
        // $res = Db::name('user')->whereRaw('id=:id',['id'=>19])->select();
        // return json($res);
        // field();
        //field指定要查询的字段
        // $res = Db::name('user')->field('id,username,email,price')->select();
        // 使用field()给指定字段设置别名
        // $res = Db::name('user')->field('id,username as name,email,price')->select();
        // $res = Db::name('user')->field(['id', 'username'=>'name'])->select();
        // $res = Db::name('user')->field(true)->select();


        // withoutField()方法排除
        // $res = Db::name('user')->withoutField('price')->select();


        //alias()给数据库起别名
        // $res = Db::name('user')->alias('ssss')->select();
        
        //limit()方法
        //limit限制数据个数
        // $res = Db::name('user')->limit(3)->select();
        // return json($res);

        //limit限制数据个数第2条开始 的第5条
        // $res = Db::name('user')->limit(2,5)->select();
        // return json($res);

        
        // order() 查看排序方式 desc倒序  asc正序
        // $res = Db::name('user')->order('id','asc')->limit(3,5)->select();
        //支持多个字段的排序
        // $res = Db::name('user')->order(['create_time'=>'desc','price'=>'asc'])->limit(3,5)->select();
        // return json($res);


        //group()  
        // $res= Db::name('user')->fieldRaw('gender, SUM(price)')
        // ->group('gender')->select();
        //多条件分组
        // $res = Db::name('user')->fieldRaw('gender, SUM(price)')
        //             ->group('gender,password')->select();
        // return json($res);


        //having分组之后再having()筛选
        // $res = Db::name('user')->fieldRaw('gender, SUM(price)')
        //             ->group('gender')->having('sum(price)>600')->select();
        // return json($res);
    }
    

    //高级查询
    public function highGrade()
    {  
        //多条件 模糊查询
    //    $user = Db::name('user')->where('username|email', 'like', '%xiao%')->where('price&uid','>',0)->select();
    // $user = Db::name('user')->where([['id','>',0],
    // ['status','=','1'],
    // ['price','>=',80],
    // ['email','like','%163%']
    // ])->select();
    // $user = Db::name('user')->where([
    //     ['status', '=', 1],
    //     ['price', 'exp', Db::raw('<80')]
    //     ])->select();
    // return json($user);

        $map = [
            ['status', '=', 1],
            ['price', 'exp', Db::raw('>80')]
        ];
        //改变查询的优先级
        // $user = Db::name('user')->where($map)->where('status', '=', '%163.com%')->select();
        // SELECT * FROM `tp_user` WHERE `status` = 1 AND ( `price` >80 ) AND `status` = %163.com%
        // $user = Db::name('user')->where([$map])->where('status', '=', '%163.com%')->select();
        // SELECT * FROM `tp_user` WHERE ( `status` = 1 AND ( `price` >80 ) ) AND `status` = %163.com%


        //多个字段or查询
        // $map1 = [
        //     ['username', 'like', '%小%'],
        //     ['email', 'like', '%163%']
        //     ];
        //     $map2 = [
        //     ['username', 'like', '%孙%'],
        //     ['email', 'like', '%.com%']
        // ];
        // $res = Db::name('user')->whereOr([$map1,$map2])->select();
        // SELECT * FROM `tp_user` WHERE ( `username` LIKE '%小%' AND `email` LIKE '%163%' ) OR ( `username` LIKE '%孙%' AND `email` LIKE '%.com%' )
        // return Db::getLastSql();

        //闭包查询可以连缀，会自动加上括号，更清晰，如果是 OR，请用 whereOR()；
        // $res = Db::name("user")->where(function($query){
        //     $query->where('id','>',10);
        // })->whereOr(function ($query) {
        //     $query->where('username', 'like', '%小%');
        //     })->select();
        // $map = [
        //     ['id','>','10']
        // ];
        //     $res = Db::name("user")->where([$map])->where('price','>','10')->select();
        return Db::getLastSql();
    }
     
    //快捷查询
    public function shortcutSelect()
    {   
        //column 比较两个字段查询
        // $user = Db::name('user')->whereColumn('update_time','>=','create_time')->select();
        // $user = Db::name('user')->whereColumn('update_time','create_time')->select();

        // $user = Db::name('user')->whereEmail('xiaoxin@163.com')->find();


        // $user = Db::name('user')->when(false, function ($query) {
        //     $query->where('id', '>', 0);
        //     }, function ($query) {
        //     $query->where('username', 'like', '%小%');
        //     })->select();
        // return json($user);
       
    }
    // 事务处理
    public function work()
    {    
        //事务查询  第一种是自动处理，出错自动回滚；
        // $res = Db::transaction(function(){
        //     Db::name('user')->where('id',19)->save(['price'=>Db::raw('price-3')]);
        //     Db::name('user1')->where('id',20)->save(['price'=>Db::raw('price + 3')]);
        // });

        //手动处理 自行输出错误信息、
        Db::startTrans();
        try{
            Db::name('user')->where('id',19)->save(['price'=>Db::raw('price - 3')]);
            Db::name('user')->where('id',20)->save(['price'=>Db::raw('price + 3')]);
            Db::commit();
        }catch(\Exception $e){
            echo '执行失败';
            Db::rollback();
        }
    }

    // 获取器 将获取的字段进行处理再进行此操作

    public function get()
    {
        $user = Db::name('user')->withAttr('email',function($value,$data){
            return strtoupper($value);
        })->select();
        return json($user);
    }

   
    
    public function selectNew(){
      Db::name('user')->find(20);
    }
}