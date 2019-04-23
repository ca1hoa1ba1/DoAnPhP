<?php include_once __DIR__ . "/autoload/autoload.php"; 
if(!isset($_SESSION['userid'])) {
    echo "<script>alert(' Vui lòng đăng nhập tài khoản để mua sắm '); location.href='login.php'; </script>";
  }
 if(!isset($_SESSION['cart'])) {
  echo "<script>alert(' Giỏ hàng không có sản phẩm '); location.href='shop.php'; </script>";
 }else {
  $cart = $_SESSION['cart'];
 }
  
?>
<?php include_once __DIR__ . '/layouts/header.php'; ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Cart</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">
        <div class="row mb-5">
          <form class="col-md-12" method="post">
            <div class="site-blocks-table">
              <table class="table table-bordered">
                <thead>
                  <tr>
                    <th class="product-thunbar">Image</th>
                    <th class="product-info">Info</th>
                    <th class="product-qty">Quantity</th>
                    <th class="product-total">Total</th>
                    <th class="product-remove">Action</th>
                  </tr>
                </thead>
                <tbody>

                  <?php $totalCart = 0; 
                  foreach ($cart as $id => $items): ?>
                    <?php foreach ($items as $index => $item): ?>
                      <tr>
                        <td style="width: 100px">
                          <a href="shop-single.php?product=<?php echo $id; ?>"><img src="<?php echo uploads() . "product/" . $item['thunbar']; ?>" alt="Image" style="width: 100px ;height: 100px;"></a>
                          
                        </td>
                        <td class="product-name" style="width: 300px">
                          <ul class="list-unstyled">
                            <li><h2 class="h5 text-black d-inline">Name: <?php echo strlen($item['namepro']) > 25 ? substr($item['namepro'], 0,25).'...' : $item['namepro'];
                              ?></h2></li>
                            <li><p class="m-0 d-inline"></p><span class="font-weight-bold">Price:</span> <?php echo format_price($item['price']); ?></li>
                            <li>
                              <p class="m-0 d-inline"><span class="font-weight-bold">Size:</span> <?php echo reSize($item['size']); ?></p>
                              <span> - </span>
                              <p class="m-0 d-inline"><span class="font-weight-bold">Quantities:</span> <?php echo $item['qty']; ?></p>
                            </li>
                          </ul>
                        </td>
                        <td>
                          <div class="input-group mb-1 mx-auto" style="width: 120px;">
                            <div class="input-group-prepend">
                              <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
                            </div>
                            <input type="text" class="form-control text-center qty" value="1" placeholder="" aria-label="Example text with button addon" aria-describedby="button-addon1" name="quantity" max='<?php echo $item['max'] ?>' readonly="">
                            <div class="input-group-append">
                              <button class="btn btn-outline-primary js-btn-plus" type="button">&plus;</button>
                            </div>
                          </div>

                        </td>
                        <td><p class="text-wrap">$<?php echo ($item['price'] * $item['qty']) ?></p></td>
                        <td>
                          <a href="#" class="btn btn-primary btn-sm updateCart" data-key="<?php echo $id; ?>" data-index="<?php echo $index; ?>"><i class="fas fa-redo-alt"></i></a>
                          <a href="#" class="btn btn-danger btn-sm deleteCart" data-key="<?php echo $id; ?>" data-index="<?php echo $index; ?>"><i class="fas fa-times"></i></a>
                        </td>
                      </tr>
                      <?php $totalCart += ($item['price'] * $item['qty']); ?>
                    <?php endforeach ?>
                  <?php endforeach ?>

                </tbody>
              </table>
            </div>
          </form>
        </div>

        <div class="row">
          <div class="col-md-6">
            <div class="row mb-5">
              <div class="col-md-6">
                <a class="btn btn-outline-primary btn-sm btn-block" href="shop.php">Continue Shopping</a>
              </div>
            </div>
          </div>
          <div class="col-md-6 pl-5">
            <div class="row justify-content-end">
              <div class="col-md-7">
                <div class="row">
                  <div class="col-md-12 text-right border-bottom mb-5">
                    <h3 class="text-black h4 text-uppercase">Cart Totals</h3>
                  </div>
                </div>
                <div class="row mb-5">
                  <div class="col-md-6">
                    <span class="text-black">Total</span>
                  </div>
                  <div class="col-md-6 text-right">
                    <strong class="text-black"><?php echo format_price($totalCart); ?></strong>
                  </div>
                </div>

                <div class="row">
                  <div class="col-md-12">
                    <button class="btn btn-primary btn-lg py-3 btn-block" onclick="window.location='checkout.php'">Proceed To Checkout</button>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>