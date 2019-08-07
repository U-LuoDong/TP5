<?php
namespace app\admin\validate;
use think\Validate;
class  Config extends Validate
{
    protected $rule=[
        'app_id'=>'unique:app_id|require',
        'notify_url'=>'require',
        'notify_url'=>'require',
        'return_url'=>'require',
        'alipay_public_key'=>'require',
        'merchant_private_key'=>'require',
    ];


    protected $message=[
        'app_id.require'=>'app_id必填！',
        'app_id.unique'=>'app_id不得重复！',
        'notify_url.require'=>'异步通知地址必填！',
        'return_url.require'=>'同步跳转地址必填！',
        'alipay_public_key.require'=>'公钥必填！',
        'merchant_private_key.require'=>'私钥必填！',
    ];

    protected $scene=[
        'add'=>['name','password'],
        'edit'=>['name','password'=>'min:6'],
    ];





    

    




   

	












}
