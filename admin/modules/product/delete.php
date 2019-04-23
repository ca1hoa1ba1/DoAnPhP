<?php 
    include_once __DIR__ . "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $DeleteCategory = $db->fetchID("product",$id);
    if(empty($DeleteCategory)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("product");
    }
    
    $num = $db->delete("product", $id);
    if($num > 0) {
        $_SESSION['success'] = "Xóa product thành công";
    }else {
        $_SESSION['error'] = "Xóa product thất bại";
    }
    redirectAdmin("product");
?>