-- phpMyAdmin SQL Dump
-- version 3.4.3.1
-- http://www.phpmyadmin.net
--
-- Host: fdb3.biz.nf
-- Generation Time: Jul 05, 2015 at 01:33 AM
-- Server version: 5.5.38
-- PHP Version: 5.3.27

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `1903325_c091`
--

-- --------------------------------------------------------

--
-- Table structure for table `config_references`
--

CREATE TABLE IF NOT EXISTS `config_references` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `config_name` varchar(50) NOT NULL,
  `config_value` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `config_references`
--

INSERT INTO `config_references` (`id`, `config_name`, `config_value`) VALUES
(1, 'address', '3730 N 1st Street, Suite 120, San Jose, CA 95134'),
(2, 'phone', '408-417-7507'),
(3, 'email', 'order@srisaifoods.com'),
(4, 'scrolltext', 'Scrollable Text'),
(5, 'businesshours', '11 am to 9 pm');

-- --------------------------------------------------------

--
-- Stand-in structure for view `getItems`
--
CREATE TABLE IF NOT EXISTS `getItems` (
`item_name` varchar(100)
,`item_description` varchar(2000)
,`item_image` blob
,`item_imageName` varchar(50)
,`item_price` double
,`choice_id` int(5)
,`choice_description` varchar(50)
,`groupid` int(5)
,`groupDescription` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `item_and_menu_group`
--

CREATE TABLE IF NOT EXISTS `item_and_menu_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `item_id` int(5) NOT NULL,
  `group_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=26 ;

--
-- Dumping data for table `item_and_menu_group`
--

INSERT INTO `item_and_menu_group` (`id`, `item_id`, `group_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 3),
(5, 6, 1),
(6, 7, 1),
(7, 8, 1),
(8, 9, 1),
(9, 6, 3),
(10, 7, 3),
(11, 8, 3),
(12, 9, 3),
(13, 3, 1),
(14, 3, 3),
(15, 4, 1),
(16, 4, 3),
(17, 5, 1),
(18, 5, 3),
(19, 10, 2),
(20, 11, 2),
(21, 12, 2),
(22, 6, 2),
(23, 7, 2),
(24, 8, 2),
(25, 9, 2);

-- --------------------------------------------------------

--
-- Table structure for table `item_choices`
--

CREATE TABLE IF NOT EXISTS `item_choices` (
  `choice_id` int(5) NOT NULL AUTO_INCREMENT,
  `choice_description` varchar(50) NOT NULL,
  PRIMARY KEY (`choice_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `item_choices`
--

INSERT INTO `item_choices` (`choice_id`, `choice_description`) VALUES
(1, 'Entree'),
(2, 'Side'),
(3, 'Drinks');

-- --------------------------------------------------------

--
-- Table structure for table `mealsize_and_group`
--

CREATE TABLE IF NOT EXISTS `mealsize_and_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `mealtypeid` int(5) NOT NULL,
  `groupid` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `mealsize_and_group`
--

INSERT INTO `mealsize_and_group` (`id`, `mealtypeid`, `groupid`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 2, 3),
(5, 3, 1),
(6, 3, 3),
(7, 4, 1),
(8, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meals_types`
--

CREATE TABLE IF NOT EXISTS `meals_types` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `meal_size` varchar(50) NOT NULL,
  `meal_description` varchar(100) DEFAULT NULL,
  `price` double NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `meals_types`
--

INSERT INTO `meals_types` (`id`, `meal_size`, `meal_description`, `price`) VALUES
(1, 'LIGHT Meals', '1 entree and 1 side', 6.99),
(2, 'MINI Meals', '2 entrees and 2 sides', 9.49),
(3, 'FULL Meals', '5 entrees & 3 sides', 13.99),
(4, 'Fresh Fruit Bowl', NULL, 6),
(5, 'Salad of the day', NULL, 6);

-- --------------------------------------------------------

--
-- Stand-in structure for view `meal_sizes_in_group`
--
CREATE TABLE IF NOT EXISTS `meal_sizes_in_group` (
`meal_size` varchar(50)
,`meal_description` varchar(100)
,`price` double
,`id` int(5)
,`groupDescription` varchar(50)
);
-- --------------------------------------------------------

--
-- Table structure for table `menu_group`
--

CREATE TABLE IF NOT EXISTS `menu_group` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `groupDescription` varchar(50) NOT NULL,
  `time_served` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `menu_group`
--

INSERT INTO `menu_group` (`id`, `groupDescription`, `time_served`) VALUES
(1, 'Lunch Menu', '11 am to 3 pm'),
(2, 'Snack Menu', '3 pm to 6 pm'),
(3, 'Dinner Menu', '6 pm to 9 pm');

-- --------------------------------------------------------

--
-- Table structure for table `menu_items`
--

CREATE TABLE IF NOT EXISTS `menu_items` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `item_name` varchar(100) NOT NULL,
  `item_description` varchar(2000) NOT NULL,
  `item_image` blob,
  `item_imageName` varchar(50) DEFAULT NULL,
  `item_price` double NOT NULL,
  `created_ts` datetime DEFAULT NULL,
  `last_modified_ts` datetime DEFAULT NULL,
  `item_choice_id` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 COMMENT='Menu Items' AUTO_INCREMENT=13 ;

--
-- Dumping data for table `menu_items`
--

INSERT INTO `menu_items` (`id`, `item_name`, `item_description`, `item_image`, `item_imageName`, `item_price`, `created_ts`, `last_modified_ts`, `item_choice_id`) VALUES
(1, 'Dry Curry', 'Curry that is dry', NULL, 'item1.jpg', 1.99, '2015-06-30 00:00:00', '2015-06-30 00:00:00', 1),
(2, 'Wet Curry', 'curry that is wet', NULL, 'item2.jpg', 2.99, '2015-06-30 00:00:00', '2015-06-30 00:00:00', 1),
(3, 'Dal & Liquid', 'Liquid in Dal', NULL, NULL, 0.99, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 1),
(4, 'White Rice', 'Rice that is white', NULL, NULL, 13.99, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 2),
(5, 'Special Rice and Roti (2)', 'Special Rice and Roti counted as two', NULL, NULL, 2, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 2),
(6, 'Flavored Butter Milk', 'Flavored Butter Milk', NULL, NULL, 2, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 3),
(7, 'Lemonade  ', 'Lemonade  ', NULL, NULL, 2, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 3),
(8, 'Soda', 'Soda', NULL, NULL, 1.5, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 3),
(9, 'Bottled Water', 'Bottled Water', NULL, NULL, 1.5, '2015-07-01 00:00:00', '2015-07-01 00:00:00', 3),
(10, 'Any One Snack of the day', '', NULL, NULL, 4.99, '2015-07-03 00:00:00', '2015-07-03 00:00:00', 1),
(11, 'Coffee', '', NULL, NULL, 2.25, '2015-07-03 00:00:00', '2015-07-03 00:00:00', 3),
(12, 'Tea', '', NULL, NULL, 2, '2015-07-03 00:00:00', '2015-07-03 00:00:00', 3);

-- --------------------------------------------------------

--
-- Structure for view `getItems`
--
DROP TABLE IF EXISTS `getItems`;

CREATE ALGORITHM=UNDEFINED DEFINER=`1903325_c091`@`%` SQL SECURITY DEFINER VIEW `getItems` AS select `items`.`item_name` AS `item_name`,`items`.`item_description` AS `item_description`,`items`.`item_image` AS `item_image`,`items`.`item_imageName` AS `item_imageName`,`items`.`item_price` AS `item_price`,`choice`.`choice_id` AS `choice_id`,`choice`.`choice_description` AS `choice_description`,`grp`.`id` AS `groupid`,`grp`.`groupDescription` AS `groupDescription` from (((`item_and_menu_group` `itemsGroup` join `menu_items` `items` on((`items`.`id` = `itemsGroup`.`item_id`))) join `item_choices` `choice` on((`items`.`item_choice_id` = `choice`.`choice_id`))) join `menu_group` `grp` on((`itemsGroup`.`group_id` = `grp`.`id`)));

-- --------------------------------------------------------

--
-- Structure for view `meal_sizes_in_group`
--
DROP TABLE IF EXISTS `meal_sizes_in_group`;

CREATE ALGORITHM=UNDEFINED DEFINER=`1903325_c091`@`%` SQL SECURITY DEFINER VIEW `meal_sizes_in_group` AS select `types`.`meal_size` AS `meal_size`,`types`.`meal_description` AS `meal_description`,`types`.`price` AS `price`,`grp`.`id` AS `id`,`grp`.`groupDescription` AS `groupDescription` from ((`mealsize_and_group` `sizeGroup` join `meals_types` `types` on((`sizeGroup`.`mealtypeid` = `types`.`id`))) join `menu_group` `grp` on((`sizeGroup`.`groupid` = `grp`.`id`)));

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
