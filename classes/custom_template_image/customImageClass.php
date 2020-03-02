<?php

//include_once "../config/config.php";
class customImageClass extends Database
{
	public function __construct()
	{

	}
	public function saveImageContent($param,$files='',$userId)
	{
		$currentDate = date("Y-m-d");
		$tablename = "tbl_customimages";
		$target_dir = SOURCE_ROOT."images/customImage/";
		$target_file = $target_dir . basename(time().$param["image_file"]["name"]);
		$filname = time().$param["image_file"]["name"];
		
		$uploadOk = 1;
		//check if it already exist or not
		$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
		// Check if image file is a actual image or fake image
		$ext = $imageFileType;
		if($ext == "gif" || $ext =="GIF" || $ext == "jpg" || $ext == "JPG" ||  $ext == "JPEG" || $ext == "jpeg" ||  $ext == "png"|| $ext == "BMP"){
			
			$check = getimagesize($param["image_file"]["tmp_name"]);
			if($check !== false) {
				move_uploaded_file($param["image_file"]["tmp_name"], $target_file);
				$uploadOk = 1;
			} else {
				$uploadOk = 0;
			}
			$arrInsertCol = array('user_id'=>$userId,'image_source'=>$filname,'created_date'=>$currentDate);
			return $this->insert($tablename,$arrInsertCol);
			
			
		}  else {
			
			return "Invalid";
		} 
			

	}
	
	public function getImageTab($userId)
	{
		//$sql = "SELECT id,max(image_source) FROM tbl_customimages WHERE user_id = '$userId' GROUP BY id";
		$sql = "SELECT min(id) id,
		image_source FROM tbl_customimages
		WHERE user_id = '$userId'
		ANd image_source != ''
		GROUP BY image_source
		Order By id";
		
		$result = $this->getArrayResult($sql);
		
		return $result;
	}
	
	public function saveCustomPopupHtml($user_id,$pophtml,$popup_name)
	{
		//check in database whether the name already exist or not
if($user_id!='' && $user_id!=NULL){
		$is_exist = $this->check_name_exist($user_id,$popup_name);
		if($is_exist)
		{
			return "name_already_exist";
		}
else
		{
			$currentDate = date("Y-m-d");
			$tablename = "tbl_custom_popup";
			$arrInsertCol = array('user_id'=>$user_id,'popup_name'=>$popup_name,'custom_pop_html'=>$pophtml,'created_date'=>$currentDate,'modified_date'=>$currentDate);
			$this->insert($tablename,$arrInsertCol);
			return "name_not_exist";
		}
} else 
{
 return "logout";
}
		
	}
	public function updateCustomPopupHtml($user_id,$pophtml,$popup_name)
	{
		
		$currentDate = date("Y-m-d");
		$tablename = "tbl_custom_popup";
		$where = " user_id ='$user_id' and popup_name = '$popup_name'";
		$arrInsertCol = array('custom_pop_html'=>$pophtml,'modified_date'=>$currentDate);
		return  $this->update($tablename, $arrInsertCol, $where);
	}
	public function check_name_exist($user_id,$popup_name)
	{
		$is_exist= false;
		$sql = "select count(*) from tbl_custom_popup where user_id ='$user_id' and popup_name= '$popup_name'";
		$result = $this->getArrayResult($sql);
		if($result[0]['count(*)']> 0)
		{
			$is_exist = true;
		}
		return $is_exist;
	}
	public function get_custom_popup_html($id,$user_id)
	{
		$sql = "select custom_pop_html from tbl_custom_popup where user_id ='$user_id' and id= '$id'";
		
		$result = $this->getArrayResult($sql);
		$resultHTML="";
		if($result !=null)
		{
			$resultHTML = $result[0]['custom_pop_html'];
		}
		$htmlp="<div id='popupform_preview' style='display: block; position: fixed; z-index: 1000000; top:2%;left:30%;'>".$resultHTML."<div style='width: 39px; height: 19px; font-size: 23px; position:absolute;top: -9px;right:-24px;' class='ulp-layer' id='ulp-layer-335'><a href='#' onclick='return ulp_self_close();'>x</a></div></div><div style='width: 100%; height: 100%; background: none repeat scroll 0% 0% rgb(0, 0, 0); opacity: 0.7; top: 0px; left: 0px; position: fixed; z-index: 20000;display:none;' id='blackscreen'></div>";
		return $htmlp;
	}
	public function get_custom_popup_html_for_edit($id,$user_id)
	{
		$sql = "select popup_name,custom_pop_html from tbl_custom_popup where user_id ='$user_id' and id= '$id'";
	
		$result = $this->getArrayResult($sql);
		$resultHTML="";
		if($result !=null)
		{
			$resultHTML = $result[0]['custom_pop_html'];
			$name = $result[0]['popup_name'];
		}
		//$htmlp="<div id='popupform_preview' style='display: block; position: fixed; z-index: 1000000; top:2%;left:30%;'>".$resultHTML."</div><div style='width: 100%; height: 100%; background: none repeat scroll 0% 0% rgb(0, 0, 0); opacity: 0.7; top: 0px; left: 0px; position: fixed; z-index: 20000;display:none;' id='blackscreen'><div style='width: 39px; height: 19px; font-size: 23px; left: 351px; top: -29px;' class='ulp-layer' id='ulp-layer-335'><a href='#' onclick='return ulp_self_close();'>x</a></div></div>";
		$res =  $resultHTML."!@#".$name;
		return $res;
	}
	
	
	public function delete_and_getimage_again($img_id,$user_id)
	{
		$tablename = "tbl_customimages";
		$where = " id='$img_id' and user_id='$user_id'";
		$delresult = $this->delete($tablename,$where);
		$getnet_result = $this->getImageTab($user_id);
		return $getnet_result;
	}
}