<?php
include "baglan.php";
$kadi=$_SESSION["kadi"];


	if (@$_FILES["arkaplan"]["size"]<2048*2048){
				if (@$_FILES["arkaplan"]["type"]=="image/jpeg" || @$_FILES["arkaplan"]["type"]=="image/png" ){
					@$dosya_adi=@$_FILES["arkaplan"]["name"];
					
					@$uzanti=substr($dosya_adi,-4,4);
					@$sayi_tut=rand(1,10000);
					@$dosyayolu="arkaplanlar/".$kadi.$uzanti;
					if (move_uploaded_file(@$_FILES["arkaplan"]["tmp_name"],$dosyayolu)){
						$ekle=mysql_query("update uyeler set arkaplan='$dosyayolu' where kadi='$kadi'");
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