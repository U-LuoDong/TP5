<?php
namespace app\UtilityItem\controller;
//use think\Controller;//模板赋值extends Controller
class Abnormal
{
	//手动抛出异常
	public function test1(){
		throw new \think\Exception('异常消息', 100006);
		exception('异常消息', 100006);//助手函数
	}
	//抛出 HTTP 异常
	public function test2(){
		throw new \think\exception\HttpException(404, '页面不存在');
		//或者通过助手函数 abort 手动抛出 HTTP 异常，例如：
		//abort(404,'页面不存在');
	}
}

?>