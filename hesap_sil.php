<?php
	require_once("baglan.php");
	$kadi=$_SESSION["kadi"];
	$sil=mysql_query("delete from uyeler where kadi='$kadi'");
	$online=mysql_query("delete from online_mi where oadi='$kadi'");
	$arkadaslik=mysql_query("delete from arkadaslik where istekgonderen='$kadi' or istekalan='$kadi'");
	if($sil && $online && $arkadaslik){
		echo "HESABINIZ SİLİNMİŞTİR.";
	}else {
		echo "HESABINIZ SİLİNEMEDİ !";
	}
?>