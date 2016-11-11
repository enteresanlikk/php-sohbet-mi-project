<?php
	require_once("baglan.php");
	$uye=$_POST["uye"];
	$kadi=$_SESSION["kadi"];	
	
	$sor=mysql_query("select * from uyeler
						where kadi not in(select u.kadi
						from arkadaslik a,uyeler u 
						where (a.istekgonderen=u.kadi and (a.onay='1' or a.onay='0') and a.engel='0' and a.istekalan='$kadi' and u.kadi<>'$kadi') 
						or (a.istekalan=u.kadi and (a.onay='1' or a.onay='0') and a.engel='0' and a.istekgonderen='$kadi' and u.kadi<>'$kadi')) and kadi<>'$kadi' and kadi like '$uye%'");
	$say=mysql_num_rows($sor);
	if($say>0){
		while($uye_son=mysql_fetch_row($sor)){
						echo "<div class='uyeler'>
									<div class='uye_resim'><img src='$uye_son[4]' title='$uye_son[3]' /></div>
									
									<div class='uye_isim'>$uye_son[1]</div>
									
									<div class='uye_ok'> + </div>";
									
								$ad=$uye_son[1];
								$online=mysql_query("select * from online_mi where oadi='$ad'");
								while($sonuc=mysql_fetch_row($online)){
									
									if($sonuc[2]=="0"){
										echo "<div class='uye_online'></div>";
									}else{
										echo "<div class='uye_online' style='background:#0f0;'></div>";
									}
									
								}	
									
						echo "
									</div>
							   
							";
					}
	}else{
		echo "<h3 align='center'>Böyle Bir Üye Yok !</h3>";
	}
	
?>