<?php if(isset($_SESSION['success'])) :?>
	<div class="alert alert-success">
		<strong><?php echo $_SESSION['success']; unset($_SESSION['success']);?></strong>
	</div>
<?php endif; ?>

<?php if(isset($_SESSION['error'])) :?>
	<div class="alert alert-danger">
		<strong><?php echo $_SESSION['error']; unset($_SESSION['error']);?></strong>
	</div>
<?php endif; ?>