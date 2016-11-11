<?php
include "baglan.php";
	$kadi=$_SESSION["kadi"];
	$tarih=time();
	mysql_query("update online_mi set online='0',tarih='$tarih' where oadi='$kadi'");

@session_destroy();
@header("refresh:0;login.php");
?>