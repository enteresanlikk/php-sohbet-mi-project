<?php
include "baglan.php";
$kadi=$_SESSION["kadi"];

		
if (@$_FILES["resim"]["size"]<2048*2048){
				if (@$_FILES["resim"]["type"]=="image/jpeg" || @$_FILES["resim"]["type"]=="image/png" ){
					@$dosya_adi=@$_FILES["resim"]["name"];
					
					@$uzanti=substr($dosya_adi,-4,4);
					@$sayi_tut=rand(1,10000);
					@$dosyayolu="uyeler/".$kadi.$uzanti;
					if (move_uploaded_file(@$_FILES["resim"]["tmp_name"],$dosyayolu)){
						mysql_query("update uyeler set resim='$dosyayolu' where kadi='$kadi'");
					}else{
						echo 'Resminiz Güncellenemedi!';
					}
				}else{
					echo 'Dosya yalnizca jpeg formatinda olabilir!';
				}
			}else{			
				echo "Dosya boyutu 1 Mb'i geçemez!";
			}
	
?>