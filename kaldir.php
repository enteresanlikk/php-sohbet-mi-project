<?php require_once("baglan.php");
$kadi=$_SESSION["kadi"];
$isim=$_POST["isim"];
$ekle=mysql_query("delete from engellimi where engelleyen='$kadi' and engellenen='$isim' ");
?>