<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'product';
  $table = true;
  $sql = "SELECT product.*, category.namecate, tag.nametag FROM product LEFT JOIN category on product.category_id = category.id LEFT JOIN tag on product.tag_id = tag.id ORDER BY product.id DESC";
  $products = $db->fetchsql($sql);

?>

<?php include_once __DIR__ . "/../../layouts/header.php"; ?>
<!-- Navbar  -->
<?php include_once __DIR__ . "/../../layouts/nav.php"; ?>

<div id="wrapper">

<!-- Sidebar -->
<?php include_once __DIR__ . "/../../layouts/sidebar.php"; ?>
    
    <div id="content-wrapper">

      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url() ?>admin">Dashboard</a>
          </li>
          <li class="breadcrumb-item active">Product</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <?php include_once __DIR__ . "/../../../partials/notification.php"; ?>
          <div class="card-header">
            <a href="add.php" class="btn btn-primary">Add new product</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Category</th>
                    <th>Tag</th>
                    <th>Price</th>
                    <th>Thunbar</th>
                    <th>Quantities</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($products as  $item) : ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item['namepro'] ?></td>
                      <td><?php echo $item['namecate'] ?></td>
                      <td><?php echo $item['nametag'] ?></td>
                      <td><?php echo $item['price'] ?></td>
                      <td>
                        <img src="<?php echo uploads(). 'product/' .$item['thunbar']; ?>" style="width: 50px; height: 50px;">
                      </td>
                      <td>
                        <ul>
                          <li>Small: <?php echo $item['size_sm'] ?></li>
                          <li>Medium: <?php echo $item['size_md'] ?></li>
                          <li>Large: <?php echo $item['size_lg'] ?></li>
                          <li>XL: <?php echo $item['size_xl'] ?></li>
                        </ul>
                      </td>
                      <td>  
                        <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger btn-del"><i class="fas fa-trash-alt"></i></a>
                      </td>
                    </tr>
                  <?php $i++; endforeach; ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>

<!-- /.container-fluid -->
<!-- Sticky Footer -->

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>