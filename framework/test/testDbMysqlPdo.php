<?php
/**
 * msyql PDO 测试
 */
include_once('../db/DbMysqlPdo.php');

$pdoObj = new DbMysqlPdo('127.0.0.1','dapp','root','root');

//插入数据
//$insertStatus = $pdoObj->insertData('baby',['name'=>'张小天']);
//var_dump($insertStatus);

//查询一条数据
$data = $pdoObj->getDataOne('baby','name',['name'=>'tao']);
var_dump($data);

//删除数据
$delStatus = $pdoObj->deleteData('baby',['name'=>'jiangtao']);
var_dump($delStatus);

//更新数据
$upStatus = $pdoObj->updateData('baby',['name'=>'jinjiangtao'],['name'=>'tao']);
var_dump($upStatus);


