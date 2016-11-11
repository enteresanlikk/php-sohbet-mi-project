<?php
	require_once("baglan.php");
	$kisi=$_SESSION["kisi"];
	$kadi=$_SESSION["kadi"];
	mysql_query("insert into engellimi(engellenen,engelleyen,engel) values('$kisi','$kadi','1')");
?>