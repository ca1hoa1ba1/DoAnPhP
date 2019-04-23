<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'tag';
  $errors = [];
  $id = intval(getInput("id"));
  $EditTag = $db->fetchID("tag",$id);
  if(empty($EditTag)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("tag");
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
      'nametag' => postInput("nametag"),
      'slug' => to_slug(postInput(("nametag")))
    ];

    if(postInput("nametag") == '') {
      $errors['nametag'] = "Vui lòng nhập tên mục";
    }

    if(empty($errors)) {
      if($data['nametag'] != $EditTag['nametag']) {
        // Kiểm tra item 
        $isset = $db->fetchOne("tag", " nametag = '" . $data['nametag'] . "' ");
        if (count($isset) > 0) {
            $_SESSION['error'] = "Tên tag đã tồn tại";
        }else {
          // Cập nhật item
          $id_update = $db->update("tag", $data, array("id" => $id));
          if($id_update > 0) {
            $_SESSION['success'] = 'Cập nhập tag thành công';
          }else {
            $_SESSION['error'] = 'Cập nhập tag thất bại';
          }
          redirectAdmin('tag');
        }
      }else {
        $_SESSION['error'] = 'Dữ liệu không thay đổi';
        redirectAdmin('tag');
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
            <a href="index.php">Tag</a>
          </li>
          <li class="breadcrumb-item active">Edit tag</li>
        </ol>
    
        <div class="row">
            <div class="col-md-12">
              <?php include_once __DIR__ . "/../../../partials/notification.php" ?>
            <form class="col-md-8" action="" method="post">
                <div class="form-group row">
                    <label for="nametag" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="nametag" value="<?php echo isset($EditTag['nametag']) ? $EditTag['nametag'] : ''; ?>">
                        <?php if(isset($errors['nametag'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['nametag']; ?></div>
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