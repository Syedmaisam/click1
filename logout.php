<?php
session_start();
$_SESSION['logeid']="";
$_SESSION['username']="";
$_SESSION['user']="";
$_SESSION['id']="";
$_SESSION['user_control']="";
$_SESSION ['trialuser'];
session_unset();
session_destroy();
header("location:login.php");

?>