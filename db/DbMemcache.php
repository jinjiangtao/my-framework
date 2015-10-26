<?php

class DbMemcache
{

    protected $mem;

    public function __construct($host, $port)
    {
        $this->mem = new Memcache();
        $this->mem->connect($host, $port);
    }

    /**
     * 向mem设置一个值
     * @param $key
     * @param $value
     * @param int $expireTime
     * @param bool $flag
     * @return boolean
     */
    public function set($key, $value, $expireTime = 0, $flag = false)
    {
        return $this->mem->set($key, $value, $flag, $expireTime);
    }

    /**
     * 通过一个key 获取一个缓存值
     * @param $key
     * @return string
     */
    public function get($key)
    {
        return $this->mem->get($key);
    }

    /**
     * 删除一个元素
     * @param string $key
     * @return boolean
     */
    public function delete($key)
    {
        return $this->mem->delete($key);
    }

    /**
     * 清除数据库中所有元素
     * @return boolean
     */
    public function flush()
    {
        return $this->mem->flush();
    }

    /**
     * 获取服务器的运行状态
     * @return boolean
     */
    public function getStatus()
    {
        return $this->mem->getstats();
    }

    /**
     * 某一个元素值按照 指定的幅度减少
     * @param $key
     * @param int $value
     * @return int
     */
    public function decrement($key, $value = 1)
    {
        return $this->mem->decrement($key, $value);
    }

    /**
     * 某一个元素的值 按照指定的幅度增加
     * @param $key
     * @param int $value
     * @return int
     */
    public function increment($key, $value = 1)
    {
        return $this->mem->increment($key, $value);
    }
}
