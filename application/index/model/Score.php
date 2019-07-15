<?php
namespace app\StudentInformationManagementSystem\model;
use think\Model;
use traits\model\SoftDelete;
class Score extends Model//这里的模型类名要和数据库中的表名对应
{
//软删除
	use SoftDelete;
	protected static $deleteTime='delete_time';
//	自动写入ip
	protected $auto=['ip'];
	protected function setIpAttr()
	{
		return request()->ip();
	}
}
?>