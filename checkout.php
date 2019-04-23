<?php include_once __DIR__ . "/autoload/autoload.php"; 
if(!isset($_SESSION['userid'])) {
    echo "<script>alert(' Vui lòng đăng nhập tài khoản để mua sắm '); location.href='login.php'; </script>";
  }
 if(!isset($_SESSION['cart'])) {
  echo "<script>alert(' Giỏ hàng không có sản phẩm '); location.href='shop.php'; </script>";
 }


  $cart = $_SESSION['cart'];
  $info_user = $db->fetchID('user', intval($_SESSION['userid']));



?>
<?php include_once __DIR__ . '/layouts/header.php'; ?>


         <div class="bg-light py-3">
            <div class="container">
               <div class="row">
                  <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <a href="cart.html">Cart</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Checkout</strong></div>
               </div>
            </div>
         </div>
         <div class="site-section">
            <div class="container">
               <div class="row">
                  <div class="col-md-6 mb-5 mb-md-0">
                     <h2 class="h3 mb-3 text-black">Billing Details</h2>
                     <div class="p-3 p-lg-5 border">
                        <form action="addTransaction.php" method="post">
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="f_fname" class="text-black">FullName </label>
                              <input type="text" class="form-control" id="f_fname" name="f_fname" value="<?php echo $info_user['fullname']; ?>" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_address" class="text-black">Address </label>
                              <input type="text" class="form-control" id="c_address" name="c_address" placeholder="Street address" value="<?php echo $info_user['address']; ?>" required>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_state_country" class="text-black">State / Country </label>
                              <input type="text" class="form-control" id="c_state_country" name="c_state_country" value="<?php echo $info_user['state']; ?>" required>
                           </div>
                        </div>
                        <div class="form-group row mb-5">
                           <div class="col-md-6">
                              <label for="c_email_address" class="text-black">Email Address </label>
                              <input type="text" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo $info_user['email']; ?>" required>
                           </div>
                           <div class="col-md-6">
                              <label for="c_phone" class="text-black">Phone </label>
                              <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo $info_user['phone']; ?>" required>
                           </div>
                        </div>
                        <div class="form-group">
                           <label for="c_order_notes" class="text-black">Order Notes</label>
                           <textarea name="c_order_notes" id="c_order_notes" cols="30" rows="5" class="form-control" placeholder="Write your notes here..."></textarea>
                        </div>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="row mb-5">
                        <div class="col-md-12">
                           <h2 class="h3 mb-3 text-black">Your Order</h2>
                           <div class="p-3 p-lg-5 border">
                              <table class="table site-block-order-table mb-5">
                                 <thead>
                                    <th>Product</th>
                                    <th>Total</th>
                                 </thead>
                                 <tbody>
                                    <?php $totalCart = 0;  foreach ($cart as $items) :
                                          foreach ($items as $item) : ?>
                                             <tr>
                                                <td><?php echo strlen($item['namepro']) > 20 ? substr($item['namepro'], 0,20).'...' : $item['namepro'];
                          ?> <strong class="mx-2">x</strong> <?php echo $item['qty'] ?> (<strong class="mx-2"><?php echo reSize($item['size']) ?></strong>)</td>
                                                <td><?php $tmp = ($item['qty'] * $item['price']); echo format_price($tmp);?></td>
                                             </tr>
                                    <?php $totalCart += $tmp; 
                                          endforeach; 
                                          endforeach; ?>
                                    <tr>
                                       <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                                       <td class="text-black font-weight-bold"><strong><?php echo format_price($totalCart); $_SESSION['amountCart'] = $totalCart;?></strong></td>
                                    </tr>
                                 </tbody>
                              </table>
                              <div class="form-group">
                                 <button type="submit" class="btn btn-primary btn-lg py-3 btn-block">Place Order</button>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <!-- </form> -->
            </div>
         </div>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>
