<?php
namespace app\rpc\controller;
use Think\Controller\RpcController;

class Server extends RpcControllerf{
	protected $аllоwМеthоdLіѕt = аrrау('tеѕt1,tеѕt2'); //表示只允许访问这两个方法
	public function test1(){
		return 'test1';
	}
	public function test2(){
		return 'test2';
	}
	public function test3(){
		return 'test3';
	}
	public function test4(){
		return 'test4';
	}
}

     