<?php
/**
 * 调试程序的时候用到的方法
 * Class Debug
 */
class Debug{

    /**
     * 直接在网页上打输出调试信息
     * @param array $params
     * @return string
     */
    public static function html_dump($params){
        echo "<pre>";
        var_dump($params);
        echo "<pre>";
        echo "<hr />";
    }

    /**
     * 将调试信息写到指定的文件中
     */
    public static function log_dump(){

    }
}