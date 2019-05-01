<?php include_once __DIR__ . "/../../autoload/autoload.php";
	if($_SERVER['REQUEST_METHOD'] == 'POST') {
		$status_current = $db->fetchID('transaction', $_POST['id'])['status'];
		if(postInput('status') != $status_current) {
			$status_current = postInput('status');
			$foo = $db->update('transaction', array('status' => $status_current), array('id' => $_POST['id']));

			if($foo > 0) {
				$_SESSION['success'] = "Update thành công";
			}else {
				$_SESSION['error'] = "Update không thành công";
			}
		}
	}

	redirectAdmin('order');


 ?>