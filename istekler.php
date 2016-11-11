<script type="text/javascript" src="https://code.jquery.com/jquery-2.2.4.min.js"></script>
	<script type="text/javascript">
	$(document).ready(function(){
		
		//İSTEĞİ ONAYLAMA BÖLÜMÜ BAŞLANGIÇ

		$("input[name=onay]").click(function(){
			var indis=$("input[name=onay]").index(this);
			var isim=$("input[name=isim]:eq("+indis+")").val();
			$.ajax({
				type:"POST",
				url:"onayla.php",
				data:{"isim":isim},
				success:function(){
					$(".istek_kisi:eq("+indis+")").fadeOut(500);
					location.reload();
				}
			});
		});

		//İSTEĞİ ONAYLAMA BÖLÜMÜ BİTİŞ

		//İSTEĞİ İPTAL ETME BÖLÜMÜ BAŞLANGIÇ

		$("input[name=iptal]").click(function(){
			var indis=$("input[name=iptal]").index(this);
			var isim=$("input[name=isim]:eq("+indis+")").val();
			$.ajax({
				type:"POST",
				url:"isteksil.php",
				data:{"isim":isim},
				success:function(){
					$(".istek_kisi:eq("+indis+")").fadeOut(500);
					location.reload();
				}
			});
		});

		//İSTEĞİ İPTAL ETME BÖLÜMÜ BİTİŞ
		
	});
	
	</script>

<a href="index.php" class="close">X</a>
<?php
require_once("baglan.php");
$kadi=$_SESSION["kadi"];

$istekler=mysql_query("select a.aid,u.kadi,u.resim,u.eposta,u.arkaplan from arkadaslik a,uyeler u where a.istekgonderen=u.kadi and a.onay='0' and a.istekalan='$kadi'");
	$say=mysql_num_rows($istekler);
	echo "<div id='istek'>";
	if($say!=0){
		
			while($son=mysql_fetch_row($istekler)){
				$ad=$son[1];
				$engellimi=mysql_query("select * from engellimi where engellenen='$ad' and engelleyen='$kadi' and engel='1' ");
			
				if(mysql_num_rows($engellimi)==0){
					echo "<div class='istek_kisi'>
						<div class='bilgiler'><img src='$son[2]' align='center'/> $son[1] </div>
						<div class='arkaplan'><img src='$son[4]' /></div>
						<div class='onaylama'>
							<form action='' method='post' onsubmit='return false'>
								<input type='hidden' value='$son[1]' name='isim' />
								<input type='submit' value='ONAYLA' name='onay' class='btn'/>
								<input type='submit' value='SİL' name='iptal' class='btn iptal'/>
							</form>
						</div>
					</div>";
				}
			}
		
	}else{
		echo "<h3>Yeni İstek Bulunmuyor !</h3>";
	}
	
	echo "</div>";
?>