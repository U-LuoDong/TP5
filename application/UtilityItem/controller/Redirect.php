<?php
namespace app\UtilityItem\controller;
use think\Controller;
class Redirect extends controller
{
	public function index(){
		echo ("这是原页面");
		//1.直接重定向
		//$this->redirect('test', array('status'=>1));
		//或者
		//$this->redirect('test',  ['status'=>1]);

		// 2、重定向到其他模块操作
		//$this->redirect('Fileupload/index');
		
		// 3、重定向到其他分组
		//$this->redirect('StudentInformationManagementSystem-Index/sign');//这个不能实现
		//$this->redirect('/StudentInformationManagementSystem/Index/sign');//这个可以
		
		//4、在重定向的时候通过session闪存数据传值
		$this->redirect('Fileupload/index', ['cate_id' => 2], 302, ['data' => 'hello']);
		
		//5、使用redirect助手函数还可以实现更多的功能，例如可以记住当前的URL后跳转
		//redirect('Fileupload/index')->remember();//没有实现 首先用这个根本不会跳转 加上$this->后在跳转后的页面中也不能正确的返回回来
		echo ("这是原页面");

	}
	public function test(){
		echo ("这是重定向页面");
	}
}
?>