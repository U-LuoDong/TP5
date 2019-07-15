<?php
namespace app\index\controller;
use think\Controller;
use think\Request;//变量获取
use app\index\model\Score as ScoreModer;//模型类
use app\index\validate\Score as ScoreValidate;//验证器类
class Score extends Controller
{
   public function index()
   {
   	    //首页还未写样式
   	    //通过分页显示数据
	    $data=ScoreModer::paginate(3);
	    $page=$data->render();
	    $this->assign('data',$data);
	    $this->assign('page',$page);
   		return	$this->fetch();
   }
   
   //新增的页面
	public function add()
	{
		return	$this->fetch();//不加参数：当前模块/默认视图目录/当前控制器（小写）/当前操作（小写）.html
	}
   
   //将用户的输入的信息放入到数据库中
   public function add1()
   {
   	$data = Request::instance()->post(); // 获取经过过滤的全部post变量
// 	$data=input('post.');  //助手函数
// 	dump($data);
// 	die;
   	$val=new ScoreValidate();
   	if(!$val->check($data)){
   		$this->error($val->getError());
   		exit;
   	}
   	$score=new ScoreModer();
   	$score->name=input('post.name');
   	$score->math=input('post.math');
   	$score->English=input('post.English');
// 	$score->math=$_POST['math']; //原生的
    if($score->save()){
   		$this->success("新增成功",'index');  //或者写成Score/index
   	}else{
   		$this->error("新增失败");
   	}
  }
	
	//列表页
//	public function lista()
//	{
////		$data=ScoreModer::all();
////		dump($data);
////		die;
////      $this->assign('data',$data);
////		return	$this->fetch();//不加参数：当前模块/默认视图目录/当前控制器（小写）/当前操作（小写）.html
//	    //通过分页显示数据
//	    $data=ScoreModer::paginate(2);
//	    $page=$data->render();
//	    $this->assign('data',$data);
//	    $this->assign('page',$page);
//	    return $this->fetch();
//	}
	public function modify()
	{
		$id=input('get.id');
		$data=ScoreModer::get($id);
		$this->assign('data',$data);
		return $this->fetch();
	}
	public function updata()
	{
		$data=input('post.');
		$id=input('post.id');
		$val=new ScoreValidate();
   	    if(!$val->check($data)){
   		$this->error($val->getError());
   		exit;
   	    }
   	    $score=new ScoreModer();
   	    $ret=$score->allowField(true)->save($_POST,['id' => $id]);
   	    if($ret){
	   		$this->success("修改成功",'Score/index');
	   	}else{
	   		$this->error("修改失败");
	   	}
	}
	//删除用户的方法
	public function delete()
	{
		//实现软删除的方法(在数据库中存在)
		$id=input('get.id');
		$ret=ScoreModer::destroy($id);
		if($ret){
	   		$this->success("删除成功",'Score/index');
	   	}else{
	   		$this->error("删除失败");
	   	}
	   	//真实删除的方法
//	   	$id=input('get.id');
//		$ret=ScoreModer::destory($id,true);
//		if($ret){
//	   		$this->success("删除成功",'Score/index');
//	   	}else{
//	   		$this->error("删除失败");
//	   	}
	}
	
}

?>