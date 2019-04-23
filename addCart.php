<?php include_once __DIR__ . "/autoload/autoload.php"; 
	if(getInput('product') == '' || getInput('shop-sizes') == '' || getInput('quantity') == '') {
		echo "<script>alert(' Thêm sản phẩm không hợp lệ'); location.href='index.php'; </script>";
	} else {
		$id = intval(getInput('product'));
		//checkk product
		$product = $db->fetchID('product',$id);
		if($product == NULL) {
			echo "<script>alert(' Thêm sản phẩm không hợp lệ'); location.href='index.php'; </script>";
		}
		$size = getInput('shop-sizes');
		$data = [
			'namepro' => $product['namepro'],
			'thunbar' => $product['thunbar'],
			'price' =>$product['price'],
			'size' => $size,
			'max' => $product[$size],
			'qty' => (getInput('quantity') < 0 ? 1 : getInput('quantity'))
		];

		if(!isset($_SESSION['cart'][$id])) {
			$_SESSION['cart'][$id][] = $data;

		}else {
			$tmp = $_SESSION['cart'][$id];
			$added = false;
			for ($i=0; $i < count($tmp); $i++) { 
				if($tmp[$i]['size'] == $data['size']) {
					$tmp[$i]['qty'] += $data['qty'];
					$added = true;
					break;
				}
			}
			if($added == false) {
				$tmp[] = $data;
			}
			$_SESSION['cart'][$id] = $tmp;
		}
	}

	$_SESSION['countCart'] = countCart();

	header("location: " . base_url() . "cart.php");
		// _debug($_SESSION['cart']);

	// session_destroy();

?>