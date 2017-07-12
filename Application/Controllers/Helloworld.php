<?php
/**
 * helloworld
 * @authors simon.zhong (simon1740@163.com)
 * @date    2017-07-12
 * @version 1.0
 */
namespace Diy\Application\Controllers;

use Diy\Application\Controllers\Base;

class Helloworld  extends Base1
{
    
    function index(){

    	echo 'helloworld';exit;
    	
    }

    function test(){
    	
        $this->smarty->assign('data','helloworld');
        $this->smarty->display('text.html');

    	
    }
}