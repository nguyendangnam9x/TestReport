-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.13-0ubuntu0.16.04.2 - (Ubuntu)
-- Server OS:                    Linux
-- HeidiSQL Version:             9.3.0.4984
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping database structure for automation
DROP DATABASE IF EXISTS `automation`;
CREATE DATABASE IF NOT EXISTS `automation` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `automation`;


-- Dumping structure for table automation.agents
DROP TABLE IF EXISTS `agents`;
CREATE TABLE IF NOT EXISTS `agents` (
  `id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '1',
  `isActive` int(1) NOT NULL DEFAULT '1',
  `name` varchar(255) DEFAULT NULL,
  `jobTitle` varchar(255) DEFAULT NULL,
  `userName` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.agents: ~0 rows (approximately)
DELETE FROM `agents`;
/*!40000 ALTER TABLE `agents` DISABLE KEYS */;
/*!40000 ALTER TABLE `agents` ENABLE KEYS */;


-- Dumping structure for table automation.authors
DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `name` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `testName` varchar(255) NOT NULL,
  `id` varchar(255) NOT NULL,
  `test` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.authors: ~0 rows (approximately)
DELETE FROM `authors`;
/*!40000 ALTER TABLE `authors` DISABLE KEYS */;
/*!40000 ALTER TABLE `authors` ENABLE KEYS */;


-- Dumping structure for table automation.categories
DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `test` varchar(255) DEFAULT NULL,
  `testName` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.categories: ~14 rows (approximately)
DELETE FROM `categories`;
/*!40000 ALTER TABLE `categories` DISABLE KEYS */;
INSERT INTO `categories` (`id`, `description`, `name`, `report`, `status`, `test`, `testName`) VALUES
	('57b37fb5a4d9bf14440f7bda', NULL, 'ExtentAPI', '57b37fb5a4d9bf14440f7bd8', 'unknown', '57b37fb5a4d9bf14440f7bd9', 'CategoryTest'),
	('57b37fb5a4d9bf14440f7be0', NULL, 'IntentionalException', '57b37fb5a4d9bf14440f7bd8', 'unknown', '57b37fb5a4d9bf14440f7bdf', 'ExceptionTest'),
	('57b37fb6a4d9bf14440f7bf4', NULL, 'Nodes', '57b37fb5a4d9bf14440f7bd8', 'unknown', NULL, 'Node1'),
	('57b37fb6a4d9bf14440f7bf8', NULL, 'SubNode', '57b37fb5a4d9bf14440f7bd8', 'unknown', NULL, 'GrandChild'),
	('57b37fc7a4d9bf174072475e', NULL, 'ExtentAPI', '57b37fc7a4d9bf174072475c', 'unknown', '57b37fc7a4d9bf174072475d', 'CategoryTest'),
	('57b37fc7a4d9bf1740724764', NULL, 'IntentionalException', '57b37fc7a4d9bf174072475c', 'unknown', '57b37fc7a4d9bf1740724763', 'ExceptionTest'),
	('57b37fc8a4d9bf1740724778', NULL, 'Nodes', '57b37fc7a4d9bf174072475c', 'unknown', NULL, 'Node1'),
	('57b37fc8a4d9bf174072477c', NULL, 'SubNode', '57b37fc7a4d9bf174072475c', 'unknown', NULL, 'GrandChild'),
	('57b37fe8a4d9bf1c50da066a', NULL, 'ExtentAPI', '57b37fe8a4d9bf1c50da0668', 'unknown', '57b37fe8a4d9bf1c50da0669', 'CategoryTest'),
	('57b37fe8a4d9bf1c50da0677', NULL, 'Nodes', '57b37fe8a4d9bf1c50da0668', 'unknown', NULL, 'Node1'),
	('57b37fe8a4d9bf1c50da067b', NULL, 'SubNode', '57b37fe8a4d9bf1c50da0668', 'unknown', NULL, 'GrandChild'),
	('57b37ff0a4d9bf15d8ec24d6', NULL, 'ExtentAPI', '57b37ff0a4d9bf15d8ec24d4', 'unknown', '57b37ff0a4d9bf15d8ec24d5', 'CategoryTest'),
	('57b3800ca4d9bf1ec0865c36', NULL, 'ExtentAPI', '57b3800ca4d9bf1ec0865c34', 'unknown', '57b3800ca4d9bf1ec0865c35', 'CategoryTest'),
	('57b3800da4d9bf1ec0865c3c', NULL, 'IntentionalException', '57b3800ca4d9bf1ec0865c34', 'unknown', '57b3800da4d9bf1ec0865c3b', 'ExceptionTest');
/*!40000 ALTER TABLE `categories` ENABLE KEYS */;


-- Dumping structure for table automation.environment
DROP TABLE IF EXISTS `environment`;
CREATE TABLE IF NOT EXISTS `environment` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `reportId` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.environment: ~0 rows (approximately)
DELETE FROM `environment`;
/*!40000 ALTER TABLE `environment` DISABLE KEYS */;
/*!40000 ALTER TABLE `environment` ENABLE KEYS */;


-- Dumping structure for table automation.logs
DROP TABLE IF EXISTS `logs`;
CREATE TABLE IF NOT EXISTS `logs` (
  `id` varchar(255) NOT NULL,
  `timestamp` timestamp NULL DEFAULT NULL,
  `test` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT 'unknown',
  `node` varchar(255) DEFAULT NULL,
  `logSequence` int(11) DEFAULT '0',
  `stepName` varchar(255) DEFAULT NULL,
  `testName` varchar(255) DEFAULT NULL,
  `details` text,
  `report` varchar(255) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.logs: ~26 rows (approximately)
DELETE FROM `logs`;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
INSERT INTO `logs` (`id`, `timestamp`, `test`, `status`, `node`, `logSequence`, `stepName`, `testName`, `details`, `report`, `value`) VALUES
	('57b37fb5a4d9bf14440f7bdc', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7bd9', 'pass', NULL, 1, NULL, 'CategoryTest', 'A category was added', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7bde', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7bdd', 'pass', NULL, 1, NULL, 'AuthorTest', 'An author was added 2', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be4', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'pass', NULL, 1, NULL, 'HTMLTagsTest', 'Labels can be created using: <span class=\'success label\'>Success</span> <span class=\'fail label\'>Fail</span> <span class=\'warning label\'>Warning</span> <span class=\'info label\'>Info</span> <span class=\'skip label\'>Skip</span>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be5', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'pass', NULL, 2, NULL, 'HTMLTagsTest', '<pre>&lt;span class=\'success label\'&gt;Success&lt;/span&gt; <br />&lt;span class=\'fail label\'&gt;Fail&lt;/span&gt; <br />&lt;span class=\'warning label\'&gt;Warning&lt;/span&gt; <br />&lt;span class=\'info label\'&gt;Info&lt;/span&gt; <br />&lt;span class=\'skip label\'&gt;Skip&lt;/span&gt;</pre>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be6', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'pass', NULL, 3, NULL, 'HTMLTagsTest', '<textarea disabled class=\'code-block\'><xml>\n	<node>\n		Hello\n	</node>\n</xml></textarea>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be7', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'info', NULL, 4, NULL, 'HTMLTagsTest', '<span class=\'label white-text blue\'>extent</span>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be8', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'pass', NULL, 5, NULL, 'HTMLTagsTest', 'Link <a href=\'http://extentreports.relevantcodes.com/\'>Linky</a>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fb5a4d9bf14440f7be9', '2016-08-17 04:03:49', '57b37fb5a4d9bf14440f7be3', 'pass', NULL, 6, NULL, 'HTMLTagsTest', '<pre>&lt;a href=\'http://extentreports.relevantcodes.com/\'&gt;Linky&lt;/a&gt;</pre>', '57b37fb5a4d9bf14440f7bd8', NULL),
	('57b37fc7a4d9bf1740724760', '2016-08-17 04:04:07', '57b37fc7a4d9bf174072475d', 'pass', NULL, 1, NULL, 'CategoryTest', 'A category was added', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf1740724762', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724761', 'pass', NULL, 1, NULL, 'AuthorTest', 'An author was added 2', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf1740724768', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'pass', NULL, 1, NULL, 'HTMLTagsTest', 'Labels can be created using: <span class=\'success label\'>Success</span> <span class=\'fail label\'>Fail</span> <span class=\'warning label\'>Warning</span> <span class=\'info label\'>Info</span> <span class=\'skip label\'>Skip</span>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf1740724769', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'pass', NULL, 2, NULL, 'HTMLTagsTest', '<pre>&lt;span class=\'success label\'&gt;Success&lt;/span&gt; <br />&lt;span class=\'fail label\'&gt;Fail&lt;/span&gt; <br />&lt;span class=\'warning label\'&gt;Warning&lt;/span&gt; <br />&lt;span class=\'info label\'&gt;Info&lt;/span&gt; <br />&lt;span class=\'skip label\'&gt;Skip&lt;/span&gt;</pre>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf174072476a', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'pass', NULL, 3, NULL, 'HTMLTagsTest', '<textarea disabled class=\'code-block\'><xml>\n	<node>\n		Hello\n	</node>\n</xml></textarea>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf174072476b', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'info', NULL, 4, NULL, 'HTMLTagsTest', '<span class=\'label white-text blue\'>extent</span>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf174072476c', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'pass', NULL, 5, NULL, 'HTMLTagsTest', 'Link <a href=\'http://extentreports.relevantcodes.com/\'>Linky</a>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fc7a4d9bf174072476d', '2016-08-17 04:04:07', '57b37fc7a4d9bf1740724767', 'pass', NULL, 6, NULL, 'HTMLTagsTest', '<pre>&lt;a href=\'http://extentreports.relevantcodes.com/\'&gt;Linky&lt;/a&gt;</pre>', '57b37fc7a4d9bf174072475c', NULL),
	('57b37fe8a4d9bf1c50da066c', '2016-08-17 04:04:40', '57b37fe8a4d9bf1c50da0669', 'pass', NULL, 1, NULL, 'CategoryTest', 'A category was added', '57b37fe8a4d9bf1c50da0668', NULL),
	('57b37ff0a4d9bf15d8ec24d8', '2016-08-17 04:04:48', '57b37ff0a4d9bf15d8ec24d5', 'pass', NULL, 1, NULL, 'CategoryTest', 'A category was added', '57b37ff0a4d9bf15d8ec24d4', NULL),
	('57b3800da4d9bf1ec0865c38', '2016-08-17 04:05:17', '57b3800ca4d9bf1ec0865c35', 'pass', NULL, 1, NULL, 'CategoryTest', 'A category was added', '57b3800ca4d9bf1ec0865c34', NULL),
	('57b3800da4d9bf1ec0865c3a', '2016-08-17 04:05:17', '57b3800da4d9bf1ec0865c39', 'pass', NULL, 1, NULL, 'AuthorTest', 'An author was added 2', '57b3800ca4d9bf1ec0865c34', NULL),
	('57b385daa4d9bf1a94c76961', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'pass', NULL, 1, NULL, 'HTMLTagsTest', 'Labels can be created using: <span class=\'success label\'>Success</span> <span class=\'fail label\'>Fail</span> <span class=\'warning label\'>Warning</span> <span class=\'info label\'>Info</span> <span class=\'skip label\'>Skip</span>', '57b385daa4d9bf1a94c7695f', NULL),
	('57b385daa4d9bf1a94c76962', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'pass', NULL, 2, NULL, 'HTMLTagsTest', '<pre>&lt;span class=\'success label\'&gt;Success&lt;/span&gt; <br />&lt;span class=\'fail label\'&gt;Fail&lt;/span&gt; <br />&lt;span class=\'warning label\'&gt;Warning&lt;/span&gt; <br />&lt;span class=\'info label\'&gt;Info&lt;/span&gt; <br />&lt;span class=\'skip label\'&gt;Skip&lt;/span&gt;</pre>', '57b385daa4d9bf1a94c7695f', NULL),
	('57b385daa4d9bf1a94c76963', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'pass', NULL, 3, NULL, 'HTMLTagsTest', '<textarea disabled class=\'code-block\'><xml>\n	<node>\n		Hello\n	</node>\n</xml></textarea>', '57b385daa4d9bf1a94c7695f', NULL),
	('57b385daa4d9bf1a94c76964', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'info', NULL, 4, NULL, 'HTMLTagsTest', '<span class=\'label white-text blue\'>extent</span>', '57b385daa4d9bf1a94c7695f', NULL),
	('57b385daa4d9bf1a94c76965', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'pass', NULL, 5, NULL, 'HTMLTagsTest', 'Link <a href=\'http://extentreports.relevantcodes.com/\'>Linky</a>', '57b385daa4d9bf1a94c7695f', NULL),
	('57b385daa4d9bf1a94c76966', '2016-08-17 04:30:02', '57b385daa4d9bf1a94c76960', 'pass', NULL, 6, NULL, 'HTMLTagsTest', '<pre>&lt;a href=\'http://extentreports.relevantcodes.com/\'&gt;Linky&lt;/a&gt;</pre>', '57b385daa4d9bf1a94c7695f', NULL);
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;


-- Dumping structure for table automation.media
DROP TABLE IF EXISTS `media`;
CREATE TABLE IF NOT EXISTS `media` (
  `id` varchar(255) NOT NULL,
  `path` varchar(255) DEFAULT NULL,
  `testName` varchar(255) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `sequence` int(11) DEFAULT '0',
  `test` varchar(255) DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.media: ~5 rows (approximately)
DELETE FROM `media`;
/*!40000 ALTER TABLE `media` DISABLE KEYS */;
INSERT INTO `media` (`id`, `path`, `testName`, `report`, `sequence`, `test`, `createdAt`, `updatedAt`) VALUES
	('57b37fb5a4d9bf14440f7beb', 'uploads/57b37fb5a4d9bf14440f7bd8/57b37fb5a4d9bf14440f7bea/1.png', 'MediaTest', '57b37fb5a4d9bf14440f7bd8', 1, '57b37fb5a4d9bf14440f7bea', '2016-09-08 16:20:11', '2016-08-16T21:03:50.689Z'),
	('57b37fc7a4d9bf174072476f', 'uploads/57b37fc7a4d9bf174072475c/57b37fc7a4d9bf174072476e/1.png', 'MediaTest', '57b37fc7a4d9bf174072475c', 1, '57b37fc7a4d9bf174072476e', '2016-09-08 16:20:11', '2016-08-16T21:04:08.287Z'),
	('57b37fe8a4d9bf1c50da066e', 'uploads/57b37fe8a4d9bf1c50da0668/57b37fe8a4d9bf1c50da066d/1.png', 'MediaTest', '57b37fe8a4d9bf1c50da0668', 1, '57b37fe8a4d9bf1c50da066d', '2016-09-08 16:20:11', '2016-08-16T21:04:40.910Z'),
	('57b37ff0a4d9bf15d8ec24da', 'uploads/57b37ff0a4d9bf15d8ec24d4/57b37ff0a4d9bf15d8ec24d9/1.png', 'MediaTest', '57b37ff0a4d9bf15d8ec24d4', 1, '57b37ff0a4d9bf15d8ec24d9', '2016-09-08 16:20:11', '2016-08-16T21:04:49.361Z'),
	('57b3800da4d9bf1ec0865c42', 'uploads/57b3800ca4d9bf1ec0865c34/57b3800da4d9bf1ec0865c41/1.png', 'MediaTest', '57b3800ca4d9bf1ec0865c34', 1, '57b3800da4d9bf1ec0865c41', '2016-09-08 16:20:11', '2016-08-16T21:05:17.614Z');
/*!40000 ALTER TABLE `media` ENABLE KEYS */;


-- Dumping structure for table automation.nodes
DROP TABLE IF EXISTS `nodes`;
CREATE TABLE IF NOT EXISTS `nodes` (
  `id` varchar(255) NOT NULL,
  `childNodesCount` int(11) NOT NULL,
  `description` varchar(255) NOT NULL,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `level` int(5) NOT NULL DEFAULT '1',
  `log` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `parentTestName` varchar(255) NOT NULL,
  `report` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `test` varchar(255) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.nodes: ~0 rows (approximately)
DELETE FROM `nodes`;
/*!40000 ALTER TABLE `nodes` DISABLE KEYS */;
/*!40000 ALTER TABLE `nodes` ENABLE KEYS */;


-- Dumping structure for table automation.projects
DROP TABLE IF EXISTS `projects`;
CREATE TABLE IF NOT EXISTS `projects` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.projects: ~2 rows (approximately)
DELETE FROM `projects`;
/*!40000 ALTER TABLE `projects` DISABLE KEYS */;
INSERT INTO `projects` (`id`, `name`, `createAt`) VALUES
	('57b37fb5a4d9bf14440f7bd7', 'Project:Heroku', '2016-09-08 17:04:26'),
	('57b37fc7a4d9bf174072475b', 'Project:Git', '2016-09-08 17:04:26'),
	('57b385daa4d9bf1a94c7695e', 'Project:Extent', '2016-09-08 17:04:37');
/*!40000 ALTER TABLE `projects` ENABLE KEYS */;


-- Dumping structure for table automation.reports
DROP TABLE IF EXISTS `reports`;
CREATE TABLE IF NOT EXISTS `reports` (
  `id` varchar(255) NOT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `project` varchar(255) DEFAULT NULL,
  `startTime` timestamp NULL DEFAULT NULL,
  `fileName` varchar(255) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `childLength` int(5) DEFAULT '0',
  `parentLength` int(5) DEFAULT '0',
  `infoChildLength` int(5) DEFAULT '0',
  `grandChildLength` int(5) DEFAULT '0',
  `infoGrandChildLength` int(5) DEFAULT '0',
  `errorChildLength` int(5) DEFAULT '0',
  `errorGrandChildLength` int(5) DEFAULT '0',
  `errorParentLength` int(5) DEFAULT '0',
  `failChildLength` int(5) DEFAULT '0',
  `failGrandChildLength` int(5) DEFAULT '0',
  `failParentLength` int(5) DEFAULT '0',
  `passChildLength` int(5) DEFAULT '0',
  `passGrandChildLength` int(5) DEFAULT '0',
  `passParentLength` int(5) DEFAULT '0',
  `skipChildLength` int(5) DEFAULT '0',
  `skipGrandChildLength` int(5) DEFAULT '0',
  `skipParentLength` int(5) DEFAULT '0',
  `unknownChildLength` int(5) DEFAULT '0',
  `unknownGrandChildLength` int(5) DEFAULT '0',
  `unknownParentLength` int(5) DEFAULT '0',
  `warningChildLength` int(5) DEFAULT '0',
  `warningGrandChildLength` int(5) DEFAULT '0',
  `warningParentLength` int(5) DEFAULT '0',
  `fatalChildLength` int(5) DEFAULT '0',
  `fatalGrandChildLength` int(5) DEFAULT '0',
  `fatalParentLength` int(5) DEFAULT '0',
  `test` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `createAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.reports: ~6 rows (approximately)
DELETE FROM `reports`;
/*!40000 ALTER TABLE `reports` DISABLE KEYS */;
INSERT INTO `reports` (`id`, `endTime`, `project`, `startTime`, `fileName`, `author`, `category`, `childLength`, `parentLength`, `infoChildLength`, `grandChildLength`, `infoGrandChildLength`, `errorChildLength`, `errorGrandChildLength`, `errorParentLength`, `failChildLength`, `failGrandChildLength`, `failParentLength`, `passChildLength`, `passGrandChildLength`, `passParentLength`, `skipChildLength`, `skipGrandChildLength`, `skipParentLength`, `unknownChildLength`, `unknownGrandChildLength`, `unknownParentLength`, `warningChildLength`, `warningGrandChildLength`, `warningParentLength`, `fatalChildLength`, `fatalGrandChildLength`, `fatalParentLength`, `test`, `status`, `createAt`) VALUES
	('57b37fb5a4d9bf14440f7bd8', '2016-08-16 21:03:50', '57b37fb5a4d9bf14440f7bd7', '2016-08-16 21:03:48', 'Extent:Project:Heroku', NULL, 'aaaaa', 15, 8, 3, 0, 0, 0, 0, 0, 2, 0, 2, 8, 0, 4, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, NULL, NULL, '2016-09-13 15:06:44'),
	('57b37fc7a4d9bf174072475c', '2016-08-16 21:04:08', '57b37fc7a4d9bf174072475b', '2016-08-16 21:04:07', 'Extent:Project:Git', NULL, NULL, 15, 8, 3, 0, 0, 0, 0, 0, 2, 0, 2, 8, 0, 4, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, NULL, NULL, '2016-09-10 09:07:32'),
	('57b37fe8a4d9bf1c50da0668', '2016-08-16 21:04:41', '57b37fc7a4d9bf174072475b', '2016-08-16 21:04:39', 'Extent:Project:Git', NULL, NULL, 7, 5, 2, 0, 0, 0, 0, 0, 1, 0, 1, 2, 0, 2, 1, 0, 1, 0, 0, 0, 1, 0, 1, 0, 0, 0, NULL, NULL, '2016-09-10 09:07:33'),
	('57b37ff0a4d9bf15d8ec24d4', '2016-08-16 21:04:49', '57b37fc7a4d9bf174072475b', '2016-08-16 21:04:48', 'Extent:Project:Git', NULL, NULL, 2, 2, 0, 0, 0, 0, 0, 0, 1, 0, 1, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2016-09-10 09:07:33'),
	('57b3800ca4d9bf1ec0865c34', '2016-08-16 21:05:17', '57b37fb5a4d9bf14440f7bd7', '2016-08-16 21:05:16', 'Extent:Project:Heroku', NULL, NULL, 9, 5, 1, 0, 0, 0, 0, 0, 2, 0, 2, 5, 0, 2, 1, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2016-09-10 09:07:33'),
	('57b385daa4d9bf1a94c7695f', '2016-08-16 21:30:02', '57b385daa4d9bf1a94c7695e', '2016-08-16 21:30:02', 'Extent:Project:Extent', NULL, NULL, 6, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 5, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, NULL, NULL, '2016-09-13 10:21:25');
/*!40000 ALTER TABLE `reports` ENABLE KEYS */;


-- Dumping structure for table automation.settings
DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `setting` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- Dumping data for table automation.settings: ~4 rows (approximately)
DELETE FROM `settings`;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` (`id`, `setting`, `value`, `createAt`) VALUES
	(1, 'trendDataPoints', '5', '2016-09-16 14:38:12'),
	(2, 'trendDataPointFormat', 'long-dt', '2016-09-16 14:38:07'),
	(3, 'dataPoints', '9', '2016-09-15 11:14:36'),
	(4, 'dataPointFormat', 'dt', '2016-09-15 11:14:36');
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;


-- Dumping structure for table automation.side
DROP TABLE IF EXISTS `side`;
CREATE TABLE IF NOT EXISTS `side` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data` varchar(255) NOT NULL,
  `testcase` varchar(255) NOT NULL,
  `value` varchar(255) NOT NULL,
  `createAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.side: ~0 rows (approximately)
DELETE FROM `side`;
/*!40000 ALTER TABLE `side` DISABLE KEYS */;
/*!40000 ALTER TABLE `side` ENABLE KEYS */;


-- Dumping structure for table automation.tests
DROP TABLE IF EXISTS `tests`;
CREATE TABLE IF NOT EXISTS `tests` (
  `id` varchar(255) NOT NULL,
  `report` varchar(255) DEFAULT NULL,
  `nodes` varchar(255) DEFAULT NULL,
  `logs` varchar(255) DEFAULT NULL,
  `media` varchar(255) DEFAULT NULL,
  `categories` varchar(255) DEFAULT NULL,
  `authors` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `bdd` int(1) DEFAULT '0',
  `childNodesCount` int(11) DEFAULT '0',
  `categorized` int(1) DEFAULT '0',
  `bddType` varchar(255) DEFAULT NULL COMMENT 'enum: [''feature'', ''background'', ''scenario'', ''given'', ''when'', ''then'', ''and'']',
  `status` varchar(255) DEFAULT 'unknown' COMMENT 'enum: [''pass'', ''fail'', ''fatal'', ''error'', ''warning'', ''skip'', ''unknown''],',
  `description` varchar(255) DEFAULT NULL,
  `warnings` varchar(255) DEFAULT NULL,
  `startTime` timestamp NULL DEFAULT NULL,
  `endTime` timestamp NULL DEFAULT NULL,
  `createdAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.tests: ~19 rows (approximately)
DELETE FROM `tests`;
/*!40000 ALTER TABLE `tests` DISABLE KEYS */;
INSERT INTO `tests` (`id`, `report`, `nodes`, `logs`, `media`, `categories`, `authors`, `name`, `bdd`, `childNodesCount`, `categorized`, `bddType`, `status`, `description`, `warnings`, `startTime`, `endTime`, `createdAt`, `updatedAt`) VALUES
	('57b37fb5a4d9bf14440f7bd9', '57b37fb5a4d9bf14440f7bd8', NULL, '57b37fb5a4d9bf14440f7bdc', NULL, '57b37fb5a4d9bf14440f7bda', NULL, 'CategoryTest', 0, 0, 0, NULL, 'pass', 'This test shows how a category is displayed. Assigning a category also enables the Categories view.', NULL, '2016-08-15 12:30:30', '2016-08-16 21:03:49', '2016-09-09 12:10:47', '2016-09-09 12:10:47'),
	('57b37fb5a4d9bf14440f7bdd', '57b37fb5a4d9bf14440f7bd8', NULL, '57b37fb5a4d9bf14440f7bde', NULL, '', NULL, 'AuthorTest', 0, 0, 0, NULL, 'pass', 'This test shows an example of an author assigned.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:03:49', '2016-09-09 12:10:12', '2016-09-09 12:10:12'),
	('57b37fb5a4d9bf14440f7bdf', '57b37fb5a4d9bf14440f7bd8', NULL, '57b37fb5a4d9bf14440f7be2', NULL, NULL, NULL, 'ExceptionTest', 0, 0, 0, NULL, 'fail', 'This test shows an example of how exceptions are displayed. Logging an exception also creates the Exceptions view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:03:49', '2016-09-09 15:39:27', '2016-09-09 15:39:27'),
	('57b37fb5a4d9bf14440f7be3', '57b37fb5a4d9bf14440f7bd8', NULL, '57b37fb5a4d9bf14440f7be9', NULL, '', NULL, 'HTMLTagsTest', 0, 0, 0, NULL, 'pass', 'HTML can be embedded anywhere in the report to create meaningful logs and messages.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:03:49', '2016-09-09 12:10:47', '2016-09-09 12:10:47'),
	('57b37fb5a4d9bf14440f7bea', '57b37fb5a4d9bf14440f7bd8', NULL, '57b37fb6a4d9bf14440f7bec', NULL, NULL, NULL, 'MediaTest', 0, 0, 0, NULL, 'fail', 'Contains Media', NULL, '2016-08-01 12:30:30', '2016-08-16 21:03:50', '2016-09-09 15:40:10', '2016-09-09 15:40:10'),
	('57b37fc7a4d9bf174072475d', '57b37fc7a4d9bf174072475c', NULL, '57b37fc7a4d9bf1740724760', NULL, '57b37fc7a4d9bf174072475e', NULL, 'CategoryTest', 0, 0, 0, NULL, 'pass', 'This test shows how a category is displayed. Assigning a category also enables the Categories view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:07', '2016-09-09 12:10:48', '2016-09-09 12:10:48'),
	('57b37fc7a4d9bf1740724761', '57b37fc7a4d9bf174072475c', NULL, '57b37fc7a4d9bf1740724762', NULL, '', NULL, 'AuthorTest', 0, 0, 0, NULL, 'pass', 'This test shows an example of an author assigned.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:07', '2016-09-09 12:10:12', '2016-09-09 12:10:12'),
	('57b37fc7a4d9bf1740724763', '57b37fc7a4d9bf174072475c', NULL, '57b37fc7a4d9bf1740724766', NULL, NULL, NULL, 'ExceptionTest', 0, 0, 0, NULL, 'fail', 'This test shows an example of how exceptions are displayed. Logging an exception also creates the Exceptions view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:07', '2016-09-09 15:39:27', '2016-09-09 15:39:27'),
	('57b37fc7a4d9bf1740724767', '57b37fc7a4d9bf174072475c', NULL, '57b37fc7a4d9bf174072476d', NULL, '', NULL, 'HTMLTagsTest', 0, 0, 0, NULL, 'pass', 'HTML can be embedded anywhere in the report to create meaningful logs and messages.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:07', '2016-09-09 12:10:48', '2016-09-09 12:10:48'),
	('57b37fc7a4d9bf174072476e', '57b37fc7a4d9bf174072475c', NULL, '57b37fc8a4d9bf1740724770', NULL, NULL, NULL, 'MediaTest', 0, 0, 0, NULL, 'fail', 'Contains Media', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:08', '2016-09-09 15:40:10', '2016-09-09 15:40:10'),
	('57b37fe8a4d9bf1c50da0669', '57b37fe8a4d9bf1c50da0668', NULL, '57b37fe8a4d9bf1c50da066c', NULL, '57b37fe8a4d9bf1c50da066a', NULL, 'CategoryTest', 0, 0, 0, NULL, 'pass', 'This test shows how a category is displayed. Assigning a category also enables the Categories view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:40', '2016-09-09 12:10:48', '2016-09-09 12:10:48'),
	('57b37fe8a4d9bf1c50da066d', '57b37fe8a4d9bf1c50da0668', NULL, '57b37fe8a4d9bf1c50da066f', NULL, NULL, NULL, 'MediaTest', 0, 0, 0, NULL, 'fail', 'Contains Media', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:40', '2016-09-09 15:40:10', '2016-09-09 15:40:10'),
	('57b37ff0a4d9bf15d8ec24d5', '57b37ff0a4d9bf15d8ec24d4', NULL, '57b37ff0a4d9bf15d8ec24d8', NULL, '57b37ff0a4d9bf15d8ec24d6', NULL, 'CategoryTest', 0, 0, 0, NULL, 'pass', 'This test shows how a category is displayed. Assigning a category also enables the Categories view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:48', '2016-09-09 12:10:48', '2016-09-09 12:10:48'),
	('57b37ff0a4d9bf15d8ec24d9', '57b37ff0a4d9bf15d8ec24d4', NULL, '57b37ff1a4d9bf15d8ec24db', NULL, NULL, NULL, 'MediaTest', 0, 0, 0, NULL, 'fail', 'Contains Media', NULL, '2016-08-01 12:30:30', '2016-08-16 21:04:49', '2016-09-09 15:40:10', '2016-09-09 15:40:10'),
	('57b3800ca4d9bf1ec0865c35', '57b3800ca4d9bf1ec0865c34', NULL, '57b3800da4d9bf1ec0865c38', NULL, '57b3800ca4d9bf1ec0865c36', NULL, 'CategoryTest', 0, 0, 0, NULL, 'pass', 'This test shows how a category is displayed. Assigning a category also enables the Categories view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:05:17', '2016-09-09 12:10:49', '2016-09-09 12:10:49'),
	('57b3800da4d9bf1ec0865c39', '57b3800ca4d9bf1ec0865c34', NULL, '57b3800da4d9bf1ec0865c3a', NULL, '', NULL, 'AuthorTest', 0, 0, 0, NULL, 'pass', 'This test shows an example of an author assigned.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:05:17', '2016-09-12 17:09:45', '2016-09-12 17:09:45'),
	('57b3800da4d9bf1ec0865c3b', '57b3800ca4d9bf1ec0865c34', NULL, '57b3800da4d9bf1ec0865c40', NULL, NULL, NULL, 'ExceptionTest', 0, 0, 0, NULL, 'fail', 'This test shows an example of how exceptions are displayed. Logging an exception also creates the Exceptions view.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:05:17', '2016-09-09 15:39:27', '2016-09-09 15:39:27'),
	('57b3800da4d9bf1ec0865c41', '57b3800ca4d9bf1ec0865c34', NULL, '57b3800da4d9bf1ec0865c43', NULL, NULL, NULL, 'MediaTest', 0, 0, 0, NULL, 'fail', 'Contains Media', NULL, '2016-08-01 12:30:30', '2016-08-16 21:05:17', '2016-09-09 15:40:10', '2016-09-09 15:40:10'),
	('57b385daa4d9bf1a94c76960', '57b385daa4d9bf1a94c7695f', NULL, '57b385daa4d9bf1a94c76964', NULL, '', NULL, 'HTMLTagsTest', 0, 0, 0, NULL, 'pass', 'HTML can be embedded anywhere in the report to create meaningful logs and messages.', NULL, '2016-08-01 12:30:30', '2016-08-16 21:30:02', '2016-09-09 12:10:49', '2016-09-09 12:10:49');
/*!40000 ALTER TABLE `tests` ENABLE KEYS */;


-- Dumping structure for table automation.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` varchar(255) NOT NULL DEFAULT '0',
  `name` varchar(255) NOT NULL,
  `admin` int(1) NOT NULL DEFAULT '0',
  `lastLoggedIn` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'user',
  `createdAt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updatedAt` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Dumping data for table automation.users: ~3 rows (approximately)
DELETE FROM `users`;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`id`, `name`, `admin`, `lastLoggedIn`, `password`, `role`, `createdAt`, `updatedAt`) VALUES
	('0', 'khue', 0, '2016-09-07 11:58:09', 'pass1', 'user', '2016-09-15 14:55:35', NULL),
	('57b37f69d624e69819ff7c89', 'root', 1, '2016-09-16 15:26:14', 'password', 'admin', '2016-09-16 15:26:14', '2016-09-06 00:00:00'),
	('57b37f69d624e69819ff7c90', 'user1', 0, '2016-09-07 11:58:09', 'password1', 'user', '2016-09-15 14:55:34', NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
