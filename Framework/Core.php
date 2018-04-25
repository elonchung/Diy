<?php

/** 
 * Diy/Framework/Core.php
 */
namespace Diy\Framework;

class Core
{
    public function run()
    {
        $this->setReporting();
        $this->route();
    }

    /**
     * 设定整站的错误报告等级
     */
    public function setReporting()
    {
        if (DEBUG_MODE === true) {
            error_reporting(E_ALL);
            ini_set('display_errors', 'On');

            //打开美观的Whoops错误报告
            $whoops = new \Whoops\Run;
            $whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
            $whoops->register();
        } else {
            error_reporting(E_ALL);
            ini_set('display_errors', 'Off');
            ini_set('log_errors', 'On');
            ini_set('error_log', LOG_DIR . '/error.log');
        }
    }

    /**
     * 路由规则
     *
     * 使用$_REQUEST['act']来定位控制器的类
     * 使用$_REQUEST['st']来定位具体的方法
     */
    public function route()
    {
        $controller = 'index';
        $action = 'index';
        $file = $_SERVER['REQUEST_URI'];
//        var_dump($file);exit;
        if ($file && $file !=='/'){
            $fileArr = explode('/',trim($file,'/'));

            if($fileArr){
                $controller = $fileArr[0] ;
                $action = $fileArr[1] ;
            }
        }

/*        //如果$_REQUEST中没有'act'，则设定默认act为index
        if (!isset($_REQUEST['act'])) {
            $_REQUEST['act'] = 'index';
        }

        //如果$_REQUEST中没有'st'，则设定默认act为main
        if (!isset($_REQUEST['st'])) {
            $_REQUEST['st'] = 'main';
        }
        //根据act定位控制器类
        $className = 'Diy\\Application\\Controllers\\' . $_REQUEST['act'];
        
        //判断控制器类是否存在，不存在则报404
        if (!class_exists($className)) {
            throw new \Exception('找不到控制器',404);
        }
        */

        //根据act定位控制器类
        $className = 'Diy\\Application\\Controllers\\' . $controller.'Controller';

        //判断控制器类是否存在，不存在则报404
        if (!class_exists($className)) {
            throw new \Exception('找不到控制器',404);
        }

        //生成目标控制器类对象
        $obj = new $className();
        
        //判断方法是否存在，不存在则报404
        if (!method_exists($obj, $action)) {
            throw new \Exception('找不到控制器的对应方法',404);
        }
        //执行目标方法
        $obj->$action();
    }
}