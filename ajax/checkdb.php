<?php

$hostingname=$_REQUEST['hostingname'];
$dbuser=$_REQUEST['dbuser'];
$dbname=$_REQUEST['dbname'];
$dbpass=$_REQUEST['dbpass'];
$adminemail=$_REQUEST['adminemail'];
$adminpass=$_REQUEST['adminpass'];

@$conn = new mysqli($hostingname, $dbuser, $dbpass,$dbname);

// Check connection
if (@$conn->connect_error) {
	echo "error in connection";
	
}
else
{
$sql = "CREATE TABLE IF NOT EXISTS `tbl_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(500) NOT NULL,
  `username` varchar(500) NOT NULL,
  `mailaddress` varchar(500) NOT NULL,
  `password` varchar(500) NOT NULL,
  `status` tinyint(4) NOT NULL,
  `userType` varchar(500) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=0;";

$sql.="CREATE TABLE IF NOT EXISTS `tbl_page_settings` (
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
);";	
	var_dump($sql);
	$conn->multi_query($sql);
	
echo "connected successfully";
}

?>