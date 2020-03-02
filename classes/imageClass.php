<?php
class imageClass extends Database
{
	public function __construct()
	{
		
	}
	public function saveImageContent($param,$files='',$userId)
	{
		var_dump($param);
		exit;

		$currentDate = date("Y-m-d");
		$tablename = "tbl_imagecontent";
		$target_dir = SOURCE_ROOT."images/basic/";
		$target_file = $target_dir . basename($_FILES["inp_ImgLocation"]["name"]);
		$uploadOk = 1;
		//check if it already exist or not
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["inp_ImgLocation"]["tmp_name"]);
		if($check !== false) {
			move_uploaded_file($_FILES["inp_ImgLocation"]["tmp_name"], $target_file);
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
		$arrInsertCol = array('userId'=>$userId,'title'=>$param['inp_title'],'contentUrl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'imageLocation'=>$_FILES["inp_ImgLocation"]["name"],'imageUrl'=>$param['inp_ImgUrl'],'yourUrl'=>$param['inp_YourUrl'],'popupHeight'=>$param['inp_Height'],'popupWidth'=>$param['inp_Width'],'popupTiming'=>$param['inp_Timing'],'created'=>$currentDate,'popup_position'=>$param['position']);
		return  $this->insert($tablename,$arrInsertCol);
			
		
	}
	public function get_profile($userid,$profile_id='',$profile_name='')
	{
		$whereP_id = ($profile_id!='')?" AND id='$profile_id'":'';
		$whereP_name = ($profile_name!='')?" AND profile_name='$profile_name'":'';
		$where = " userId='$userid'{$whereP_name}{$whereP_id}";
		$arrSelectCol = array('id','userId','profile_name','profile_image_path','profile_type','profile_link','created_date','modified_date');
		return $this->select($tablename,$arrSelectCol,$where);
	}
	public function getImageDetailContent($Id)
	{
		$sql = "SELECT * FROM tbl_imagecontent WHERE title = '$Id'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
	public function editImageContent($param,$files='',$userId)
	{
		$currentDate = date("Y-m-d");
		$tablename = "tbl_imagecontent";
		$target_dir = SOURCE_ROOT."images/basic/";
		$target_file = $target_dir . basename($_FILES["inp_ImgLocation"]["name"]);
		$uploadOk = 1;
		//check if it already exist or not
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$check = getimagesize($_FILES["inp_ImgLocation"]["tmp_name"]);
		if($check !== false) {
			move_uploaded_file($_FILES["inp_ImgLocation"]["tmp_name"], $target_file);
			$uploadOk = 1;
		} else {
			$uploadOk = 0;
		}
		$where = " where userId =$userId";
		$arrInsertCol = array('userId'=>$userId,'title'=>$param['inp_title'],'contentUrl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'imageLocation'=>$_FILES["inp_ImgLocation"]["name"],'imageUrl'=>$param['inp_ImgUrl'],'yourUrl'=>$param['inp_YourUrl'],'popupHeight'=>$param['inp_Height'],'popupWidth'=>$param['inp_Width'],'popupTiming'=>$param['inp_Timing'],'created'=>$currentDate);
		return  $this->update($tablename, $arrInsertCol, $where);
	}
}