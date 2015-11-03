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
    const CONTROLLER = 'Controller';
    const ACTION = 'action';
    protected $config;


    /**
     * 需要自动包含的项目目录
     * @var array
     */
    private $autoPathList = [
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
     * @param array $config 由应用传入的配置文件
     */
    public function run($config)
    {

        $this->config = $config;
        $this->updateAutoPathList();
        spl_autoload_register(array($this, 'autoLoad'));
        $routeObj = new RouteHttp();
        $route = $routeObj->getRoute();
        if (!empty($route)) {
            $controller = $route['controller'] . self::CONTROLLER;
            $action =  $route['action'];
            $objController = new $controller($this->config);
            $objController->$action();
        }
    }

    /**
     * 初始化 并 更新自动加载的目录
     */
    public function updateAutoPathList()
    {
        foreach ($this->autoPathList as $k=>$v) {
            $this->autoPathList[$k] = MY_BASE_PATH . $v;
        }
        if (!empty($this->config['import'])) {
            $configPath = $this->config['import'];
            foreach($configPath as $path){
                $turePath = WEB_BASE_URL.'/'.$path.'/';
                array_push($this->autoPathList,$turePath);
            }
        }
    }

    /**
     * 导入应用中文件
     */
    public function import()
    {

    }

    /**
     *自动加载
     */
    public function autoLoad($class)
    {
        if (!empty($this->autoPathList)) {
            foreach ($this->autoPathList as $path) {
                $file = $path . $class . '.php';
                if (is_file($file)) {
                    require_once($file);
                }
            }
        }
    }
}