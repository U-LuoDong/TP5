<?php
namespace app\redisxinlang\controller;
class Pub
{
	public $redis;
	public function __construct(){
	   //连接本地的 Redis 服务
	   $redis = new \Redis();
	   $redis->connect('localhost', 6379);
	   $this->redis = $redis;
	}
	//实现发布/订阅  pub/sub
	//发布消息
	public function sixstar(){
		$msg="新年快乐";
		$ret = $this->redis->publish('sixstar:新年',$msg);
		dump($ret);
	}
	public function swoole(){
		$msg="swoole做一步开发通信";
		$ret = $this->redis->publish('sixstar:swoole',$msg);
		dump($ret);
	}
	public function redis(){
		$msg="redis做分布式存储";
		$ret = $this->redis->publish('sixstar:redis',$msg);
		dump($ret);
	}
}

?>