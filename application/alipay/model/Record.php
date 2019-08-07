<?php
namespace app\alipay\model;
use think\Model;

class Record extends Model
{
// 关闭自动写入create_time字段
    protected $createTime = false;

    public $_link=array(
        'Users'=>array(
            'mapping_type'=>self::BELONGS_TO,
            'class_name'=>'Users',
            'foreign_key'=>'user_id',
            'mapping_name'=>'username',
            'as_fields'=>'username:username',
        ),
    );
}
?>