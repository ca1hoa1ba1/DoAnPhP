<?php 
	include_once __DIR__ . "/autoload/autoload.php"; 
	$data = $db->fetchID('product', intval(5));
	$test = 'size_sm';
	$arr = array_combine(array($test), array($data[$test]));
	_debug($arr);
 ?>