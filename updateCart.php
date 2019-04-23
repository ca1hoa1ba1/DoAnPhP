<?php include_once __DIR__ . "/autoload/autoload.php"; 
	$id = intval(getInput('key'));
	$index = intval(getInput('index'));
	$qty = intval(getInput('qty'));

	$_SESSION['cart'][$id][$index]['qty'] = $qty;

	echo 1;
?>