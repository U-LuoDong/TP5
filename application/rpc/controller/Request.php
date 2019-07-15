<?php
namespace app\rpc\controller;
use Think\Controller;

class Request extends Controller{
	public function index(){
		Vendor('phpRPC.phprpc_client');
		$request = new \PHPRPC_Client("10.118.35.182/tp5/public/rpc/Server");
		$result = $request->test1();
		dump($result);
	}
}

     