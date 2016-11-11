<?php

	include "baglan.php";
	
if(file_exists("mesajlarimiz.txt")){
	date_default_timezone_set('Europe/Istanbul');
		
		//KONUŞULAN KİŞİ BİLGİLERİ
		$kisi=$_SESSION["kisi"];
		$kisimiz=mysql_query("select * from uyeler where kadi='$kisi'");
		$bilgileri=mysql_fetch_row($kisimiz);
		$konusulan_resim=$bilgileri[4];
		$konusulan_ad=$bilgileri[1];
		$konusulan_eposta=$bilgileri[3];
		//KONUŞULAN KİŞİ BİLGİLERİ
	
	
		//GİRİŞ YAPAN KİŞİ BİLGİLERİ
			$kadi=$_SESSION["kadi"];
			$resim=$_SESSION["resim"];
			$eposta=$_SESSION["eposta"];
	
		//GİRİŞ YAPAN KİŞİ BİLGİLERİ
	
	@$mesaj=trim($_POST["mesaj"]);
	$kadi=$_SESSION["kadi"];
	$tarih=time();
	if($mesaj!=""){
		$dosyamiz=fopen("mesajlarimiz.txt","ab");
		$yazilacaklar=$tarih."\t".$kadi."\t".$kisi."\t".$mesaj."\n";
		$mesajyaz=fwrite($dosyamiz,$yazilacaklar);
		
	}

	 //----------------------------------------------------------------------------
	
//GELEN MESAJ SAYISINI HESAPLAMAK


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
		
			if( (eregi ( $kisi, $gonderen ) && eregi ( $kadi, $alan ))) {
				$i++;
				$gelen=$i;
				
			}
			
			if( (eregi ( $kadi, $gonderen ) && eregi ( $kisi, $alan ))) {
				$j++;
				$gonderilen=$j;
				
			}
		

		}
		
		$aa=$gelen>0 ? $gelen:0;
		/*
		$bb=$gonderilen>0 ? $gonderilen:0;
		echo "GELEN SAYİ : ".$aa."<br />";
		echo "GÖNDERİLEN SAYI : ".$bb."<br />";
		echo $aa-$sonuc[3];
		*/
		$sor=mysql_query("SELECT * FROM mesaj_sayisi WHERE mesaj_alan='$kisi' and mesaj_gonderen='$kadi' ");
		$sonuc=mysql_fetch_row($sor);
		
		
		
		mysql_query("UPDATE mesaj_sayisi SET mesaj_sayi='$aa' WHERE mesaj_alan='$kadi' and mesaj_gonderen='$kisi' ");
	
		
//GELEN MESAJ SAYISINI HESAPLAMAK
	
//------------------------------------------------------------------------------
	
	$dosya=file("mesajlarimiz.txt");
	foreach($dosya as $yeni){
		$bol=explode("\t",$yeni);
		$gelentar=$bol[0];
		$gonderen=$bol[1];
		$alan=$bol[2];
		$mesaji=$bol[3];
		
		$tarih=date("d-m-Y",$gelentar);
			
		if($tarih==date("d-m-Y")){
			$tarih=date("H:i",$gelentar);
		}else{
			$tarih=date("d-m-Y H:i",$gelentar);
		}
		
		$mesaji=str_replace(":)","&#x1f603;",$mesaji);
		$mesaji=str_replace(":D","&#128512;",$mesaji);
		
		$mesaji=str_replace(":(","&#128543;",$mesaji);
		$mesaji=str_replace(";)","&#128540;",$mesaji);
		$mesaji=str_replace(";(","&#128531;",$mesaji);
		
		
$mesaji = preg_replace( "`((http)+(s)?:(//)|(www\.))((\w|\.|\-|_)+)(/)?(\S+)?`i", "<a target=_blank href=\"http\\3://\\5\\6\\8\\9\" class='mesaj_link' title=\"\\0\"><b>\\5\\6\\8\\9</b></a>", $mesaji);

		
		
		if(($alan==$kisi && $gonderen==$kadi)){
		
			if($gonderen==$kadi){
				
				
				
				//ÜYE GİRİŞİ YAPAN KİŞİNİN MESAJI
				echo "<div class='satir' align='right'>
				<span class='saat'>($tarih)</span>
				<span class='gonderen_mesaj'>$mesaji</span>
				<span class='giris_resim'> <img src='$resim' align='center'/></span>
				
				</div>";
				
			}else if($gonderen==$kisi){
				
				//SEÇİLEN ÜYENİN MESAJI
				echo "<div class='satir'>
				<span class='alan_resim'><img src='$konusulan_resim' align='center'/></span>
				<span class='mesaj'>$mesaji</span>
				<span class='saat'>($tarih)</span>
				</div>";
				
			}
			
		
		}else if(($alan==$kadi && $gonderen==$kisi)){
			
			if($gonderen==$kadi){
				
				//ÜYE GİRİŞİ YAPAN KİŞİNİN MESAJI
				echo "<div class='satir'>
				<span class='giris_resim'><img src='$resim' align='center'/> </span>
				<span class='gonderen_mesaj'>$mesaji</span>
				<span class='saat'>($tarih)</span>
				</div>";
				
			}else if($gonderen==$kisi){
				
				//SEÇİLEN ÜYENİN MESAJI
				echo "<div class='satir'>
				<span class='alan_resim'><img src='$konusulan_resim' align='center'/></span>
				<span class='mesaj'>$mesaji</span> 
				<span class='saat'>($tarih)</span>
				</div>";
				
			}
			
		}
	
	
		

		
			
	
	}
	
	
	
		


}else{
	touch("mesajlarimiz.txt");
}
	
?>