<?php
	require_once("baglan.php");
	@$kadi=$_SESSION["kadi"];
	
	@$uye=mysql_query("select * from uyeler where kadi='$kadi'");
	@$son=mysql_fetch_row($uye);
	@$resim=$son[4];
	@$eposta=$son[3];
	@$arkaplan=$son[6];
	
	if(empty($_SESSION["login"])){
		header("refresh:0;url=login.php");
	}
	
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<link rel="short icon" href="img/logo.png" />
	<title>SOHBET Mİ ?</title>
	<link rel="stylesheet" href="css/style.css" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.1.0.min.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
	<script type="text/javascript" src="js/jquery.form.js"></script>
	<style type="text/css">
		#kapsayici #icerik #mesajlar{
			background-image:url('<?php if($arkaplan!=""){ echo $arkaplan;}else{ echo "img/mesaj_arkaplan.png";}?>');
		}
	</style>
</head>
<body>
	<div id="kapsayici">
	
	
		<div id="sol">
		
		<!-- PROFİL BÖLÜMÜ İÇİN -->
			<div id="ust_profil">
				<?php
					echo "<div id='resim_bolumu'><img src='$resim' title='$eposta' id='kucuk_resim'/></div>";
					echo "<div id='isim_bolumu'><span>$kadi</span></div>";
					echo "<div id='ayrinti_bolumu'>
						<img src='img/ayrinti.png' id='ayrinti' />
							<ul id='ayrinti_menu'>
							
								
								<li><a href='#' id='hesap_cikis'>Çıkış Yap!</a></li>
								<li><a href='#' id='hesap_sil'>Hesabı Sil!</a></li>
								
								
							</ul>
						</div>";
				?>
			</div>
			
			<div id="ust_profil_gizli">
				<div id="geri_don">
					<div id="geri_resim"><img src="img/geri_don.png" alt="" /></div>
					<div id="geri_yazi">Profil ve Şifre</div>
				</div>
				
				<div id="ust_profil_resim">
				
				<form action='resim_guncelle.php' method='post' enctype='multipart/form-data' id='resim_guncelle'>
					<label class='file'>
						<input type="file" name="resim" />
					
						<img src="<?php echo $resim;?>" title="Profil Resmini Güncelle"/>
						
					</label>
				</form>	
					
				</div>
				
				<div id="sifre_yenileme_bolumu">
					<form action="" method="post" onsubmit="return false" id="sifre_yenileme">
						<p id='yenile_yazi'>Şifre Yenileme</p>
						
						<label class='yenile_satir'>
							<span class='yazi'>Eski Şifre</span>
							<span><input type="password" name="eski" class="txt"/></span>
						</label>
						
						<label class='yenile_satir'>
							<span class='yazi'>Yeni Şifre</span>
							<span><input type="password" name="yeni" class="txt"/></span>
						</label>
						
						<label class='yenile_satir'>
							<span class="gonderme">
								<input type="submit" name="yenile" value="Şifreyi Güncelle"  class="btn"/>
							</span>
						</label>
						
						
							
						
						
						
					</form>
					
					<form action='arkaplan.php' method='post' enctype='multipart/form-data' id='arkaplan_ekle'>
							<label class='yenile_satir'>
								<label class="arkaplan" >
									<span>Arkaplan Resmini Değiştir</span>
									<input type="file" name="arkaplan"/>
								</label>
							</label>
						</form>
						
						<span id="sonuc"></span>
				</div>
			</div>
			
			<!-- ARAMA BÖLÜMÜ İÇİN -->
			<div id="uye_arama">
				<form action="" method="post" onsubmit="return false">
					<label id='uye'>
						<img src="img/arama.png" title="Üye Ara" id="resim_arama" />
						<input type="text" placeholder="Üye Ara" id="txt" />
					</label>
				</form>
			</div>
			
			<!-- ÜYELER BÖLÜMÜ İÇİN -->
			
			<ul class='tab'>
				<li>ARKADAŞLARIM</li>
				<li>ÜYELER</li>
			</ul>
			<div id='bolum'>
				<div id="arkadaslar_bolumu" class="tabicerik"></div>

				<div id="uyeler_bolumu" class="tabicerik">
					
					
				
					<?php 
						$uyeler=mysql_query("select * from uyeler
						where kadi not in(select u.kadi
						from arkadaslik a,uyeler u
						where (a.istekgonderen=u.kadi and (a.onay='1' or a.onay='0') and a.istekalan='$kadi' and u.kadi<>'$kadi') 
						or (a.istekalan=u.kadi and (a.onay='1' or a.onay='0') and a.istekgonderen='$kadi' and u.kadi<>'$kadi')) and kadi<>'$kadi'");
						
						$uye_say=mysql_num_rows($uyeler);
						if($uye_say>0){
							while($uye_son=mysql_fetch_row($uyeler)){
								
								echo "<div class='uyeler'>
								
										<form action='' method='post' onsubmit='return false'>
										<div class='uye_resim'><img src='$uye_son[4]' title='$uye_son[3]' /></div>
										
										<div class='uye_isim' value='$uye_son[1]'>$uye_son[1]</div>
										
										<div class='uye_ok' value='$uye_son[1]'> + </div>";
												
											
								echo "
								
											</form>
											</div>
									   
									";
							}
						}
					?>
				</div>
			</div>
			
		</div>
	
		
		<div id="icerik">
			<?php
				if(isset($_GET["kisi"])){
					
					$kisi=$_GET["kisi"];	
					$_SESSION["kisi"]=$_GET["kisi"];
					$kisimiz=mysql_query("select * from uyeler where kadi='$kisi'");
					$bilgileri=mysql_fetch_row($kisimiz);
						$konusulan_resim=$bilgileri[4];
						$konusulan_ad=$bilgileri[1];
						$konusulan_eposta=$bilgileri[3];
					
					echo "<div id='konusulan_uye'>
							<div id='konusulan_uye_resim'><img src='$konusulan_resim' title='$konusulan_ad' /></div>
							
							<div id='konusulan_uye_isim'>$konusulan_ad</div>
							
							<div id='konusulan_uye_ayrinti'>
								<img src='img/kisi_ayrinti.png'/>
								<div id='ayrinti'>
									<ul>
										<li><a href='#' id='sohbet_kapat'>Sohbeti Kapat</a></li>
										<li><a href='#' id='sil' >Sil</a></li>
										<li><a href='#' id='engelle'>Engelle</a></li>
									</ul>
								</div>
							</div>
						</div>";
						
					echo "<div id='mesajlar'></div>";
					echo "<div id='mesaj_gonder_bolumu'>
							<span id='gonder'>
							<form action='mesaj_resim.php' id='resim_mesaj' enctype='multipart/form-data' method='post'>
								
									<div id='mesaj_resim'>
										<label class='resim_mesaj'>
											<img src='img/resim.png'/>
											<input type='file' name='resim_mesaj' />
										</label>
									</div>
									
								
							</form>
							<form action='' method='post' onsubmit='return false'>
								<textarea name='mesaj' id='txt' placeholder='MESAJINIZI YAZINIZ.'/></textarea>
							</span>
							<div id='gonder_btn'><img src='img/gonder.png'/></div>
						</form>
					</div>";
					
					

	$sor1=mysql_query("select * from mesaj_sayisi where mesaj_gonderen='$kadi' and mesaj_alan='$kisi' ");
	
	if(mysql_num_rows($sor1)==0){
		
		mysql_query("INSERT INTO mesaj_sayisi (mesaj_gonderen,mesaj_alan,mesaj_sayi) VALUES ('$kadi','$kisi', '0')");
		
	}
	
	$sor2=mysql_query("select * from mesaj_sayisi where mesaj_gonderen='$kisi' and mesaj_alan='$kadi' ");
	
	if(mysql_num_rows($sor2)==0){
		
		mysql_query("INSERT INTO mesaj_sayisi (mesaj_gonderen,mesaj_alan,mesaj_sayi) VALUES ('$kisi','$kadi', '0')");
		
	}
	
	
	


			
		
	
	
	
					
				}else{
				
				
				$kadi=$_SESSION["kadi"];
				$arkadasim=mysql_query("select a.aid,u.kadi,u.resim,u.eposta,u.arkaplan 
				from arkadaslik a,uyeler u 
				where (a.istekgonderen=u.kadi and a.onay='1'  and a.istekalan='$kadi' and u.kadi<>'$kadi') 
				or (a.istekalan=u.kadi and a.onay='1'  and a.istekgonderen='$kadi' and u.kadi<>'$kadi') 
				");
				$say=mysql_num_rows($arkadasim);
				
				
				$bekleyen=mysql_query("select a.aid,u.kadi,u.resim,u.eposta,u.arkaplan 
				from arkadaslik a,uyeler u 
				where (a.istekgonderen=u.kadi and a.onay='0' and a.istekalan='$kadi' and u.kadi<>'$kadi') 
				
				");
				$onay=mysql_num_rows($bekleyen);
				
				
				$engel=mysql_query("select * from engellimi where engelleyen='$kadi' and engel='1' ");
				$benim_engel=mysql_num_rows($engel);
				
				
				
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
					$oku = fread($ac, 1024); 
					 
					
					if ( eregi ( $kadi, $gonderen )) {
						$i++;
						$mesajin=$i;
					}
					
					if(eregi ( $kadi, $alan )){
						$j++;
						$mesa=$j;
					}

				}
				?>
					<div id='me'>
					
						<h1>Sen Şu Ana Kadar ;</h1>
						<div id="me_resim">
							<img src="<?php echo $resim; ?>" title="<?php echo $eposta;?>" id="me_img"/>
						</div>
						
						<div id="me_icerik">
							<ul>
								<li><h3>Şuana Kadar <?php echo $say>0 ? $say." Arkadaş Edindin.":"Hiç Arkadaşın Yok.";?> </h3></li>
								<li><h3>Onay Bekleyen <?php echo $onay>0 ? "<a href='#' id='hesap_istek'>".$onay."</a> İsteğin Var.":"Hiç İsteğin Yok.";?></h3></li>
								<li><h3>Engellediğin <?php echo $benim_engel>0 ? "<a href='#' id='hesap_engel'>".$benim_engel."</a> Arkadaşın Var.":"Hiç Arkadaşın Yok.";?></h3></li>
								<li><h3><?php echo @$mesajin>0 ? $mesajin." Mesaj Gönderdin":"Hiç Mesaj Göndermedin.";?></h3></li>
								<li><h3><?php echo @$mesa>0 ? $mesa." Mesaj Aldın":"Hiç Mesaj Almadın.";?></h3></li>
								
							</ul>
						</div>
						
						<div id="me_alt">
							<h2>Sizce Gerçekten Sohbet Mi ?</h2>
							
							<?php
							$anketsay=mysql_num_rows(mysql_query("select * from anket"));
							
							$evetsay=mysql_num_rows(mysql_query("select * from anket where deger='EVET'"));
							@$evet=round($evetsay/$anketsay*100);

							$hayirsay=mysql_num_rows(mysql_query("select * from anket where deger='HAYIR'"));
							@$hayir=round($hayirsay/$anketsay*100);
							$hayirp=4*($hayir)."px";
							$evetp=4*($evet)."px";
							echo "<form action='' method='post' onsubmit='return false'>";
							echo "<label><input type='radio' value='EVET' id='e' /> <span>EVET</span> <div id='evet' style='width:$evetp;'>$evet</div></label>";
							echo "<input type='radio' value='HAYIR' id='h' /> 
							<label><span>HAYIR</span> <div id='hayir' style='width:$hayirp;'>$hayir</div></label>";
							echo "</form>";
							
							
							?>
								
							
						</div>
					
					</div>
			<?php		
				}
				
			?>
		</div>
		
		
	</div>
</body>
</html>