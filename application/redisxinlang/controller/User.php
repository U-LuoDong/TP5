<?php
//创建一个和表名一样的控制器
namespace app\index\controller;
use think\Controller;  
use app\index\model\User as UserModer;
class User extends Controller
{
	//新增数据
   public function add()
   {
     //	新增一条数据的方法 save方法新增数据返回的是写入的记录数。
     
//   法1
 	$user=new UserModer();
 	$user->name="石鹏程";
 	$user->email="faf@qq.com";
 	$user->birthday=strtotime('1998-11-21');
 	if($user->save()){
 		return "用户新增成功";
 	}else{
 		return "用户新增失败";
 	}
// 	法2直接静态调用 create 方法创建并写入
//	$user = UserModer::create([
//	'name' => 'thinkphp',
//	'email' => 'thinkphp@qq.com'
//	]);
//	echo $user->name;
//	echo $user->email;
//	echo $user->id; // 获取自增ID


   	//新增多条数据的方法  saveAll 方法新增数据默认会自动识别数据是需要新增还是更新操作，当数据中存在主键的时候会认为是更新操作

// 	$user=new UserModer();
// 	$list	=	[
// 	['name'=>'thinkphp','email'=>'thinkphp@qq.com','birthday'=>strtotime("1998-11-21")],				
// 	['name'=>'onethink','email'=>'onethink@qq.com','birthday'=>strtotime("1998-11-21")] 
// 	            ]; 
//	if($user->saveAll($list)){
// 		return "批量插入成功";
// 	}else{
// 		return "批量插入失败";
// 	}
   }
   //更新数据
   public function update()
   {
   	//1.查找并更新
   	$user=UserModer::get(1); //1为主键Id
   	$user->name	='thinkphp'; 
   	$user->email='thinkphp@qq.com'; 
   	$user->save();
   	//2.直接更新
   	$user	=new UserModer(); //	save方法第二个参数为更新条件
   	$user->save(['name'=>'罗东','email'=>'thinkphp@qq.com' ],['id'=>1]);
   	//3.批量更新数据
   	$user	=	new	UserModer(); 
   	$list=[
   	['id'=>1,	'name'=>'thinkphp',	'email'=>'thinkphp@qq.com'],				
   	['id'=>2,	'name'=>'onethink',	'email'=>'onethink@qq.com'] 
     	]; //和前面批量增加数据相比多了一个id
   	$user->saveAll($list);
   }
   //查询数据
   public function select()
   {
// 	//获取单个数据开始
//		// 法1
// 	$user = UserModer::get(1);
//	echo $user->name;
//		//法2： 使用数组查询
//	$user = UserModer::get(['name' => '罗东']);
//		//法3：在实例化模型后调用查询方法
//	$user = new UserModer();
//	$user->where('name', '罗东')->find();
//	获取单个数据结束

//获取多个数据开始
	// 根据主键获取多个数据
		//法1：静态
	$list = UserModer::all('1,2,3');
	// 或者使用数组
//	$list = UserModer::all([1,2,3]);
	foreach($list as $key=>$value){
	echo $value->name.'<br/>';
	echo $value->email.'<br/>';
	}
//	// 使用数组查询
//	$list = User::all(['status'=>1]);
//	// 使用闭包查询
//	$list = User::all(function($query){
//	$query->where('status', 1)->limit(3)->order('id', 'asc');
//	});
//	foreach($list as $key=>$user){
//	echo $user->name;
//	}
		//法2：实例化
	$user = new UserModer();
	// 查询数据集
	$result = $user->where('name', '罗东')
	->limit(10)
	->order('id', 'desc')
	->select();
	foreach($result as $key=>$value){
	echo $value->name.'<br/>';
	echo $value->email.'<br/>';
//获取多个数据结束
	//聚合函数的调用
	$user = new UserModer;
	$user->count('id');
	$user->where('status','>',0)->count();
	$user->where('status',1)->avg('score');
	$user->max('score');
	}
   }
   public function delete()
   {
   	$user = UserModer::get(1);
	$user->delete();
	//根据主键删除
	UserModer::destroy(1);
		// 删除多个数据开始
	UserModer::destroy('1,2,3');
			// 删除状态为0的数据
	UserModer::destroy(['status' => 0]);
	UserModer::destroy([1,2,3]);
		//使用闭包删除
	UserModer::destroy(function($query){
	$query->where('id','>',10);
	});
		// 删除多个数据结束
   }
//  内置标签  不能用list作为函数名  
   public function lists()  
   {
   	  $list=UserModer::all();//查找出表中的全部数据
   	  $this->assign('list',$list);
   	  return $this->fetch();
   }
}
?>