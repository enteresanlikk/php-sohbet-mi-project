<?php
	require_once("baglan.php");
	
	$kisi=$_SESSION["kisi"];
	$kadi=$_SESSION["kadi"];
	//----------------------------------------------------------------------------
	
//GELEN MESAJ SAYISINI HESAPLAMAK
/*
$ac = @fopen ( "mesajlarimiz.txt", 'r' );
		$i=0;
		$j=0;
		$dosya=file("mesajlarimiz.txt");
		foreach($dosya as $yeni){
			$bol=explode("\t",$yeni);
			$gelentar=$bol[0];
			$gonderen=$bol[1];
			$alan=$bol[2];
			$mesaji=$bol[3];
		
			if( (eregi ( $kadi, $gonderen ) && eregi ( $kisi, $alan ))) {
				$j++;
				$gonderilen=$j;
				
			}
		

		
		}
		$bb=$gonderilen>0 ? $gonderilen:0;
		
		mysql_query("UPDATE mesaj_sayisi SET mesaj_sayi='$bb' WHERE mesaj_alan='$kisi' and mesaj_gonderen='$kadi' ");
		
		*/
		
//GELEN MESAJ SAYISINI HESAPLAMAK
	
//------------------------------------------------------------------------------
	
	
	
	unset($_SESSION["kisi"]);
	header("refresh:0;url=index.php");
?>