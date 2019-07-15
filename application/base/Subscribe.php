<?php
namespace app\base;
use think\console\Command;

class Subscribe extends Command
{
	protected function configure()
	{
		//设置命令选项
		$this->setName('subscribe')->setDescription('接受订阅消息');
	}
	protected function execute($input,$output)
	{
		$redis = new \Redis();
	    $redis->pconnect('localhost', 6379);
	    $result = $redis->psubscribe(['sixstar:*'],function($redis,$pattern,$chan,$msg){
	    		dump($chan);//频道名称
	    		dump($msg);//频道信息
	    });
	}
	
}

?>