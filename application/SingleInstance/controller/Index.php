<?php
namespace app\SingleInstance\controller;
use think\Controller;
use app\SingleInstance\model\Department as De;
class Index extends Controller
{
	/*
	 * 这里将已经实现department和teacher的一对多，teacher和schedule的一对多嵌套连接
	 */
    public function index()
    {
    	$res=De::test("Dp01");
    	echo($res['DepartmentName']);
    	die;
    }
}
