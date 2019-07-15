<?php
namespace app\redis\controller;
class Test
{
	public $redis=2;
	public function __construct(){
		$this->redis = 1;
	}
	//实现发布/订阅  pub/sub
	//发布消息
	public function index(){
		echo($this->redis);
	}
}
?>