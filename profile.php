<?php include_once __DIR__ . "/autoload/autoload.php"; 
  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
      ''
    ];
  }
  $info_user = $db->fetchID('user', intval($_SESSION['userid']));
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
                       </div>
                       <div class="col-md-6">
                          <label for="c_phone" class="text-black">Phone </label>
                          <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" value="<?php echo $info_user['phone']; ?>" required="">
                       </div>
                    </div>
                     <div class="form-group row">
                      <div class="col-md-12">
                         <button type="submit" class="btn btn-primary btn-lg py-2 btn-block">Edit Profile</button>
                      </div>
                      <div class="col-md-12 mt-3">
                         <a href="#" class="btn btn-primary btn-lg py-2 btn-block">Edit Password</a>
                      </div>
                     </div>
                 </div>
                  </form>
            </div>

            <div class="col-md-6 mt-5">
              <div class="border border-rounded p-3 mb-3">
                <h3>ORDER No: # <span class="float-right text-small">2019-04-23 18:33:12</span></h3>
                <p>Total: <u>$123123.00</u> | Status: <span class="bg-success text-white rounded px-2">Done</span> <a href="#" class="float-right text-underline text-primary text-small"><u>Read More</u></a></p>
              </div>

              <div class="border border-rounded p-3 mb-3">
                <h3>ORDER No: # <span class="float-right text-small">2019-04-23 18:33:12</span></h3>
                <p>Total: <u>$123123.00</u> | Status: <span class="bg-success text-white rounded px-2">Done</span> <a href="#" class="float-right text-underline text-primary text-small"><u>Read More</u></a></p>
              </div>
  
              <div class="border border-rounded p-3 mb-3">
                <h3>ORDER No: # <span class="float-right text-small">2019-04-23 18:33:12</span></h3>
                <p>Total: <u>$123123.00</u> | Status: <span class="bg-success text-white rounded px-2">Done</span> <a href="#" class="float-right text-underline text-primary text-small"><u>Read More</u></a></p>
              </div>


            </div>

          </div>
        </div>
      </section>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>