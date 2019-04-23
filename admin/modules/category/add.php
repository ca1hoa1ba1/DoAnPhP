<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'category';
  $errors = [];

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
      'namecate' => postInput("namecate")
    ];

    if(postInput("namecate") == '') {
      $errors['namecate'] = "Vui lòng nhập tên mục";
    }

    if(empty($errors)) {
    $isset = $db->fetchOne("category", " namecate = '" . $data['namecate'] . "' ");
    if (count($isset) > 0) {
        $_SESSION['error'] = "Tên mục đã tồn tại";
    }else {
      $id_insert = $db->insert("category", $data);
      if($id_insert > 0) {
        $_SESSION['success'] = 'Thêm category mới thành công';
      }else {
        $_SESSION['error'] = 'Thêm category thất bại';
      }
      redirectAdmin('category');
    }
   }
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
            <a href="index.php">Category</a>
          </li>
          <li class="breadcrumb-item active">Add new</li>
        </ol>
    
        <div class="row">
            <div class="col-md-12">
              <?php include_once __DIR__ . "/../../../partials/notification.php" ?>
            <form class="col-md-8" action="" method="post">
                <div class="form-group row">
                    <label for="namecate" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="namecate">
                        <?php if(isset($errors['namecate'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['namecate']; ?></div>
                        <?php endif; ?>
                    </div> 
                </div>
                <div class="form-group row float-right">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Add</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
      </div>

<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>