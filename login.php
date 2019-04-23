<?php include_once __DIR__ . "/autoload/autoload.php";
  $errors = []; 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(postInput('txtusername') == ''){
      $errors["txtusername"] = "Vui lòng nhập username";
    }
    if(postInput('txtpasswd') == ''){
      $errors["txtpasswd"] = "Vui lòng nhập password";
    }

    if(empty($errors)) {
      $data = [
        'username' => postInput('txtusername'),
        'passwd' => postInput('txtpasswd')
      ];
      $result = $db->checkPass($data);
      if($result != NULL) {
        $_SESSION['userid'] = $result['id'];
        $_SESSION['fullname'] = $result['fullname'];
        header("location: " . base_url());
      }else {
        $errors['error'] = "Tài khoản hoặc mật khẩu không đúng";
      }
    }
  }else {
    if(isset($_SESSION['userid'])) {
      header("location: " . base_url());
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
          <div class="login-wrapper">
              <h2>Login Account</h2>
              <!-- form login -->
              <form action="" method="POST" id="login-form">
                <div class="form-group d-inline-block">
                  <?php if (isset($errors['error'])): ?>
                    <div class="alert alert-danger row"><?php echo $errors['error']; ?></div>
                  <?php endif ?>
                  <div class="col-mb-5 row">
                    <label for="txtusername" class="text-black">Username</label>
                    <input
                      type="text"
                      class="form-control"
                      id="txtusername"
                      name="txtusername"
                    />
                    <?php if (isset($errors['txtusername'])): ?>
                      <div class="alert alert-danger"><?php echo $errors['txtusername']; ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="form-group d-inline-block">
                  <div class="col-mb-5 row">
                    <label for="txtpasswd" class="text-black">Password</label>
                    <input
                      type="password"
                      class="form-control"
                      id="txtpasswd"
                      name="txtpasswd"
                    />
                    <?php if (isset($errors['txtpasswd'])): ?>
                      <div class="alert alert-danger"><?php echo $errors['txtpasswd']; ?></div>
                    <?php endif ?>
                  </div>
                </div>
                <div class="form-group">
                  <button type="submit" class="btn btn-primary btn-lg py-2 btn-block">Login</button>
                </div>

                <div class="form-group text-center">
                    Don't have an account? 
                    <a href="register.php" class="forget-passwd">
                      Sign Up
                    </a>
                </div>
              </form>
          </div>
        </div>
      </section>

<?php include_once __DIR__ . '/layouts/footer.php'; ?>