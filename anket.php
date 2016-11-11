<?php

require_once("baglan.php");

if(isset($_POST)){
	$sonuc=$_POST["sonuc"];
	$kadi=$_SESSION["kadi"];
	$tarih=time();	
	$anket=mysql_query("insert into anket(katilan,deger,tarih) values('$kadi','$sonuc','$tarih')");
	if($anket){
		echo "Ankete Katıldığınız için Teşekkürler :D";
		
	}else{
		echo "Ankete Katıldığınız için Teşekkürler :D";
	}
}

?>