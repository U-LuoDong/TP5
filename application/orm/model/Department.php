<?php
namespace app\orm\model;
use think\Model;
class Department extends Model//这里的模型类名要和数据库中的表名对应
{
	public function items() { //建立一对多关联
        return $this->hasMany('teacher', 'DepartmentID', 'DepartmentID'); //关联的模型，外键，当前模型的主键
    }
 
 
    public static function getBannerByID($id)	
    {
    	//1、连接单表
//      $banner = self::with('items')->find($id); // 通过 with 使用关联模型，参数为关联关系的方法名
//      return $banner;
		//2、嵌套关联【连接多表】
        $banner = self::with('items,items.img')->find($id); // with 接收一个数组。也可以使用with(['items', 'items.img'])
        return $banner;
    }
}
?>