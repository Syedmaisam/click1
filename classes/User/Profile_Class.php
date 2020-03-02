<?php
Class Profile_Class extends Database
{

	public function create_profile($param,$files='',$userId)
	{
                $currentTime = time();
		$target_dir = SOURCE_ROOT."images/profile/";
		$target_file = $target_dir . basename($currentTime.$_FILES["profileLogoUploadBtn"]["name"]);
		$uploadOk = 1;
		$arrData = $this->get_profile($userId,'',$param['profilename']);
		if(count($arrData) > 0)
		{
		return "registered";	
		} else {
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["profileLogoUploadBtn"]["tmp_name"]);
			if($check !== false) {
				move_uploaded_file($_FILES["profileLogoUploadBtn"]["tmp_name"], $target_file);
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
		$arrInsertCol = array('userId'=>$userId,'profile_name'=>$param['profilename'],'profile_image_path'=>$currentTime.$_FILES["profileLogoUploadBtn"]["name"],'profile_type'=>$param['profileType'],'profile_link'=>$param['profilelink']);
		return  $this->insert(TABLE_TABLE_PROFILE,$arrInsertCol);
		}
	}
	
	public function edit_profile($param,$files='',$userId)
	{
                $currentTime = time();
		$target_dir = SOURCE_ROOT."images/profile/";
		$target_file = $target_dir . basename($currentTime.$_FILES["profileLogoUploadBtn"]["name"]);
		$uploadOk = 1;
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		$id =$param['p_id'];
		$where = " id='$id'";
		// Check if image file is a actual image or fake image
			$check = getimagesize($_FILES["profileLogoUploadBtn"]["tmp_name"]);
			if($check !== false) {
				move_uploaded_file($_FILES["profileLogoUploadBtn"]["tmp_name"], $target_file);
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
		$arrUpdateCol = array('userId'=>$userId,'profile_name'=>$param['profilename'],'profile_type'=>$param['profileType'],'profile_link'=>$param['profilelink'],'modified_date'=>date("Y-m-d H:i:s"));
		if($_FILES["profileLogoUploadBtn"]["name"]!='')
		{
		$arrUpdateCol+=array('profile_image_path'=>$currentTime.$_FILES["profileLogoUploadBtn"]["name"]);
		}
		return  $this->update(TABLE_TABLE_PROFILE,$arrUpdateCol,$where);
	}
	
	public function save_img_logo($param,$files='')
	{
	
 		$currentTime = time();
 		$target_dir = SOURCE_ROOT."images/";
 		$target_file = $target_dir . basename($currentTime.$_FILES["logoimage"]["name"]);
 		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
 		$mailid=$_SESSION['logeid'];
     	move_uploaded_file($_FILES["logoimage"]["tmp_name"], $target_file);
	
		$arrUpdateCol = array('logoImage'=>$currentTime.$_FILES["logoimage"]["name"]);
		$where = "usermailid='$mailid'";
	    return  $this->update(TABLE_PAGE_SETTINGS,$arrUpdateCol,$where);
	}
	
	
	
	
	public function get_profile($userid,$profile_id='',$profile_name='')
	{
		$whereP_id = ($profile_id!='')?" AND id='$profile_id'":'';
		$whereP_name = ($profile_name!='')?" AND profile_name='$profile_name'":'';
		$where = " userId='$userid'{$whereP_name}{$whereP_id}";
		$arrSelectCol = array('id','userId','profile_name','profile_image_path','profile_type','profile_link','created_date','modified_date');	
		return $this->select(TABLE_TABLE_PROFILE,$arrSelectCol,$where);
	}
	public function get_profileImage($userid,$profilename)
	{
		$where="userId='$userid' and profile_name='$profilename'";
		$val=array('id','userId','profile_name','profile_image_path','profile_type','profile_link','created_date','modified_date');
		return $this->select(TABLE_TABLE_PROFILE, $val, $where);
	}
	public function get_profilepicpath()
	{
		$mailid=$_SESSION['logeid'];
		$where="userId ='$mailid'";
		$val=array('id','userId','profile_name','profile_image_path','profile_type','profile_link','created_date','modified_date');
		return $this->select(TABLE_TABLE_PROFILE, $val, $where);
	}
	
	
	public function deleteProfile($profile_id)
	{
		$where = " id='$profile_id'";
		return $this->delete(TABLE_TABLE_PROFILE, $where);
	}
	public function get_profile_stats($profile_id)
	{
		$pfofile_id=$profile_id;
		
		
		$sql="Select
		(
		(
		SELECT  Count(*)  FROM `tbl_basicontent` WHERE `profile` = $pfofile_id
		)
		+
		(
		SELECT Count(*)   FROM `tbl_imagecontent` WHERE `profile` = $pfofile_id
		)
		
		+
		
		(
		SELECT Count(*)   FROM `tbl_justlink` WHERE `profile_id` = $pfofile_id
		)
		
		+
		
		(
		
		SELECT Count(*)   FROM `tbl_popups` WHERE `profile_id` = $pfofile_id
		
		)
		
		) As TotalCount, 
                (
                 (SELECT IFNull(Sum(view),0)  FROM `tbl_basicontent` WHERE `profile` = $pfofile_id)               
                   +
                (SELECT IFNull(Sum(`view`),0) FROM `tbl_imagecontent` WHERE `profile` = $pfofile_id)
                   +
                (SELECT  IFNull(sum(`view`),0) FROM `tbl_justlink` WHERE `profile_id` = $pfofile_id)

                ) As TotalView,

               (
                (SELECT IFNull(Sum(uniqueview),0)  FROM `tbl_basicontent` WHERE `profile` = $pfofile_id)               
                   +
                (SELECT IFNull(Sum(uniqueview),0) FROM `tbl_imagecontent` WHERE `profile` = $pfofile_id)
                   +
                (SELECT  IFNull(sum(uniqueview),0) FROM `tbl_justlink` WHERE `profile_id` = $pfofile_id)
              ) As TotalUniqueView
		";
		
		$result=mysql_query($sql);
		$row=mysql_fetch_row($result);
		//echo $row[0].",".$row[1].",".$row[2];
		
		return $arrstatprofile = array($row[0], $row[1],$row[2] );
		
	}
	public function get_profile_links($profile_id)
	{
		$sql="SELECT randomlink As rLink  FROM `tbl_basicontent` WHERE `profile` = $profile_id
		Union All
		SELECT randomLink As rLink  FROM `tbl_imagecontent` WHERE `profile` = $profile_id
		Union All
		SELECT randUrl As rLink   FROM `tbl_justlink` WHERE `profile_id`=$profile_id";
		$result = $this->getArrayResult($sql);
	
		return $result;
	}
	public function get_all_profile_links($userId)
	{
	
		$sql="SELECT randomlink As rLink  FROM `tbl_basicontent` WHERE `userId` = '$userId'
		Union All
		SELECT randomLink As rLink  FROM `tbl_imagecontent` WHERE `userId` = '$userId'
		Union All
		SELECT randUrl As rLink   FROM `tbl_justlink` WHERE `user_id`='$userId'";
	
		//var_dump($sql);
		$result = $this->getArrayResult($sql);
	
		return $result;
	}
	public function get_campaign_links($campId)
	{
		$sql="SELECT randomlink As rLink  FROM `tbl_basicontent` WHERE `campaignId` = '$campId'
		Union All
		SELECT randUrl As rLink  FROM `tbl_campaign` WHERE `id` = '$campId'";
	
	
		//var_dump($sql);
		$result = $this->getArrayResult($sql);
	
		return $result;
	}
	public function get_campaign_msg_links($msgId)
	{
		$sql="SELECT randomlink As rLink  FROM `tbl_basicontent` WHERE `messageId` = '$msgId'
		Union All
		SELECT randUrl As rLink  FROM `tbl_campaign` WHERE `id` = '$msgId'";
	
	
		//var_dump($sql);
		$result = $this->getArrayResult($sql);
	
		return $result;
	}
	public function save_SciptData($userId,$script)
	{
		$sql= "SELECT script FROM tbl_pixeladmin WHERE userId = '$userId'";
		$result = $this->getArrayResult($sql);
		$insertScript = mysql_real_escape_string($script);

		if($result[0]['script'] != '')
		{
			$sql= "UPDATE tbl_pixeladmin SET script= '$insertScript' WHERE userId = '$userId'";
			$result = $this->getArrayResult($sql);
		}
		else
		{
			$sql= "INSERT INTO tbl_pixeladmin(userId, script) VALUES ('$userId','$insertScript')";
			$result = $this->getArrayResult($sql);
		}
	}
	public function get_SciptData($userId)
	{
		$sql= "SELECT script FROM tbl_pixeladmin WHERE userId = '$userId'";
		return $result = $this->getArrayResult($sql);
	}
	public function Onload_SciptData($randurl)
	{
		$sql = "Select userId From
		(
		SELECT userId FROM `tbl_popups` WHERE `layered_randUrl` = '$randurl'
		UNION All
		SELECT user_Id as userId FROM `tbl_justlink` WHERE `randUrl` = '$randurl'
		UNION All
		SELECT userId FROM `tbl_imagecontent` WHERE `randomLink` = '$randurl'
		UNION All
		SELECT userId FROM `tbl_basicontent` WHERE `randomlink` = '$randurl'
		) A
		limit 1";
		
		$randata = $this->getArrayResult($sql);		
		if($randata[0]['userId'] != '' && $randata[0]['userId'] != null)
		{
			return $this->get_SciptData($randata[0]['userId']);
		}		
	}
	public function SaveAnalyticData($param, $path) {		
		$emailid = $_SESSION['logeid'];
		//var_dump($emailid); exit;
		$sql = "select * from tbl_analytic_setting where email = '$emailid'";
		$result = $this->getArrayResult($sql);
		$trackid = $param['trackid'];
		$serviceaccount = $param['serviceaccount'];
		$applicationname = $param['applicationname'];	
		$trackcode = mysql_real_escape_string($param['trackcode']);
		$p12 = $path;
		//var_dump($result); exit;
		if($result != null)	{ 
			$sql = "UPDATE tbl_analytic_setting SET trackid= '$trackid',
			serviceaccount = '$serviceaccount',
			applicationname = '$applicationname',
			trackcode = '$trackcode',
			p12 = '$path' WHERE email = '$emailid'";
			//echo $sql;
			$this->getArrayResult($sql);
		}
		else {
			$sql = "INSERT INTO tbl_analytic_setting(email, trackid, serviceaccount, applicationname, trackcode, p12) VALUES
			('$emailid', '$trackid', '$serviceaccount', '$applicationname', '$trackcode', '$p12')";
			//echo $sql;
			$this->getArrayResult($sql);			
		}		
	}
	public function GetAnalyticData()	{		
			$sql = "select * from tbl_analytic_setting limit 1";
			$result = $this->getArrayResult($sql);
			return $result;		
	}
}