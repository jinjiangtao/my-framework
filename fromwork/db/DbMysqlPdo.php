<?php

/**
 * Class DbMysqlPdo
 *
 */
class DbMysqlPdo
{
    protected $db;
    protected $table;
    protected $filed;

    /**
     * 初始化pdo 链接
     * @param $host
     * @param $dbName
     * @param $user
     * @param $password
     */
    public function __construct($host, $dbName, $user, $password)
    {
        $this->db = new PDO("mysql:host=$host;dbname=$dbName", $user, $password);
    }

    /**
     * 设置被操作的数据表
     * @param $table
     */
    public function setTable($table)
    {
        $this->table = $table;
    }

    /**
     * 设置数据列
     * @param string $filed
     */
    public function setFiled($filed)
    {
        $this->filed = $filed;
    }

    /**
     * 想数据库中插入一条数据
     * @param $table
     * @param $params
     * @param $debug
     * @return int|string
     */
    public function insertData($table, $params, $debug = false)
    {
        $this->checkParams(['table', 'params'], 'empty');
        $this->setTable($table);

        $keyStr = '';
        $keyArr = [];
        $bindKeyStr = '';
        $bindArrKey = [];
        $bindArr = [];
        foreach ($params as $key => $value) {
            $keyArr[] = "`" . $key . "`";
            $bingKey = ":" . $key;
            $bindArrKey[] = $bingKey;
            $bindArr[$bingKey] = $value;
        }

        $sql = "INSERT INTO {$this->table} (" . implode(',', $keyArr) . ")VALUES (" . implode(',', $bindArrKey) . ")";
        if ($debug) {
            return $sql;
        } else {
            $stmt = $this->db->prepare($sql);
            $insertStatus = $stmt->execute($bindArr);
            if ($insertStatus) {
                return $this->db->lastInsertId();
            } else {
                return $this->db->errorInfo();
            }
        }
    }

    /**
     * 删除数据 成功返回影响的行数
     * @param $table  表名
     * @param $whereArr where 条件
     * @param bool $debug 是否开启调试模式
     * @return array|int|string
     */
    public function deleteData($table, $whereArr, $debug = false)
    {
        $this->checkParams(['table', 'where'], 'empty');
        $this->setTable($table);
        $whereStr = '';
        $whereArrNew = [];
        $bindArr = [];
        foreach ($whereArr as $key => $value) {
            $bingKey = ":" . $key;
            $whereArrNew[] = $key . '=' . $bingKey;
            $bindArr[$bingKey] = $value;
        }
        $whereStr = implode(' and ', $whereArrNew);

        $sql = "DELETE FROM {$this->table} WHERE " . $whereStr;

        if ($debug) {
            return $sql;
        } else {
            $pdoStatement = $this->db->prepare($sql);
            $deleteStatus = $pdoStatement->execute($bindArr);
            if ($deleteStatus) {
                return $pdoStatement->rowCount();
            } else {
                return $pdoStatement->errorInfo();
            }
        }
    }


    public function getDataList($table, $whereArr, $debug = false)
    {


    }

    /**
     * 从数据库中查询一条数据
     * @param $table
     * @param $filed
     * @param $whereArr
     * @param bool $debug
     * @return mixed|string
     */
    public function getDataOne($table, $filed, $whereArr, $debug = false,$fetchStyle=PDO::FETCH_ASSOC)
    {
        $this->checkParams(['table', 'where'], 'empty');

        $this->setTable($table);
        $this->setFiled($filed);

        $whereStr = '';
        $whereArrNew = [];
        $bindArr = [];
        foreach ($whereArr as $key => $value) {
            $bingKey = ":" . $key;
            $whereArrNew[] = $key . '=' . $bingKey;
            $bindArr[$bingKey] = $value;
        }
        $whereStr = implode(' and ', $whereArrNew);

        $sql = "SELECT {$this->filed} FROM {$this->table} WHERE " . $whereStr . " LIMIT 1";

        if ($debug) {
            return $sql;
        } else {
            $podStatement = $this->db->prepare($sql);
            $data = $podStatement->execute($bindArr);
            if ($data) {
                return $podStatement->fetch($fetchStyle);
            }
        }

    }

    /**
     * 更新一条数据对象 成功返回影响的行数
     * @param  string $table      表名
     * @param  array  $setArr     设置的新值
     * @param  array  $whereArr   设置的条件
     * @param  bool   $debug      是否开启调试模式
     * @return array|int|string
     */
    public function updateData($table, $setArr, $whereArr, $debug = false)
    {
        $this->checkParams(['table,setArr,whereArr'], 'empty');
        $this->setTable($table);
        $whereStr = '';
        $whereArrNew = [];
        $bindArr = [];
        foreach ($whereArr as $key => $value) {
            $bingKey = ":" . $key;
            $whereArrNew[] = $key . '=' . $bingKey;
            $bindArr[$bingKey] = $value;
        }
        $whereStr = implode(' and ', $whereArrNew);

        $setStr = '';
        $setArrNew = [];
        foreach ($setArr as $key => $value) {
            $bingKey = ":" . $key;
            $setArrNew[] = "`".$key."`" . "='" . $value."'";
        }
        $setStr = implode(',', $setArrNew);

        $sql = "UPDATE  {$this->table} SET $setStr WHERE ".$whereStr;

        if($debug){
            return $sql;
        }else{
            $pdoStatement = $this->db->prepare($sql);
            $upStatus = $pdoStatement->execute($bindArr);
            if($upStatus){
                return $pdoStatement->rowCount();
            }else{
                return $pdoStatement->errorInfo();
            }
        }
    }

    protected function checkParams()
    {

    }
}
