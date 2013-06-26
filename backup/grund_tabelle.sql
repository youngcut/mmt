-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Erstellungszeit: 15. Juni 2013 um 11:07
-- Server Version: 5.1.44
-- PHP-Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `mmt`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `objects`
--

CREATE TABLE IF NOT EXISTS `objects` (
  `do_index` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `do_name` varchar(45) NOT NULL,
  `do_id` int(11) NOT NULL,
  `do_class` int(10) unsigned NOT NULL DEFAULT '0' COMMENT 'parent',
  `do_user` varchar(4) NOT NULL,
  `do_pic` float NOT NULL,
  `do_attr1` text NOT NULL,
  `do_attr2` text NOT NULL,
  `do_attr3` text NOT NULL,
  `do_attr4` text NOT NULL,
  `do_attr5` text NOT NULL,
  PRIMARY KEY (`do_index`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT AUTO_INCREMENT=12 ;

--
-- Daten für Tabelle `objects`
--

INSERT INTO `objects` (`do_index`, `do_name`, `do_id`, `do_class`, `do_user`, `do_pic`, `do_attr1`, `do_attr2`, `do_attr3`, `do_attr4`, `do_attr5`) VALUES
(4, 'Werkzeug', 1, 2, '', 0, 'Bau', 'Pool', '', '', ''),
(5, 'Auto', 1, 1, '', 0, 'ja', 'keine', 'pool', '', ''),
(10, 'Messgerät', 1, 3, 'gsro', 0, 'Bild', 'HDMI, VGA, DVI', 'nein', '', ''),
(11, 'Laptop', 0, 4, 'gsro', 0, 'Windows XP', 'ja', '', '', '');
