<?php 
session_start();
	require_once __DIR__ . "/../../libraries/Database.php";
	require_once __DIR__ . "/../../libraries/Function.php";
  	$db = new Database;
  	if($_SESSION['admin'] != 1) {
	    header('location: '. base_url().'admin/login.php');
  	}
  	define("ROOT", $_SERVER['DOCUMENT_ROOT'] . "/DoAn/public/uploads");
 ?>