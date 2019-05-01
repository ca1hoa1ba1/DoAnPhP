
<!-- Sticky Footer -->
      <footer class="sticky-footer">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright © Your Website 2019</span>
          </div>
        </div>
      </footer>

    </div>
    <!-- /.content-wrapper -->

  </div>
  <!-- /#wrapper -->

  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
          <a class="btn btn-primary" href="logout.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="<?php echo public_admin(); ?>vendor/jquery/jquery.min.js"></script>
  <script src="<?php echo public_admin(); ?>vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="<?php echo public_admin(); ?>vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="<?php echo public_admin(); ?>js/sb-admin.min.js"></script>
  <script type="text/javascript"> 
    $('.btn-del').click(function(e){
      e.preventDefault();
      if(confirm('Are you sure ??')){
        location.href = $(this).attr('href');
      }
    });
  </script>
  <?php 
    if(isset($table) && $table == true) {
      echo '
        <!-- Page level plugin JavaScript-->
        <script src="' . public_admin() . 'vendor/datatables/jquery.dataTables.js"></script>
        <script src="' . public_admin() . 'vendor/datatables/dataTables.bootstrap4.js"></script>
        
        <!-- Demo scripts for this page-->
        <script src="' . public_admin() . 'js/demo/datatables-demo.js"></script>
      ';
    }
   ?>

</body>

</html>
