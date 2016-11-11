<?php
	session_start();
	ob_start();
	@$bag=mysql_connect("Adres","Veritabanı Kullanıcı Adı","Veritabanı Şifresi")or die("Bağlantı Başarısız!");
	@$sec=mysql_select_db("Veritabanı İsimi",$bag)or die("Veritabanı Yok!");
	mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER SET utf8");
	error_reporting(0);
	date_default_timezone_set('Europe/Istanbul');
?>