<?php

/**
 * mysqli 数据库 操作类
 */
class DbMysqli
{
    protected $db;     //数据库名称
    protected $table;  //数据表名称
    protected $filed='*';  //数据列

    /**
     * 数据库构造方法 初始化链接
     */
    public function __construct($host, $name, $password)
    {
        $this->db = new mysqli($host, $name, $password);
        if (!$this->db) {
            return $this->db->error;
        }
    }

    /**
     * 设置链接使用的数据库
     * @param string $dbName
     * @return boolean
     */
    public function setDb($dbName)
    {
        if (empty($dbName) || empty($this->db)) {
            return false;
        }
        return $this->db->select_db($dbName);
    }

    /**
     * 设置链接的表名
     * @param $table
     */
    public function setTable($table){
        $this->table = $table;
    }

    /**
     * 设置数据库的字段
     * @param $filed
     */
    public function setField($filed){
        $this->filed = $filed;
    }

    /**
     * 向数据库中插入数据  单条数据返回最后的id  多条数据返回插入的个数
     * @param $table         插入的数据表
     * @param $insertDataArr 插入的数据
     * @param $debug boolean 是否开启调试模式
     * @return string
     */
    public function insertData($table, $insertDataArr, $debug = false)
    {
        $this->setTable($table);
        if (empty($table) || empty($insertDataArr)) {
            return 'params can not empty!!!';
        }

        $sql = '';
        $keyStr = $DataStr = '';

        $dataArr = $keyArr = [];

        //获取插入的keys
        foreach ($insertDataArr as $k => $v) {
            $keyArr[] = "`" . $k . "`";
            $dataArr[] = "'" . $v . "'";
        }
        $keyStr = implode(',', $keyArr);
        $DataStr = implode(',', $dataArr);

        $sql = "INSERT INTO {$this->table} (" . $keyStr . ") VALUES (" . $DataStr . ")";

        if ($debug) {
            return $sql;
        } else {
            $insertStatus = $this->db->query($sql);
            if ($insertStatus) {
                return $this->db->insert_id;
            } else {
                return $this->db->error;
            }
        }
    }

    /**
     * 删除满足where条件的数据 返回删除的条数
     * @param string $table
     * @param int $whereArr
     * @param bool $debug
     * @return string
     */
    public function deleteData($table, $whereArr, $debug = false)
    {
        if (empty($table) || empty($whereArr)) {
        }
        $this->setTable($table);
        $whereNewArr = [];
        foreach ($whereArr as $key => $value) {
            $whereNewArr[] = "`" . $key . "` = '" . $value . "'";
        }
        $whereStr = implode(' and ', $whereNewArr);
        $sql = "delete from {$this->table} where " . $whereStr;

        if ($debug) {
            return $sql;
        } else {
            $deleteStatus = $this->db->query($sql);
            if ($deleteStatus) {
                return $this->db->affected_rows;
            } else {
                return $this->db->error;
            }
        }
    }

    /**
     * 更新一条数据 更新成功返回影响行数
     * @param $table
     * @param $setArr
     * @param $whereArr
     * @param bool $debug
     * @return int|string
     */
    public function updateData($table, $setArr, $whereArr, $debug = false)
    {
        $this->checkParams(['table', 'setArr', 'where'], 'empty');

        $this->table = $table;
        $setStr = '';
        $setArrNew = [];
        foreach ($setArr as $key => $value) {
            $setArrNew[] = "`" . $key . "`='" . $value . "'";
        }
        $setStr = implode(',', $setArrNew);

        $whereStr = '';
        $whereArrNew = [];
        foreach ($whereArr as $key => $value) {
            $whereArrNew[] = "`" . $key . "`='" . $value . "'";
        }
        $whereStr = implode(' and ', $whereArrNew);

        $sql = "update {$this->table} set " . $setStr . " where " . $whereStr;
        if ($debug) {
            return $sql;
        } else {
            $updateStatus = $this->db->query($sql);
            if ($updateStatus) {
                return $this->db->affected_rows;
            } else {
                return $this->db->error;
            }
        }
    }

    /**
     * 查询多条数据并返回
     * @param string $table 数据表的名称
     * @param string $filed 数据项 默认是*
     * @param array $whereArr where 条件
     * @param bool $relevancy 是否返回列名称
     * @param bool $debug
     * @return array
     */
    public function getDataList($table, $filed = '*', $whereArr, $relevancy = true, $debug = false)
    {
        $this->checkParams(['table', 'filed', 'whereArr'], 'empty');

        foreach ($whereArr as $key => $value) {
            $whereArrNew[] = "`" . $key . "`='" . $value . "'";
        }
        $this->setTable($table);
        $this->setField($filed);
        $whereStr = implode(' and ', $whereArrNew);

        $sql = "select {$this->filed} from {$this->table} where " . $whereStr;
        if ($debug) {
            return $sql;
        } else {
            $resultData = $this->db->query($sql);
            if ($resultData) {
                $returnArr = [];
                if ($relevancy) {
                    while ($data = $resultData->fetch_array(MYSQL_ASSOC)) {
                        array_push($returnArr, $data);
                    }
                    return $returnArr;
                }
                while ($data = $resultData->fetch_array(MYSQL_NUM)) {
                    array_push($returnArr, $data);
                }
                return $returnArr;
            } else {
                return $this->db->error;
            }
        }
    }

    /**
     * 获取单条数据
     */
    public function getDataOne()
    {

    }

    /**
     * 检查参数的有效性
     */
    protected function checkParams()
    {

    }

}

