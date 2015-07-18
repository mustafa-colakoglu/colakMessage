<?php
	session_start();
	$baglan=mysql_connect("localhost","root","");
	$db=mysql_select_db("mesajlasma",$baglan);
?>