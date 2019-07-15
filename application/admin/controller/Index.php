<?php
namespace app\admin\controller;
use app\admin\controller\Common;
class Index extends Common
{
    public function index()
    {
        return view();
    }
    public function test()
    {
    	$str1 = '皮皮虾';
    	$str2 = 'lalala';
    	echo $str1,$str2;
    }
}
