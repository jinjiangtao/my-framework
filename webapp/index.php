<?php
/**
 * 项目入口
 */
define('WEB_BASE_URL',dirname(__FILE__));
$config = WEB_BASE_URL.'/config/config.php';
$myBaseFile = '../framework/my.php';
$config = require_once($config);
require_once($myBaseFile);
$my = new my($config);
$my->run($config);
