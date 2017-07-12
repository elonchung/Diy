<?php

/**
 * User.php
 *
 * Initial version by: melon.zhong
 * Initial version created on: 2017/7/12
 */

namespace Diy\Application\Models;
use Diy\Framework\DB;

class User extends Model
{
    protected $db;

    protected $table = 't_test';

    /**
     * 根据用户id查询用户信息并返回查询结果
     *
     * @return array
     */
    public function getUserInfo($userId)
    {
        $data = $this->db->getOne('id,name',array('id'=>$userId));

        return $data;

    }
}