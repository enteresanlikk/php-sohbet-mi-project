<?php
require_once("baglan.php");
$kadi=$_SESSION["kadi"];
$uye=$_POST["uye"];

$sor=mysql_query("SELECT * FROM arkadaslik WHERE (istekgonderen='$kadi' and istekalan='$uye') or (istekgonderen='$uye' and istekalan='$kadi') ");
if(!mysql_affected_rows()){
	
	$istekgonder=mysql_query("insert into arkadaslik(istekgonderen,istekalan,onay) values('$kadi','$uye','0')");
	
	
}
	
	

?>