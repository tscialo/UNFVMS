-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Feb 12, 2013 at 12:39 PM
-- Server version: 5.5.29
-- PHP Version: 5.3.10-1ubuntu3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `VMS`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `eID` bigint(20) unsigned NOT NULL,
  `userID` int(10) unsigned NOT NULL,
  `recipID` int(10) unsigned NOT NULL,
  `commentID` int(11) NOT NULL AUTO_INCREMENT,
  `parentID` int(11) NOT NULL,
  `comment` varchar(15000) NOT NULL,
  `uVotes` int(11) NOT NULL,
  `dVotes` int(11) NOT NULL,
  `created` int(11) NOT NULL,
  `deleted` tinyint(4) NOT NULL,
  PRIMARY KEY (`commentID`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`eID`, `userID`, `recipID`, `commentID`, `parentID`, `comment`, `uVotes`, `dVotes`, `created`, `deleted`) VALUES
(2, 12, 14, 1, 0, 'Testing the comments', 1, 0, 0, 0),
(2, 11, 0, 3, 0, 'a comment yes', 0, 0, 1360256864, 0),
(2, 11, 0, 4, 0, 'getting there', 0, 0, 1360259154, 0),
(2, 11, 0, 5, 0, 'maybe getting there', 0, 0, 1360259206, 0),
(2, 11, 0, 6, 0, 'closer?', 0, 0, 1360259388, 0),
(2, 11, 0, 8, 1, 'arggggggg', 0, 0, 1360260458, 0),
(2, 11, 0, 9, 0, 'a reply!', 0, 0, 1360266559, 0),
(2, 11, 12, 10, 1, 'i like it!', 0, 0, 1360266743, 0),
(2, 11, 11, 11, 4, 'were here now!', 0, 0, 1360266797, 0),
(2, 11, 11, 12, 4, 'not quite', 0, 0, 1360266830, 0),
(2, 11, 11, 13, 4, 'get there then', 0, 0, 1360266899, 0),
(2, 11, 11, 14, 4, 'trying!!!', 0, 0, 1360266937, 0),
(2, 11, 11, 15, 4, 'stilll', 0, 0, 1360267043, 0),
(2, 11, 11, 16, 4, 'sdfsdfsdfsdf', 0, 0, 1360267208, 0),
(2, 11, 11, 17, 5, 'here now?', 0, 0, 1360267360, 0),
(2, 11, 11, 18, 8, 'yeahhhh', 0, 0, 1360283492, 0),
(2, 11, 11, 19, 10, 'sure ya do', 0, 0, 1360301332, 0),
(2, 11, 11, 20, 19, 'i rllly do', 0, 0, 1360301466, 0),
(2, 11, 11, 21, 20, 'rlly rlly?', 0, 0, 1360301506, 0),
(2, 11, 11, 22, 21, 'like kale loves orange soda', 0, 0, 1360301750, 0),
(2, 11, 0, 23, 0, 'play play duh duh', 0, 0, 1360302051, 0),
(2, 11, 0, 24, 0, '50 50', 0, 0, 1360302194, 0),
(2, 11, 0, 25, 0, '8979787', 0, 0, 1360302273, 0),
(2, 11, 0, 26, 0, 'sdfsdfsdfdf', 0, 0, 1360302551, 0),
(2, 11, 0, 27, 0, 'dsfeeeeeee', 0, 0, 1360302639, 0),
(2, 11, 0, 28, 0, 'sdfwwwww', 0, 0, 1360302708, 0),
(2, 11, 11, 29, 3, 'o yes', 0, 0, 1360302815, 0),
(2, 11, 11, 30, 6, 'there', 0, 0, 1360302844, 0),
(2, 11, 11, 31, 27, 'agreed', 0, 0, 1360302940, 0),
(2, 11, 11, 32, 31, 'sssseeeee', 0, 0, 1360302949, 0);

-- --------------------------------------------------------

--
-- Table structure for table `Event`
--

CREATE TABLE IF NOT EXISTS `Event` (
  `eID` int(11) NOT NULL AUTO_INCREMENT,
  `oID` int(11) NOT NULL,
  `o_cID` int(11) NOT NULL,
  `eName` varchar(60) NOT NULL,
  `eDate` date NOT NULL,
  `eLocation` varchar(30) DEFAULT NULL,
  `streetAddr` varchar(30) NOT NULL,
  `cityAddr` varchar(30) NOT NULL,
  `stateAddr` text NOT NULL,
  `eLong` float DEFAULT NULL,
  `eLat` float DEFAULT NULL,
  `eStartTime` time NOT NULL,
  `eEndTime` time NOT NULL,
  `eDescription` varchar(600) NOT NULL,
  `volNeeded` int(5) NOT NULL,
  `ePhoto` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `approved` int(1) NOT NULL,
  `totalVol` int(5) NOT NULL,
  PRIMARY KEY (`eID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Dumping data for table `Event`
--

INSERT INTO `Event` (`eID`, `oID`, `o_cID`, `eName`, `eDate`, `eLocation`, `streetAddr`, `cityAddr`, `stateAddr`, `eLong`, `eLat`, `eStartTime`, `eEndTime`, `eDescription`, `volNeeded`, `ePhoto`, `created`, `approved`, `totalVol`) VALUES
(2, 11, 11, 'Pizza handout to the homeless', '2012-12-22', '839 12th St N, Jacksonville Be', '', '', '', NULL, NULL, '12:00:00', '16:00:00', 'Come help us as we hand out pizza to the homeless in Jacksonville beach. This event is being sponsored by Dominos pizza. Free pizza will be given to volunteers as well.', 40, 0, '2012-11-29 20:01:24', 1, 1),
(3, 11, 11, 'Petting zoo for power!', '2012-12-18', '9823 President Rd, Jacksonvill', '', '', '', NULL, NULL, '13:00:00', '16:00:00', 'Come help us at the Jacksonville petting zoo as we introduce autistic kids to fuzzy loving animals. We encourage you to bring your family along and enjoy the day with the animals.', 10, 0, '2012-11-29 21:02:26', 1, 0),
(4, 11, 11, 'Jacksonville RollerGirls - Toys for Tots Charity Bout', '2012-12-30', 'Jacksonville Ice & Sportsplex', '', '', '', NULL, NULL, '18:00:00', '22:00:00', 'Jacksonville RollerGirls Double Header Bout First bout starts at 6pm. $12 at the door (cash only) $10 tickets in advance from website Bring children''s gift worth $10 or more and get free entry. ', 20, 0, '2012-11-29 23:06:44', 1, 3),
(5, 12, 12, '21st Annual Community Nutcracker - Sponsored by Walgreens', '2012-12-08', 'Florida Theatre Performing Art', '', '', '', NULL, NULL, '14:00:00', '20:00:00', 'Every year, The Community Nutcracker delights audiences of all ages with its holiday classic, The Nutcracker Ballet. The Community Nutcracker is the only nonprofit, volunteer-run organization that offers a portion of its proceeds to local charitable agencies with each performance. The Community Nutcracker has raised nearly $390,000 for local charities, with Dreams Come True of Jacksonville being the primary charity.', 40, 0, '2012-11-30 10:24:42', 1, 2),
(6, 13, 13, 'Jacksonville Symphony Youth Orchestra Spring Concert', '2013-05-13', 'Times-Union Center for the Per', '', '', '', NULL, NULL, '17:00:00', '22:00:00', 'The performing ensembles Jacksonville Symphony Youth Orchestra bring their 2012-2013 season to a close with this celebration of spring.\r\n\r\nScott Gregg, JSYO Music Director and Principal Conductor', 15, 0, '2012-11-30 10:35:35', 1, 1),
(7, 14, 14, 'Second Saturday Program: Ornament Painting', '2012-12-08', ' Tree Hill Nature Center', '', '', '', NULL, NULL, '13:00:00', '13:45:00', 'Paint and take an ornament for your favorite winter holiday. Good for all ages. Sponsored by Pink Flamingo Arts.\r\n\r\nReserve your space by registering online. Space available day of - first come, first served. Wear comfortable, weather-appropriate clothing. We recommend closed-toed shoes. Rain policy: We will proceed with programs if there is a chance of or if we are experiencing light rain.', 5, 0, '2012-11-30 13:21:42', 2, 0),
(8, 14, 14, 'Come plant trees at the beaches', '2012-12-30', '5th St  S Jacksonville Beach', '', '', '', NULL, NULL, '12:00:00', '18:00:00', 'Come join us at the beautiful beaches for a day of community, bonding, and planting trees. We need volunteers to help hand out and regulate supplies. We will be planting baby trees and you can expect to get your hands a little bit dirty.', 22, 0, '2012-11-30 13:30:52', 2, 0),
(27, 14, 14, 'Map testing time', '2013-02-21', 'null', '211 16th Ave N', 'Jacksonville', 'Florida', -81.394, 30.3043, '17:00:00', '20:00:00', 'Testing the map at my house!', 12, 0, '2013-02-08 12:39:15', 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `organization`
--

CREATE TABLE IF NOT EXISTS `organization` (
  `oID` int(11) NOT NULL AUTO_INCREMENT,
  `oName` varchar(60) NOT NULL,
  `created` datetime NOT NULL,
  `photo` int(1) NOT NULL,
  `oDescription` varchar(1200) NOT NULL,
  `mainContactID` int(11) DEFAULT NULL,
  PRIMARY KEY (`oID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `organization`
--

INSERT INTO `organization` (`oID`, `oName`, `created`, `photo`, `oDescription`, `mainContactID`) VALUES
(6, 'timmys grass cutters', '2012-11-14 00:23:44', 0, 'gayyy shit', 6),
(7, 'big bob', '2012-11-14 00:47:05', 0, 'gay', 7),
(8, '', '2012-11-26 22:41:01', 1, '', 8),
(9, '', '2012-11-26 22:42:41', 0, '', 9),
(10, 'MEEEEEE', '2012-11-26 22:44:44', 0, 'blah blah blahhhhh', 10),
(11, 'Helping Hands', '2012-11-29 19:58:05', 1, 'We help people with their lives.', 11),
(12, 'Jax NutCracker', '2012-11-30 10:21:26', 0, 'We put togethor plays and shows for people to come watch for free.', 12),
(13, 'Publix Super Markets Charities ', '2012-11-30 10:33:05', 0, 'We try to give back to a community that has helped us.', 13),
(14, 'Tree Hill', '2012-11-30 12:56:07', 0, 'A community that helps those who are less fortunate.', 14);

-- --------------------------------------------------------

--
-- Table structure for table `o_contact`
--

CREATE TABLE IF NOT EXISTS `o_contact` (
  `o_cID` int(11) NOT NULL AUTO_INCREMENT,
  `o_cEmail` varchar(40) NOT NULL,
  `oID` int(11) NOT NULL,
  `o_cFirstName` varchar(20) NOT NULL,
  `o_cLastName` varchar(20) NOT NULL,
  `photo` int(1) NOT NULL,
  `created` datetime NOT NULL,
  `password` varchar(150) NOT NULL,
  PRIMARY KEY (`o_cID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=15 ;

--
-- Dumping data for table `o_contact`
--

INSERT INTO `o_contact` (`o_cID`, `o_cEmail`, `oID`, `o_cFirstName`, `o_cLastName`, `photo`, `created`, `password`) VALUES
(6, 'bradley@gmail.com', 6, 'James', 'Hamilton', 0, '2012-11-14 00:23:44', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f33364'),
(7, 'bob@gmail.com', 7, 'bob', 'bobby', 0, '2012-11-14 00:47:05', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9'),
(8, '', 8, '', '', 0, '2012-11-26 22:41:01', '001cae4ec58192b81c555c49eff849e295d8ecf32ca87428227481e8c17f161383fdba16a846af7309c6188217db6532aa354e5e95ddf3567edf4af64a98bb30'),
(9, '', 9, '', '', 0, '2012-11-26 22:42:41', '001cae4ec58192b81c555c49eff849e295d8ecf32ca87428227481e8c17f161383fdba16a846af7309c6188217db6532aa354e5e95ddf3567edf4af64a98bb30'),
(10, 'you@gmail.com', 10, 'Brad', 'Hammyyy', 0, '2012-11-26 22:44:44', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9'),
(11, 'cturner@gmail.com', 11, 'Charlie', 'Turner', 0, '2012-11-29 19:58:05', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9'),
(12, 'bturner@gmail.com', 12, 'Bobby', 'Turner', 0, '2012-11-30 10:21:26', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9'),
(13, 'aturner@gmail.com', 13, 'Andy', 'Turner', 0, '2012-11-30 10:33:05', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9'),
(14, 'sturner@gmail.com', 14, 'Sean', 'Turner', 0, '2012-11-30 12:56:07', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `sID` int(255) NOT NULL AUTO_INCREMENT,
  `sEmail` varchar(60) NOT NULL,
  `nNumber` varchar(9) NOT NULL,
  `firstName` varchar(30) NOT NULL,
  `lastName` varchar(30) NOT NULL,
  `created` datetime NOT NULL,
  `password` varchar(150) NOT NULL,
  `totalHours` int(4) NOT NULL DEFAULT '0',
  `admin` int(1) NOT NULL,
  PRIMARY KEY (`sID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`sID`, `sEmail`, `nNumber`, `firstName`, `lastName`, `created`, `password`, `totalHours`, `admin`) VALUES
(10, 'n00651126@unf.edu', '', '', '', '2012-10-23 11:40:40', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 0),
(11, 'bradley@unf.edu', 'n00651126', 'James', 'Hamilton', '2012-10-24 17:11:46', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 0),
(12, 'bradley1@unf.edu', 'n00651126', 'Brad', 'Hammy', '2012-10-25 12:07:01', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 1),
(13, 'bradley2@unf.edu', 'n0076238', 'Timmy', 'Burke', '2012-11-29 23:33:57', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 0),
(14, 'bradley3@unf.edu', 'n0067889', 'Eric', 'Leary', '2012-11-30 11:35:47', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 0),
(15, 'bradley4@unf.edu', 'n00239838', 'Carly', 'Lism', '2012-11-30 13:06:21', 'abf6a1a141d2a612b8bc1673c3f6b6b1f408f686305f96a6c59bbd4ba7c5fbe189d36db8edc2058ea2c88f9751d87c238c73ff110b6e7e8667f333640d077dd9', 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `s_Events`
--

CREATE TABLE IF NOT EXISTS `s_Events` (
  `seID` int(11) NOT NULL AUTO_INCREMENT,
  `sID` int(5) NOT NULL,
  `eID` int(5) NOT NULL,
  PRIMARY KEY (`seID`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Dumping data for table `s_Events`
--

INSERT INTO `s_Events` (`seID`, `sID`, `eID`) VALUES
(13, 13, 2),
(17, 13, 4),
(19, 14, 5),
(20, 14, 6),
(21, 15, 4),
(22, 14, 4),
(23, 11, 5),
(24, 11, 2);

-- --------------------------------------------------------

--
-- Table structure for table `s_hours`
--

CREATE TABLE IF NOT EXISTS `s_hours` (
  `sID` int(11) NOT NULL,
  `sHours` int(3) NOT NULL,
  `eID` int(11) NOT NULL,
  `created` datetime NOT NULL,
  KEY `sID` (`sID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `votesC`
--

CREATE TABLE IF NOT EXISTS `votesC` (
  `userID` int(10) unsigned NOT NULL,
  `commentID` int(11) NOT NULL,
  `updown` tinyint(11) NOT NULL,
  `voteID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`voteID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
