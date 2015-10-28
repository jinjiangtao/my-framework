<?php
/**
 * 框架入口文件
 */
define('MY_BASE_PATH', dirname(__FILE__));

class my
{
    /**
     * 需要自动包含的项目目录
     * @var array
     */
    private $autoDirList = [
        '/cache/',
        '/command/',
        '/config/',
        '/curl/',
        '/db/',
        '/db/redis/',
        '/helper/',
        '/route/',
        '/safe/',
        '/test/',
        '/web/',
    ];

    /**
     * 程序的入口
     */
    public function run()
    {
        spl_autoload_register(array($this, 'autoLoad'));
        $routeObj = new RouteHttp();
        $route = $routeObj->getRoute();
    }

    /**
     *自动加载
     */
    public function autoLoad($class)
    {
        if (!empty($this->autoDirList)) {
            foreach ($this->autoDirList as $dir) {
                $file = MY_BASE_PATH . $dir . $class . '.php';
                if (is_file($file)) {
                    require_once($file);
                }
            }
        }
    }
}