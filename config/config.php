<?php
/**
 * Config
 *
 * This is the config file of the website.
 *
 * DateCreated 20th December, 2014
 *
 * @copyright Copyright (C) 2010-2014 Techprocompsoft
 *
 * 
 * @version 10.0
 */
$REQUEST_URI = $_SERVER ['REQUEST_URI'];
$URI_COLL = explode ( '/', $REQUEST_URI );
$REQUEST_URI = $URI_COLL [1];
$filepath = dirname ( dirname ( dirname ( __FILE__ ) ) ) .'/'. $REQUEST_URI. "/configXML.xml" ;
$found = file_exists ( $filepath );

$dbhostname = "";
$dbusername = "";
$dbpassword = "";
$dbname = "";
$applicationfolder = "";
if ($found) {
	$xml = simplexml_load_file ( $filepath );
	$dbhostname = (string)$xml->dbhostname;
	$dbusername = (string)$xml->dbusername;
	$dbpassword = (string)$xml->dbpassword;
	$dbname = (string)$xml->dbname;
	$applicationfolder = (string)$xml->applicationfolder;
} else {
	// Get header Location
	
	$REQUEST_SCHEME = (isset($_SERVER ['REQUEST_SCHEME']))?$_SERVER ['REQUEST_SCHEME']:"http";
	$SERVER_NAME = $_SERVER ['SERVER_NAME'];
	$REQUEST_URI = $_SERVER ['REQUEST_URI'];
	$URI_COLL = explode ( '/', $REQUEST_URI );
	$REQUEST_URI = $URI_COLL [1];
	$headerloc = $REQUEST_SCHEME . '://' . $SERVER_NAME . '/' . $REQUEST_URI . '/setup.php';
	header ( "Location: $headerloc" );
}
//var_dump($dbhostname); exit;
// Set display error true.
ini_set ( 'display_errors', "1" );
// //Report all error except notice
ini_set ( 'error_reporting', '1' );
// // Do not allow php_sess_id to be passed in the querystring and it's use for google search
ini_set ( 'session.use_only_cookies', 1 );
// Start new sesstion
session_start ();
// Database configuration settings for local and server mode and define some constant
if ($_SERVER ['HTTP_HOST'] == "localhost") {
	$arrConfig ['dbHost'] = $dbhostname;
	$arrConfig ['dbName'] = $dbname;
	$arrConfig ['dbUser'] = $dbusername;
	$arrConfig ['dbPass'] = $dbpassword;
	//var_dump($arrConfig); exit;
	define ( 'SITE_TITLE', $applicationfolder );
	define ( 'SITE_FOLDER', $applicationfolder );
	define ( 'SITE_ROOT_URL', 'http://' . $_SERVER ['HTTP_HOST'] . '/' . SITE_FOLDER . '/' );
	define ( "SOURCE_ROOT", dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/' . SITE_FOLDER . '/' );
} else {
	$arrConfig ['dbHost'] = $dbhostname;
	$arrConfig ['dbName'] = $dbname;
	$arrConfig ['dbUser'] = $dbusername;
	$arrConfig ['dbPass'] = $dbpassword;
	
	define ( 'SITE_TITLE', $applicationfolder );
	define ( 'SITE_FOLDER', $applicationfolder );
	define ( 'SITE_ROOT_URL', 'http://' . $_SERVER ['HTTP_HOST'] . '/' . SITE_FOLDER . '/' );
	define ( "SOURCE_ROOT", dirname ( dirname ( dirname ( __FILE__ ) ) ) . '/' . SITE_FOLDER . '/' );
}

// Site root url define in constant variable
define ( "ADMIN_ROOT_FACEBOOK_DATA", SITE_ROOT_URL . 'facebook-php-sdk-master/' );
define ( "ADMIN_SOURCE_ROOT_FACEBOOK_DATA", SOURCE_ROOT . 'facebook-php-sdk-master/' );
define ( "ADMIN_ROOT_ADMIN", SITE_ROOT_URL . 'Admin/' );
define ( "SOURCE_ROOT_DATABASE", SOURCE_ROOT . 'database/' );
define ( "SOURCE_ROOT_ADMIN", SOURCE_ROOT . 'Admin/' );
define ( "SOURCE_ROOT_CLASSES", SOURCE_ROOT . 'classes/' );
define ( "SOURCE_ROOT_CONTROLLER", SOURCE_ROOT . 'controller/' );
define ( 'SITE_PAGE_NOT_FOUND', SITE_ROOT_URL . '404.php' );

// Define analytics foldername
define ( "ANALYTICS_FOLDER", SITE_FOLDER );

// js css urls
define ( 'SITE_CSS_URL', SITE_ROOT_URL . 'css/' );
define ( 'SITE_IMG_URL', SITE_ROOT_URL . 'img/' );
define ( 'SITE_JS_URL', SITE_ROOT_URL . 'cssjs/' );

require_once SOURCE_ROOT . 'config/table_constants.php';

require_once SOURCE_ROOT . 'database/class_database_dbl.php';

require_once SOURCE_ROOT_CLASSES . 'class_general_bll.php';

$objGenral = new General ();

// Open a connection to Database
//var_dump($arrConfig); exit;
$objDatabase = new Database ( $arrConfig ['dbHost'], $arrConfig ['dbUser'], $arrConfig ['dbPass'], $arrConfig ['dbName'] );

$objDatabase->connect ();

// Trail user
$mailurl = $_SERVER['REQUEST_URI'];
$indexurl = "/".$applicationfolder.'/index.php';
$pos = strpos($mailurl, 'dashboardData.php');

if ($mailurl != $indexurl && $pos=== false) {
	if (isset ( $_SESSION ['trialuser'] )) {		
		//var_dump("yahn aaya"); exit;
$nvurl=$_SESSION ['trialuser'];
$_SESSION['logeid']="";
$_SESSION['username']="";
$_SESSION['user']="";
$_SESSION['id']="";
$_SESSION['user_control']="";
$_SESSION ['trialuser']="";
session_unset();
session_destroy();		
$objGenral->standardRedirect($nvurl);

//echo "<script type='text/javascript'>window.location.assign('".$nvurl."')</script>";
//header ( "location:".$nvurl);
	}
}