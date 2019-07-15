<?php

namespace app\websocket\controller;

use Workerman\Worker;

class Index
{
    /**
     * 手册上复制过来的
     */
    public function index()
    {
        // 初始化一个worker容器，监听2346端口
        $worker = new Worker("websocket://127.0.0.1:2346");
        // ====这里进程数必须必须必须设置为1====
        $worker->count = 1;
        // 新增加一个属性，用来保存uid到connection的映射(uid是用户id或者客户端唯一标识)
        $worker->uidConnections = array();//一维数组 键是用户名字 值是$connection【方便下面对单独的uid发送】
        // 当有客户端发来消息时执行的回调函数
        $worker->onMessage = function ($connection, $data) {
            global $worker;//就是采用上面设置的全局变量 而不是用局部变量
            // 判断当前客户端是否已经验证,即是否设置了uid
            if (!isset($connection->uid)) {
                // 没验证的话把第一个包当做uid（标识客户端的名字）【所以第一次需要设置名字】
                $connection->uid = $data;
                /* 保存uid到connection的映射，这样可以方便的通过uid查找connection，
                 * 实现针对特定uid推送数据
                 */
                $worker->uidConnections[$connection->uid] = $connection;//键是名字 值是$connection【方便下面对单独的uid发送】
                echo 'login success, your name is ' . $connection->uid."\n";
                //【标识3】:通过数组发送欢迎消息
                $welcome=array();
                $welcome['msgType']=3;
                $welcome['content']='欢迎' . $connection->uid . "进入聊天室";
//                echo gettype(json_encode($welcome,256))."   ";
//                echo json_encode($welcome,256);
                return $connection->send(json_encode($welcome,256));//序列化且中文不转为Unicode 直接返回 不执行下面的代码
            }
            // 其它逻辑，针对某个uid发送 或者 全局广播
            // 假设消息格式为 uid:message 时是对 uid 发送 message
            // uid 为 all 时是全局广播
            list($recv_uid, $message) = explode(':', $data);//将分割后得数组的值赋值给list中的相应变量
            //循环找到值对应的键【也就是用户名】
            foreach ($worker->uidConnections as $uName=>$con) {
                if($con==$connection){
                    $name=$uName;
                }
            }
            // 全局广播
            if ($recv_uid == 'all') {
                //【标识1】:通过数组发送全体广播
                broadcast($name,$message);
            }
            // 给特定uid发送
            else {
                //【标识1】:通过数组发送私聊消息
                sendMessageByUid($recv_uid, $message,$name);
            }
        };

        // 当有客户端连接断开时
        $worker->onClose = function ($connection)
        {
            global $worker;
            if (isset($connection->uid)) {
                // 连接断开时删除映射【就是删除连接用户数组中的】
                unset($worker->uidConnections[$connection->uid]);
            }
        };

        /**
         * 向所有验证的用户推送数据 利用循环来实现
         * @param $message
         */
        function broadcast($name,$message)
        {
            global $worker;
            foreach ($worker->uidConnections as $uName=>$connection) {
                $res=array();
                $res['msgType']=1;
                $res['chatDateTime']=date("Y-m-d H:i:s");//发送信息时间
                $res['userName']=$name;//发送消息的用户
                $res['userPhoto']="/img/iu.png";//用户头像 写死了
                $res['chatMessage']=$message;//发送信息内容
                $res['tag']="0";//标识 1表示私聊 0表示群发
                $connection->send(json_encode($res,256));//序列化且中文不转为Unicode
            }
        }

        /**
         * 针对uid推送数据
         * @param $uid
         * @param $message
         */
        function sendMessageByUid($uid, $message,$person)
        {
            global $worker;
            if (isset($worker->uidConnections[$uid])) {//私聊要发送2个【一个是私聊方 一个是己方】
                $coHe = $worker->uidConnections[$uid];//接受消息的用户
                $coMe = $worker->uidConnections[$person];//发送消息的用户
                $res=array();
                $res['msgType']=1;
                $res['chatDateTime']=date("Y-m-d H:i:s");//发送信息时间
                $res['userName']=$person;//发送消息的用户
                $res['userPhoto']="/img/iu.png";//用户头像 写死了
                $res['chatMessage']=$message;//发送信息内容
                $res['tag']="1";//标识 1表示私聊 0表示群发
                $coHe->send(json_encode($res,256));//序列化且中文不转为Unicode 直接返回 不执行下面的代码
                $coMe->send(json_encode($res,256));//序列化且中文不转为Unicode 直接返回 不执行下面的代码
            }
        }

        // 运行所有的worker（其实当前只定义了一个）
        Worker::runAll();
    }

    /**
     * 简单的实现  参考：http://www.pianshen.com/article/8905320846/
     */
    public function index1()
    {
        // 创建一个Worker监听2346端口，使用websocket协议通讯
        $ws_worker = new Worker("websocket://127.0.0.1:2346");
        // 启动4个进程对外提供服务
        $ws_worker->count = 1;
        // 当收到客户端发来的数据后返回hello $data给客户端
        $ws_worker->onMessage = function ($connection, $data) {
            // 向客户端发送hello $data
            $connection->send('hello ' . $data);//对当前的连接发送消息
            echo "向客户端发送：'hello ' . $data";
        };
        $ws_worker->onConnect = function ($connection) {
            $connection->send('与服务端建立连接成功');//对当前的连接发送消息
        };

        // 运行worker
        Worker::runAll();

//        /**
//         * 收到信息
//         * @param $connection
//         * @param $data
//         */
//        public function onMessage($connection, $data)
//        {
//            $connection->send('我收到你的信息了');
//        }
//
//        /**
//         * 当连接建立时触发的回调函数
//         * @param $connection
//         */
//        public function onConnect($connection)
//        {
//
//        }
//
//        /**
//         * 当连接断开时触发的回调函数
//         * @param $connection
//         */
//        public function onClose($connection)
//        {
//
//        }
//
//        /**
//         * 当客户端的连接上发生错误时触发
//         * @param $connection
//         * @param $code
//         * @param $msg
//         */
//        public function onError($connection, $code, $msg)
//        {
//            echo "error $code $msg\n";
//        }
//
//        /**
//         * 每个进程启动
//         * @param $worker
//         */
//        public function onWorkerStart($worker)
//        {
//
//        }

    }
}

