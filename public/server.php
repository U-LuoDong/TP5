<?php
// +----------------------------------------------------------------------
// | ThinkPHP [ WE CAN DO IT JUST THINK ]
// +----------------------------------------------------------------------
// | Copyright (c) 2006-2016 http://thinkphp.cn All rights reserved.
// +----------------------------------------------------------------------
// | Licensed ( http://www.apache.org/licenses/LICENSE-2.0 )
// +----------------------------------------------------------------------
// | Author: liu21st <liu21st@gmail.com>
// +----------------------------------------------------------------------
// 启动socket，通过cmd启动

// [ 应用入口文件 ]

// 定义应用目录

//这里的__DIR__代表的是使用相对路劲

define('APP_PATH', __DIR__ . '/../application/');//参数1.规定常量的名称。参数2 规定常量的值。
//绑定到socket所在模块
define('BIND_MODULE', 'websocket/index/index');
// 加载框架引导文件
require __DIR__ . '/../thinkphp/start.php';