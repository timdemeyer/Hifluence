-- phpMyAdmin SQL Dump
-- version 4.0.10.6
-- http://www.phpmyadmin.net
--
-- Machine: 10.3.0.121
-- Genereertijd: 26 sep 2016 om 15:31
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_comments`
--

INSERT INTO `tbl_comments` (`PK_CommentID`, `Name`, `Comment`, `Date`) VALUES
(11, 'Tim', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21'),
(12, 'Jan', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21'),
(13, 'Mark', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam varius leo nec diam auctor, id ultrices nisl vulputate. Phasellus vitae tortor libero.', '2016-09-21'),
(14, 'some', 'this comment', '2016-09-21');

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
-- Tabelstructuur voor tabel `tbl_tags`
--

CREATE TABLE IF NOT EXISTS `tbl_tags` (
  `PK_TagId` int(11) NOT NULL AUTO_INCREMENT,
  `Tagname` varchar(128) NOT NULL,
  PRIMARY KEY (`PK_TagId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_tags`
--

INSERT INTO `tbl_tags` (`PK_TagId`, `Tagname`) VALUES
(1, 'Red'),
(2, 'Orange'),
(3, 'Yellow'),
(4, 'Green'),
(5, 'Blue'),
(6, 'Indigo'),
(7, 'Violet'),
(8, 'White'),
(9, 'Black');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_users`
--

INSERT INTO `tbl_users` (`PK_UserId`, `Username`, `Password`, `Email`, `ProfileImage`, `Tag`) VALUES
(28, 'Tim', 'dded3fd91f6487b9692a5107b2bbcbb1720a17c2', 'timdemeyer92@gmail.com', 'tim.jpg', 'white'),
(29, 'MIchiel', '66652356dc9cedf5c91a1c93d2ef1bbfd6aee684', 'michiel.steegmans@gmail.com', 'incorrect2.jpg', 'red'),
(33, 'Jan', 'dded3fd91f6487b9692a5107b2bbcbb1720a17c2', 'tim315859@hotmail.com', 'incorrect3.jpg', '');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tbl_usertags`
--

CREATE TABLE IF NOT EXISTS `tbl_usertags` (
  `PK_UserTagId` int(11) NOT NULL AUTO_INCREMENT,
  `FK_UserId` int(11) NOT NULL,
  `FK_TagId` int(11) NOT NULL,
  PRIMARY KEY (`PK_UserTagId`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Gegevens worden uitgevoerd voor tabel `tbl_usertags`
--

INSERT INTO `tbl_usertags` (`PK_UserTagId`, `FK_UserId`, `FK_TagId`) VALUES
(1, 30, 1),
(3, 0, 1),
(4, 0, 2),
(5, 0, 6),
(6, 32, 2),
(7, 32, 4),
(8, 32, 6),
(9, 33, 2),
(10, 33, 4),
(11, 33, 6);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
