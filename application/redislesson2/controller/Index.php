<?php
namespace app\redislesson2\controller;
use think\Cache as Ca;
use think\Request;//调用该类去引用变量
use think\Db;//查询构造器-基于PDO实现
use think\Controller;//模板赋值
class Index extends Controller
{
    public function index()
    {
    	$list1 = db('admin')->find(1);
    	$list2 = Db::table('think_admin')->find(2);
//  	db('auth_group')->delete(input('id'));
    	$list3 = Db::table('think_admin')->find(3);
		$bool1 = Ca::store('redis')->set("user_base:1", $list1,3600);
		$bool2 = Ca::store('redis')->set("user_base:2", $list1,3600);
		$bool3 = Ca::store('redis')->set("user_base:3", $list1,3600);
		dump($bool1,$bool2,$bool3);
    }
    
    public function getHas(){
    	$list1 = Ca::store('redis')->get("user_base:1");
    	$list2 = Ca::store('redis')->get("user_base:2");
    	$list3 = Ca::store('redis')->get("user_base:3");
//		$bool3 = Ca::store('redis')->set("test", "test",10);
//  	$list3 = Ca::store('redis')->get("test");
//  	dump($list3);
//  	dump($list1,$list2,$list3);
    }
}
