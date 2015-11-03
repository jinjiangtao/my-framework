<?php

/**
 * 控制器基类
 */
class  BaseController
{
    protected $defaultViewDir = 'view';
    protected $thisViewDirName;
    protected $contName;
    protected $contAction;
    protected $route;

    /**
     * 初始化控制器的方法
     */
    protected function init()
    {
        $this->thisViewDirName = str_replace('controller', '', strtolower(__CLASS__));
    }

    /**
     * 渲染一个视图
     *
     * @param string $viewPath 模版的路径 支持 / 或 . 分割
     * @param array $params 传到模版的参数
     * @param boolean $returnTmp 是否返回模版
     * @return string
     */
    protected function render($viewPath = '', $params = [], $returnTmp = false)
    {
        $pathArr = [];
        $viewFile = '';
        if (strpos($viewPath, '/')) {
            $pathArr = explode('/', $viewPath);
            var_dump($pathArr);
            $viewFile = WEB_BASE_URL . '/' . $this->defaultViewDir . '/' . $pathArr[0] . '/' . $pathArr[1] . '.php';
        }
        if (strpos($viewPath, '.')) {
            $pathArr = explode('.', $viewPath);
            $viewFile = WEB_BASE_URL . '/' . $this->defaultViewDir . '/' . $pathArr[0] . '/' . $pathArr[1] . '.php';
        }
        if (!empty($params)) {
            extract($params);
        }
        $content = require($viewFile);
        if ($returnTmp) {
            return $content;
        } else {
            echo $content;
        }
    }

    protected function after()
    {

    }


}
