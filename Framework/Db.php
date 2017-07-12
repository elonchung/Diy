<?php

/**
 * Class DB 数据库单例类
 * @package Diy\Framework
 */

namespace Diy\Framework;

class DB
{

    private static $obj;//私有的静态变量 储存 实例化的类
    public $table;
    public $dsn;
    public $pdo;

    private function __clone()
    {
        trigger_error('Clone is not allow', E_USER_ERROR);//若是克隆 报错提醒 这是不被允许的
    }//私有的克隆方法

    private final function __construct()//私有的不可被继承的 构造方法
    {
        echo 123;
        $cfg = require CONFIG_DIR.'/config.php';

        $dsn['dsn'] = $cfg['db']['dsn'];
        $dsn['username'] = $cfg['db']['username'];
        $dsn['password'] = $cfg['db']['password'];
        $dsn['charset'] = $cfg['db']['charset'];

        $this->dsn = $dsn;

        $pdo = new \PDO($this->dsn['dsn'], $this->dsn['username'], $this->dsn['password']);
        $pdo->exec("set names " . $this->dsn['charset'] . "");

        $this->pdo = $pdo;

        return $this;
    }

    public static function getInstance()
    {
        //instanceof 用于确定一个 PHP 变量是否属于某一类 class 的实例：
        if (!self::$obj instanceof self) {
            self::$obj = new self;
        }
        return self::$obj;
    }

    public function connect()
    {

    }

    public function table($tableName)
    {
        $tableName = trim($tableName);
        $this->table = $tableName;
        return $this;
    }

    public function insert($data)
    {//进行添加  返回 上一条的添加值
        $keyStr = "";
        $valStr = "";
        foreach ($data as $k => $v) {
            $keyStr .= ',' . $k;
            $valStr .= ',' . "'$v'";
        }
        $keyStr = trim($keyStr, ',');
        $valStr = trim($valStr, ',');

        $sql = "INSERT INTO " . $this->table . " ($keyStr) VALUES($valStr)";
        $res = $this->pdo->exec($sql);
        if ($res) {
            return $this->pdo->lastInsertId();
        } else {
            return $this->pdo->errorInfo();
        }

    }

    public function select($columns, $join = null, $where = null, $group = null, $having = null, $order = null, $limit = null)
    {
        $columns = implode(',', array_values($columns));
        // 需要加条件判断是否为空，是否需要拼接
        $sql = "select " . $columns . " from `" . $this->table . "` ";
        if ($join != null) {
            $sql .= $join;
        }
        if ($where != null) {
            $sql .= " where " . $where;
        }
        if ($group != null) {
            $sql .= " group by " . $group;
        }
        if ($having != null) {
            $sql .= " having " . $having;
        }
        if ($order != null) {
            $sql .= " order by " . $order;
        }
        if ($limit != null) {
            $sql .= " limit " . $limit;
        }

        //echo $sql;exit;
        $res = $this->pdo->query($sql);
        return $res;
    }

    public function getRow($field = '*', $where)
    {
        //获取 单行数据    参数为  字段名和where条件  （数据类型为数组）
        $whereStr = 1;
        if (!empty($where)) {
            foreach ($where as $k => $val) {
                $whereStr .= " AND " . $k . "=" . "'$val'";
            }
        }
        $whereStr = substr($whereStr, 5);
        //$fieldStr='*';
        if (!empty($field)) {
            $field = trim($field, ',');
        }

        $sql = "select $field from " . $this->table . " where $whereStr";
        $data = $this->pdo->query($sql)->fetch(\PDO::FETCH_ASSOC);
        return $data;

    }

    /**
     * //获取 单个字段名的数据  参数为字段名（string） 和where条件（array）
     * @param string $field
     * @param $where
     * @return array
     */
    public function getOne($field = "*", $where)
    {

        $whereStr = 1;
        if (!empty($where)) {
            foreach ($where as $k => $val) {
                $whereStr .= " AND " . $k . "=" . "'$val'";
            }
        }
        $whereStr = substr($whereStr, 5);

        if (!empty($field)) {
            $field = trim($field, ',');
        }

        $sql = "select $field from " . $this->table . " where $whereStr";
        $data = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $data;

    }

    /**
     * 所有数据
     * @return array
     */

    public function getAll()
    {
        $sql = "select * from " . $this->table;
        $res = $this->pdo->query($sql)->fetchAll(\PDO::FETCH_ASSOC);
        return $res;
    }

    /**
     * 更新数据
     * @param $data
     * @param $where
     * @return int
     */
    public function update($data, $where)
    {
        $setStr = "";
        foreach ($data as $k => $v) {
            $setStr .= $k . '=' . "'$v'" . ',';
        }
        $whereStr = "";
        foreach ($where as $k => $val) {
            $whereStr .= " AND " . $k . "=" . "'$val'";
        }
        $whereStr = substr($whereStr, 5);
        $setStr = trim($setStr, ',');
        $sql = "update " . $this->table . " set  $setStr where $whereStr";
        $res = $this->pdo->exec($sql);
        return $res;
    }

    /**
     * 删除数据
     * @param $where
     * @return int
     */
    public function delete($where)//删除
    {
        $str = "";
        foreach ($where as $k => $val) {
            $str .= " AND " . $k . "=" . "'$val'";
        }
        $str = substr($str, 5);
        $sql = "delete from $this->table where $str";
        $res = $this->pdo->exec($sql);
        return $res;
    }
}