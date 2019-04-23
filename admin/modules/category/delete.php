<?php 
    include_once __DIR__ . "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $DeleteCategory = $db->fetchID("category",$id);
    if(empty($DeleteCategory)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
    }

    /**
     * Check item of cate
     */
    $has_product = $db->fetchOne("product", "category_id = {$id} ");
    if($has_product == NULL) {
        $num = $db->delete("category", $id);
        if($num > 0) {
            $_SESSION['success'] = "Xóa category thành công";
        }else {
            $_SESSION['error'] = "Xóa category thất bại";
        }
        redirectAdmin("category");
    }else {
        $_SESSION['error'] = "Can not delete this category - the category '{$DeleteCategory['namecate']}' has products";
        redirectAdmin("category");
    }
?>