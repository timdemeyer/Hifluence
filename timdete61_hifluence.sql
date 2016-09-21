-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Machine: 10.3.0.121
-- Genereertijd: 21 sep 2016 om 17:28
-- Serverversie: 5.6.29
-- PHP-versie: 5.5.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `timdete61_hifluence`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_comments`
--

CREATE TABLE IF NOT EXISTS `tbl_comments` (
  `PK_CommentID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(255) NOT NULL,
  `Comment` text NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`PK_CommentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_comments`
--

INSERT INTO `tbl_comments` (`PK_CommentID`, `Name`, `Comment`, `Date`) VALUES
(11, 'Tim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21'),
(12, 'Jan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21'),
(13, 'Mark', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_json`
--

CREATE TABLE IF NOT EXISTS `tbl_json` (
  `PK_JsonId` int(11) NOT NULL AUTO_INCREMENT,
  `Json` text NOT NULL,
  PRIMARY KEY (`PK_JsonId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_json`
--

INSERT INTO `tbl_json` (`PK_JsonId`, `Json`) VALUES
(1, '{"key0":"white","key1":"red","key2":"green"}');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_users`
--

CREATE TABLE IF NOT EXISTS `tbl_users` (
  `PK_UserId` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `ProfileImage` varchar(255) NOT NULL,
  `Tag` varchar(255) NOT NULL,
  PRIMARY KEY (`PK_UserId`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=29 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_users`
--

INSERT INTO `tbl_users` (`PK_UserId`, `Username`, `Password`, `Email`, `ProfileImage`, `Tag`) VALUES
(28, 'Tim', 'dded3fd91f6487b9692a5107b2bbcbb1720a17c2', 'timdemeyer92@gmail.com', 'tim.jpg', 'white');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
