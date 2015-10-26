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
     * 通过给定的条件删除数据 成功返回影响的行数
     * @param $table
     * @param $whereArr
     * @param $debug
     */
    public function deleteData($table, $whereArr, $debug)
    {
        $keyStr = '';
        $keyArr = [];
        $bindKeyStr = '';
        $bindArrKey = [];
        $bindArr = [];
        foreach ($whereArr as $key => $value) {
            $bingKey = ":" . $key;
            $bindArrKey[] = $bingKey;

            $bindArr[$bingKey] = $value;
        }
    }

    public function getDataList()
    {

    }

    public function getDataOne()
    {

    }

    public function updateData()
    {

    }

    protected function checkParams()
    {

    }
}
