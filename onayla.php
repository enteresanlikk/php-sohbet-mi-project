<?php
require_once("baglan.php");
$kadi=$_SESSION["kadi"];
$isim=$_POST["isim"];

$ekle=mysql_query("update arkadaslik set onay='1' where istekalan='$kadi' and istekgonderen='$isim'");

?>