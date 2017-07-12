<?php

/**
 * Model.php
 * Model基础类 -- 获取单例数据连接，重置table等公共属性
 * Initial version by: melon.zhong
 * Initial version created on: 2017/7/12
 */

namespace Diy\Application\Models;
use Diy\Framework\DB;


class Model
{
    protected $db;

    protected $table;

    protected static $_instance;

    public function __construct()
    {
        //使用PDO创建mysql数据库连接
        $this->db = DB::getInstance();
        $this->db->table = $this->table;

    }

}