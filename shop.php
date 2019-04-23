<?php include_once __DIR__ . "/autoload/autoload.php"; $page_current = "shop";?>
<?php 
  ob_start();
  $category_current = getInput('shop') == '' ? '%' : getInput('shop');

  $p = getInput("p") != '' ? getInput("p") : 1;

  $sqlCountRow = "SELECT COUNT(product.id) FROM product INNER JOIN category on product.category_id = category.id and category.namecate LIKE '{$category_current}'";
  $totalRow = intval($db->fetchSqlNum($sqlCountRow)[0]);

  if($totalRow > 0) {
    $sql = "SELECT product.* FROM product INNER JOIN category on product.category_id = category.id and category.namecate LIKE '{$category_current}' ORDER BY product.id DESC";

    $items = $db->fetchJones('product', $sql, $totalRow, $p, 12, true);
    $sotrang = $items['page'];
    unset($items['page']);
  }else {
    $items = [];
    $sotrang = 1;
  }

?>

<?php include_once __DIR__ . '/layouts/header.php'; ?>

    <div class="bg-light py-3">
      <div class="container">
        <div class="row">
          <div class="col-md-12 mb-0"><a href="index.html">Home</a> <span class="mx-2 mb-0">/</span> <strong class="text-black">Shop</strong></div>
        </div>
      </div>
    </div>

    <div class="site-section">
      <div class="container">

        <div class="row mb-5">
          <div class="col-md-9 order-2">

            <div class="row">
              <div class="col-md-12 mb-5">
                <div class="float-md-left mb-4"><h2 class="text-black h5">Shop <?php echo getInput('shop') == '' ? 'All' : getInput('shop'); ?></h2></div>
              </div>
            </div>

            <div class="row mb-5">
              <?php if(count($items) == 0) {
                echo "<h1 class='ml-5'>There is no item</h1>";
              } 
              else {
              foreach ($items as $item) :?>
                <div class="col-sm-6 col-lg-4 mb-4" data-aos="fade-up">
                  <div class="block-4 text-center border" style="height: 305px;">
                    <figure class="block-4-image">
                      <a href="shop-single.php?product=<?php echo $item['id']; ?>"><img src="<?php echo uploads(); ?>product/<?php echo $item['thunbar']; ?>" alt="Image placeholder" class="img-fluid" style="height: 180px;"></a>
                    </figure>
                    <div class="block-4-text p-2">
                      <h3>
                        <a href="shop-single.php?product=<?php echo $item['id']; ?>">
                          <?php echo strlen($item['namepro']) > 35 ? substr($item['namepro'], 0,35).'...' : $item['namepro'];
                          ?>
                        </a>
                      </h3>
                      <p class="text-primary "><?php echo format_price($item['price']); ?></p>
                    </div>
                  </div>
                </div>
              <?php endforeach; }?>
            </div>


            <div class="row" data-aos="fade-up">
              <div class="col-md-12 text-center">
                <div class="site-block-27">
                  <ul>
                    <?php echo pages($sotrang,$p);?>
                  </ul>
                </div>
              </div>
            </div>
          </div>
          <!-- Sidebar Searching -->
          <?php include_once __DIR__ . '/layouts/sidebar.php' ?>
        </div>

        <div class="row">
          <div class="col-md-12">
            <div class="site-section site-blocks-2">
                <div class="row justify-content-center text-center mb-5">
                  <div class="col-md-7 site-section-heading pt-4">
                    <h2>Categories</h2>
                  </div>
                </div>
                <?php include_once __DIR__ . '/layouts/category.php'; ?>
              
            </div>
          </div>
        </div>
        
      </div>
    </div>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>