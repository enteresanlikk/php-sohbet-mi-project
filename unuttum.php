<?php
require_once("baglan.php");
$eposta=$_POST["eposta"];
	$sor=mysql_query("select * from uyeler where eposta='$eposta'");
	$say=mysql_num_rows($sor);
	if($say!=0){
	
	while($sonuc=mysql_fetch_row($sor)){	
		$diger = "MIME-Version: 1.0\r\n"; 
		$diger .= "Content-type: text/html; charset='UTF-8' \r\n";
		$konu='SOHBET Mİ ? : Şifre Hatırlatma';
                $kime=$sonuc[3];
                $icerik='<h3>Gönderen : SOHBET Mİ ?</h3>';
                $icerik.='<strong>Kullanıcı Adınız : </strong>'.$sonuc[1];
                $icerik.=' <strong><br /> Şifreniz : </strong>'.$sonuc[2];
				   $diger .= "From : SOHBET Mİ ?";
			$gonder=mail($kime,$konu,$icerik,$diger);
			
			if($gonder){
				echo "E-Posta Adresinize Gönderilmiştir.";
			}else{
				echo "Şifreniz Gönderilemedi !";
			}
			
	}	
		
	}else{
		echo "Böyle Bir E-Posta Yok !";
	}
?>