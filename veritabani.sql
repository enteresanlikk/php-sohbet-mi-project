
-- phpMyAdmin SQL Dump
-- version 3.5.2.2
-- http://www.phpmyadmin.net
--
-- Anamakine: localhost
-- Üretim Zamanı: 11 Kas 2016, 07:15:05
-- Sunucu sürümü: 10.0.20-MariaDB
-- PHP Sürümü: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Veritabanı: `u239346644_soh`
--

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `anket`
--

CREATE TABLE IF NOT EXISTS `anket` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `katilan` varchar(255) NOT NULL,
  `deger` varchar(255) NOT NULL,
  `tarih` varchar(255) NOT NULL,
  PRIMARY KEY (`aid`),
  UNIQUE KEY `katilan` (`katilan`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `arkadaslik`
--

CREATE TABLE IF NOT EXISTS `arkadaslik` (
  `aid` int(11) NOT NULL AUTO_INCREMENT,
  `istekgonderen` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `istekalan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `onay` int(11) NOT NULL,
  PRIMARY KEY (`aid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `engellimi`
--

CREATE TABLE IF NOT EXISTS `engellimi` (
  `eid` int(11) NOT NULL AUTO_INCREMENT,
  `engelleyen` varchar(255) NOT NULL,
  `engellenen` varchar(255) NOT NULL,
  `engel` int(11) NOT NULL,
  PRIMARY KEY (`eid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `mesaj_sayisi`
--

CREATE TABLE IF NOT EXISTS `mesaj_sayisi` (
  `sid` int(11) NOT NULL AUTO_INCREMENT,
  `mesaj_gonderen` varchar(255) NOT NULL,
  `mesaj_alan` varchar(255) NOT NULL,
  `mesaj_sayi` int(11) NOT NULL,
  PRIMARY KEY (`sid`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Tablo döküm verisi `mesaj_sayisi`
--

INSERT INTO `mesaj_sayisi` (`sid`, `mesaj_gonderen`, `mesaj_alan`, `mesaj_sayi`) VALUES
(1, 'ilknur', 'ahmet', 0),
(2, 'ahmet', 'ilknur', 25);

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `online_mi`
--

CREATE TABLE IF NOT EXISTS `online_mi` (
  `oid` int(11) NOT NULL AUTO_INCREMENT,
  `oadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `online` varchar(11) COLLATE utf8_turkish_ci NOT NULL,
  `tarih` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`oid`),
  UNIQUE KEY `oadi` (`oadi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tablo için tablo yapısı `uyeler`
--

CREATE TABLE IF NOT EXISTS `uyeler` (
  `uid` int(11) NOT NULL AUTO_INCREMENT,
  `kadi` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `sifre` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `eposta` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `resim` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `uip` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  `arkaplan` varchar(255) COLLATE utf8_turkish_ci NOT NULL,
  PRIMARY KEY (`uid`),
  UNIQUE KEY `kadi_2` (`kadi`),
  KEY `kadi` (`kadi`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_turkish_ci AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
