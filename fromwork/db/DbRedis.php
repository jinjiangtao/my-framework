<?php

/**
 * Redis 有关操作的封装
 * Class DbRedis
 */
class DbRedis
{
    protected $_redisObj = null;
    protected $_clinet = null;
    protected $_host = '127.0.0.1';
    protected $_port = 6739;
    protected $_prefix = '';
    protected $_database = 0;

    public function __construct()
    {
        $this->_redisObj = new Redis();
    }

    public function getClient()
    {
        if ($this->_clinet == null) {
            $this->_clinet = $this->_redisObj->connect($this->_host, $this->_port);
            if (!$this->_clinet) {
                return $this->_redisObj->getLastError();
            }
        }else{
            return $this->_clinet;
        }
    }

    public function setDatabase()
    {

    }
}
