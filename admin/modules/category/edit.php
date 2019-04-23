<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'category';
  $errors = [];
  $id = intval(getInput("id"));
  $EditCategory = $db->fetchID("category",$id);
  if(empty($EditCategory)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("category");
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
      'namecate' => postInput("namecate")
    ];

    if(postInput("namecate") == '') {
      $errors['namecate'] = "Vui lòng nhập tên mục";
    }

    if(empty($errors)) {
      if($data['namecate'] != $EditCategory['namecate']) {
        // Kiểm tra item 
        $isset = $db->fetchOne("category", " namecate = '" . $data['namecate'] . "' ");
        if (count($isset) > 0) {
            $_SESSION['error'] = "Tên mục đã tồn tại";
        }else {
          // Cập nhật item
          $id_update = $db->update("category", $data, array("id" => $id));
          if($id_update > 0) {
            $_SESSION['success'] = 'Cập nhập category thành công';
          }else {
            $_SESSION['error'] = 'Cập nhập category thất bại';
          }
          redirectAdmin('category');
        }
      }else {
        $_SESSION['error'] = 'Dữ liệu không thay đổi';
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
          <li class="breadcrumb-item active">Edit category</li>
        </ol>
    
        <div class="row">
            <div class="col-md-12">
              <?php include_once __DIR__ . "/../../../partials/notification.php" ?>
            <form class="col-md-8" action="" method="post">
                <div class="form-group row">
                    <label for="namecate" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="namecate" value="<?php echo isset($EditCategory['namecate']) ? $EditCategory['namecate'] : ''; ?>">
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