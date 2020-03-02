<?php
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
class Auth extends Database{

	// authenticate admin users and maintain session
	public function loginAdmin($userId,$userPass,$type=''){
		$varTableName = TABLE_USER;
		if($type!=''){
			$typeCondtn = "AND user_type='{$type}'";
		}
		$arrCol = array('id','user_name','user_id','user_email','user_password','user_type','join_date','sex');
		$varWhere="user_id='{$userId}' AND user_password='{$userPass}' $typeCondtn";
		$arrData = $this->select($varTableName, $arrCol, $varWhere);
		return $arrData ;
	}
	public function getUserVideos($userId='',$status='', $limitStart='', $limitTo='',$sts=''){
		$varTableName = TABLE_VIDEO_LINKS;
		$arrCol = array('id','user_id','video_link','video_title','status');
		if($userId!='' && $status == '' && $limitTo!='' && $limitStart!=''){
			$varWhere="user_id='{$userId}'";
			$limits = "$limitStart,$limitTo";
			$arrData = $this->select($varTableName, $arrCol, $varWhere,'',$limits);
		} else if($userId=='' && $status != '' && $limitTo!='' && $limitStart!=''){
			$varWhere="status='{$status}'";
			$limits = "$limitStart,$limitTo";
			$arrData = $this->select($varTableName, $arrCol, $varWhere,'',$limits);
		}
		else if($userId=='' && $status == '' && $limitTo!='' && $limitStart!=''){
			$limits = "$limitStart,$limitTo";
			$arrData = $this->select($varTableName, $arrCol,'','',$limits);
		}
		else if($userId=='' && $status !='' && $limitTo=='' && $limitStart ==''){
			$varWhere="status='{$status}'";
			$sts = ($sts!='')?'500':'';
			$arrData = $this->select($varTableName, $arrCol, $varWhere,'',$sts);
		} else if($userId!='' && $status!= '' && $limitTo=='' && $limitStart==''){
			$varWhere="user_id='{$userId}' AND status='{$status}'";
			$arrData = $this->select($varTableName, $arrCol, $varWhere);
		}   else if($userId!='' && $status == '' && $limitTo=='' && $limitStart==''){
			$varWhere="user_id='{$userId}'";
			$arrData = $this->select($varTableName, $arrCol, $varWhere);
		} else {

			$arrData = $this->select($varTableName, $arrCol,$where);
		}
		//var_dump($arrData);
		return $arrData ;
	}
	public function resgisterUser($uname,$uid,$uemail,$upass,$utype,$sex){
		$varTableName = TABLE_USER;
		$arrInsertCol = array('user_name'=>$uname,'user_id'=>$uid,'user_email'=>$uemail,'user_password'=>$upass,'user_type'=>$utype,'sex'=>$sex);
		return $arrData = $this->insert($varTableName, $arrInsertCol);
	}
	public function addLink($userId,$vLink,$lTitle){
		$varTableName = TABLE_VIDEO_LINKS;
		$lTitle=str_replace("+"," ",$lTitle);
		$arrSelectCol = array('user_id','video_title','video_link','status');
		$where = "user_id='{$userId}' AND video_link='{$vLink}'";
		$arrSelect = $this->select($varTableName,$arrSelectCol,$where);
		if(count($arrSelect)>0){
			$success = "exist";
		} else {
			$arrInsertCol = array('user_id'=>$userId,'video_title'=>$lTitle,'video_link'=>$vLink,'status'=>'false');
			$arrData = $this->insert($varTableName, $arrInsertCol);
			$success = "added";
		}
		return $success;
	}
	public function checkLink($userId,$vLink){
		$varTableName = TABLE_VIDEO_LINKS;
		$arrSelectCol = array('user_id','video_title','video_link','status');
		//user_id='{$userId}' AND
		$where = "video_link='{$vLink}'";
		$arrSelect = $this->select($varTableName,$arrSelectCol,$where);
		if(count($arrSelect)>0){
			$success = "exist";
		} else {
			$success = "not";
		}
		return $success;
	}
	public function getUserData($userId,$vLink){
		$varTableName = TABLE_VIDEO_LINKS;
		$arrSelectCol = array('id','user_id','video_title','video_link','status');
		$where = "user_id='{$userId}' AND video_link='{$vLink}'";
		$arrSelect = $this->select($varTableName,$arrSelectCol,$where);
		return $arrSelect;
	}
	public function updateUserData($userId='',$vLink=''){
		$varTableName = TABLE_VIDEO_LINKS;
		if($userId!='' && $vLink !=''){
			$arrSelectCol = array('status'=>'true');
			$where = "user_id='{$userId}' AND video_link='{$vLink}'";
			$arrSelect = $this->update($varTableName,$arrSelectCol,$where);
		} else if($userId!='' && $vLink=='') {
			$arrSelectCols = array('status'=>'false');
			$wheres = "id='{$userId}'";
			$arrSelect = $this->update($varTableName,$arrSelectCols,$wheres);
		}
		return $arrSelect;
	}
	public function removeLink($userIds,$vLinks){
		$varTableNames = TABLE_VIDEO_LINKS;
		$wheres = "user_id='{$userIds}' AND video_link='{$vLinks}'";
		$remove = $this->delete($varTableNames,$wheres);
		return $remove;
	}
	public function getTotalUsers(){
		$varTableName = TABLE_USER;
		$where = "user_type='user'";
		$arrCol = array('id','user_name','user_id','user_email','user_password','user_type','join_date','sex');
		$arrData = $this->select($varTableName, $arrCol,$where);
		return $arrData ;
	}
	public function key_bucket($user_id,$key){
		$varTableName = TABLE_KEYWORD_BUCKET;
		$arrData = $this->get_key_bucket($user_id,$key);
		$arrInsertCol = array('keyword'=>$key,'user_id'=>$user_id);
		if(count($arrData) > 0)
		{
			$arrData = "Registered";
		} else {
		$arrData = $this->insert($varTableName, $arrInsertCol);
		}
		return $arrData ;
	}
	public function get_key_bucket($user_id='',$key=''){
		$varTableName = TABLE_KEYWORD_BUCKET;
		$keyCon = ($key!='')?" AND keyword='$key'":'';
		$where = " user_id='$user_id'{$keyCon}";
		$arrSelectCol = array('keyword','key_id','user_id');
		$arrData = $this->select($varTableName, $arrSelectCol,$where);
		return $arrData ;
	}
	public function logout()
	{
		session_destroy();
	}
	public function viewCount($vidId)
	{
		$JSON = file_get_contents("https://gdata.youtube.com/feeds/api/videos/{$vidId}?v=2&alt=json");
		$JSON_Data = json_decode($JSON);
		//var_dump($JSON_Data);exit;
		return  $views = $JSON_Data->{'entry'}->{'yt$statistics'}->{'viewCount'};
	}
}
