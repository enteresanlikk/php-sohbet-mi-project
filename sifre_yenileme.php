<?php
include "baglan.php";
$kadi=$_SESSION["kadi"];
$eski=$_POST["eski"];
$yeni=$_POST["yeni"];


	$sor=mysql_query("select * from uyeler where kadi='$kadi' and sifre='$eski'");
	$say=mysql_num_rows($sor);
	if($say>0){
		
		$guncelle=mysql_query("update uyeler set sifre='$yeni' where kadi='$kadi'");
		if($guncelle){
			echo "Şifreniz Güncellendi.";
		}else{
			echo "Şifreniz Güncellenemedi !";
		}
		
	}else{
		echo "Eski Şifreniz Yanlış !";
	}	



?>