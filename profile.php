<?php include_once __DIR__ . "/autoload/autoload.php"; 
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
          <div class="row">
            <div class="col-md-6">
                 <h2 class="h3 mb-3 text-black">Profile User</h2>
                 <form action="" method="post">
                 <div class="p-3 p-lg-5 border">
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_username" class="text-black">Username <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="c_username" required="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_passwd" class="text-black">Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" name="c_passwd" required="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_re_passwd" class="text-black">Re-Password <span class="text-danger">*</span></label>
                          <input type="password" class="form-control" name="c_re_passwd" required="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_fullname" class="text-black">FullName <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="c_fullname" required="">
                       </div>
                          
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_address" class="text-black">Address <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="c_address" placeholder="Street address" required="">
                       </div>
                    </div>
                    <div class="form-group row">
                       <div class="col-md-12">
                          <label for="c_state_country" class="text-black">State / Country <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" name="c_state_country" required="">
                       </div>
                    </div>
                    <div class="form-group row mb-5">
                       <div class="col-md-6">
                          <label for="c_email_address" class="text-black">Email Address <span class="text-danger">*</span></label>
                          <input type="email" class="form-control" id="c_email_address" name="c_email_address" required="">
                       </div>
                       <div class="col-md-6">
                          <label for="c_phone" class="text-black">Phone <span class="text-danger">*</span></label>
                          <input type="text" class="form-control" id="c_phone" name="c_phone" placeholder="Phone Number" required="">
                       </div>
                    </div>
                     <div class="form-group">
                       <button class="btn btn-primary btn-lg py-2 btn-block">Sign up</button>
                     </div>
                 </div>
                  </form>
            </div>
            <div class="col-md-6 mt-5">
              <div class="border border-rounded p-3">
                <h1>acsacasc</h1>
                <p>acascacsasc</p>
              </div>
            </div>
          </div>
        </div>
      </section>
<?php include_once __DIR__ . '/layouts/footer.php'; ?>