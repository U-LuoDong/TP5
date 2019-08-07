<?php

namespace app\alipay\controller;
use app\alipay\model\Config as ConfigModel;
use app\alipay\model\Record as RecordModel;
use think\Controller;

class Index extends Controller
{
    /**
     * 获取支付金额并写入支付记录表以及支付
     * @return \think\response\View
     */
    public function index()
    {
        if (request()->isPost()) {
            //获取需要支付的金额
            $money = $_POST['money'];
            if (!preg_match("/^\d+\.?\d{0,2}$/", $money) || $money == 0) {
                $this->error("充值金额有误，请重新输入");
            }
            //查询配置表是否已完成配置
//            $model_config = D('Config');
            $model_config = new ConfigModel();
            $where_config['id'] = array('eq', 1);
            $config_result = $model_config->where($where_config)->find();
            if (!$config_result or !$config_result['app_id'] or !$config_result['notify_url'] or !$config_result['return_url'] or !$config_result['alipay_public_key'] or !$config_result['merchant_private_key']) {
                $this->error("配置信息不完整");
            }
            //生成订单编号
            $out_trade_no = uniqid();
            //填写需要写入的数据
            $data = array(
                'user_id' => 1,
                'order_no' => $out_trade_no,
                'type' => '支付宝支付',
                'money' => $money,
                'status' => 0,
                'create_time' => time(),
            );
            //写入充值记录表
//            $model = D('Record');
            $model = new RecordModel();
            $result = $model->data($data)->add();
            /*  此处为了调用方便，我自己封装了一个类。该类只是对官方demo进行了简单的处理
                该类所在路径为 AlipayClass/ThinkPHP/Library/Org/Alipay/get_pay_data.class.php
                以下采用的方法为Tp的自动加载方法，具体使用方法请参见该地址：
                http://document.thinkphp.cn/manual_3_2.html#autoload
            */
            Vendor('get_pay_data', 'thinkphp/library/Alipay/', '.class.php');
            //此处需传递支付金额以及订单号两个参数
            $alipay = Alipay::go_pay($money, $out_trade_no);
            echo json_encode($alipay);
            exit;
        }
        return view();
    }

    /**
     * 该方法为显示配置页面
     */
    public function config(){
        $model = new ConfigModel();
        $where['id'] = array('eq',1);
        $result = $model->where($where)->find();
//        if($result['app_id'] or $result['notify_url'] or $result['return_url'] or $result['alipay_public_key'] or $result['merchant_private_key']){
            $this->assign('result',$result);
//        }
//        echo $result['sign_type'];die;
        return view();
    }

    /**
     * 该方法为将配置信息保存数据库
     */
    public function save_config(){
        $id = $_POST['id'];

        $model = new ConfigModel();

        if (!$model->create()){
            // 如果创建失败 表示验证没有通过 输出错误提示信息
            $this->error($model->getError());
        }else{
            $flag=$model->save();
            if($flag){
                $this->success("配置成功","Index/index");
            }else{
                $this->error("配置失败");
            }
        }
    }
}
