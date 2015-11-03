<?php
$arr = [];
$arr1 = [];
$arr2 = [];

array_change_key_case($arr,CASE_UPPER);
array_chunk($arr,2,true);
array_combine($arr,$arr2);
array_count_values($arr);

$arr = array_intersect_key($arr1,$arr2);
array_intersect_key($arr1,$arr2);
array_intersect($arr1,$arr2);
array_pad($arr,3,'value');
array_reverse($arr);
var_dump($arr);




