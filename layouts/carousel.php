 <div class="row">
          <div class="col-md-12">
            <div class="nonloop-block-3 owl-carousel">
              <?php $sql = "1 ORDER BY id DESC ";
              $newArrivals = $db->fetchLimit('product', $sql, 6);
              foreach ($newArrivals as $item): ?>
                <div class="item">
                <div class="block-4 text-center" style="height: 455px;">
                  <figure class="block-4-image">
                    <img src="<?php echo uploads() ?>product/<?php echo $item['thunbar']; ?>" alt="Image placeholder" style="height: 300px;" class="img-fluid">
                  </figure>
                  <div class="block-4-text p-4">
                    <h3><a href="shop-single.php?product=<?php echo $item['id']; ?>"><?php echo strlen($item['namepro']) > 45 ? substr($item['namepro'], 0,45).'...' : $item['namepro'];
                          ?></a></h3>

                    <p class="text-primary"><?php echo format_price($item['price']); ?></p>
                  </div>
                </div>
              </div>
              <?php endforeach ?>
              
            </div>
          </div>
        </div>