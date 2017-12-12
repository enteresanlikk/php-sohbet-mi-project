<?php 

require_once("baglan.php"); 

if(isset($_SESSION["login"])){
	header("refresh:0;url=index.php");
}
?>
<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>SOHBET Mİ ? | GİRİŞ</title>
	<link rel="stylesheet" href="css/giris.css" />
	<link rel="short icon" href="img/logo.png" />
	<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript" src="js/js.js"></script>
</head>
<body>

<?php
		
		if(isset($_POST["kayit"])){
			$kadi=$_POST["kadi"];
			$sifre=$_POST["sifre"];
			$eposta=$_POST["eposta"];
			$ip = $_SERVER["REMOTE_ADDR"];
		
			if($kadi=="" || $sifre==""){
				@$sonuc="<h3>Boş Alan Bırakmayınız.</h3>";
			}else{
		
				
				@$dosya_adi=$_FILES["dosya"]["name"];
			
				$uzanti=substr($dosya_adi,-4,4);
				$sayi_tut=rand(1,10000);
				$dosyayolu="uyeler/".$kadi.$uzanti;
				if (@move_uploaded_file($_FILES["dosya"]["tmp_name"],$dosyayolu)){
				
					@$kayityap=mysql_query("insert into uyeler(kadi,eposta,sifre,uip,resim) values('$kadi','$eposta','$sifre','$ip','$dosyayolu')");
				
					mysql_query("insert into online_mi(oadi,online) values('$kadi','1')");
					
					
				
					if ($kayityap){
						@$sonuc="<h3>Kayıt Başarıyla Yapıldı.</h3>";							
					}else{
						@$sonuc="<h3>Kayıt Yapılamadı!</h3>";
					}
					
				}else{
					@$sonuc="<h3>Resim Yüklenemedi!</h3>";
				}
						
			}
		}
		
		
		?>
		
		
		
		<?php
		
		$sonuc="Sohbet Edebilmek İçin Giriş Yapınız. Eğer Hesabınız Yoksa Lütfen Kayıt Olunuz.";	
		if(isset($_POST["giris"])){
			$kadi=$_POST["kadi"];
			$sifre=$_POST["sifre"];
			if($kadi=="" || $sifre==""){
				@$sonuc="<h3>Lütfen Boş Alan Bırakmayınız!</h3>";
			}else{
			
			@$girisyap=mysql_query("select * from uyeler where kadi='$kadi' and sifre='$sifre'");
			@$bakalim=mysql_fetch_row($girisyap);
			
			
			if($bakalim){
				$_SESSION["kadi"]=$bakalim[1];
				$_SESSION["uid"]=$bakalim[0];
				$_SESSION["eposta"]=$bakalim[3];
				$_SESSION["ip"]=$bakalim[5];
				$_SESSION["resim"]=$bakalim[4];
				$_SESSION["arkaplan"]=$bakalim[6];
				$_SESSION["login"]="true";
				
				$tarih=time();
				
				mysql_query("update online_mi set online='1',tarih='' where oadi='$kadi'");
				
				
				@$sonuc="<h3>Hoşgeldin $kadi Giriş Yapılıyor...</h3>";
				
				header("refresh:1;url=index.php");
			}else{
				@$sonuc="<h3>Giriş Yapılamadı!.</h3>";
			}
			}
			
		}
		
		?>
		



	<div id="gelen_sonuc"><?php echo @$sonuc;?></div>
	<div id="kapsayici">
	
	<div id="unuttum_bolumu">
		<div id="ust">Şifremi Unuttum ! <a href="#" class="kapat" >X</a></div>
		
		<div id="icerik">
			<form action="" method="post" onsubmit="return false">
				<input type="email" name="eposta" class="txt" placeholder="E-Posta Adresinizi Girin."/>
				<div id="sifresonuc"></div>	
		<div id="buton">
		
				<input type="submit" name="gonder" value="E-Postaya Gönder" class="btn"/>
			</form>
		
		</div>	
		
		</div>
	
	</div>
	
	
		<div id="kayit_bolumu">
			<div id="kayit_btn">KAYIT OL</div>
			<div id="kayit_kutu">
				<form action="" method="post" enctype="multipart/form-data">
					<span>Kullanıcı Adı :</span>
					<input type="text" name="kadi" class="txt" />
					
					<span>Şifre :</span>
					<input type="password" name="sifre" class="txt" />
					
					<span>E-Posta :</span>
					<input type="email" name="eposta" class="txt" />
					
					<span>Profil Resimi:</span>
						<label class="file">
							<span class="ayri">Resim Seç</span>
							<input type="file" name="dosya" />
						</label>
					<p id="satir">
						<input type="submit" name="kayit" value="KAYIT OL" class="btn"/>
					</p>
				</form>
			</div>
		</div>
		
		
		
		
		
		<div id="giris_bolumu">
		
			<div id="giris_btn">GİRİŞ YAP</div>
			<div id="giris_kutu">
				<form action="" method="post" >
					<span>Kullanıcı Adı :</span>
					<input type="text" name="kadi" class="txt" value="<?php if(isset($_POST["kayit"])){echo $_POST["kadi"];}?>"/>
					
					<span>Şifre :</span>
					<input type="password" name="sifre" class="txt" value="<?php if(isset($_POST["kayit"])){echo $_POST["sifre"];}?>"/>
					
					<p id="satir">
						<a href="#" id="unuttum">Şifremi Unuttum!</a>
						<input type="submit" name="giris" value="GİRİŞ YAP" class="btn"/>
						
					</p>
				</form>
			</div>
		
		</div>
		
		
		
		
	</div>
	
</body>
</html>