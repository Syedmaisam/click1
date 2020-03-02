-- phpMyAdmin SQL Dump
-- version 3.4.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 14, 2016 at 08:34 AM
-- Server version: 5.5.16
-- PHP Version: 5.3.8

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `whiteclick`
--

-- --------------------------------------------------------

--
-- Table structure for table `popup`
--

CREATE TABLE IF NOT EXISTS `popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `text_data` text NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `post_detail_layered`
--

CREATE TABLE IF NOT EXISTS `post_detail_layered` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `layered_id` varchar(100) NOT NULL,
  `get_response_api_key` varchar(100) NOT NULL,
  `campign_id` varchar(100) NOT NULL,
  `submit_count` int(11) NOT NULL,
  `responder_type` varchar(100) NOT NULL,
  `mailerlite_api_key` varchar(100) NOT NULL,
  `mailchimp_api_key` varchar(100) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `awaber_auth_token` varchar(500) NOT NULL,
  `awaber_account_id` varchar(500) NOT NULL,
  `active_api_url` varchar(100) NOT NULL,
  `active_api_key` varchar(100) NOT NULL,
  `auth_token_secret` varchar(500) NOT NULL,
  `constant_api_key` text NOT NULL,
  `constant_access_token` text NOT NULL,
  `iContact_appId` varchar(100) NOT NULL,
  `iContact_passwsord` varchar(100) NOT NULL,
  `iContact_user_name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_analytic_setting`
--

CREATE TABLE IF NOT EXISTS `tbl_analytic_setting` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(100) NOT NULL,
  `trackid` varchar(500) NOT NULL,
  `serviceaccount` varchar(500) NOT NULL,
  `applicationname` varchar(500) NOT NULL,
  `p12` varchar(500) NOT NULL,
  `trackcode` longtext NOT NULL,
  `created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_basicontent`
--

CREATE TABLE IF NOT EXISTS `tbl_basicontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `contenturl` varchar(200) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `message` varchar(300) NOT NULL,
  `yoururl` varchar(200) NOT NULL,
  `calltoaction` varchar(50) NOT NULL,
  `popuphtml` longtext NOT NULL,
  `userId` varchar(100) NOT NULL,
  `view` int(11) NOT NULL,
  `uniqueview` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `randomlink` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `campaignId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_campaign`
--

CREATE TABLE IF NOT EXISTS `tbl_campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `profile_id` int(11) NOT NULL,
  `campaign_name` varchar(1000) NOT NULL,
  `campaign_desc` text NOT NULL,
  `user_id` varchar(500) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `randUrl` varchar(1000) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  `messageCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_customimages`
--

CREATE TABLE IF NOT EXISTS `tbl_customimages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `image_source` varchar(300) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_custom_popup`
--

CREATE TABLE IF NOT EXISTS `tbl_custom_popup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` varchar(100) NOT NULL,
  `popup_name` varchar(100) NOT NULL,
  `custom_pop_html` longtext NOT NULL,
  `created_date` datetime NOT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_domain`
--

CREATE TABLE IF NOT EXISTS `tbl_domain` (
  `user_id` varchar(100) NOT NULL,
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(100) NOT NULL,
  `domain_status` tinyint(4) NOT NULL DEFAULT '0',
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_domain_files`
--

CREATE TABLE IF NOT EXISTS `tbl_domain_files` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `domain_name` varchar(100) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `uploaded_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_formsandpoll`
--

CREATE TABLE IF NOT EXISTS `tbl_formsandpoll` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(100) NOT NULL,
  `contenturl` varchar(100) NOT NULL,
  `profile` varchar(100) NOT NULL,
  `message` varchar(300) NOT NULL,
  `yoururl` varchar(100) NOT NULL,
  `calltoaction` varchar(50) NOT NULL,
  `popuphtml` longtext NOT NULL,
  `userId` varchar(100) NOT NULL,
  `view` int(11) NOT NULL,
  `uniqueview` int(11) NOT NULL,
  `created` datetime NOT NULL,
  `randomlink` varchar(100) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `campaignId` int(11) NOT NULL,
  `messageId` int(11) NOT NULL,
  `Type` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `AnswerCount` int(11) DEFAULT NULL,
  `PollAnswer` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `Custom_Html` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_imagecontent`
--

CREATE TABLE IF NOT EXISTS `tbl_imagecontent` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(50) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  `contentUrl` varchar(500) DEFAULT NULL,
  `profile` varchar(100) DEFAULT NULL,
  `imageLocation` varchar(300) DEFAULT NULL,
  `imageUrl` varchar(300) DEFAULT NULL,
  `yourUrl` varchar(300) DEFAULT NULL,
  `popupHeight` int(11) DEFAULT NULL,
  `popupWidth` int(11) DEFAULT NULL,
  `randomLink` varchar(100) NOT NULL,
  `popupTiming` int(11) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `view` int(11) NOT NULL,
  `uniqueview` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `popup_position` int(11) NOT NULL,
  `overlay` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_justlink`
--

CREATE TABLE IF NOT EXISTS `tbl_justlink` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `link_name` varchar(100) NOT NULL,
  `destination_url` varchar(200) NOT NULL,
  `link_url` varchar(200) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `add_date` datetime NOT NULL,
  `randUrl` varchar(20) NOT NULL,
  `modified_date` date NOT NULL DEFAULT '0000-00-00',
  `masking` tinyint(4) NOT NULL DEFAULT '0',
  `view` int(11) NOT NULL,
  `uniqueview` int(11) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_messages`
--

CREATE TABLE IF NOT EXISTS `tbl_messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaignId` int(11) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `user_id` varchar(1000) NOT NULL,
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `message` longtext NOT NULL,
  `actionText` longtext NOT NULL,
  `actionLink` longtext NOT NULL,
  `popData` longtext NOT NULL,
  `defaultMessage` tinyint(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_page_settings`
--

CREATE TABLE IF NOT EXISTS `tbl_page_settings` (
  `usermailid` varchar(500) NOT NULL,
  `logoType` varchar(100) NOT NULL,
  `logoImage` varchar(500) NOT NULL,
  `logoTxt` varchar(500) NOT NULL,
  `logoTxtColor` varchar(500) NOT NULL,
  `TopBarBgColor` varchar(500) NOT NULL,
  `TopBarTxtColor` varchar(500) NOT NULL,
  `TopBarTxtHoverColor` varchar(500) NOT NULL,
  `SideBarBgColor` varchar(500) NOT NULL,
  `SideBarTxtColor` varchar(500) NOT NULL,
  `SideBarTxtHoverColor` varchar(500) NOT NULL,
  `LoginPageBgColor` varchar(500) NOT NULL,
  `CopyRightTxtColor` varchar(500) NOT NULL,
  `LandPColor` varchar(500) NOT NULL,
  `AppName` varchar(500) NOT NULL,
  `AdminEmail` varchar(500) NOT NULL,
  `SignupStatus` varchar(500) NOT NULL,
  `SignupToken` varchar(500) NOT NULL,
  `SupportLink` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_page_settings`
--

INSERT INTO `tbl_page_settings` (`usermailid`, `logoType`, `logoImage`, `logoTxt`, `logoTxtColor`, `TopBarBgColor`, `TopBarTxtColor`, `TopBarTxtHoverColor`, `SideBarBgColor`, `SideBarTxtColor`, `SideBarTxtHoverColor`, `LoginPageBgColor`, `CopyRightTxtColor`, `LandPColor`, `AppName`, `AdminEmail`, `SignupStatus`, `SignupToken`, `SupportLink`) VALUES
('', 'Image', '1465884596quiksitbox.png', 'Cliks', 'rgb(244, 255, 143)', 'rgb(42, 34, 56)', 'rgb(255, 255, 255)', 'rgb(166, 187, 255)', 'rgb(32, 31, 31)', 'rgb(191, 255, 230)', 'rgb(0, 1, 33)', 'rgb(255, 210, 207)', 'rgb(0, 0, 0)', 'rgb(255, 255, 255)', 'Cliks', '', 'Signup Enabled', 'Lb5lLXpR67', '');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_pixeladmin`
--

CREATE TABLE IF NOT EXISTS `tbl_pixeladmin` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(200) NOT NULL,
  `script` longtext NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_polls_answer_votes`
--

CREATE TABLE IF NOT EXISTS `tbl_polls_answer_votes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `poll_randurl` varchar(500) NOT NULL,
  `poll_answer` varchar(500) NOT NULL,
  `created_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popups`
--

CREATE TABLE IF NOT EXISTS `tbl_popups` (
  `poup_id` int(11) NOT NULL AUTO_INCREMENT,
  `poup_name` varchar(100) CHARACTER SET latin1 NOT NULL,
  `userId` varchar(100) CHARACTER SET latin1 NOT NULL,
  `profile_id` int(11) NOT NULL,
  `popup_width` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_hieght` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_postion` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_overlay` tinyint(4) NOT NULL DEFAULT '1',
  `popup_overlay_color` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_overlay_opacity` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_email_provide` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_html` longtext CHARACTER SET latin1 NOT NULL,
  `popup_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL,
  `popup_status` tinyint(4) NOT NULL DEFAULT '1',
  `layered_randUrl` varchar(100) CHARACTER SET latin1 NOT NULL,
  `popup_title` varchar(500) CHARACTER SET latin1 NOT NULL,
  `link_url` varchar(500) CHARACTER SET latin1 NOT NULL,
  `popup_timing` int(11) NOT NULL,
  `autoresponder_html` longtext CHARACTER SET latin1 NOT NULL,
  `countdown_timer` date NOT NULL,
  PRIMARY KEY (`poup_id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1848 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_popups_new`
--

CREATE TABLE IF NOT EXISTS `tbl_popups_new` (
  `poup_id` int(11) NOT NULL AUTO_INCREMENT,
  `poup_name` varchar(100) NOT NULL,
  `userId` varchar(100) NOT NULL,
  `profile_id` int(11) NOT NULL,
  `popup_width` varchar(100) NOT NULL,
  `popup_hieght` varchar(100) NOT NULL,
  `popup_postion` varchar(100) NOT NULL,
  `popup_overlay` tinyint(4) NOT NULL DEFAULT '1',
  `popup_overlay_color` varchar(100) NOT NULL,
  `popup_overlay_opacity` varchar(100) NOT NULL,
  `popup_email_provide` varchar(100) NOT NULL,
  `popup_html` longtext NOT NULL,
  `popup_created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_date` datetime NOT NULL,
  `popup_status` tinyint(4) NOT NULL DEFAULT '1',
  `layered_randUrl` varchar(100) NOT NULL,
  `popup_title` varchar(500) NOT NULL,
  `link_url` varchar(500) NOT NULL,
  `popup_timing` int(11) NOT NULL,
  `autoresponder_html` longtext NOT NULL,
  `countdown_timer` date NOT NULL,
  PRIMARY KEY (`poup_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_profile`
--

CREATE TABLE IF NOT EXISTS `tbl_profile` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `userId` varchar(100) NOT NULL,
  `profile_name` varchar(100) NOT NULL,
  `profile_image_path` varchar(250) NOT NULL,
  `profile_type` text NOT NULL,
  `profile_link` varchar(100) NOT NULL,
  `created_date` datetime DEFAULT NULL,
  `modified_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_typeipadress`
--

CREATE TABLE IF NOT EXISTS `tbl_typeipadress` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `typeid` int(11) NOT NULL,
  `ipaddress` varchar(30) NOT NULL,
  `type` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user`
--

CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `mailaddress` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `userType` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_viewstats`
--

CREATE TABLE IF NOT EXISTS `tbl_viewstats` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `views_count` mediumint(9) NOT NULL,
  `visitor_count` mediumint(9) NOT NULL,
  `ip` varchar(30) NOT NULL,
  `user_id` varchar(100) NOT NULL,
  `random_url` varchar(100) NOT NULL,
  `created_date` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
