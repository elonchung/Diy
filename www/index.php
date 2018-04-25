<?php
	
	//给目录定义一些常量
	define('ROOT_DIR', __DIR__.'/..');
	define('APP_DIR', ROOT_DIR.'/Application');
	define('CONFIG_DIR', ROOT_DIR.'/config');
	define('FRAMEWORK_DIR', ROOT_DIR.'/Framework');
	define('LOG_DIR', ROOT_DIR.'/logs');
	define('WWW_DIR', __DIR__.'/');
    define('LIB_DIR', ROOT_DIR.'/vendor');

    //是否开启DEBUG模式 默认true 开启
    define('DEBUG_MODE', true);

	//设置一下站点的时区
	define('TIMEZONE', 'Asia/Shanghai');
	ini_set('data.timezone', TIMEZONE);

	//引入初始化程序
	require FRAMEWORK_DIR.'/init.php';




