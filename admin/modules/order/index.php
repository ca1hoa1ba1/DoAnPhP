<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'order';
  $table = true;
  if($_SERVER['REQUEST_METHOD'] == 'POST'){
    if(intval(strtotime(postInput('eday'))) >= intval(strtotime(postInput('sday')))) {
      $start = postInput('sday'). ' 00:00:01';
      $end = postInput('eday'). ' 23:59:59';
      $sql = "SELECT transaction.*,user.username FROM transaction LEFT JOIN user ON user.id = transaction.user_id WHERE transaction.create_at BETWEEN '{$start}' AND '{$end}'";
    }else {
      $_SESSION['error'] = 'Dữ liệu ngày không hợp lệ';
      $sql = "SELECT transaction.*,user.username FROM transaction LEFT JOIN user ON user.id = transaction.user_id";
    }

  }else {
    $sql = "SELECT transaction.*,user.username FROM transaction LEFT JOIN user ON user.id = transaction.user_id";
  }

  $orders = $db->fetchsql($sql);

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
          <li class="breadcrumb-item active">Order</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <?php include_once __DIR__ . "/../../../partials/notification.php"; ?>
          <div class="card-body">
            <div class="card-header row mb-3">
              <form class="col-md-8" action="" method="POST">
                <div class="form-group row">
                  <div class="col-md-5">
                     <label >Start</label>
                     <input type="date" name="sday" max="12-31-2022" 
                            min="01-01-2000" class="form-control" value="<?php echo postInput('sday'); ?>">
                  </div>
                  <div class="col-md-5">
                     <label >End</label>
                     <input type="date" name="eday" max="12-31-2022" 
                            min="01-01-2000" class="form-control" value="<?php echo postInput('eday'); ?>">
                  </div>
                  <div class="col-md-2 pt-4 mt-2">
                    <input type="submit" class="form-control btn btn-primary" value="Search">
                  </div>
                </div>
              </form>
              
            </div>
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>Order No</th>
                    <th>Username</th>
                    <th>Info</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Creat At</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <?php if(!empty($orders)) :?>
                  <tbody>
                    <?php foreach ($orders as  $item) : ?>
                      <tr>
                        <td>#<?php echo $item['id']; ?></td>
                        <td><?php echo $item['username'] ?></td>
                        <td><p><?php echo $item['info'] ?></p></td>
                        <td><?php echo $item['email'] ?></td>
                        <td><?php echo $item['phone'] ?></td>
                        <td class="text-center"><?php echo getStatus($item['status']) ?></td>
                        <td><?php echo format_price($item['amount']) ?></td>
                        <td><?php echo $item['create_at'] ?></td>
                        <td>  
                          <a href="detail.php?id=<?php echo $item['id']; ?>" class="text-primary">Detail</a>
                        </td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                <?php else  :?>
                  <h3>No results</h3>
                <?php endif; ?>
              </table>
            </div>
          </div>
        </div>
      </div>

<!-- /.container-fluid -->
<!-- Sticky Footer -->

<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>