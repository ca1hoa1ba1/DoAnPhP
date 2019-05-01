<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'order';
  $id = getInput('id');
  $transaction = $db->fetchSqlNum("SELECT amount FROM transaction WHERE id = {$id}");
  if($transaction == NULL) {
    echo "<script>alert(' Đơn hàng không tồn tại '); location.href='index.php'; </script>";
  }

  $items = $db->fetchsql("SELECT orders.*, product.namepro FROM orders LEFT JOIN product ON orders.product_id = product.id WHERE transaction_id = '{$id}'");
  if(empty($items)) {
    echo "<script>alert(' Đơn hàng không tồn tại '); location.href='index.php'; </script>";
  }

?>

<?php include_once __DIR__ . "/../../layouts/header.php"; ?>
<!-- Navbar  -->
<?php include_once __DIR__ . "/../../layouts/nav.php"; ?>

<div id="wrapper">

<!-- Sidebar -->
<?php include_once __DIR__ . "/../../layouts/sidebar.php"; ?>
    
    <div id="content-wrapper">
      <div class="container-fluid">
      <!-- Breadcrumbs-->
        <ol class="breadcrumb">
          <li class="breadcrumb-item">
            <a href="<?php echo base_url() ?>admin">Dashboard</a>
          </li>
          <li class="breadcrumb-item">
            <a href="index.php">Order</a>
          </li>
          <li class="breadcrumb-item active">Detail</li>
        </ol>
    
        <div class="row">
          <div class="col-md-8 mx-auto">
             <h2 class="h3 mb-3 text-black">Order No: #<?php echo $id; ?></h2>
             <div class="p-3 p-lg-5 border">
                <table class="table site-block-order-table mb-1">
                   <thead>
                      <th>Product</th>
                      <th>Total</th>
                   </thead>
                   <tbody>
                    <?php foreach ($items as $item): ?>
                      <tr>
                        <td><?php echo $item['namepro'];?> x <?php echo $item['qty'];?> ( <?php echo reSize($item['size']); ?> )</td>
                        <td><?php echo format_price($item['price']); ?></td>
                      </tr>
                    <?php endforeach ?>
                      <tr>
                         <td class="text-black font-weight-bold"><strong>Order Total</strong></td>
                         <td class="text-black font-weight-bold"><strong><?php echo format_price($transaction[0]) ?></strong></td>
                      </tr>
                   </tbody>
                </table>
             </div>
          </div>
       </div>

       <div class="row">
         <div class="col-md-4 mx-auto my-4">
           <form action="update.php" method="POST">
             <div class="form-group row">
               <div class="col-md-6">
                <input type="hidden" name="id" value="<?php echo $id; ?>">
                 <select class="form-control" name="status">
                   <option value="0">Pending</option>
                   <option value="1">Done</option>
                 </select>
               </div>
              <div class="col-md-6 pl-5">
                <button type="submit" class="btn btn-primary px-4" >Update</button>
              </div>
             </div>
           </form>
         </div>
       </div>
      </div>

<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>