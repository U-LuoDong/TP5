<?php
namespace app\index\controller;
use think\Request;//调用该类去引用变量
use think\Db;//查询构造器-基于PDO实现
use think\Controller;//模板赋值
class Index extends Controller
{
    public function index()
    {
    	//赋值给模板变量
    	$name="罗东";
    	$email="222333";
    	$this->assign('name',$name);
    	$this->assign('email',$email);
    	//	或者批量赋值	
//       $this->assign(['name'		=>	'ThinkPHP',	'email'	=>	'thinkphp@qq.com']);
        return	$this->fetch();//不加参数：当前模块/默认视图目录/当前控制器（小写）/当前操作（小写）.html
		//或者这样直接进行传值渲染
//  	return  $this->fetch('index',['name'=>'text','email'=>'email']);
    }
    //验证包含文件的
    public function lista()
    {
    	return	$this->fetch();
    }
}
