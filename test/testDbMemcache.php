<?php
/**
 * DbMemcache 的测试文件
 *
 */
include_once('../db/DbMemcache.php');

//链接初始化
$memObj = new DbMemcache('127.0.0.1','11211');
//var_dump($memObj);

//插入取出值
$setStatus = $memObj->set('jin','jinjiangtao',10);
var_dump($setStatus);
$value = $memObj->get('jin');
var_dump($value);

//指定的值 加 减测试
$setStatus = $memObj->set('jin_key',100,10);
$setStatus = $memObj->increment('jin_key');
var_dump($memObj->get('jin_key'));
$memObj->decrement('jin_key',10);
var_dump($memObj->get('jin_key'));

//删除一个值
$memObj->delete('jin_key');
var_dump($memObj->get('jin_key'));

//获取状态
var_dump($memObj->getStatus());



