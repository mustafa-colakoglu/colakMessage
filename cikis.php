<?php
	session_start();
	@$_SESSION["giris"]=false;
	header("Location:index.php");
?>