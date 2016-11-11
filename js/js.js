$(document).ready(function(){
	//AYRINTI BÖLÜMÜ BAŞLANGIÇ
		$("#ayrinti_bolumu img").click(function(){
			$("#ayrinti_menu").toggle(200);
			return false
		});
		
	//AYRINTI BÖLÜMÜ BİTİŞ
	
	//PROFİL BÖLÜMÜ BAŞLANGIÇ
	$("#kucuk_resim").click(function(){
	
			$("#ust_profil").hide(200);
			$("#uye_arama").hide(200);
			$("#bolum").hide(200);
			$(".tab").hide(200);
			$("#ust_profil_gizli").show(300);
			
		});
		
		$("#geri_resim").click(function(){			
			$("#ust_profil_gizli").hide(200);
			
			
			$("#ust_profil").show(300);
			$("#uye_arama").show(300);
			$(".tab").show(300);
			$("#bolum").show(300);
			
		});
	
	//PROFİL BÖLÜMÜ BİTİŞ
	
	//ÇIKIŞ BÖLÜMÜ BAŞLANGIÇ
	
		$("#hesap_cikis").click(function(){
			
				window.location.href="logout.php";
			
		});
	
	//ÇIKIŞ BÖLÜMÜ BİTİŞ
	
	//SOHBET KAPATMA BÖLÜMÜ BAŞLANGIÇ
	
		$("#sohbet_kapat").click(function(){
			
				window.location.href="sohbet_kapat.php";
			
		});
	
	//SOHBET KAPATMA BÖLÜMÜ BİTİŞ
	
	
	//HESAP SİLME BÖLÜMÜ BAŞLANGIÇ
	
		$("#hesap_sil").click(function(){
			var a=confirm("Hesabınız Silinecektir.");
			
			if(a==true){
				$.ajax({
					url:"hesap_sil.php",
					success:function(gelen){
						alert(gelen);
						window.location.href="logout.php";
					}
				});
			}
			
		});
	
	//HESAP SİLME BÖLÜMÜ BİTİŞ
	
	
	
	//ŞİFRE YENİLEME BÖLÜMÜ BAŞLANGIÇ
	
	$("input[name=yenile]").click(function(){
			var eski=$("input[name=eski]").val();
			var yeni=$("input[name=yeni]").val();
			if(eski=="" || yeni==""){
				$("#sonuc").html("Boş Alan Bırakmayınız !");
				
			}else{
				$.ajax({
					type:"POST",
					url:"sifre_yenileme.php",
					data:{"eski":eski,"yeni":yeni},
					success:function(sonuc){
						$("input[name=eski]").val("");
						$("input[name=yeni]").val("");
						
						$("#sonuc").html(sonuc);
					}
					
				});
				
			}
			
		});
	
	//ŞİFRE YENİLEME BÖLÜMÜ BAŞLANGIÇ
	
	//PROFİL RESİMİ GÜNCELLEME BÖLÜMÜ BAŞLANGIÇ
	
		$("input[name=resim]").change(function(){
					
				$("#resim_guncelle").ajaxForm({
					target:"#uyeler_bolumu"
				}).submit();
				
				location.reload();
				
			});
	
	//PROFİL RESİMİ GÜNCELLEME BÖLÜMÜ BİTİŞ
	
	
	//MESAJ GÖNDERME BÖLÜMÜ BAŞLANGIÇ
	
	$(document).on('keydown', function(e){
			if(e.keyCode==13){
				
				var mesaj=$("textarea[name=mesaj]").val();
				$("textarea[name=mesaj]").attr("disabled","disabled");
				if(mesaj==""){
					$("textarea[name=mesaj]").removeAttr("disabled");
				}else{
					
					$.ajax({
						type:"POST",
						url:"mesajlar.php",
						data:{"mesaj":mesaj},
						success:function(aa){
							$("textarea[name=mesaj]").val("");
							$("textarea[name=mesaj]").removeAttr("disabled","disabled");
							$("textarea[name=mesaj]").focus();
							$.oynat();
							$.guncelle();
				
						}
						
					});
				}
				
			}
		});
		
		
		$("#gonder_btn").click(function(){
			
				
				var mesaj=$("textarea[name=mesaj]").val();
				$("textarea[name=mesaj]").attr("disabled","disabled");
				if(mesaj==""){
					$("textarea[name=mesaj]").removeAttr("disabled");
				}else{
					
					$.ajax({
						type:"POST",
						url:"mesajlar.php",
						data:{"mesaj":mesaj},
						success:function(aa){
							$("textarea[name=mesaj]").val("");
							$("textarea[name=mesaj]").removeAttr("disabled","disabled");
							$("textarea[name=mesaj]").focus();
							$.oynat();
							$.guncelle();
				
						}
						
					});
				}
				
			
		});
	
	//MESAJ GÖNDERME BÖLÜMÜ BİTİŞ
	
	
	
	//SCROLLU KAYDIRMA BÖLÜMÜ BAŞLANGIÇ
	
	
		$.oynat=function(){
			
				$('#mesajlar').animate({scrollTop:$('#mesajlar')[0].scrollHeight},1000);
			
			}
			
	
	//SCROLLU KAYDIRMA BÖLÜMÜ BİTİŞ
	
	
	
	//MESAJ ALANI GÜNCELLEME BÖLÜMÜ BAŞLANGIÇ
	
	$.ajax({
				type:"POST",
				url:"mesajlar.php",
				success:function(sonuc){
					
					$("#mesajlar").html(sonuc);
					
				}
				
			});
			
		
		$.guncelle=function(){
			$.ajax({
				type:"POST",
				url:"mesajlar.php",
				success:function(sonuc){
					
					$("#mesajlar").html(sonuc);
				}
				
			});
		}
		
		setInterval("$.guncelle();",1000);
	
	//MESAJ ALANI GÜNCELLEME BÖLÜMÜ BİTİŞ
	
	//FOCUS BÖLÜMÜ BAŞLANGIÇ
	
		$("textarea[name=mesaj]").focus();
	
	//FOCUS BÖLÜMÜ BİTİŞ
	
	
	//ARKAPLAN RESİMİ GÜNCELLEME BÖLÜMÜ BAŞLANGIÇ
	
		$("input[name=arkaplan]").change(function(){
					
				$("#arkaplan_ekle").ajaxForm({
					target:"#sifre_yenileme_bolumu"
				}).submit();
				
				location.reload();
				
			});
	
	//ARKAPLAN RESİMİ GÜNCELLEME BÖLÜMÜ BİTİŞ
	
	
	//RESİM ATMA BÖLÜMÜ BAŞLANGIÇ
	
		$("input[name=resim_mesaj]").change(function(){
					
				$("#resim_mesaj").ajaxForm({
					target:"#mesajlar"
				}).submit();
				
				$.oynat();
				
			});
	
	//RESİM ATMA BÖLÜMÜ BİTİŞ
	
	
	
	
	//KONUŞMA KAPATMA BÖLÜMÜ BAŞLANGIÇ
	
		$("#konusulan_uye_ayrinti img").click(function(){
			$(" #konusulan_uye_ayrinti #ayrinti").toggle(200);
			return false
		});
	
	//KONUŞMA KAPATMA BÖLÜMÜ BİTİŞ
	
	
	
	
	
	//ÜYE ARAMA BÖLÜMÜ BAŞLANGIÇ
	
		$.uyeler=function(){
			$("#uyeler_bolumu").load("index.php #uyeler_bolumu");
		}
	
	
		$("#uye_arama #txt").keyup(function(){
				
				// Veriyi alalım
				var uye = $(this).val();
				if(uye!=""){
				
					$.ajax({
						
						type: "POST",
						url: "uye_arama.php",
						data: {"uye":uye},
						success: function(cevap){
							$("#uyeler_bolumu .uyeler").html("");
							$("#uyeler_bolumu").html(cevap);
						}	
						
					});
				
				}else{
					$.uyeler();
					
				}
				
			});
	
	//ÜYE ARAMA BÖLÜMÜ BİTİŞ
	
	
	//KAYİT BÖLÜMÜ AÇILIŞ BAŞLANGIÇ
	
	
		$("#kapsayici #kayit_bolumu #kayit_btn").click(function(){
			$("#kapsayici #kayit_bolumu #kayit_kutu").fadeToggle(600);
		});
		
	
	//KAYİT BÖLÜMÜ AÇILIŞ BİTİŞ
	
	
	//GİRİŞ BÖLÜMÜ AÇILIŞ BAŞLANGIÇ
	
	
		$("#kapsayici #giris_bolumu #giris_btn").click(function(){
			$("#kapsayici #giris_bolumu #giris_kutu").fadeToggle(600);
		});
		
	
	//GİRİŞ BÖLÜMÜ AÇILIŞ BİTİŞ
	
	
	//ANKET BÖLÜMÜ BAŞLANGIÇ
	
		$("#kapsayici #icerik #me_alt input#e").click(function(){
			var evet=$(this).val();
			$("#kapsayici #icerik #me_alt input").attr("disabled","disabled");
			
			$.ajax({
				type:"POST",
				url:"anket.php",
				data:{"sonuc":evet},
				success:function(son){
					
				}
			});
			
		});
		
		
		$("#kapsayici #icerik #me_alt input#h").click(function(){
			var hayir=$(this).val();
			$("#kapsayici #icerik #me_alt input").attr("disabled","disabled");
			$.ajax({
				type:"POST",
				url:"anket.php",
				data:{"sonuc":hayir},
				success:function(son){
					
				}
			});
			
		});
		
		
	
	//ANKET BÖLÜMÜ BİTİŞ
	
	
	//ÜYE VE ARKADAŞIN TAB MENÜ BÖLÜMÜ BAŞLANGIÇ
	
	$("ul.tab li:first").addClass("aktif");
			$("div.tabicerik").hide();
			$("div.tabicerik:first").show();
			$("ul.tab li").click(function(){
				var indis=$(this).index();
				$("ul.tab li").removeClass("aktif");
				$("ul.tab li:eq("+indis+")").addClass("aktif");
				
				$("div.tabicerik").hide();
				$("div.tabicerik:eq("+indis+")").show();
				return false
			});

	
	//ÜYE VE ARKADAŞIN TAB MENÜ BÖLÜMÜ BİTİŞ
	
	
	//ARKADAŞLIK İSTEĞİ GÖNDERME BÖLÜMÜ BAŞLANGIÇ
	
	$("#uyeler_bolumu .uyeler .uye_ok").click(function(){
		var indis=$("#uyeler_bolumu .uyeler .uye_ok").index(this);
		var uye=$("#uyeler_bolumu .uye_isim:eq("+indis+")").attr("value");
		
		$.ajax({
			type:"POST",
			url:"istek.php",
			data:{"uye":uye},
			success:function(){
				$("#uyeler_bolumu .uyeler:eq("+indis+")").fadeOut(500);
			}
		});
		
	});
	
	
	//ARKADAŞLIK İSTEĞİ GÖNDERME BÖLÜMÜ BİTİŞ
	
	//ARKADAŞLAR YENİLEME BÖLÜMÜ BAŞLANGIÇ
	
		$.arkadas_yukle=function(){
			$("#arkadaslar_bolumu").load("arkadaslarim.php");
		}
		$.arkadas_yukle();
		setInterval("$.arkadas_yukle();",1000);
		
	
	//ARKADAŞLAR YENİLEME BÖLÜMÜ BİTİŞ
	
	
	
	//İSTEKLERİ LİSTELE BÖLÜMÜ BAŞLANGIÇ
	
	$("#hesap_istek").click(function(){
		$("#icerik").load("istekler.php");
	});
	
	//İSTEKLERİ LİSTELE BÖLÜMÜ BİTİŞ
	
	
	
	//ENGELLEME BÖLÜMÜ BAŞLANGIÇ
		
		$("#engelle").click(function(){
			var sor=confirm("Bu Arkadaşınızı Engellenecektir. Bir Daha Bu Arkadaşınızla İletişim Kuramazsınız.");
			if(sor==true){
				$.ajax({
					url:"engelle.php",
					success:function(aa){
						window.location="index.php";
					}
				});
			}
		});
	
	//ENGELLEME BÖLÜMÜ BİTİŞ
	
	//ENGELLENENLERİ LİSTELE BÖLÜMÜ BAŞLANGIÇ
	
	$("#hesap_engel").click(function(){
		$("#icerik").load("engellenenler.php");
	});
	
	//ENGELLENENLERİ LİSTELE BÖLÜMÜ BİTİŞ
	
	//ARKADAŞ SİLME BÖLÜMÜ BAŞLANGIÇ
		
		$("#sil").click(function(){
			var sor=confirm("Bu Arkadaşınızı Silinecektir. Bir Daha Bu Arkadaşınızla İletişim Kuramazsınız.");
			if(sor==true){
				$.ajax({
					url:"sil.php",
					success:function(aa){
						window.location="index.php";
					}
				});
			}
		});
	
	//ARKADAŞ SİLME BÖLÜMÜ BİTİŞ

	
	
	//ŞİFREMİ UNUTTUM BÖLÜMÜ BAŞLANGIÇ
	
	$("#unuttum").click(function(){
		$("#unuttum_bolumu").fadeToggle(500);
		return false
	});
	
	$(".kapat").click(function(){
		$("#unuttum_bolumu").fadeOut(500);
		$("#sifresonuc").hide();
		return false
	});
	
	$("#unuttum_bolumu .btn").click(function(){
		var eposta=$("input[name=eposta]").val();
		if(eposta==""){
			$("#sifresonuc").fadeIn(300);
			$("#sifresonuc").html("Boş Bırakmayınız !");
		}else{
			
			$.ajax({
				type:"POST",
				url:"unuttum.php",
				data:{"eposta":eposta},
				success:function(cevap){
					$("#sifresonuc").fadeIn(300);
					$("#sifresonuc").html(cevap);
				}
				
			});
			
		}
		
		
	});
	
	
	//ŞİFREMİ UNUTTUM BÖLÜMÜ BİTİŞ
	
	/*
	$("#mesajlar").scroll(function(){
		
		var mesaj=document.getElementById("mesajlar");
		alert("SCROLL TOP : "+mesaj.scrollTop);
		alert("CLİENT HEİGHT : "+mesaj.clientHeight);
		
		var toplam=parseInt(mesaj.scrollTop)+parseInt(mesaj.clientHeight);
		
		alert("SCROLL HEİGHT : "+mesaj.scrollHeight+" TOPLAMLARI : "+toplam);
		
		
		
	});
	*/
	
	
	
	
});