<?php
	session_start();
	ob_start();
	@$bag=mysql_connect("mysql.hostinger.web.tr","u239346644_root","bilal61")or die("Bağlantı Başarısız!");
	@$sec=mysql_select_db("u239346644_soh",$bag)or die("Veritabanı Yok!");
	mysql_query("SET NAMES utf8");
	mysql_query("SET CHARACTER SET utf8");
	error_reporting(0);
	date_default_timezone_set('Europe/Istanbul');
?>