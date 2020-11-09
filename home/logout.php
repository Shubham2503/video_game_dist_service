<?php 
	session_start();
	$_SESSION = array();
    session_destroy();
    setcookie("userid", "", time() - 3600);
	header("location: signin.php");
	exit;
 ?>