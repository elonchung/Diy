<?php
/**
 * controler的基础类Base
 * @authors simon.zhong (simon1740@163.com)
 * @date    2017-07-12
 * @version 1.0
 */
namespace Diy\Application\Controllers;

Class Base {

	public $smarty;

    public function __construct()
    {
  		// $smarty = new \Smarty;
		// //$smarty->left_delimiter = "{#";
		// //$smarty->right_delimiter = "#}";
		// $smarty->setTemplateDir(SITE_ROOT . '/views/'); //设置模板目录
		// $smarty->setCompileDir(SITE_ROOT . '/data/cache/templates_c/');
		// $smarty->setConfigDir(SITE_ROOT . '/views/smarty_confi`gs/');
		// $smarty->setCacheDir(SITE_ROOT . '/data/cache/smarty_cache/');
		// //$smarty->force_compile = true;
		// if (APP_DEBUG) {
		// 	//$smarty->debugging      = true;
		// 	$smarty->caching        = false;
		// 	$smarty->cache_lifetime = 0;
		// } else {
		// 	//$smarty->debugging      = false;
		// 	$smarty->caching        = true;
		// 	$smarty->cache_lifetime = 120;

        //调用Smarty的Autoloader
        // \Smarty_Autoloader::register();
        //创建Smarty的一个实例化对象
        $this->smarty = new \Smarty();
        //对smarty做一些基本设置

        //设置模板的存放位置
        $this->smarty->setTemplateDir(APP_DIR.'/Views/');
        //smarty编译文件的存储位置
        $this->smarty->setCompileDir(ROOT_DIR.'/compiled/');
        //设置smarty配置文件的存放位置
        $this->smarty->setConfigDir(CONFIG_DIR.'/smarty/');
        //smarty自带缓存，设置缓存的存储位置
        $this->smarty->setCacheDir(ROOT_DIR.'/cache/');
    }

}