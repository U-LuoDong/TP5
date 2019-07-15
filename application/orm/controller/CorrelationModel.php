<?php
namespace app\orm\controller;
use think\Controller;
use app\orm\model\Department as ORM;
use app\orm\model\Teacher as ORM1;
class CorrelationModel extends Controller
{
	/*
	 * 这里将已经实现department和teacher的一对多，teacher和schedule的一对多嵌套连接
	 */
    public function index()
    {
    	$ORM=new ORM();
    	$res=$ORM->getBannerByID("Dp01");
//  	dump($res);
		$result1 = $res['items'];
		foreach($result1 as $value){
    		echo $value['TeacherID']."</br>";
    	}
    	$result2 = array();
    	$LastRes = array();//存放最终结果的数组
    	foreach($result1 as $value){
    		$result2 = $value['img'];//这里又是一个二维数组，每次对其进行覆盖赋值
		  	foreach($result2 as $value){
				$LastRes[] = $value['CourseID'];
    		}	
    	}
    	dump($LastRes);
    	die;
    }
    /*
     * 这里实现了teacher、course表的多对多连接查询
     */
    public function manyTomany(){
    	$ORM=new ORM1();
    	$res=$ORM->getThemeWithProducts("dep01001");
		$result1 = $res['products'];
//  	dump($result1);
    	foreach($result1 as $value){
    		echo $value['CourseName']."</br>";
    	}
    }
}
