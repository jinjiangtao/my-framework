<?php
/**
 * 框架入口文件
 */
//设置框架的根目录
defined('MY_BASE_PATH') or define('MY_BASE_PATH', dirname(__FILE__));

//是否开启调试模式
defined('MY_DEBUG') or define('MY_DEBUG', false);

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