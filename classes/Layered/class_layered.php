<?php
Class Layered_class extends Database
{

	public function create_layered_popup($param,$userid)
	{
		$created_date = date("Y-m-d H:i:s");
		//$arrData = $this->get_layered_popup('',$userid,'',$param['title']);
		$randurl = $this->randPass(5);
		if(count($arrData) > 0){
			return "Already registered!!";
		} else {
			$arrInsertCol = array('popup_created_date'=>$created_date,'layered_randUrl'=>$randurl,'popup_title'=>$param['title'],'poup_name'=>$param['layered_name'],'userId'=>$userid,'profile_id'=>'','popup_width'=>$param['width'],'popup_hieght'=>$param['hieght'],'popup_postion'=>$param['msgPosition'],'popup_overlay'=>$param['checkOverlay'],'popup_overlay_color'=>$param['textcolor'],'popup_overlay_opacity'=>$param['overlay_op'],'popup_email_provide'=>$param['email_provider'],'popup_html'=>$param['popupform'],'link_url'=>$param['linkurl'],'popup_timing'=>$param['inp_timing'],'autoresponder_html'=>$param['autoresponder_html'],'countdown_timer'=>$param['countdown_timer']);
			$retunId = $this->insert(TABLE_TABLE_LAYERED,$arrInsertCol);
			$sql = "select *,(Select profile_image_path from tbl_profile where userId = '$userid' limit 1) As ProfileImage from tbl_popups where poup_id = '$retunId'";
			$popData = $this->getArrayResult($sql);
//var_dump($popData); exit;
			return $popData;
				
			if($param['email_provider']==1){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'get_response_api_key'=>$param['api_key'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==5){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'mailerlite_api_key'=>$param['api_key'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==3){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'mailchimp_api_key'=>$param['api_key'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==2){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'awaber_auth_token'=>$param['access_token'],'auth_token_secret'=>$param['access_secret'],'awaber_account_id'=>$param['account_id'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==4){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'active_api_url'=>$param['api_key'],'active_api_key'=>$param['account_key'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==6){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'constant_api_key'=>$param['api_key'],'constant_access_token'=>$param['account_key'],'campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==7){
				$arrInsertPostingCol = array('layered_id'=>$retunId,'iContact_appId'=>$param['api_key'],'iContact_passwsord'=>$param['iContact_password'],'iContact_user_name'=>$param['iContact_user_name'],'campign_id'=>$param['camp_id']);
			}
			$this->insert(TABLE_POST_DETAIL,$arrInsertPostingCol);
				
		}
	}

	public function update_layered_popup($param,$userid)
	{
		if($param['layered_name']!='' && $param['popup_id']){
			$date = date("Y-m-d H:i:s");
			$popup_id=$param['popup_id'];
			$where = " poup_id='$popup_id'";
			$wherePosting = " layered_id='$popup_id'";
			$arrUpdateCol = array('modified_date'=>$date,'popup_title'=>$param['title'],'poup_name'=>$param['layered_name'],'profile_id'=>'','popup_width'=>$param['width'],'popup_hieght'=>$param['hieght'],'popup_postion'=>$param['msgPosition'],'popup_overlay'=>$param['checkOverlay'],'popup_overlay_color'=>$param['textcolor'],'popup_overlay_opacity'=>$param['overlay_op'],'popup_email_provide'=>$param['email_provider'],'popup_html'=>$param['popupform'],'link_url'=>$param['link_url'],'popup_timing'=>$param['inp_timing'],'autoresponder_html'=>$param['autoresponder_html'],'countdown_timer'=>$param['countdown_timer']);
			if($param['email_provider']==1){
				$arrInsertPostingCol = array('get_response_api_key'=>$param['api_key'],'campign_id'=>$param['camp_id'],'mailerlite_api_key'=>'');
			} elseif($param['email_provider']==5){
				$arrInsertPostingCol = array('mailerlite_api_key'=>$param['api_key'],'get_response_api_key'=>'','campign_id'=>$param['camp_id']);
			} elseif($param['email_provider']==3){
				$arrInsertPostingCol = array('mailchimp_api_key'=>$param['api_key'],'campign_id'=>$param['camp_id'],'mailerlite_api_key'=>'','get_response_api_key'=>'');
			} elseif($param['email_provider']==2){
				$arrInsertPostingCol = array('awaber_auth_token'=>$param['access_token'],'auth_token_secret'=>$param['access_secret'],'awaber_account_id'=>$param['account_id'],'campign_id'=>$param['camp_id']);
			}elseif($param['email_provider']==4){
				$arrInsertPostingCol = array('active_api_url'=>$param['api_key'],'active_api_key'=>$param['account_key'],'campign_id'=>$param['camp_id']);
			}
elseif($param['email_provider']==6){
				$arrInsertPostingCol = array('constant_api_key'=>$param['api_key'],'constant_access_token'=>$param['account_key'],'campign_id'=>$param['camp_id']);
			}elseif($param['email_provider']==7){
				$arrInsertPostingCol = array('iContact_appId'=>$param['api_key'],'iContact_passwsord'=>$param['iContact_password'],'iContact_user_name'=>$param['iContact_user_name'],'campign_id'=>$param['camp_id']);
			}
if($param['email_provider']!=''){
			$this->update(TABLE_POST_DETAIL,$arrInsertPostingCol,$wherePosting);	
}
			return $this->update(TABLE_TABLE_LAYERED,$arrUpdateCol,$where);
		}
	}

	public function get_layered_popup($p_id='',$user_id,$profile_id='',$layered_name='',$limit)
	{
		$arrSelectCol = array('countdown_timer','autoresponder_html','popup_timing','popup_status','popup_created_date','layered_randUrl','poup_id','popup_title','poup_name','userId','profile_id','popup_width','popup_hieght','popup_postion','popup_overlay','popup_overlay_color','popup_overlay_opacity','popup_email_provide','popup_html','link_url');
		$p_id_where = ($p_id!='')?" AND poup_id='$p_id'":'';
		$profile_id_where = ($profile_id!='')?" AND profile_id='$profile_id'":'';
		$layered_name_where = ($layered_name!='')?" AND popup_title='$layered_name'":'';
		$where = " userId='$user_id'{$p_id_where}{$profile_id_where}{$layered_name_where}";
		return $this->select(TABLE_TABLE_LAYERED,$arrSelectCol,$where,'',$limit);
	}

	public function get_layered_rand($rand)
	{
		$arrSelectCol = array('countdown_timer','autoresponder_html','popup_timing','popup_status','popup_created_date','layered_randUrl','poup_id','popup_title','poup_name','userId','profile_id','popup_width','popup_hieght','popup_postion','popup_overlay','popup_overlay_color','popup_overlay_opacity','popup_email_provide','popup_html','link_url');
		$p_id_where = ($rand!='')?" layered_randUrl='$rand'":'';
		$where = " {$p_id_where}";
		return $this->select(TABLE_TABLE_LAYERED,$arrSelectCol,$where);
	}
	public function get_post_detail($camp_id)
	{
		$arrSelectCol = array('iContact_appId','iContact_user_name','iContact_passwsord','active_api_key','active_api_url','awaber_auth_token','awaber_account_id','auth_token_secret','mailchimp_api_key','mailerlite_api_key','id','layered_id','get_response_api_key','campign_id','submit_count','constant_api_key','constant_access_token');
		$p_id_where = ($camp_id!='')?" layered_id='$camp_id'":'';
		$where = " {$p_id_where}";
		return $this->select(TABLE_POST_DETAIL,$arrSelectCol,$where);
	}
	public function delete_layered($id)
	{
		if($id!='')
		{
			$where = " poup_id='$id'";
			$this->delete(TABLE_TABLE_LAYERED,$where);
		}
	}

	public function change_status($status,$id)
	{
		if($status!='' && $id!=''){
			$where = " poup_id='$id'";
			$arrUpdateCol = array('popup_status'=>$status);
			return $this->update(TABLE_TABLE_LAYERED,$arrUpdateCol,$where);
		}
	}

	public function getSubmitCount($id)
	{
		$arrSelectCount = array('submit_count');
		$where = " layered_id='$id'";
		$arrData = $this->select(TABLE_POST_DETAIL,$arrSelectCount,$where);
		return $arrData;
	}

	public function saveSubmitCount($id)
	{
		$arrSelectCount = array('submit_count');
		$where = " id='$id'";
		$arrData = $this->select(TABLE_POST_DETAIL,$arrSelectCount,$where);
		$count = $arrData[0]['submit_count']+1;
		//$where = " id='$id'";
		$arrUpdateCol = array('submit_count'=>$count);
		return $this->update(TABLE_POST_DETAIL,$arrUpdateCol,$where);
	}

	public function randPass($length, $strength=8) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength >= 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength >= 2) {
			$vowels .= "AEUY";
		}
		if ($strength >= 4) {
			$consonants .= '23456789';
		}
		if ($strength >= 8) {
			$consonants .= 'ABCDEFGH12344533';
		}
		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}
		public function get_custom_popup_name($user_name)
	{
		$sql = "SELECT id, popup_name from tbl_custom_popup where user_id = '$user_name'";
		
		$result = $this->getArrayResult($sql);
		
		return $result;
	}
	public function onloadImpression($randomUrl)
	{
		$sql = "Select count(id) from tbl_viewstats where random_url='$randomUrl' AND views_count='1' ";
		$result = $this->getArrayResult($sql);
		return $result;
	}
        public function getMetaData($random_url)
	{
		$sql = "Select A.title,A.contenturl From
		(
				SELECT `title`,`contenturl` FROM `tbl_basicontent` WHERE `randomlink` = '$random_url'
				UNION ALL
				SELECT `link_name` As title,`link_url` As contenturl FROM `tbl_justlink` WHERE `randUrl` = '$random_url'
				UNION ALL
				SELECT '' AS title,`link_url` As contenturl  FROM `tbl_popups` WHERE layered_randUrl= '$random_url'
				UNION ALL
				SELECT `title`,`contentUrl` FROM `tbl_imagecontent` WHERE randomLink= '$random_url'
		) A Limit 1";
//echo $sql;
		return $this->getArrayResult($sql);
		
	}
}