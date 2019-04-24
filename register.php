<?php include_once __DIR__ . "/autoload/autoload.php"; 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $errors = [];
    if(!preg_match("/^[a-z0-9]{6,20}$/", postInput('c_username'), $match)){
      $errors['c_username'] = "Username không hợp lệ (6-20 ký tự , a-z và 0-9)";
    }
    if(!preg_match("/^[a-zA-Z0-9]{6,20}$/", postInput('c_passwd'), $match)){
      $errors['c_passwd'] = "Password không hợp lệ (6-20 ký tự , a-z, A-Z và 0-9)";
    }
    if(postInput('c_passwd') != postInput('c_re_passwd')) {
      $errors['c_re_passwd'] = "Re-Password không trùng khớp";
    }
    if(!preg_match("/^[a-zA-Z\s-]+$/", to_slug(postInput('c_fullname')), $match)){
      $errors['c_fullname'] = "Họ tên không hợp lệ";
    }
    if (!filter_var(postInput('c_email_address'), FILTER_VALIDATE_EMAIL)) {
      $errors['c_email_address'] = "Email không hợp lệ";
    }
    if(!preg_match("/^\d{10,15}$/", postInput('c_phone'), $match)){
      $errors['c_phone'] = "SDT không hợp lệ";
    }
    $sql = "username LIKE BINARY '" .postInput('c_username'). "' OR email LIKE BINARY '" .postInput('c_email_address'). "'";
    $checked = $db->fetchOne('user', $sql);
    if($checked != NULL) {
      $errors['warn'] = "Username hoặc email đã tồn tại ";
    }
    if(empty($errors)) {
      $data = [
        'username' => postInput('c_username'),
        'passwd' => postInput('c_passwd'),
        'fullname' => postInput('c_fullname'),
        'address' => postInput('c_address'),
        'state' => postInput('c_state_country'),
        'email' => postInput('c_email_address'),
        'phone' => postInput('c_phone')
      ];
      $insert = $db->insert('user', $data);
      if($insert > 0) {
        echo "<script>alert(' Đăng kí thành công '); location.href='index.php'; </script>";    
      }else {
        $errors['warn'] = "Đăng kí thất bại";
      }
    }
  }


?>
<?php include_once __DIR__ . '/layouts/header.php'; ?>

      <div class="bg-light py-3">
        <div class="container">
          <div class="row">
            <div class="col-md-12 mb-0">
              <a href="index.html">Home</a> <span class="mx-2 mb-0">/</span>
              <strong class="text-black">Login</strong>
            </div>
          </div>
        </div>
      </div>

      <section class="site-login mt-4 mb-5">
        <div class="container">
           <div class="col-md-6 mb-5 mb-md-0  mx-auto">
                     <h2 class="h3 mb-3 text-black">Sign Up</h2>
                     <form action="" method="post">
                     <div class="p-3 p-lg-5 border">
                        <?php if(isset($errors['warn'])) : ?>
                          <div class="col-md-12">
                            <div class="alert alert-danger mt-2"><?php echo $errors['warn']; ?></div>
                          </div>
                        <?php endif; ?>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_username" class="text-black">Username <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="c_username" value="<?php echo postInput('c_username') ?>" required="">
                              <?php if(isset($errors['c_username'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_username']; ?></div>
                              <?php endif; ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_passwd" class="text-black">Password <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" name="c_passwd" required="">
                              <?php if(isset($errors['c_passwd'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_passwd']; ?></div>
                              <?php endif; ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_re_passwd" class="text-black">Re-Password <span class="text-danger">*</span></label>
                              <input type="password" class="form-control" name="c_re_passwd" required="">
                              <?php if(isset($errors['c_re_passwd'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_re_passwd']; ?></div>
                              <?php endif; ?>
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_fullname" class="text-black">FullName <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="c_fullname" value="<?php echo postInput('c_fullname') ?>" required="">
                              <?php if(isset($errors['c_fullname'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_fullname']; ?></div>
                              <?php endif; ?>
                           </div>
                              
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="c_address" value="<?php echo postInput('c_address') ?>" placeholder="Street address" required="">
                           </div>
                        </div>
                        <div class="form-group row">
                           <div class="col-md-12">
                              <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" name="c_state_country" value="<?php echo postInput('c_state_country') ?>" required="">
                           </div>
                        </div>
                        <div class="form-group row mb-5">
                           <div class="col-md-6">
                              <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                              <input type="email" class="form-control" id="c_email_address" value="<?php echo postInput('c_email_address') ?>" name="c_email_address" required="">
                              <?php if(isset($errors['c_email_address'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_email_address']; ?></div>
                              <?php endif; ?>
                           </div>
                           <div class="col-md-6">
                              <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                              <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo postInput('c_phone') ?>" required="">
                              <?php if(isset($errors['c_phone'])) : ?>
                                <div class="alert alert-danger mt-2"><?php echo $errors['c_phone']; ?></div>
                              <?php endif; ?>
                           </div>
                        </div>
                         <div class="form-group">
                           <button class="btn btn-primary btn-lg py-2 btn-block">Sign up</button>
                         </div>
                      </form>
                     </div>
                  </div>
        </div>
      </section>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>