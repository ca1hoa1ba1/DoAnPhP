<?php include_once __DIR__ . "/autoload/autoload.php"; 
	$id = intval(getInput('key'));
	$index = intval(getInput('index'));
	unset($_SESSION['cart'][$id][$index]);
	if(count($_SESSION['cart'][$id]) == 0) {
		unset($_SESSION['cart'][$id]);
	}
	if(count($_SESSION['cart']) == 0) {
		unset($_SESSION['cart']);
		echo 0;
	}else {
		echo 1;
	}
	$_SESSION['countCart'] = countCart();

	
?>