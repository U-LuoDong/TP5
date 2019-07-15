<?php
namespace app\orm\model;
use think\Model;
class Teacher extends Model//这里的模型类名要和数据库中的表名对应
{
    public function img() {
    	return $this->hasMany('schedule', 'TeacherID', 'TeacherID'); //关联模型名，外键名，关联模型的主键
    }
     /**
     * 建立多对多关联模型
     */
    public function products()
    {	
	//关联模型名，中间表名，外键名，当前模型外键名
		return $this->belongsToMany('Course', 'Schedule', 'CourseID', 'TeacherID'); 
    }
         /** * 返回 theme和poducts * @id theme id * @return theme数据模型 */
    public static function getThemeWithProducts($id) 
    {
         $theme = self::with('products') ->find($id);
         return $theme; 
    }
}
?>