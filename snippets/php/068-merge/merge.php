<?php 

$header = ['column1','column2','column3','column4',];

$data = [
	['column1'=>'value1','column2'=>'value2','column3'=>'value3','column4'=>'value4',],
	['column1'=>'value5','column2'=>'value6','column3'=>'value7','column4'=>'value8',],
];

var_dump(array_merge([$header],$data));