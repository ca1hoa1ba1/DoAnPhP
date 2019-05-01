<?php
  session_start();
  require_once __DIR__ . "/../libraries/Function.php";

  if(isset($_SESSION['admin'])) {
      header('location: index.php');
  }

  if($_SERVER['REQUEST_METHOD'] == 'POST') {
    if(postInput('useradmin') == 'admin' && postInput('passwdadmin') == 'admin') {
      $_SESSION['admin'] = '1';
      header('location: index.php');
    }
  }
?>

<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>SB Admin - Login</title>

  <!-- Custom fonts for this template-->
  <link href="<?php echo public_admin();?>vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

  <!-- Custom styles for this template-->
  <link href="<?php echo public_admin();?>css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

  <div class="container">
    <div class="card card-login mx-auto mt-5">
      <div class="card-header">Login</div>
      <div class="card-body">
        <form action="" method="POST">
          <div class="form-group">
              <input type="text" id="inputAdmin" name="useradmin" class="form-control" placeholder="Username" required="required">
          </div>
          <div class="form-group">
              <input type="password" id="inputPassword" name="passwdadmin" class="form-control" placeholder="Password" required="required">
          </div>
          <button class="btn btn-primary btn-block" type="submit">Login</a>
        </form>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo public_admin();?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo public_admin();?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo public_admin();?>vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
