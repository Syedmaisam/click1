<?php
$sql="Select
(
 (
SELECT  Count(*)  FROM `tbl_basicontent` 
WHERE `profile` = $profile_id AND `userId` = '$profile_email'
And  DATE_FORMAT(created,'%Y-%m-%d')  = DATE_FORMAT(Now(), '%Y-%m-%d') 
)  
+ 
(
SELECT Count(*)   FROM `tbl_imagecontent` WHERE `profile` = $profile_id And `userId` = '$profile_email'
 And  DATE_FORMAT(created,'%Y-%m-%d')  = DATE_FORMAT(Now(), '%Y-%m-%d') 
)

+

(
SELECT Count(*)   FROM `tbl_justlink` WHERE `profile_id` = $profile_id And `user_id` = '$profile_email'
 And  DATE_FORMAT(`add_date`,'%Y-%m-%d')  = DATE_FORMAT(Now(), '%Y-%m-%d') 
)

+

(

SELECT Count(*)   FROM `tbl_popups` WHERE `profile_id` = $profile_id And `userid` = '$profile_email'
 And  DATE_FORMAT(`popup_created_date`,'%Y-%m-%d')  = DATE_FORMAT(Now(), '%Y-%m-%d') 

)

) As TotalCount";

$result=mysql_query($sql);
$row=mysql_fetch_row($result);

//echo $_SESSION['product_level']=4;
//echo $row[0];
//exit;

if($_SESSION['product_level']==2 && $row[0]>=15)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==3 && $row[0]>=50)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==4 && $row[0]>=25)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
if($_SESSION['product_level']==6 && $row[0]>=5)
{
	
	$url=SITE_ROOT_URL.'upgrade.php';
	header("location: $url");
}
?>