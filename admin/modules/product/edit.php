<?php
  include_once __DIR__ . "/../../autoload/autoload.php";
  $open = 'product';
  $errors = [];
  // get Category
  $id = intval(getInput("id"));
  $EditProduct = $db->fetchID("product", $id);
  if(empty($EditProduct)) {
    $_SESSION['error'] = "Dữ liệu không tồn tại";
    redirectAdmin("product");
  }

  $Category = $db->fetchAll("category");
  $Tags = $db->fetchAll("tag");


  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
      'namepro' => postInput("namepro"),
      'slug' => to_slug(postInput('namepro')),
      'category_id' => postInput("category_id"),
      'tag_id' => postInput('tag_id'),
      'price' => postInput('price'),
      'description' => postInput('description'),
      'size_sm' => postInput('size_sm'),
      'size_md' => postInput('size_md'),
      'size_lg' => postInput('size_lg'),
      'size_xl' => postInput('size_xl')
    ];

    if($data['namepro'] == '') {
      $errors['namepro'] = "Vui lòng nhập tên product";
    }
    if($data['category_id'] == '') {
      $errors['category_id'] = "Vui lòng chọn category";
    }
    if($data['tag_id'] == '') {
      $errors['tag_id'] = "Vui lòng nhập tag";
    }
    if($data['price'] == '' || $data['price'] < 0) {
      $errors['price'] = "Vui lòng nhập lại giá tiền";
    }
    if($data['description'] == '') {
      $errors['description'] = "Vui lòng nhập mô tả product";
    }
    if($data['size_sm'] == '' || $data['size_md'] == '' || $data['size_lg'] == '' || $data['size_xl'] == '') {
      $errors['quantity'] = "Vui lòng nhập quantitiy";
    }
    if($data['size_sm'] < 0 || $data['size_md'] < 0 || $data['size_lg'] < 0 || $data['size_xl'] < 0) {
      $errors['quantity'] = "Quantity phải là số dương";
    }

    // if(!isset($_FILES['thunbar'])) {
    //   $errors['thunbar'] = "Vui lòng chọn hình ảnh cho product";
    // }
    if(empty($errors)) {
    $isset = $db->fetchOne("product", " namepro = '" . $data['namepro'] . "' ");
    if (count($isset) > 0 && $EditProduct['namepro'] != $data['namepro']) {
        $_SESSION['error'] = "Tên product đã tồn tại";
    }else {
      if( isset($_FILES['thunbar'])) {
          $file_name = $_FILES['thunbar']['name'];
          $file_tmp = $_FILES['thunbar']['tmp_name'];
          $file_error = $_FILES['thunbar']['error'];
          $get_type = explode('.', $file_name);
          $file_type = $get_type[count($get_type)-1];
          if($file_error == 0) {
              $path = ROOT . "/product/";
              $data['thunbar'] = $data['slug'].'.'.$file_type;
          }
      }
      $id_update = $db->update("product", $data, array("id" => $id));
      if($id_update > 0) {
        if(isset($data['thunbar'])) {
          move_uploaded_file($file_tmp, $path.$data['thunbar']);
        }
        $_SESSION['success'] = 'Cập nhật product thành công';
      }else {
        $_SESSION['error'] = 'Cập nhật product thất bại';
      }
      redirectAdmin('product');
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
            <a href="index.php">Product</a>
          </li>
          <li class="breadcrumb-item active">Edit product</li>
        </ol>
    
        <div class="row">
            <div class="col-md-12">
            <form class="col-md-8" action="" method="post" enctype="multipart/form-data">
                <div class="form-group row">
                    <label for="category_id" class="col-sm-2 col-form-label">Category</label>
                    <div class="col-sm-3 mt-1">
                      <select name="category_id">
                        <option value=''>Choose Category</option>
                        <?php foreach ($Category as $item) : ?>
                          <option value="<?php echo $item['id']; ?>" <?php echo isset($EditProduct['category_id']) && $EditProduct['category_id'] == $item['id'] ? "selected='selected'" : '' ?>><?php echo $item['namecate']; ?></option>
                        <?php endforeach; ?>
                      </select>
                      <?php if(isset($errors['category_id'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['category_id']; ?></div>
                        <?php endif; ?>
                    </div> 
                    <label for="tag_id" class="col-sm-2 col-form-label">Tag</label>
                    <div class="col-sm-5">
                        <select name="tag_id">
                        <option value=''>Choose Tag</option>
                        <?php foreach ($Tags as $item) : ?>
                          <option value="<?php echo $item['id']; ?>" <?php echo isset($EditProduct['tag_id']) && $EditProduct['tag_id'] == $item['id'] ? "selected='selected'" : '' ?>><?php echo $item['nametag']; ?></option>
                        <?php endforeach; ?>
                      </select>
                        <?php if(isset($errors['tag_id'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['tag_id']; ?></div>
                        <?php endif; ?>
                    </div> 
                </div>
                <div class="form-group row">
                    <label for="namepro" class="col-sm-2 col-form-label">Name Product</label>
                    <div class="col-sm-10">
                        <input type="text" class="form-control" name="namepro" value="<?php echo isset($EditProduct['namepro']) ? $EditProduct['namepro'] : ''; ?>">
                        <?php if(isset($errors['namepro'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['namepro']; ?></div>
                        <?php endif; ?>
                        <?php include_once __DIR__ . "/../../../partials/notification.php" ?>
                    </div> 
                </div>
                <div class="form-group row mt-4">
                    <label for="description" class="col-sm-2 col-form-label">Description</label>
                    <div class="col-sm-10">
                        <textarea class="form-control mt-2" name="description" row="4"><?php echo isset($EditProduct['description']) ? $EditProduct['description'] : ''; ?></textarea>
                        <?php if(isset($errors['description'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['description']; ?></div>
                        <?php endif; ?>
                    </div> 
                </div>
                <div class="form-group row">
                    <label for="price" class="col-sm-2 col-form-label">Price</label>
                    <div class="col-sm-3">
                        <input type="number" class="form-control" name="price" placeholder="1.000$" value="<?php echo isset($EditProduct['price']) ? $EditProduct['price'] : ''; ?>">
                        <?php if(isset($errors['price'])) : ?>
                          <div class="alert alert-danger mt-2"><?php echo $errors['price']; ?></div>
                        <?php endif; ?>
                    </div> 
                    <label for="thunbar" class="col-sm-2 col-form-label">Image</label>
                    <div class="col-sm-5">
                      <div class="set-height"  style="height: 40px;">
                        <input type="file" class="form-control" style="height: 100%;" name="thunbar">
                        <img src="<?php echo uploads().'product/'. $EditProduct['thunbar']; ?>" style="width: 50px;height: 50px;" alt="">
                      </div>
                        <?php if(isset($errors['thunbar'])) : ?>
                          <div class="alert alert-danger mt-2 mb-2"><?php echo $errors['thunbar']; ?></div>
                        <?php endif; ?>
                    </div> 
                </div>
                
                <div class="form-group row">
                  <label class="col-sm-2 col-form-label">Quantity</label> 
                  <?php if(isset($errors['quantity'])) : ?>
                  <div class="col-sm-10">
                    <div class="alert alert-danger">
                      <?php echo $errors['quantity']; ?>
                    </div>
                  </div>
                  <?php endif; ?>
                </div>
                <div class="form-group row">
                    <label for="size_sm" class="col-sm-1 col-form-label">Small</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="size_sm" value="<?php echo isset($EditProduct['size_sm']) ? $EditProduct['size_sm'] : 0; ?>">
                    </div> 
                    <label for="size_md" class="col-sm-1 col-form-label">Medium</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="size_md" value="<?php echo isset($EditProduct['size_md']) ? $EditProduct['size_md'] : 0; ?>">
                    </div> 
                    <label for="size_lg" class="col-sm-1 col-form-label">Large</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="size_lg" value="<?php echo isset($EditProduct['size_lg']) ? $EditProduct['size_lg'] : 0; ?>">
                    </div> 
                    <label for="size_xl" class="col-sm-1 col-form-label">XL</label>
                    <div class="col-sm-2">
                        <input type="number" class="form-control" name="size_xl" value="<?php echo isset($EditProduct['size_xl']) ? $EditProduct['size_xl'] : 0; ?>">
                    </div> 
                </div>
                <div class="form-group row float-right">
                    <div class="col-sm-10">
                        <button type="submit" name="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </form>
            </div>
        </div>
      </div>

<!-- /.container-fluid -->

<!-- Sticky Footer -->
<?php include_once __DIR__ . "/../../layouts/footer.php"; ?>