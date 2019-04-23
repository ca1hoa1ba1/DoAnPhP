<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'user';
  $table = true;
  $users = $db->fetchAll("user");
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
          <div class="card-body">
            <div class="table-responsive">
              <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                  <tr>
                    <th>STT</th>
                    <th>Username</th>
                    <th>Fullname</th>
                    <th>Info</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Create_at</th>
                    <th>Action</th>
                  </tr>
                </thead>
                <tbody>
                  <?php $i = 1; foreach ($users as  $user) : ?>
                    <tr>
                      <td><?php echo $i; ?></td>
                      <td><?php echo $user['username'] ?></td>
                      <td><?php echo $user['fullname'] ?></td>
                      <td><?php echo $user['address'] . ', ' . $user['state']; ?></td>
                      <td><?php echo $user['email'] ?></td>
                      <td><?php echo $user['phone'] ?></td>
                      <td><?php echo $user['create_at'] ?></td>
                      <td>  
                        <a href="delete.php?id=<?php echo $user['id']; ?>" class="btn btn-danger"><i class="fas fa-trash-alt"></i></a>
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