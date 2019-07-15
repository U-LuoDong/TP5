<?php
namespace app\redis\controller;
class Sub
{
//	public $redis;
//	public function __construct(){
//	   //连接本地的 Redis 服务
//	   $redis = new Redis();
//	   $redis->connect('localhost', 6379);
//	   $redis -> flushAll();
//	   $this->$redis = $redis;
//	}
	//实现发布/订阅  pub/sub
	//接受消息
	public function index(){
		//连接本地的 Redis 服务
	    $redis = new \Redis();
	    $redis->connect('localhost', 6379);
	    //接受频道的消息，第一个参数为复数
	    $res = $redis->subscribe(['cctv'],function($redis,$chan,$msg){
	    	dump($redis);
	    	dump($chan);
	    	dump($msg);
	    });
	    dump($res);
	}
}

?>