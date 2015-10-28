<?php
/**
 * 项目入口
 */
$config = './config.php';
$myFile = '../framework/my.php';
require_once($myFile);
$my = new my();
$my->run();

