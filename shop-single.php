<?php include_once __DIR__ . "/autoload/autoload.php"; 
  $page_current = "shop"; 
  if (getInput('product') != '') {
    $id = getInput('product');
    $product = $db->fetchID('product', $id);
    if($product == NULL) {
      header("location: " . base_url() . '404.php');
    }
  }else {
    header("location: " . base_url() . '404.php');
  }
?>
  <!-- $product -->
<?php include_once __DIR__ . '/layouts/header.php'; ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.php">Home</a> <span class="mx-2 mb-0">/</span>  <a href="shop.php">Shop</a> <span class="mx-2 mb-0">/</span> <strong class="text-black"><?php echo $product['namepro']; ?></strong></div>
        </div>
      </div>
    </div>  

    <div class="site-section">
      <div class="container">
        <div class="row">
          <div class="col-md-6">
            <img src="<?php echo uploads() . 'product/' . $product['thunbar'];?>" alt="Image" class="img-fluid">
          </div>
          <div class="col-md-6">
            <h2 class="text-black"><?php echo $product['namepro']; ?></h2>
            <p><?php echo $product['description']; ?></p>
            <p><strong class="text-primary h4"><?php echo format_price($product['price']); ?></strong></p>
            <form action="addCart.php" method="get">
            <input type="hidden" name="product" value="<?php echo $product['id']; ?>" hi>
            <div class="mb-1 d-flex">
              <?php if ($product['size_sm'] <= 0 && $product['size_md'] <= 0 && $product['size_lg'] <= 0 && $product['size_xl'] <= 0){
                $outOfStock = "Sản phẩm đã hết hàng";
                echo "<h3 class='text-danger'>{$outOfStock}</h3>";
              } else { $flag = false;?>
              <?php if ($product['size_sm'] > 0): ?>
                <label for="option-sm" class="d-flex mr-3 mb-3">
                  <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                    <input type="radio" 
                    id="option-sm" 
                    name="shop-sizes" 
                    value="size_sm" 
                    data-max = "<?php echo $product['size_sm']; ?>" 
                    <?php if($flag == false) {
                      $flag = $product['size_sm'];
                      echo 'checked';
                    }?> >
                  </span> 
                  <span class="d-inline-block text-black">Small</span>
                </label>
              <?php endif ?>

              <?php if ($product['size_md'] > 0): ?>
                <label for="option-md" class="d-flex mr-3 mb-3">
                  <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                    <input type="radio" 
                    id="option-md" 
                    name="shop-sizes"
                    value="size_md" 
                    data-max = "<?php echo $product['size_md']; ?>" 
                    <?php if($flag == false) {
                      $flag = $product['size_md'];
                      echo 'checked';
                    }?> >
                  </span> 
                  <span class="d-inline-block text-black">Medium</span>
                </label>
              <?php endif ?>

              <?php if ($product['size_lg'] > 0): ?>
                <label for="option-lg" class="d-flex mr-3 mb-3">
                  <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                    <input type="radio" 
                    id="option-lg" 
                    name="shop-sizes" 
                    value="size_lg" 
                    data-max = "<?php echo $product['size_lg']; ?>" 
                    <?php if($flag == false) {
                      $flag = $product['size_lg'];
                      echo 'checked';
                    }?> >
                  </span> 
                  <span class="d-inline-block text-black">Large</span>
                </label>
              <?php endif ?>

              <?php if ($product['size_xl'] > 0): ?>
                <label for="option-xl" class="d-flex mr-3 mb-3">
                  <span class="d-inline-block mr-2" style="top:-2px; position: relative;">
                    <input type="radio" 
                    id="option-xl" 
                    name="shop-sizes" 
                    value="size_xl" 
                    data-max = "<?php echo $product['size_xl']; ?>" 
                    <?php if($flag == false) {
                      $flag = $product['size_xl'];
                      echo 'checked';
                    }?> >
                  </span> 
                  <span class="d-inline-block text-black">Extra Large</span>
                </label>
              <?php endif ?>

              <?php } ?>

            </div>
            <?php if (!isset($outOfStock)): ?>
              <div class="mb-5">
              <div class="input-group mb-3" style="max-width: 120px;">
              <div class="input-group-prepend">
                <button class="btn btn-outline-primary js-btn-minus" type="button">&minus;</button>
              </div>
              <input type="text" class="form-control text-center" value="1" max='<?php echo $flag; ?>' placeholder="" name="quantity" aria-label="Example text with button addon" aria-describedby="button-addon1" readonly="">
              <div class="input-group-append">
                <button class="btn btn-outline-primary js-btn-plus" type="button" >&plus;</button>
              </div>
            </div>

            </div>
            <?php if(isset($_SESSION['notification'])) {
                    echo "<p class='text-warning'>". $_SESSION['notification'] . "</p>";
                    unset($_SESSION['notification']);
            }?>
              <p>
                <input type="submit" class="buy-now btn btn-sm btn-primary" name="submit" value="Add To Cart">
              </p>
            <?php endif ?>
            </form>
          </div>
        </div>
      </div>
    </div>

    <div class="site-section block-3 site-blocks-2 bg-light">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-7 site-section-heading text-center pt-4">
            <h2>Featured Products</h2>
          </div>
        </div>
           <?php include_once __DIR__ . '/layouts/carousel.php'; ?>
      </div>
    </div>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>
