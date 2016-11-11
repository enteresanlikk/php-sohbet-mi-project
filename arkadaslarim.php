<?php

	require_once("baglan.php");
	$kadi=$_SESSION["kadi"];
	$arkadaslar=mysql_query("select a.aid,u.kadi,u.resim,u.eposta,u.arkaplan 
	from arkadaslik a,uyeler u
	where (a.istekgonderen=u.kadi and a.onay='1' and a.istekalan='$kadi' and u.kadi<>'$kadi') 
	or (a.istekalan=u.kadi and a.onay='1' and a.istekgonderen='$kadi' and u.kadi<>'$kadi')");
	
	$say=mysql_num_rows($arkadaslar);
	
	if($say!=0){
		
		while($sor=mysql_fetch_row($arkadaslar)){
			$ad=$sor[1];
			$engellimi=mysql_query("select * from engellimi where engellenen='$ad' and engelleyen='$kadi' and engel='1' ");
			
			if(mysql_num_rows($engellimi)==0){
				
			
			
			//KAÇ MESAJ OLDUĞUNU BULMAK
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
			
			 
			
			
				if( (eregi ( $sor[1], $gonderen ) && eregi ( $kadi, $alan ))) {
					$j++;
					$gelen_sayi=$j;
					
				}
				
				
			

			}
			
			
			$ad=$sor[1];
			
			
		$sor1=mysql_query("select * from mesaj_sayisi where (mesaj_alan='$kadi' and mesaj_gonderen='$ad') ");
		$mesajsay1=mysql_fetch_row($sor1);
			
			/*
			echo $gelen_sayi."-";
			echo $mesajsay1[3]."=";
			echo $gelen_sayi-$mesajsay1[3]."<br />";
			*/
			
			echo "<a href='index.php?kisi=$sor[1]'><div class='uyeler' title='";
			echo "'>
				
		
		
					<div class='uye_resim'><img src='$sor[2]' title='$sor[3]' />";
					$mesaj_sonuc=$gelen_sayi-$mesajsay1[3];
					if($mesaj_sonuc>0){
						$yeni_sayi=$mesaj_sonuc;
						echo "<div class='mesaj_sayisi'>$yeni_sayi</div>";
					}	
				echo "</div>
					
					<div class='uye_isim' value='$sor[1]'>$sor[1]</div>";					
					
					
				
				$online=mysql_query("select * from online_mi where oadi='$ad'");
				while($sonuc=mysql_fetch_row($online)){
					echo "<div class='aa'>";	
						if($sonuc[2]=="0"){
							
							$gelentar=$sonuc[3];
							$tarih=date("d-m-Y",$gelentar);

							if($tarih==date("d-m-Y")){
								$tarih="En Son ".date("H:i",$gelentar)." Saatinde Aktifti.";
							}else{
								$tarih="En Son".date("d-m-Y H:i",$gelentar)." Tarihinde Aktifti.";
							}
							
							
							
							echo "<div class='uye_online' title='$tarih'>Off</div>";
						}else{
							echo "<div class='uye_online' style='background:#0f0;' title='Gerçekten Şuan Aktif.'>On</div>";
						}
					echo "</div>";	
				}	
					
		echo "</div></a>";
		
		}
		
		}
	}else{
		echo "<h4 align='center'>Hiç Arkadaşın Yok !</h4>";
	}
?>