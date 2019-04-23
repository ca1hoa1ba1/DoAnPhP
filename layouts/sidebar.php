<div class="col-md-3 order-1 mb-5 mb-md-0">
            <div class="border p-4 rounded mb-4">
              <form action="search.php" method="post">
              <div class="mb-4">
                <h2 class="mb-3 h6 text-uppercase text-black d-block">Searching</h2>
                <input type="text" name="adsearch" class="form-control pl-2 bg-white" placeholder="Searching .....">
                <input type="submit" name="submit" class="btn btn-primary mt-2 float-right" value="Search">
              </div>
              <div class="clearfix"></div>
              <div class="mt-2 mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Price</h3>
                <div id="slider-range" class="border-primary"></div>

                <input type="text" name="prices" id="amount" class="form-control border-0 pl-0 bg-white"  readonly="readonly"/>
              </div>

              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Size</h3>
                <label for="s_sm" class="d-flex">
                  <input type="checkbox" name="size[]" value="size_sm" class="mr-2 mt-1"> <span class="text-black">Small</span>
                </label>
                <label for="s_md" class="d-flex">
                  <input type="checkbox" name="size[]" value="size_md"  class="mr-2 mt-1"> <span class="text-black">Medium</span>
                </label>
                <label for="s_lg" class="d-flex">
                  <input type="checkbox" name="size[]" value="size_lg" class="mr-2 mt-1"> <span class="text-black">Large</span>
                </label>
                <label for="s_lg" class="d-flex">
                  <input type="checkbox" name="size[]" value="size_xl" class="mr-2 mt-1"> <span class="text-black">Extra Large</span>
                </label>
              </div>
              <div class="mb-4">
                <h3 class="mb-3 h6 text-uppercase text-black d-block">Tag</h3>
                <?php $tags = $db->fetchAll("tag") ;
                  foreach ($tags as $item) :?>
                    <label for="s_sm" class="d-flex">
                      <input type="checkbox" name="tag[]" value="<?php echo $item['slug'] ?>" class="mr-2 mt-1"> <span class="text-black"><?php echo $item['nametag'] ?></span>
                    </label>
                <?php endforeach; ?>
              </div>
              </form>
            </div>
          </div>