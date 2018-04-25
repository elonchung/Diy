<?php
/**
 * HelloworldController
 * @authors simon.zhong (simon1740@163.com)
 * @date    2017-07-12
 * @version 1.0
 */
namespace Diy\Application\Controllers;

use Diy\Application\Controllers\Base;
use Diy\Application\Models\User;

class HelloworldController  extends Base
{
    
    function index(){

    	echo 'helloworld';exit;
    	
    }

    function test(){

        $user = new User();
        $data = $user->getUserInfo(2);
        
        $this->smarty->assign('data',$data);
        $this->smarty->display('text.html');

    	
    }
}