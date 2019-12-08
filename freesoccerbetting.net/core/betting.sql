-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 03, 2016 at 07:17 PM
-- Server version: 10.1.16-MariaDB
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `betting`
--

-- --------------------------------------------------------

--
-- Table structure for table `final_winers`
--

CREATE TABLE `final_winers` (
  `id` int(11) NOT NULL,
  `win_id_tickets` int(11) DEFAULT NULL,
  `win_g_match` varchar(485) CHARACTER SET utf8 DEFAULT NULL,
  `win_allocation` decimal(9,2) DEFAULT NULL,
  `win_t_money` bigint(255) DEFAULT NULL,
  `win_pos_win` bigint(255) DEFAULT NULL,
  `win_id_user` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `games`
--

CREATE TABLE `games` (
  `id_game` int(11) NOT NULL,
  `team1` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `team2` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tip_win` varchar(22) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tip1` decimal(9,2) DEFAULT NULL,
  `tip2` decimal(9,2) DEFAULT NULL,
  `tip_x` decimal(9,2) DEFAULT NULL,
  `utakmica` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `beginning` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `games`
--

INSERT INTO `games` (`id_game`, `team1`, `team2`, `tip_win`, `tip1`, `tip2`, `tip_x`, `utakmica`, `beginning`) VALUES
(244, 'Arsenal', 'Bournemouth', '1', '1.40', '9.00', '5.00', 'Arsenal - Bournemouth', '2016-11-27 15:15:00'),
(245, 'Manchester United', 'West Ham', 'X', '1.45', '7.50', '4.75', 'Manchester United - West Ham', '2016-11-27 17:30:00'),
(246, 'Southampton', 'Everton', '1', '2.15', '3.70', '3.40', 'Southampton - Everton', '2016-11-27 17:30:00'),
(247, 'Lyon', 'Paris SG', '2', '3.60', '2.05', '3.50', 'Lyon - Paris SG', '2016-11-27 20:45:00'),
(248, 'Nice', 'Bastia', 'X', '1.62', '6.00', '3.75', 'Nice - Bastia', '2016-11-27 17:00:00'),
(249, 'Angers', 'St Etienne', '2', '2.30', '3.30', '3.00', 'Angers - St Etienne', '2016-11-27 15:00:00'),
(250, 'Schalke', 'Darmstadt', '1', '1.33', '10.00', '5.00', 'Schalke - Darmstadt', '2016-11-27 15:30:00'),
(251, 'Hertha Berlin', 'FSV Mainz 05', '1', '2.00', '3.80', '3.50', 'Hertha Berlin - FSV Mainz 05', '2016-11-27 17:30:00'),
(252, 'Genoa', 'Juventus', '1', '6.00', '1.62', '3.75', 'Genoa - Juventus', '2016-11-27 15:00:00'),
(253, 'AS Roma', 'Pescara', '1', '1.20', '12.00', '7.50', 'AS Roma - Pescara', '2016-11-27 20:45:00'),
(254, 'Palermo', 'Lazio', '2', '5.50', '1.62', '4.00', 'Palermo - Lazio', '2016-11-27 12:30:00'),
(255, 'Real Sociedad', 'Barcelona', 'X', '7.00', '1.44', '4.75', 'Real Sociedad - Barcelona', '2016-11-27 20:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `options`
--

CREATE TABLE `options` (
  `id` int(11) NOT NULL,
  `site_name` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `site_desc` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ad` text COLLATE utf8_unicode_ci,
  `analytics` longtext CHARACTER SET utf8,
  `logo` varchar(99) CHARACTER SET utf8 DEFAULT NULL,
  `seo_text` varchar(99) CHARACTER SET utf8 DEFAULT NULL,
  `virtual_money` int(11) DEFAULT NULL,
  `prize` int(11) DEFAULT NULL,
  `gplus` int(11) DEFAULT '1',
  `prizeoff` int(11) DEFAULT NULL,
  `points_every_day` int(11) DEFAULT NULL,
  `points_less_then` int(11) DEFAULT NULL,
  `paypal_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_identitytoken` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paypal_off` int(11) DEFAULT NULL,
  `paypal_price` int(11) DEFAULT NULL,
  `virtual_amount` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `options`
--

INSERT INTO `options` (`id`, `site_name`, `site_desc`, `ad`, `analytics`, `logo`, `seo_text`, `virtual_money`, `prize`, `gplus`, `prizeoff`, `points_every_day`, `points_less_then`, `paypal_email`, `paypal_identitytoken`, `paypal_off`, `paypal_price`, `virtual_amount`) VALUES
(1, 'Ticket 1x2 Free Soccer Betting Game', 'Bet virtually on real matches with real odds using a virtual currency and win prize', '<script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script><!-- ban --><ins class="adsbygoogle"style="display:block"data-ad-client="ca-pub-4690665151022700"data-ad-slot="5923751474"data-ad-format="auto"></ins><script>(adsbygoogle = window.adsbygoogle || []).push({});</script>', '', 'images/logo.png', 'Bet virtually on real matches<br> with real odds using a virtual<br> currency and win prize', 100000, 10, 1, 1, 50, 200, 'prodavaccoins@ticket1x2.com', 'WlipXhoMrOBC-D-uuFV5Ep13FOjetgJUtaEq4_7lV7oNP9QPpFwCZuvN8B0', 1, 1, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `transaction_id` varchar(245) COLLATE utf8_unicode_ci DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `order_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `paid` int(11) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`order_id`, `user_id`, `transaction_id`, `amount`, `order_time`, `paid`) VALUES
(8, 2, '2LS61097N9727264N', 10, '2016-12-03 16:35:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `prize`
--

CREATE TABLE `prize` (
  `prize_id` int(11) NOT NULL,
  `prize_user_id` int(11) NOT NULL,
  `prize_user` varchar(45) CHARACTER SET utf8 NOT NULL,
  `prize_email` varchar(45) CHARACTER SET utf8 DEFAULT NULL,
  `prize_money` int(11) NOT NULL,
  `prize_status` int(11) DEFAULT '0',
  `prize_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id_tickets` int(11) NOT NULL,
  `g_match` varchar(485) CHARACTER SET utf8 DEFAULT NULL,
  `allocation` decimal(9,2) DEFAULT NULL,
  `t_money` int(11) DEFAULT NULL,
  `pos_win` bigint(255) DEFAULT NULL,
  `id_user` int(11) DEFAULT NULL,
  `time_a` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id_tickets`, `g_match`, `allocation`, `t_money`, `pos_win`, `id_user`, `time_a`) VALUES
(339, ' <br>1: England - Spain: 3.00 <br>1: Costa Rica - USA: 2.05 <br>1: Peru - Brazil: 6.00 <br>1: Figueirense - Corinthians: 2.75 <br>1: Arsenal Tula - CSKA Moscow: 5.00 <br>1: Lorient - Monaco: 4.00 <br>1: Betis - Las Palmas: 2.38 <br>1: Lille - Monaco: 2.75', '13283.08', 100, 1328308, 3, '2016-11-18 20:45:00'),
(340, ' <br>1: England - Spain: 3.00 <br>1: Costa Rica - USA: 2.05 <br>1: Peru - Brazil: 6.00 <br>1: Figueirense - Corinthians: 2.75 <br>1: Arsenal Tula - CSKA Moscow: 5.00 <br>1: Lorient - Monaco: 4.00 <br>1: Betis - Las Palmas: 2.38 <br>1: Lille - Monaco: 2.75', '13283.08', 100, 1328308, 3, '2016-11-18 20:45:00'),
(341, ' <br>1: Peru - Brazil: 6.00 <br>1: Figueirense - Corinthians: 2.75', '16.50', 100, 1650, 3, '2016-11-18 20:45:00'),
(355, ' <br>1: Benfica - Maritimo: 1.25 <br>1: FK Sarajevo - Mladost DK: 1.29 <br>2: Atalanta - AS Roma: 1.95 <br>1: Salzburg - Rapid Vienna: 1.62 <br>1: Marseille - Caen: 1.70 <br>2: Middlesbrough - Chelsea: 1.55', '13.42', 1, 13, 141, '2016-11-20 20:45:00'),
(356, ' <br>1: FK Sarajevo - Mladost DK: 1.29 <br>2: Leeds - Newcastle Utd: 2.10 <br>2: Atalanta - AS Roma: 1.95 <br>2: Odense - Brondby: 1.83 <br>X: Salzburg - Rapid Vienna: 3.75 <br>2: Belupo - Rijeka: 1.57 <br>1: Marseille - Caen: 1.70 <br>2: Middlesbrough - Chelsea: 1.55 <br>X: Ath Bilbao - Villarreal: 3.30 <br>1: AC Milan - Inter: 2.80', '1385.73', 20, 27715, 145, '2016-11-20 20:45:00'),
(364, ' <br>1: Corinthians - Internacional: 2.10', '2.10', 1, 2, 155, '2016-11-22 20:45:00'),
(365, ' <br>2: Sporting - Real Madrid: 1.57', '1.57', 50, 79, 156, '2016-11-22 20:45:00'),
(376, ' <br>1: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>1: Genk - Rapid Vienna: 2.25 <br>2: Dundalk - AZ Alkmaar: 2.30 <br>1: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>1: St Etienne - FSV Mainz 05: 2.45', '101.51', 120, 12181, 20, '2016-11-24 21:05:00'),
(377, ' <br>1: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>1: Genk - Rapid Vienna: 2.25 <br>2: Dundalk - AZ Alkmaar: 2.30 <br>1: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>1: St Etienne - FSV Mainz 05: 2.45', '101.51', 91, 9237, 20, '2016-11-24 21:05:00'),
(378, ' <br>1: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>1: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>1: Partizan - Napredak: 1.30 <br>1: Lok. Zagreb - Belupo: 1.80 <br>2: SC Freiburg - RB Leipzig: 1.91 <br>1: Club Brugge KV - KV Mechelen: 1.33', '47.59', 54, 2570, 20, '2016-11-25 21:30:00'),
(386, ' <br>2: Burnley - Manchester City: 1.33 <br>2: Eintracht Frankfurt - Dortmund: 1.65 <br>1: Liverpool - Sunderland: 1.17 <br>1: Leicester - Middlesbrough: 1.91 <br>1: Real Madrid - Gijon: 1.06 <br>1: Monaco - Marseille: 1.67 <br>1: Chelsea - Tottenham: 1.75 <br>1: Bayern Munich - Bayer Leverkusen: 1.29 <br>2: Empoli - AC Milan: 2.05 <br>1: Sevilla - Valencia: 1.73', '69.50', 1, 70, 166, '2016-11-26 20:45:00'),
(391, ' <br>1: Nice - Bastia: 162.00', '162.00', 263, 42606, 151, '2016-11-27 20:45:00'),
(392, ' <br>1: Nice - Bastia: 162.00', '162.00', 355, 57510, 151, '2016-11-27 20:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id_users` int(11) NOT NULL,
  `user` varchar(45) CHARACTER SET utf8 NOT NULL,
  `pass` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `email_paypal` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `user_money` bigint(255) DEFAULT NULL,
  `status` int(11) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id_users`, `user`, `pass`, `email`, `email_paypal`, `user_money`, `status`) VALUES
(2, 'petar', '8fc5cfec5633247f5aadf14d3870d896', 'radewebsite@gmail.com', 'prodavaccoins@ticket1x2.com', 9200, 1),
(3, 'admin', '21232f297a57a5a743894a0e4a801fc3', 'umetnikcvelee@gmail.com', 'radecoins@ticket1x2.com', 1200, 2),
(5, 'remabre', 'cfec6612de8a75c257f42378ce499c0e', 'remajecarbree@gmail.com', '', 200, 1),
(6, 'Erw', 'dcaa7d861a3ae3bfebc54c9b7fcc69ea', 'X@c.on', NULL, 200, 1),
(20, 'Radovan Stojanovic', '12345', 'umetnikcvele@gmail.com', NULL, 200, 1),
(130, 'oglasi clasifeed', '12345', 'oglasiad@gmail.com', NULL, 200, 1),
(140, 'vertez', '1e852549ca14322f9ce1134da15b4768', 'wiktorinio@wp.pl', '', 200, 1),
(141, 'ÐÐºÑ€Ð¾Ð±Ð°Ñ‚', '12345', 's.accrobat@gmail.com', NULL, 249, 1),
(144, 'Florim', '0318a2caf5ff012a9bcdf7804f4759af', 'florimi_bb7@hotmail.com', NULL, 200, 1),
(145, 'Nemanja Petrovic', '12345', 'nemanjap55@gmail.com', NULL, 230, 1),
(147, 'harisonn', 'bb20a41079c508ae4738a12286ec5d2c', 'hmilavic@gmail.com', NULL, 200, 1),
(151, 'Aleksandar', '38b14284dd6ea4b9fc3ad3943f4c7cdc', 'sale.kovjanic@gmail.com', NULL, 221, 1),
(152, 'pks', '9cf41d1b7c127f997fc8f61ebd5c308b', 'perojzma@gmail.com', NULL, 200, 1),
(153, 'asd', '48c03a144a8065f6d4e23bd63008be4d', 'qwery@yahoo.com', NULL, 200, 1),
(154, '"hello"', '81dc9bdb52d04dc20036dbd8313ed055', 'asd@hsa.er', NULL, 200, 1),
(155, 'test', '098f6bcd4621d373cade4e832627b4f6', 'some@mail.com', NULL, 249, 1),
(156, 'Hezekia Lyatuu', '12345', 'hlyatuu4@gmail.com', NULL, 200, 1),
(158, 'tan', 'be5720a8fa6aba223f193237877e3b76', 'ck.calvinklein94@yahoo.com', NULL, 200, 1);

-- --------------------------------------------------------

--
-- Table structure for table `winers`
--

CREATE TABLE `winers` (
  `id_tickets_w` int(11) NOT NULL,
  `g_match_w` varchar(485) CHARACTER SET utf8 DEFAULT NULL,
  `allocation_w` decimal(9,2) DEFAULT NULL,
  `t_money_w` int(11) DEFAULT NULL,
  `pos_win_w` bigint(255) DEFAULT NULL,
  `id_user_w` int(11) DEFAULT NULL,
  `time_w` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `winers`
--

INSERT INTO `winers` (`id_tickets_w`, `g_match_w`, `allocation_w`, `t_money_w`, `pos_win_w`, `id_user_w`, `time_w`) VALUES
(339, ' <br>X: England - Spain: 3.00 <br>1: Costa Rica - USA: 2.05 <br>2: Peru - Brazil: 6.00 <br>X: Figueirense - Corinthians: 2.75 <br>2: Arsenal Tula - CSKA Moscow: 5.00 <br>2: Lorient - Monaco: 4.00 <br>1: Betis - Las Palmas: 2.38 <br>: Lille - Lyon: 2.75', '13283.08', 100, 1328308, 3, '2016-11-18 20:45:00'),
(340, ' <br>X: England - Spain: 3.00 <br>1: Costa Rica - USA: 2.05 <br>2: Peru - Brazil: 6.00 <br>X: Figueirense - Corinthians: 2.75 <br>2: Arsenal Tula - CSKA Moscow: 5.00 <br>2: Lorient - Monaco: 4.00 <br>1: Betis - Las Palmas: 2.38 <br>: Lille - Lyon: 2.75', '13283.08', 100, 1328308, 3, '2016-11-18 20:45:00'),
(341, ' <br>2: Peru - Brazil: 6.00 <br>X: Figueirense - Corinthians: 2.75', '16.50', 100, 1650, 3, '2016-11-18 20:45:00'),
(355, ' <br>1: Benfica - Maritimo: 1.25 <br>1: FK Sarajevo - Mladost DK: 1.29 <br>1: Atalanta - AS Roma: 1.95 <br>1: Salzburg - Rapid Vienna: 1.62 <br>1: Marseille - Caen: 1.70 <br>2: Middlesbrough - Chelsea: 1.55', '13.42', 1, 13, 141, '2016-11-20 20:45:00'),
(356, ' <br>1: FK Sarajevo - Mladost DK: 1.29 <br>2: Leeds - Newcastle Utd: 2.10 <br>1: Atalanta - AS Roma: 1.95 <br>1: Odense - Brondby: 1.83 <br>1: Salzburg - Rapid Vienna: 3.75 <br>X: Belupo - Rijeka: 1.57 <br>1: Marseille - Caen: 1.70 <br>2: Middlesbrough - Chelsea: 1.55 <br>1: Ath Bilbao - Villarreal: 3.30 <br>X: AC Milan - Inter: 2.80', '1385.73', 20, 27715, 145, '2016-11-20 20:45:00'),
(364, ' <br>1: Corinthians - Internacional: 2.10', '2.10', 1, 2, 155, '2016-11-22 20:45:00'),
(365, ' <br>2: Sporting - Real Madrid: 1.57', '1.57', 50, 79, 156, '2016-11-22 20:45:00'),
(376, ' <br>X: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>1: Genk - Rapid Vienna: 2.25 <br>2: Dundalk - AZ Alkmaar: 2.30 <br>2: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>X: St Etienne - FSV Mainz 05: 2.45', '101.51', 120, 12181, 20, '2016-11-24 21:05:00'),
(377, ' <br>X: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>1: Genk - Rapid Vienna: 2.25 <br>2: Dundalk - AZ Alkmaar: 2.30 <br>2: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>X: St Etienne - FSV Mainz 05: 2.45', '101.51', 91, 9237, 20, '2016-11-24 21:05:00'),
(378, ' <br>X: Olympiakos Piraeus - Young Boys: 1.67 <br>1: Manchester United - Feyenoord: 1.36 <br>2: Austria Vienna - Astra: 1.80 <br>1: Ath Bilbao - Sassuolo: 1.44 <br>1: AS Roma - Plzen: 1.36 <br>1: Partizan - Napredak: 1.30 <br>2: Lok. Zagreb - Belupo: 1.80 <br>2: SC Freiburg - RB Leipzig: 1.91 <br>1: Club Brugge KV - KV Mechelen: 1.33', '47.59', 54, 2570, 20, '2016-11-25 21:30:00'),
(386, ' <br>2: Burnley - Manchester City: 1.33 <br>1: Eintracht Frankfurt - Dortmund: 1.65 <br>1: Liverpool - Sunderland: 1.17 <br>X: Leicester - Middlesbrough: 1.91 <br>1: Real Madrid - Gijon: 1.06 <br>1: Monaco - Marseille: 1.67 <br>1: Chelsea - Tottenham: 1.75 <br>1: Bayern Munich - Bayer Leverkusen: 1.29 <br>2: Empoli - AC Milan: 2.05 <br>1: Sevilla - Valencia: 1.73', '69.50', 1, 70, 166, '2016-11-26 20:45:00'),
(391, ' <br>X: Nice - Bastia: 162.00', '162.00', 263, 42606, 151, '2016-11-27 20:45:00'),
(392, ' <br>X: Nice - Bastia: 162.00', '162.00', 355, 57510, 151, '2016-11-27 20:45:00');

-- --------------------------------------------------------

--
-- Table structure for table `winer_tickets`
--

CREATE TABLE `winer_tickets` (
  `winer_tickets_id` int(11) NOT NULL,
  `winer_tickets_win_id_tickets` int(11) DEFAULT NULL,
  `winer_tickets_g_match` varchar(485) COLLATE utf8_unicode_ci DEFAULT NULL,
  `winer_tickets_allocation` decimal(9,2) DEFAULT NULL,
  `winer_tickets_win_t_money` bigint(255) DEFAULT NULL,
  `winer_tickets_win_pos_win` bigint(255) DEFAULT NULL,
  `winer_ticket_win_id_user` int(11) DEFAULT NULL,
  `winer_tickets_time` datetime DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `winer_tickets`
--

INSERT INTO `winer_tickets` (`winer_tickets_id`, `winer_tickets_win_id_tickets`, `winer_tickets_g_match`, `winer_tickets_allocation`, `winer_tickets_win_t_money`, `winer_tickets_win_pos_win`, `winer_ticket_win_id_user`, `winer_tickets_time`) VALUES
(1, 349, ' <br>1: Dortmund - Bayern Munich: 3.50', '3.50', 3, 11, 20, '2016-11-20 17:03:00'),
(7, 352, ' <br>1: Partizan - Backa: 1.10 <br>2: Napredak - FK Crvena zvezda: 1.73', '1.90', 300, 571, 2, '2016-11-20 17:16:58'),
(11, 357, ' <br>1: Ath Bilbao - Villarreal: 2.15', '2.15', 25, 54, 20, '2016-11-22 23:00:35'),
(16, 369, ' <br>1: Monaco - Tottenham: 2.60 <br>1: Dortmund - Legia: 1.10 <br>2: Sporting - Real Madrid: 1.57', '4.49', 50, 225, 2, '2016-11-23 11:39:41'),
(29, 368, ' <br>1: Leicester - Club Brugge KV: 1.44 <br>1: Dortmund - Legia: 1.10 <br>2: D. Zagreb - Lyon: 1.57 <br>2: Sporting - Real Madrid: 1.57', '3.90', 50, 195, 5, '2016-11-23 19:25:03'),
(30, 363, ' <br>1: Leicester - Club Brugge KV: 1.44 <br>1: Dortmund - Legia: 1.10 <br>2: D. Zagreb - Lyon: 1.57 <br>2: Sporting - Real Madrid: 1.57', '3.90', 200, 781, 5, '2016-11-23 19:25:03'),
(36, 367, ' <br>1: Leicester - Club Brugge KV: 1.44 <br>1: Dortmund - Legia: 1.10 <br>2: D. Zagreb - Lyon: 1.57 <br>2: Sporting - Real Madrid: 1.57', '3.90', 50, 195, 151, '2016-11-24 17:07:59'),
(37, 366, ' <br>1: Leicester - Club Brugge KV: 1.44 <br>1: Dortmund - Legia: 1.10 <br>2: D. Zagreb - Lyon: 1.57 <br>2: Sporting - Real Madrid: 1.57', '3.90', 50, 195, 151, '2016-11-24 17:07:59'),
(52, 382, ' <br>1: Partizan - Napredak: 1.30 <br>1: Club Brugge KV - KV Mechelen: 1.33', '1.73', 100, 173, 151, '2016-11-25 23:53:00'),
(54, 389, ' <br>2: Empoli - AC Milan: 2.05 <br>1: Sevilla - Valencia: 1.73', '3.55', 500, 1773, 2, '2016-11-26 22:35:40'),
(55, 384, ' <br>2: Burnley - Manchester City: 1.33 <br>1: Liverpool - Sunderland: 1.17 <br>1: Real Madrid - Gijon: 1.06 <br>1: Bayern Munich - Bayer Leverkusen: 1.29', '2.13', 200, 426, 151, '2016-11-26 23:31:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `final_winers`
--
ALTER TABLE `final_winers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `win_id_tickets_UNIQUE` (`win_id_tickets`);

--
-- Indexes for table `games`
--
ALTER TABLE `games`
  ADD PRIMARY KEY (`id_game`);

--
-- Indexes for table `options`
--
ALTER TABLE `options`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `prize`
--
ALTER TABLE `prize`
  ADD PRIMARY KEY (`prize_id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id_tickets`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id_users`),
  ADD UNIQUE KEY `user_UNIQUE` (`user`),
  ADD UNIQUE KEY `id_users_UNIQUE` (`id_users`),
  ADD UNIQUE KEY `email_UNIQUE` (`email`);

--
-- Indexes for table `winers`
--
ALTER TABLE `winers`
  ADD PRIMARY KEY (`id_tickets_w`);

--
-- Indexes for table `winer_tickets`
--
ALTER TABLE `winer_tickets`
  ADD PRIMARY KEY (`winer_tickets_id`),
  ADD UNIQUE KEY `winer_tickets_win_id_tickets_UNIQUE` (`winer_tickets_win_id_tickets`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `final_winers`
--
ALTER TABLE `final_winers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `games`
--
ALTER TABLE `games`
  MODIFY `id_game` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=256;
--
-- AUTO_INCREMENT for table `options`
--
ALTER TABLE `options`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `prize`
--
ALTER TABLE `prize`
  MODIFY `prize_id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id_tickets` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id_users` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=159;
--
-- AUTO_INCREMENT for table `winers`
--
ALTER TABLE `winers`
  MODIFY `id_tickets_w` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=393;
--
-- AUTO_INCREMENT for table `winer_tickets`
--
ALTER TABLE `winer_tickets`
  MODIFY `winer_tickets_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
