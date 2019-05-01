<?php include_once __DIR__ . "/autoload/autoload.php"; 
  if(!isset($_SESSION['userid'])) {
    echo "<script>alert(' Vui lòng đăng nhập tài khoản'); location.href='login.php'; </script>";
  }else {
    $id = $_SESSION['userid'];
  }
  
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if(!preg_match("/^[a-zA-Z\s-]+$/", to_slug(postInput('c_fullname')), $match)){
      $errors['c_fullname'] = "Họ tên không hợp lệ";
    }
    if (!filter_var(postInput('c_email_address'), FILTER_VALIDATE_EMAIL)) {
      $errors['c_email_address'] = "Email không hợp lệ";
    }
    if(!preg_match("/^\d{10,15}$/", postInput('c_phone'), $match)){
      $errors['c_phone'] = "SDT không hợp lệ";
    }
    $sql = "id != " . $id . " AND email LIKE BINARY '" .postInput('c_email_address'). "'";
    $checked = $db->fetchOne('user', $sql);
    if($checked != NULL) {
      $errors['c_email_address'] = "email đã tồn tại ";
    }  
    // _debug($errors);
    // die();
    if(empty($errors)) {
      $data = [
        'fullname' => postInput('c_fullname'),
        'address' => postInput('c_address'),
        'state' => postInput('c_state_country'),
        'email' => postInput('c_email_address'),
        'phone' => postInput('c_phone')
      ];
      $update_profile_user = $db->update('user', $data, array('id' => $id));
      if($update_profile_user > 0) {
        $_SESSION['fullname'] = postInput('c_fullname');
        $_SESSION['success'] = 'Update profile thanh cong';
      }else {
        $_SESSION['error'] = 'Update profile that bai';
      }
    }
  }
  $info_user = $db->fetchID('user', intval($id));
?>
<?php include_once __DIR__ . '/layouts/header.php'; ?>

      <div class="bg-light py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mb-0">
              <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
              <strong class="text-black">Profile</strong>
            </div>
          </div>
        </div>
      </div>

      <section class="site-login mt-4 mb-5">
        <div class="container">
          <div class="row">
            <div class="col-md-6">
                 <h2 class="h3 mb-3 text-black">Profile User</h2>
                 <form action="" method="post">
                 <div class="p-3 p-lg-5 border">
                  <?php include_once __DIR__ . '/partials/notification.php'; ?>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_username" class="text-black">Username </label>
                          <input type="text" class="form-control" name="c_username" value="<?php echo $info_user['username']; ?>" readonly="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_fullname" class="text-black">FullName </label>
                          <input type="text" class="form-control" name="c_fullname" value="<?php echo $info_user['fullname']; ?>" required="">
                          <?php if(isset($errors['c_fullname'])) : ?>
                            <div class="alert alert-danger mt-2"><?php echo $errors['c_fullname']; ?></div>
                          <?php endif; ?>
                       </div>
                          
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_address" class="text-black">Address </label>
                          <input type="text" class="form-control" name="c_address" placeholder="Street address" value="<?php echo $info_user['address']; ?>" required="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_state_country" class="text-black">State / Country </label>
                          <input type="text" class="form-control" name="c_state_country" value="<?php echo $info_user['state']; ?>"  required="">
                       </div>
                    </div>
                    <div class="form-group row mb-5">
                       <div class="col-md-6">
                          <label for="c_email_address" class="text-black">Email Address </label>
                          <input type="email" class="form-control" id="c_email_address" name="c_email_address" value="<?php echo $info_user['email']; ?>" required="">
                          <?php if(isset($errors['c_email_address'])) : ?>
                            <div class="alert alert-danger mt-2"><?php echo $errors['c_email_address']; ?></div>
                          <?php endif; ?>
                       </div>
                       <div class="col-md-6">
                          <label for="c_phone" class="text-black">Phone </label>
                          <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo $info_user['phone']; ?>" required="">
                          <?php if(isset($errors['phone'])) : ?>
                            <div class="alert alert-danger mt-2"><?php echo $errors['phone']; ?></div>
                          <?php endif; ?>
                       </div>
                    </div>
                     <div class="form-group row">
                      <div class="col-md-12">
                         <button type="submit" class="btn btn-primary btn-lg py-2 btn-block">Edit Profile</button>
                      </div>
                      <!-- <div class="col-md-12 mt-3">
                         <a href="#" class="btn btn-primary btn-lg py-2 btn-block">Edit Password</a>
                      </div> -->
                     </div>
                 </div>
                  </form>
            </div>

            <div class="col-md-6 mt-5">
              <?php $orders = $db->fetchsql("SELECT * FROM transaction WHERE user_id = {$id} ORDER BY (id) DESC");
              foreach ($orders as $order) :?>
                <div class="border border-rounded p-3 mb-3">
                  <h3 class="text-primary">ORDER No: #<?php echo $order['id'] ?> <span class="float-right text-small"><?php echo $order['create_at']; ?></span></h3>
                  <p>Info: <?php echo strlen($order['info']) > 60 ? substr($order['info'],0,60).'...' : $order['info']; ?></p>
                  <p>Total: <u><?php echo format_price($order['amount']); ?></u> | Status: <?php echo getStatus($order['status']); ?> <a href="order.php?o=<?php echo $order['id']; ?>" class="float-right text-underline text-primary text-small"><u>Read More</u></a></p>
                </div>
              <?php endforeach; ?>
            </div>
          </div>
        </div>
      </section>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>