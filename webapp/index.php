<?php
/**
 * 项目入口
 */
$config = './config.php';
$myFile = '../fromwork/my.php';
require_once($myFile);
$my = new my();
$my->run();

