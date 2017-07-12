<?php
/**
 * Diy/Framework/init.php
 */
namespace Diy\Framework;

//引入配置文件
require CONFIG_DIR . '/config.php';
//引入自动加载类
require 'Autoloader.php';

require ROOT_DIR.'/vendor/autoload.php';

//初始化自动加载
Autoloader::init();
//启用Session
// Session::start();

//启动核心处理程序
$core = new Core;
$core->run();
