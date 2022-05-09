#
# Add Static SQL tables
#
-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Generation Time: May 08, 2022 at 11:24 AM
-- Server version: 10.6.4-MariaDB-1:10.6.4+maria~focal
-- PHP Version: 7.4.19

--
-- Table structure for table `tx_btp_domain_model_expertise`
--

CREATE TABLE IF NOT EXISTS `tx_btp_domain_model_expertise` (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT 0,
  `tstamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `crdate` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cruser_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `hidden` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `starttime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `endtime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sys_language_uid` int(11) NOT NULL DEFAULT 0,
  `l10n_parent` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `l10n_state` text DEFAULT NULL,
  `l10n_diffsource` mediumblob DEFAULT NULL,
  `t3ver_oid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `t3ver_wsid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `t3ver_state` smallint(6) NOT NULL DEFAULT 0,
  `t3ver_stage` int(11) NOT NULL DEFAULT 0,
  `title` varchar(255) NOT NULL DEFAULT '',
  `team` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sorting` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`),
  KEY `parent` (`pid`,`deleted`,`hidden`),
  KEY `t3ver_oid` (`t3ver_oid`,`t3ver_wsid`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `tx_btp_domain_model_team`
--

CREATE TABLE IF NOT EXISTS `tx_btp_domain_model_team` (
  `uid` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `pid` int(11) NOT NULL DEFAULT 0,
  `tstamp` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `crdate` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `cruser_id` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `deleted` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `hidden` smallint(5) UNSIGNED NOT NULL DEFAULT 0,
  `starttime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `endtime` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sys_language_uid` int(11) NOT NULL DEFAULT 0,
  `l10n_parent` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `l10n_state` text DEFAULT NULL,
  `l10n_diffsource` mediumblob DEFAULT NULL,
  `t3ver_oid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `t3ver_wsid` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `t3ver_state` smallint(6) NOT NULL DEFAULT 0,
  `t3ver_stage` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL DEFAULT '',
  `expertise` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sorting` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`uid`),
  KEY `parent` (`pid`,`deleted`,`hidden`),
  KEY `t3ver_oid` (`t3ver_oid`,`t3ver_wsid`)
) ENGINE=InnoDB;

-- --------------------------------------------------------

--
-- Table structure for table `tx_btp_team_expertise_mm`
--

CREATE TABLE IF NOT EXISTS `tx_btp_team_expertise_mm` (
  `uid_local` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `uid_foreign` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sorting` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `sorting_foreign` int(10) UNSIGNED NOT NULL DEFAULT 0,
  `debug` text COLLATE utf8mb4_unicode_ci DEFAULT '',
  KEY `uid_local` (`uid_local`),
  KEY `uid_foreign` (`uid_foreign`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Triggers `tx_btp_team_expertise_mm`
--
DELIMITER $$
CREATE TRIGGER `btp_team_expertise_mm_insert_before` BEFORE INSERT ON `tx_btp_team_expertise_mm` FOR EACH ROW begin

declare uidLocal int(11) unsigned default 0;
declare uidForeign int(11) unsigned default 0;
declare sortingLocal int(11) unsigned default 0;
declare sortingForeign int(11) unsigned default 0;
declare maxSortingLocal int(11) unsigned default 0;
declare maxSortingForeign int(11) unsigned default 0;

-- TEAM (from expertise)
SELECT  new.uid_local into uidLocal;
SELECT  new.sorting into sortingLocal;
SELECT IFNULL(MAX(sorting),0) into  maxSortingLocal FROM tx_btp_team_expertise_mm WHERE uid_local = new.uid_local;

-- EXPERTISE (from team)
SELECT  new.uid_foreign into uidForeign;
SELECT  new.sorting_foreign into sortingForeign;
SELECT IFNULL(MAX(sorting_foreign),0) into maxSortingForeign FROM tx_btp_team_expertise_mm WHERE uid_foreign = new.uid_foreign;

IF maxSortingLocal > 0 AND sortingLocal = 0 THEN
    SET NEW.sorting = maxSortingLocal + 1;
ELSEIF maxSortingLocal = 0 AND sortingLocal = 0 THEN
    SET NEW.sorting = 1;
END IF;

IF maxSortingForeign > 0 AND sortingForeign = 0 THEN
    SET NEW.sorting_foreign = maxSortingForeign + 1;
ELSEIF maxSortingForeign = 0 AND sortingForeign = 0 THEN
    SET NEW.sorting_foreign = 1;
END IF;

set new.debug = CONCAT(
  "uidLocal: ", uidLocal,
  ", uidForeign: ", uidForeign,
  ", sortingLocal: ", sortingLocal,
  ", sortingForeign: ", sortingForeign,
  ", maxSortingLocal:", maxSortingLocal, 
  ", maxSortingForeign:", maxSortingForeign
);

end
$$
DELIMITER ;
