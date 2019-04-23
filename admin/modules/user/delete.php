<?php 
    include_once __DIR__ . "/../../autoload/autoload.php";

    $id = intval(getInput('id'));

    $deleteUser = $db->fetchID("user",$id);
    if(empty($deleteUser)) {
        $_SESSION['error'] = "Dữ liệu không tồn tại";
        redirectAdmin("user");
    }

    /**
     * Check item of cate
     */
    $has_transaction = $db->fetchOne("transaction", "user_id = {$id} ");
    if($has_transaction == NULL) {
        $user_deleted = $db->delete("user", $id);
        if($user_deleted > 0) {
            $_SESSION['success'] = "Xóa user thành công";
        }else {
            $_SESSION['error'] = "Xóa user thất bại";
        }
        redirectAdmin("user");
    }else {
        $orders_deleted = $db->deletesql('orders', "transaction_id IN (SELECT id FROM transaction WHERE user_id = {$id})");
        $transaction_deleted = $db->deletesql('transaction', "user_id = {$id}");
        $user_deleted = $db->delete("user", $id);
        if($user_deleted > 0) {
            $_SESSION['success'] = "Xóa user thành công";
        }else {
            $_SESSION['error'] = "Xóa user thất bại";
        }
        redirectAdmin("user");
    }
?>