<?php
namespace app\SingleInstance\model;
use think\Model;
class Department extends Model//这里的模型类名要和数据库中的表名对应
{
//	public function __construct()   
//	{   
//	}   
	private static $instance;
    private function __clone(){} //禁止被克隆
    /**
    * 单例
    */
    public static function getInstance()
    {
        if(!(self::$instance instanceof self)){
            self::$instance = new self();//new了一个新的对象
            //或者
//          self::$instance = new static();
        }
        return self::$instance;
    }
	public static function test($id){
	    $res = self::getInstance()->find($id);
	    return $res;
	}
}
?>