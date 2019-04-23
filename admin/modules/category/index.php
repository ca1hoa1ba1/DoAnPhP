<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'category';
  $table = true;
  $categories = $db->fetchAll("category");

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
          <li class="breadcrumb-item active">Category</li>
        </ol>

        <!-- DataTables Example -->
        <div class="card mb-3">
          <?php include_once __DIR__ . "/../../../partials/notification.php"; ?>
          <div class="card-header">
            <a href="add.php" class="btn btn-primary">Add new category</a>
          </div>
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Name</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($categories as  $item) : ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $item['namecate'] ?></td>
                      <td>  
                        <a href="edit.php?id=<?php echo $item['id']; ?>" class="btn btn-secondary"><i class="fas fa-edit"></i></a>
                        <a href="delete.php?id=<?php echo $item['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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