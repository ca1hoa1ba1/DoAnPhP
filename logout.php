<?php 
	include_once __DIR__ . "/autoload/autoload.php"; 
	session_destroy();
	header("location: " . base_url());
 ?>