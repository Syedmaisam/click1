<?php
/******************************************
Module name : Database
Parent module : None
Date created : 18th October 2007
Date last modified : 18th October 2007
Author : Sandeep Kumar
Last modified by : Sandeep Kumar
Comments : Database class use for connection. Execute queries like insert , update, delete etc.
******************************************/	
class Database
{
	/******************************************
	Variable declaration begins
	******************************************/
	// 0 = die($error), 1 = notify & continue, 2 = do nothing & continue
	var $onError = 0; 
	// 0 = ignore, otherwise email($query) if query time > $longQuery	
	var $longQuery = 0; 
	var $errorFrom = 'info@llg.com';
	var $db;
	var $dbname;
	var $host;
	var $password;
	var $queries;
	var $result;
	var $user;	
	var $id;
	var $id_name;
	var $table_name;
	var $columns = array();
	/******************************************
	Variable declaration ends
	******************************************/
	/******************************************
	Function name : Database
	Return type : none
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Constructor of database class
	User instruction :$objDb = new Database($varDbServer, $varDbUser, $varDbPass, $varDbName);
	******************************************/
	function Database($host, $user, $password, $dbname)
	{
		$this->host     = $host;
		$this->user     = $user;
		$this->password = $password;
		$this->dbname   = $dbname;
//		if(LOCAL_MODE)
//		{
//			$errorTo = 'sandeep@localhost.com';
//			$errorPage = 'http://localhost/learn_live_global/';
//			$errorMsg = '';
//		}
//		else
//		{
//			$errorTo = 'sandeep.kumar@mail.vinove.com';
//			$errorPage= 'http://10.0.0.1/~sandbox/labs/learn_live_global/';
//			$errorMsg = '';
//		}
	}
	/******************************************
	Function Name : connect
	Return type : none
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Use to connect with database If error redirect to notify page
	User instruction :$objDb->connect($arg);
	******************************************/
	function connect($redirect = false)
	{
		 $this->queries = array();
		
		$this->db = mysql_connect($this->host, $this->user, $this->password) or $this->notify(mysql_error(), false, true);

		mysql_select_db($this->dbname, $this->db) or $this->notify(mysql_error(), false, true);
		
		if(strpos($_SERVER['REQUEST_URI'], 'install.php') !== false) {
			echo "<p style='display:none;'>XML Found</p>";
			$connew = mysqli_connect($this->host, $this->user, $this->password, $this->dbname);
			$sql = "
				SET SQL_MODE='NO_AUTO_VALUE_ON_ZERO';
				SET time_zone = '+00:00';
				
				
				/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
				/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
				/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
				/*!40101 SET NAMES utf8 */;
				
				--
				-- Database: `whiteclick`
				--
				
					
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
				
			    -- Table structure for table `tbl_page_settings`--
				
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
				  `SupportLink` varchar(500) NOT NULL,
				  `trialstatus` varchar(500) NOT NULL,
				  `trialdays` int(11) NOT NULL,
				  `endurl` varchar(500) NOT NULL,
				  `trialcode` longtext NOT NULL
				) ENGINE=InnoDB DEFAULT CHARSET=latin1;
				
				--
				-- Dumping data for table `tbl_page_settings`
				--
				
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
				  `trialcode` longtext NOT NULL,
				  `startdate` date NOT NULL,
				  PRIMARY KEY (`id`)
				) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;
				
				--
				-- Dumping data for table `tbl_user`
				--
								
				
				INSERT INTO `tbl_page_settings` (`usermailid`, `logoType`, `logoImage`, `logoTxt`, `logoTxtColor`, `TopBarBgColor`, `TopBarTxtColor`, `TopBarTxtHoverColor`, `SideBarBgColor`, `SideBarTxtColor`, `SideBarTxtHoverColor`, `LoginPageBgColor`, `CopyRightTxtColor`, `LandPColor`, `AppName`, `AdminEmail`, `SignupStatus`, `SignupToken`, `SupportLink`) VALUES
				('', 'Image', '1465884596quiksitbox.png', 'Cliks', 'rgb(244, 255, 143)', 'rgb(42, 34, 56)', 'rgb(255, 255, 255)', 'rgb(166, 187, 255)', 'rgb(32, 31, 31)', 'rgb(191, 255, 230)', 'rgb(0, 1, 33)', 'rgb(89, 103, 120)', 'rgb(0, 0, 0)', 'rgb(255, 255, 255)', 'Cliks', '', 'Signup Enabled', 'Lb5lLXpR67', '');
									
				";
			//var_dump($sql); exit;
			mysqli_multi_query($connew,$sql);
		}
	}

	/******************************************
	Function Name : query
	Return type : Record set
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Execute mysql query. It takes one argument as a parameter. If error redirect to notify page
	Calling function : getArrayResult();
	User instruction :$objDb->query($sql);
	******************************************/
	function query($sql)
	{
		//Set multiple queries
		$this->queries[] = $sql;
		//echo $sql;exit;
		$varStart = microtime();
		$this->result = mysql_query($sql) or $this->notify(mysql_error(),false ,true);
		$varStop = microtime();

		$varQueryExecutionTime = $varStop - $varStart;
		
		if(($longQuery != 0) && ($varQueryExecutionTime > $longQuery))
		{
			$msg  = $_SERVER['PHP_SELF'] . " @ " . date("Y-m-d H:ia") . "\n\n";
			$msg .= 'The following query took $varQueryExecutionTime to complete:\n\n';
			$msg .= $this->lastQuery() . "\n\n";
			$msg .= $this->queries() . "\n\n";
			
			@mail($this->errorTo, "Long Query " . $_SERVER['PHP_SELF'], $msg, "From: {$this->errorFrom}");
		}
		return $this->result;
	}
	
	/******************************************
	Function Name : formatColumnValue
	Return type : Associative array
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Add slashes in column values. It takes one argument as a parameter. Used in insert() and update().
	User Instruction : $objDb->formatColumnValue($columnVals)
	******************************************/
	function formatColumnValue($columnVals)
	{
		foreach($columnVals  as $key => $val)
		{
			$columnVals[$key] = mysql_real_escape_string($val);
		}	
		return $columnVals;
	}	
	
	/******************************************
	Function Name : quotedColumnValue
	Return type : Associative array
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Escapes special characters in a string for use in a SQL statement. It takes one argument as a parameter.
	User Instruction : $objDb->quotedColumnValue($columnVals)
	******************************************/
	function quotedColumnValue($columnVals)
	{
		foreach($columnVals  as $key => $val)
		{	
			if($val=="now()" )
			{
				$columnValues[$key] = mysql_real_escape_string($val);				
			}
			else
			{	$clmValue = mysql_real_escape_string($val);
				$columnValues[$key] = "'".$clmValue."'";
			}	
		}	
		return $columnValues;
	}
	
	/******************************************
	Function Name : getArrayResult
	Return type : Associative array
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Generate assoc array from record set. Used in selecting values from database. It takes query as a parameter.
	User Instruction : $objDb->getArrayResult($columnVals)
	******************************************/
	function getArrayResult($sql)
	{
		
		$res = $this->query($sql);
		
		if($res)
		{
			while ($row = mysql_fetch_assoc($res))
			{	
				$row = $this->formatDbValue($row);
				$resultProvider[] = $row;
			}
		}
		return $resultProvider;  
	 }
	
	/******************************************
	Function Name : formatDbValue
	Return type : Associative array
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Format database value and remove addshlashes and htmlspecial chars. It takes two arg. as a parameter.
	User Instruction : $objDb->formatDbValue($text, $nl2br = false)
	******************************************/
	function formatDbValue($text, $nl2br = false) 
	{
		if(is_array($text)) 
		{
			$tmp_array = Array();
			foreach($text as $key => $value) 
			{
				$tmp_array[$key] = $this->formatDbValue($value);
			} 
			return $tmp_array;
		} 
		else 
		{
			$text = htmlspecialchars(stripslashes($text));
			if($nl2br) 
			{
				return nl2br($text);
			} 
			else 
			{
				return $text;
			} 
		} 
	} 
	
	/******************************************
	Function Name : select
	Return type : Associative array
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to select values from a table. It takes table name and assoc column array, where, order by and limit as a parameter.
	User Instruction : $objDb->formatDbValue($tableName, $arrColumns='', $where='', $orderBy='' , $limit='')
	******************************************/	
	function select($tableName, $arrColumns='', $where='', $orderBy='' , $limit='' , $groupBy='')
	{	
		if(!(is_array($arrColumns)) )
		{
			 $this->notify('function :  select() <br> Error: Passed argument should be an array!', false, true);
		}
		
		if(is_array($arrColumns)) 
		{
			$arrColumns = implode(',',$arrColumns);			
		}
		
		if($arrColumns=='*')
		{
			 $this->notify('function :  select() <br> Error: Passed argument should be an column no astric(*)!', false, true);
		}
		
		if($where=='')
		{
			$where = ' 1 ';
		}
		
		if($orderBy!='')
		{
			$orderBy = ' ORDER BY ' .	$orderBy;
		}
		
		if($limit!='')
		{
			$limit = ' LIMIT '.$limit;
		}
	if($groupBy!='')
		{
			$groupBy = ' GROUP BY '.$groupBy;
		}
		
		$query = 'SELECT ' . $arrColumns . ' FROM '.$tableName . ' WHERE '. $where . $orderBy . $groupBy . $limit;
		//echo $query."<br /> <br />";
		return $this->getArrayResult($query);
	}

	/******************************************
	Function Name : insert
	Return type : Integer
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to insert values in a table. It takes table name and assoc column array as a parameter.
	User Instruction : $objDb->insert($tableName, $arrColumns)
	******************************************/
	function insert($tableName, $arrColumns)
	{
		$columnsKeys = join(", ", array_keys($arrColumns));
		
		$values  = $this->quotedColumnValue($arrColumns);
		 
		$values  =  join(", ", $values);

		//echo $values  = "'" . join("', '", $this->formatColumnValue($arrColumns)) . "'";

		 $this->query("INSERT INTO " . $tableName . " ($columnsKeys) VALUES ($values)");
		//Return inserted id
		$this->id = mysql_insert_id();
		return $this->id;
	}

	/******************************************
	Function Name : update
	Return type : Integer
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to update values in a table. It takes table name,  assoc column array and where condition as a parameter.
	User Instruction : $objDb->update($tableName, $arrColumns, $where)
	******************************************/
	/*function update($tableName, $arrColumns, $where)
	{
		$arrStuff = array();
		
		if(!(is_array($arrColumns)))
		{
			$this->notify('function :  update() <br> Error: Passed argument should be an array!', false, true);
		}
		
		if($where=='')
		{
			$this->notify('function :  update() <br> Error:  where condition is missing !', false, true);
		}
		
		//unset($this->columns[$this->id_name]);
		foreach($arrColumns as $key => $val)
		{	
			if($val == 'now()' || $val == 'NOW()' || $val == 'curtime()' || $val == 'CURTIME()')
			{
				$arrStuff[] = "$key = ".mysql_real_escape_string($val);
			}
			else
			{
				$arrStuff[] = "$key = '".mysql_real_escape_string($val)."'";
			}	
		}
			
		$stuff = implode(", ", $arrStuff);
		
		//$id = mysql_real_escape_string($id);
		
		$sqlUpdate = 'UPDATE ' . $tableName . ' SET '. $stuff .' WHERE  ' . $where;
		 $this->query($sqlUpdate);
		// Not always correct due to mysql update bug/feature
		return mysql_affected_rows(); 
	}*/
    
    /******************************************
    Function Name : update
    Return type : Integer
    Date created : 23rd Feb 2013
    Date last modified : 23rd Feb 2013
    Author :  Rakesh Kumar
    Last modified by : rakesh Kumar
    Comments : Used to update values in a table. It takes table name,  assoc column array and where condition as a parameter.
    User Instruction : $objDb->update($tableName, $arrColumns, $where)
    ******************************************/
    function update($tableName, $arrColumns, $where)
    {
        $arrStuff = array();

        if (!(is_array($arrColumns)))
        {
            $this->notify('function :  update() <br> Error: Passed argument should be an array!', false, true);
        }

        if ($where=='')
        {
            $this->notify('function :  update() <br> Error:  where condition is missing !', false, true);
        }
        
        //unset($this->columns[$this->id_name]);
        foreach($arrColumns as $key => $val)
        { 

            if($val=="now()" )//|| strstr($val,'encode')<>''
            {
                $arrStuff[] = "$key = ".mysql_real_escape_string(trim($val));
            }
            else if(strstr($val,'encode(')<>'')
            {
                $arrStuff[] = "$key = trim($val)";
            }
            /*else if(substr($val,0,1) === '+')
            {
                $arrStuff[] = "$key = $key$val";
            }*/
            else if(strstr($val,$key))
            {
                $arrStuff[] = "$key = '$val'";
            }
            else
            {
                $arrStuff[] = "$key = '".mysql_real_escape_string(trim($val))."'";
            }
        }
            //print_r($arrStuff); die;
        $stuff = implode(", ", $arrStuff);

        //$id = mysql_real_escape_string($id);

         $sqlUpdate = 'UPDATE ' . $tableName . ' SET '. $stuff .' WHERE  ' . $where;
         //echo $sqlUpdate;exit;
         $this->query($sqlUpdate);

        return mysql_affected_rows(); // Not always correct due to mysql update bug/feature
    } 
	
	/******************************************
	Function Name : updateList
	Return type : Integer value
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to update values in a table. It takes table name,  assoc column array, column name and it's values (comma seperated or single array )  as a parameter.
	User Instruction : $objDb->updateList($tableName, $arrColumns, $idName, $idValues)
	******************************************/
	function updateList($tableName, $arrColumns, $idName, $idValues)
	{	
		
		if(!(is_array($arrColumns)) || !(is_array($idValues)))
		{
			$this->notify('function :  updateList() <br> Error: Passed argument should be an array!', false, true);
		}
		
		if(count($idValues)>0)
		{
			if(is_array($idValues))
			{
				$idValues = implode(',',$idValues);
			}
		}
		else
		{
			$this->notify('function :  updateList() <br> Error: Passed array is blank!', false,true );
		}		
		
		$arrStuff = array();			
		
		foreach($this->formatColumnValue($arrColumns) as $key => $val)
		{
			$arrStuff[] = "$key = '".mysql_real_escape_string($val)."'";
		}			
		$stuff = implode(", ", $arrStuff);		
		
		$sql="UPDATE " . $tableName . " SET " . $stuff . " WHERE ".$idName." IN ( ".$idValues." )";	
		$this->query($sql);		
		// Not always correct due to mysql update bug/feature
		return mysql_affected_rows(); 
	}
	
	/******************************************
	Function Name : delete
	Return type : Integer value
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to delete records from a table. It takes table name and where condition as a parameter.
	User Instruction : $objDb->updateList($tableName, $where)
	******************************************/					
	function delete($tableName, $where)
	{
		if($where=='')
		{
			$this->notify('function :  delete() <br> Error: where condition is missing !', false, true);
		}
	
		$idValue = mysql_real_escape_string($idValue);
		$varDel=$this->query("DELETE FROM " . $tableName . " WHERE " . $where);
		
		return mysql_affected_rows();
	}		
	
	/******************************************
	Function Name : deleteList
	Return type : Integer value
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Used to delete records from a table. It takes table name, column name and it's values (comma seperated or single array )as a parameter.
	User Instruction : $objDb->deleteList($tableName, $idName, $idValues)
	******************************************/	
	function deleteList($tableName, $idName, $idValues)
	{	
		if(!(is_array($idValues)))
		{
			$this->notify('function :  deleteList() <br> Error: passargument should be an array (idValues)!', false, true);
		}

		if(is_array($idValues))
		{
			$idValues = implode(',',$idValues);
		}
		
		$sqlDel = 'DELETE FROM ' . $tableName . ' WHERE ' . $idName . ' IN (' . $idValues . ')';
		//echo $sqlDel;exit;
		$this->query($sqlDel);
		return mysql_affected_rows();
	}		

	/******************************************
	Function Name : getNumRows
	Return type : Number
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Number of records in  a table . It takes three argument as a parameter.
	User Instruction : $objDb->getNumRows($argTableName, $argClmn, $argWhr='1')
	******************************************/	
	function getNumRows($argTableName, $argClmn, $argWhr = '')
	{	
		$varWhr = ' 1 '.$argWhr;
		
		$sqlNum = 'SELECT count('.$argClmn.') as numrows FROM ' . $argTableName .' Where '.$varWhr ;
		//echo $sqlNum;exit;
		$varResult = mysql_query($sqlNum) or die(mysql_error());
		$resutlNum = mysql_fetch_assoc($varResult);
		return $resutlNum[numrows];
	}
		
	/******************************************
	Function Name : numQueries
	Return type : Number of queries. 
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Display number of queries in queries array.
	User Instruction : $objDb->numQueries()
	******************************************/	
	function numQueries()
	{
		return count($this->queries);
	}

	/******************************************
	Function Name : numQueries
	Return type : query. 
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Display last executed query from  queries array.
	User Instruction : $objDb->lastQuery()
	******************************************/	
	function lastQuery()
	{
		return $this->queries[count($this->queries) - 1];
	}

	/******************************************
	Function Name : queries
	Return type : queries. 
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Display all queries from queries array .
	User Instruction : $objDb->queries()
	******************************************/	
	function queries()
	{
		return implode("\n", $this->queries);
	}
	
	/******************************************
	Function Name : isValid
	Return type : Boolean. 
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author :  Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Display all queries from queries array .
	User Instruction : $objDb->queries()	
	******************************************/	
	function isValid() 
	{
		return isset($this->result) && (mysql_num_rows($this->result) > 0);
	}

	/******************************************
	Function Name : notify
	Return type : none
	Date created : 18th October 2007
	Date last modified : 18th October 2007
	Author : Sandeep Kumar
	Last modified by : Sandeep Kumar
	Comments : Display error message to user .There is  three parameter error message , redirect and show last query.
	User Instruction : $objDb->notify($errMsg, $redirect = false, $showQuery = true)
	********************************************/	
	function notify($errMsg, $redirect = false, $showQuery = true)
	{	
		return;
		switch($this->onError)
		{
			case 0:
				if($showQuery)
				{
					$errMsg = $errMsg . "<br/><br/>" . $this->lastQuery();
				}
				else
				{
					$errMsg = $errMsg . "<br/><br/>";
				}	
				$_SESSION[sessErrMsg] = $errMsg;
				
				break;
			
			case 1:
				$msg  = $_SERVER['PHP_SELF'] . " @ " . date("Y-m-d H:ia") . "\n";
				$msg .= $errMsg . "\n\n";
				$msg .= $this->queries() . "\n\n";
				
				$msg .= "POST VARIABLES\n==============\n" . var_export($_POST, true) . "\n\n";
				$msg .= "GET VARIABLES\n=============\n"   . var_export($_GET, true)  . "\n\n";
				@mail($this->errorTo, $_SERVER['PHP_SELF'], $msg, "From: {$this->errorFrom}");
				header("Location: $_SERVER[HTTP_REFERER]");
				exit();
				break;
		}
		
		if($redirect)
		{	
			header("Location: $this->errorPage");
			exit();
		}
		else
		{
			die($_SESSION[sessErrMsg]);
		}			
	}	
}
?>