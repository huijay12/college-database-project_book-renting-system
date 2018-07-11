-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- 主機: 127.0.0.1
-- 產生時間： 2015 �?05 ??14 ??16:59
-- 伺服器版本: 5.6.16
-- PHP 版本： 5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- 資料庫： `rentbook`
--

-- --------------------------------------------------------

--
-- 資料表結構 `books`
--

CREATE TABLE IF NOT EXISTS `books` (
  `book_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `version` int(11) NOT NULL,
  `subject` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `image` varchar(128) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=32 ;

--
-- 資料表的匯出資料 `books`
--

INSERT INTO `books` (`book_id`, `name`, `version`, `subject`, `status`, `image`) VALUES
(2, 'Algorithm', 3, '演算法', 3, 'algorithm.jpeg'),
(3, '深入淺出離散數學', 4, '離散數學', 4, 'discretemath.jpeg'),
(4, 'Introduction of Data Structure', 3, '資料結構', 4, 'datastructure.jpg'),
(5, '七把刀弄懂微積分', 1, '微積分', 4, '7knife.jpg'),
(16, '深入淺出程式設計', 4, '其他', 3, 'lrg.jpg'),
(17, 'gundam weapons 00', 1, '其他', 1, 'gundam_weapons.jpg'),
(18, 'C++程式設計', 2, 'C++', 2, 'Cplusplus.jpg'),
(19, 'JAVA2程式設計', 3, 'JAVA', 3, 'java.jpg'),
(20, '深入淺出python', 2, '其他', 2, 'python.jpg'),
(21, 'javaScript&JQuery', 1, '其他', 4, 'JSandJQ.jpg'),
(22, 'Objective-C 設計指南', 4, '其他', 2, 'objC.jpg'),
(23, 'Software Engineering', 6, '其他', 3, 'softwareEngineering.jpg'),
(24, 'LPI Linux 資格檢定', 2, '其他', 2, 'linux.gif'),
(25, 'CSS3 實作指南', 4, '其他', 4, 'CSS3.jpg'),
(26, '王者歸來 HTML5 & CSS3 權威指南', 4, '其他', 1, 'html5_css3.jpg'),
(27, '網頁程式設計 HTML5.Javascript.CSS.XHTML.Ajax', 4, '其他', 3, 'webprogramming.jpg'),
(28, 'HTML&CSS 網頁建置與優化之道', 3, '其他', 2, 'html_css.jpg'),
(29, '超圖解 Arduino 互動設計入門 2', 2, '其他', 2, '2013120294899b.jpg'),
(30, '8051 單晶片C語言入門與實作', 4, '其他', 3, '8051.jpg'),
(31, '浩銘的日記', 1, '其他', 1, 'Cover.jpg');

-- --------------------------------------------------------

--
-- 資料表結構 `manager`
--

CREATE TABLE IF NOT EXISTS `manager` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- 資料表的匯出資料 `manager`
--

INSERT INTO `manager` (`id`, `name`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- 資料表結構 `record`
--

CREATE TABLE IF NOT EXISTS `record` (
  `u_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `b_id` int(11) NOT NULL,
  `lend_time` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `back_time` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apply_rent_date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `apply_back_date` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`u_id`,`b_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `record`
--

INSERT INTO `record` (`u_id`, `b_id`, `lend_time`, `back_time`, `apply_rent_date`, `apply_back_date`) VALUES
('110016000', 16, '20140902', NULL, '20140902', '20140902'),
('110016000', 22, NULL, NULL, '20140618', NULL),
('110016000', 23, '20140902', NULL, '20140902', '20140902'),
('110016000', 24, NULL, NULL, '20140618', NULL),
('110016000', 25, '20140619', NULL, '20140618', NULL),
('110016002', 21, '20140620', NULL, '20140620', NULL),
('110016002', 27, '20140605', '', '20140604', '20140617'),
('110016025', 2, '20140618', NULL, '20140616', '20140618'),
('110016025', 3, '20140620', NULL, '20140620', NULL),
('110016025', 5, '20140620', NULL, '20140620', NULL),
('110016025', 18, NULL, NULL, '20140620', NULL),
('110016025', 19, '20140618', NULL, '20140618', '20140620'),
('110016025', 20, NULL, NULL, '20140620', NULL),
('110016025', 28, NULL, NULL, '20140620', NULL),
('110016025', 29, NULL, NULL, '20140620', NULL),
('110016025', 30, '20140618', NULL, '20140618', '20140620');

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `stu_id` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `phone_num` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`stu_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- 資料表的匯出資料 `users`
--

INSERT INTO `users` (`stu_id`, `name`, `phone_num`) VALUES
('110016000', 'flyflylee', '0937117493'),
('110016002', 'yimming tsai', '0922323878'),
('110016003', 'YimingTsai', '0953820619'),
('110016004', 'å† ç¨‹å¸¥', '0912345678'),
('110016011', 'yimming', '0912345678'),
('110016025', '緋緋小飛飛', '0937117493'),
('110016099', 'jifjiefjeklmcdsklvns', '0939393939');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
