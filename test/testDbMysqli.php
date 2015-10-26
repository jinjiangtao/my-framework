<?php
include_once('../db/DbMysqli.php');

$obj = new DBMysqli('127.0.0.1','root','root');
$obj->setDb('dapp');

//删除数据测试
$result = $obj->deleteData('baby',['name'=>'jin']);
var_dump($result);

//插入数据测试
//$result = $obj->insertData('baby',['name'=>'tao']);
//var_dump($result);

//查询多条数据测试
$result = $obj->getDataList('baby','baby_id,name',['name'=>'tao']);
//var_dump($result);

//更新数据测试
$result = $obj->updateData('baby',['gender'=>2],['name'=>'tao']);
var_dump($result);
