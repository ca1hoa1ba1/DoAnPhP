<?php include_once __DIR__ . "/autoload/autoload.php"; 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $info = "";
    if(postInput('f_fname') != '') {
      $info .= 'Name: ' . postInput('f_fname');
    }
    if(postInput('c_address') != '') {
      $info .= ', address: ' . postInput('c_address');
    }
    if(postInput('c_state_country') != '') {
      $info .= ', state: ' . postInput('c_state_country');
    }
    if(postInput('c_order_notes') != '') {
      $info .= ', notes: ' . postInput('c_order_notes');
    }
    $data = [
      'amount' => intval($_SESSION['amountCart']),
      'user_id' => intval($_SESSION['userid']),
      'phone' => postInput('c_phone'),
      'info' => $info,
      'email' => postInput('c_email_address')
    ];

    $transaction_insert = $db->insert('transaction', $data);
    if($transaction_insert > 0) {
      foreach ($_SESSION['cart'] as $id => $items) {
        foreach ($items as $index => $item) {

          $orders = [
            'transaction_id' => $transaction_insert,
            'product_id' => $id,
            'size' => $item['size'],
            'qty' => $item['qty'],
            'price' => ($item['price'] * $item['qty'])
          ];

          $order_insert = $db->insert('orders', $orders);

          if($order_insert > 0) {
            $product = $db->fetchID('product', $orders['product_id']);
            $updateStock = $product[$orders['size']] - $orders['qty'];

            if($updateStock < 0) {
              header("location: " . base_url() . '404.php');
            }else {
              $updateProduct = array_combine(array($orders['size']), array($updateStock));
              $success = $db->update('product', $updateProduct, array('id'=> $orders['product_id']));
              if($success <= 0) {
                die('404 Truy van loi~');
              }
            }
          }else {
                die('404 Truy van loi~');
          }
        }
      }
    }else {
      header("location: " . base_url() . '404.php');
    }
    unset($_SESSION['cart']);
    unset($_SESSION['countCart']);
    unset($_SESSION['amountCart']);

     header("location: " . base_url() . 'thankyou.php');

  }
?>
