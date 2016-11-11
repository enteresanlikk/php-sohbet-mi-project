<?php

require_once("baglan.php");
$kadi=$_SESSION["kadi"];
$isim=$_POST["isim"];

$ekle=mysql_query("delete from arkadaslik where istekalan='$kadi' and istekgonderen='$isim'");



?>