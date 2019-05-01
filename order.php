<?php include_once __DIR__ . "/autoload/autoload.php"; 
   if(!isset($_SESSION['userid'])) {
    echo "<script>alert(' Vui lòng đăng nhập tài khoản'); location.href='login.php'; </script>";
  }else {
    $id = intval($_SESSION['userid']);
  }

  $orderId = intval(getInput('o'));
  if($orderId == '') {
   header("location: index.php");
  }
  $sql = "user_id = {$id} AND id = {$orderId} ";

  $transaction = $db->fetchOne('transaction', $sql);
  $totalOrder = $transaction['amount'];
  if($transaction > 0) {
   unset($transaction);
   $sql = "SELECT orders.*, product.namepro FROM orders LEFT JOIN product ON product.id = orders.product_id WHERE transaction_id = {$orderId}";
   $orders = $db->fetchsql($sql);
  }else {
   header("location: profile.php");
  }



?>
<?php include_once __DIR__ . '/layouts/header.php'; ?>


         <div class="bg-light py-3">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span> <a href="profile.php">Profile</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Order</strong></div>
               </div>
            </div>
         </div>
         <div class="site-section">
            <div class="container">
               <div class="row">
                  <div class="col-md-8 mx-auto">
                     <h2 class="h3 mb-3 text-black">Your Order</h2>
                     <div class="p-3 p-lg-5 border">
                        <table class="table site-block-order-table mb-1">
                           <thead>
                              <th>Product</th>
                              <th>Total</th>
                           </thead>
                           <tbody>
                              <?php foreach ($orders as $item) : ?>
                                       <tr>
                                          <td><?php echo strlen($item['namepro']) > 30 ? substr($item['namepro'], 0,30).'...' : $item['namepro'];?> <strong class="mx-2">x</strong> <?php echo $item['qty'] ?> (<strong class="mx-2"><?php echo reSize($item['size']) ?></strong>)</td>
                                          <td><?php  echo format_price($item['price']);?></td>
                                       </tr>
                              <?php endforeach; ?>
                              <tr>
                                 <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                 <td class="text-black font-weight-bold"><strong><?php echo format_price($totalOrder);?></strong></td>
                              </tr>
                           </tbody>
                        </table>
                     </div>
                  </div>
               </div>
            </div>
         </div>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>
