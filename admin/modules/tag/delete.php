<?php 
    include_once __DIR__ . "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $DeleteTag = $db->fetchID("tag",$id);
    if(empty($DeleteTag)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("tag");
    }

    /**
     * Check item of cate
     */
    $has_product = $db->fetchOne("product", " tag_id  = {$id} ");
    if($has_product == NULL) {
        $num = $db->delete("tag", $id);
        if($num > 0) {
            $_SESSION['success'] = "Xóa tag thành công";
        }else {
            $_SESSION['error'] = "Xóa tag thất bại";
        }
        redirectAdmin("tag");
    }else {
        $_SESSION['error'] = "Can not delete this tag - the tag '{$DeleteTag['namecate']}' has products";
        redirectAdmin("tag");
    }
?>