<?php
include_once '../../config/config.php';
Class campaign_Class extends Database
{
	public function __construct()
	{
		
	}
	
	public function add_campaign($param,$usrId)
	{
		$arrCheckData = $this->get_campaign('',$usrId,$param['campaignName']);
		if(count($arrCheckData) > 0)
		{
			$arrMsg = "Already registered!!";
		} else {
			$randUrl = $this->randPass(5);
			$arrInsertCol = array('randUrl'=>$randUrl,'profile_id'=>$param['campaignProfile'],'campaign_name'=>$param['campaignName'],'campaign_desc'=>$param['campaignMessage'],'user_id'=>$usrId);
			$arrMsg = $this->insert(TABLE_CAMPAIGN,$arrInsertCol);
			
		}
		return $arrMsg;
	}
	public function get_campaign($id,$usrId)
	{
				
		$arrSelectCol = array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl');
		$where = " id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrSelectCol,$where);
	}
	public function getcampaignList($campaignId,$MsgId,$profileId,$usrId)
	{
		$arrSelCampaign=array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl');
		$where="profile_id='$profileId' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrSelCampaign,$where);
	}
	public function getMessageCount($id,$CmpId,$usrId)
	{
		
		$arrSelectCamp="Select count(*) as mcount from tbl_messages where profile_id=$id and campaignId=$CmpId";	
		return $this->getArrayResult($arrSelectCamp);
		
	}
	
	
	public function get_user_all_campaign($id,$usrId,$type)
	{
		/* $arrSelectCol = array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl','messageCount');			
		$nameId = ($name!='')?" AND campaign_name='$name'":'';
		$where = " profile_id='$id' AND user_id='$usrId' AND status='1' {$nameId} "; */
		if($type == "Basic")
		{
			$sql = "SELECT A.id, A.profile_id, A.campaign_name, A.campaign_desc, A.user_id, A.add_date, A.randUrl, A.messageCount,
			IFNULL
			(
			(
			SELECT
			Sum(View)
			FROM tbl_basicontent
			WHERE userId = A.user_id AND `profile` = A.profile_id
			And `campaignId` = A.id
			)
			,0)
			As ViewCount,
			IFNULL
			(
			(
			SELECT
			Sum(uniqueview)
			FROM tbl_basicontent
			WHERE `userId` = A.user_id AND profile = A.profile_id
			And `campaignId` = A.id
			)
			,0)
			As UniqueViewCount,
			(Select profile_name from tbl_profile where id=A.profile_id) as ProfileName
			FROM `tbl_campaign` A
			WHERE A.user_id ='$usrId' AND A.profile_id='$id' AND A.status=1";
		}
		else
		{
			$sql = "SELECT A.id, A.profile_id, A.campaign_name, A.campaign_desc, A.user_id, A.add_date, A.randUrl, A.messageCount,
			IFNULL
			(
			(
			SELECT
			Sum(View)
			FROM tbl_basicontent
			WHERE userId = A.user_id AND `profile` = A.profile_id
			And `campaignId` = A.id
			)
			,0)
			As ViewCount,
			IFNULL
			(
			(
			SELECT
			Sum(uniqueview)
			FROM tbl_basicontent
			WHERE `userId` = A.user_id AND profile = A.profile_id
			And `campaignId` = A.id
			)
			,0)
			As UniqueViewCount,
			(Select profile_name from tbl_profile where id=A.profile_id) as ProfileName
			FROM `tbl_campaign` A
			WHERE A.user_id ='$usrId'";
			//echo $sql;
		}
	
		return $this->getArrayResult($sql); //(TABLE_CAMPAIGN,$arrSelectCol,$where);
		
	}
	public function get_user_ProfileImage($id)
	{
		$sql = "select profile_image_path from tbl_profile where id='$id'";
		return $this->getArrayResult($sql);
	}
	public function get_Profile_name($profileId, $id)
	{
		$sql = "select profile_name from tbl_profile where id='$profileId' and userId='$id'";
		return $this->getArrayResult($sql);
		
	}
	
	
	
	public function MessageUpdate($id,$campaignid,$usrId)
	{
		$arrVal=array('defaultMessage'=>1);
		$Val=array('defaultMessage'=>0);
		$whereCondition="campaignId='$campaignid' AND user_id='$usrId' AND defaultMessage='1'";
		$where= "id='$id'AND campaignId='$campaignid' AND user_id='$usrId' AND defaultMessage='0'";
		$Msg = $this->update(TABLE_MESSAGES,$Val,$whereCondition);
        $value=$this->update(TABLE_MESSAGES,$arrVal,$where);
		//return $this->update(TABLE_MESSAGES, $arrVal, $where); 
	}
	public function get_user_campaigns($id,$usrId)
	{
		
		$arrSelectCol = array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl');
		$where = " profile_id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrSelectCol,$where);
	}
	
	public function get_campaign_data($profileId,$userid)
	{
		$where="user_id= '$userid' and profile_id = '$profileId'";
		$val=array('id','campaignId','message','actionText','actionLink');
		return $this->select(TABLE_MESSAGES, $val, $where);
	
	}
	public function getCampaignName($profileId,$userid)
	{
		$where="user_id = '$userid' and profile_id = '$profileId'";
		$val=array('id','profile_id','campaign_name','campaign_desc');
		return $this->select(TABLE_CAMPAIGN,$val,$where);
	}
	
	
	public function get_user_Message($id,$usrId)
	{
		$arrSelectMessageCol=array('id','campaignId','profile_id','user_id','add_date','message','actionText','actionLink','popData');
		$where = " profile_id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_MESSAGES,$arrSelectMessageCol,$where);
	}
	public function get_User_EditCampaign($id,$usrId)
	{
		$arrSelectCampaignCol=array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl');
		$where = " profile_id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrSelectCampaignCol,$where);
	}
	
	
	public function get_campaign_byRand($rand='',$usrId)
	{
		$arrSelectCol = array('id','profile_id','campaign_name','campaign_desc','user_id','add_date','randUrl');
		$whereRand= ($rand!='')?" AND randUrl='$rand'":'';
		$where = " user_id='$usrId' {$whereRand}";
		return $this->select(TABLE_CAMPAIGN,$arrSelectCol,$where);
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
			$consonants .= '@#$%';
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
	
	public function update_campaign($param,$usrId)
	{
	
	$popdata=mysql_real_escape_string(html_entity_decode($param['pophtml']));
	$usrId=$_SESSION['logeid'];
		//$ids = $param['campaignName'];
		//$popcampaing=mysql_real_escape_string(html_entity_decode($param['pophtml']));
		//$paramId = ($param['id']!='')?" AND id='$ids'":'';
		//$where = " id='$ids'";
		//$arrUpdateCol = array('campaignId'=>$param['id'],'actionText'=>$param['generatorActionText'],'actionLink'=>$param['generatorActionLink'],'popdata'=>$popcampaing);
		//return $this->update(TABLE_CAMPAIGN,$arrUpdateCol,$where);
	
	$arrInsertCol = array('campaignId'=>$param['id'],'profile_id'=>$param['campaignProfile'],'user_id'=>$usrId,'actionText'=>$param['generatorActionText'],'actionLink'=>$param['generatorActionLink'],'popData'=>$popdata,'message'=>$param['generatorMessageText']);
	
	$arrMsg = $this->insert(TABLE_MESSAGES,$arrInsertCol);
	$campaignid=$param['id'];
	$msgcount="select messageCount from tbl_campaign where id=$campaignid";
	$result = $this->getArrayResult($msgcount);
    $count=$result[0]['messageCount'];
	$count=$count+1;
	$arrupdateCol=array('messageCount'=>$count,'status'=>'1');
	$pid=$param['campaignProfile'];
    $where="id= $campaignid And profile_id=$pid";
	
    $MsgCount=$this->update(TABLE_CAMPAIGN,$arrupdateCol,$where);
	}
	
	public function update_Message($id,$usrId)
	{
		$arrInsertMsgCol=array('campaignId'=>$id['id'],'profile_id'=>$id['campaignProfile'],'user_id'=>$usrId,'actionText'=>$id['generatorActionText'],'actionLink'=>$id['generatorActionLink'],'popData'=>$popdata,'message'=>$id['generatorMessageText']);
		return $this->insert(TABLE_MESSAGES, $arrInsertMsgCol);
	}
	
	public function edit_campaign($param,$usrId)
	{
	
		$ids = $param['id'];
	//	$popcampaing=mysql_real_escape_string(html_entity_decode($param['pophtml']));
	//$paramId = ($param['id']!='')?" AND id='$ids'":'';
		$where = " id='$ids'";
		$arrUpdateCol = array('campaign_name'=>$param['campaignName'],'campaign_desc'=>$param['campaignMessage']);
		return $this->update(TABLE_CAMPAIGN,$arrUpdateCol,$where);
	}
	public function edit_Message($param,$usrId)
	{
		
		$msgid=$param['msgid'];
		$ids = $param['id'];
		$profile=$param['campaignProfile'];
		$fetchdata="Select campaignId from tbl_messages where user_id='$usrId' and id='$msgid'";
		$result = $this->getArrayResult($fetchdata);
		if ($result!=$ids)
		{
			$fetchid=$result[0]['campaignId'];
			$wherecondition="campaignId=$fetchid and id=$msgid and profile_id=$profile ";
			$arrinsert=array('message'=>$param['generatorMessageText'],'actionText'=>$param['generatorActionText'],'actionLink'=>$param['generatorActionLink'],'campaignId'=>$ids,'popData'=>$param['pophtml']);
			return  $this->update(TABLE_MESSAGES, $arrinsert,$wherecondition);
		}
		 else 
		{
		$where = "campaignId=$ids AND id=$msgid";
		$arrUpdateCol = array('message'=>$param['generatorMessageText'],'actionText'=>$param['generatorActionText'],'actionLink'=>$param['generatorActionLink'],'campaignId'=>$param['id'],'popData'=>$param['pophtml']);
		return $this->update(TABLE_MESSAGES,$arrUpdateCol,$where);
		} 
	
	}	
	
	public function get_user_messages_campaign($id,$profileId,$usrId)
	{
		/* echo $id,$usrId;
		$arrSelectCol = array('id','campaignId','profile_id','message','popData','actionText','actionLink');
		$where = " 	campaignId='$id' AND user_id='$usrId'";
		return $this->select(TABLE_MESSAGES,$arrSelectCol,$where);
		*/
		
		
		//echo $id,$usrId;
		//AND B.`profile` = A.profile_id AND B.`messageId` = A.id
		
		/* $sql = "SELECT A.* ,(SELECT IFNull(Sum(View),0) FROM `tbl_basicontent` WHERE `messageId` = A.id) As ViewCount, 
             (SELECT IFNull(Sum(`uniqueview`),0) FROM `tbl_basicontent` WHERE `messageId` = A.id) As uniqueviewCount
            FROM `tbl_messages` A WHERE A.`campaignId`='$id' And A.user_id = '$usrId' AND A.profile_id=$profileId"; */
		

		$sql = "SELECT A.* ,(SELECT IFNull(Sum(View),0) FROM `tbl_basicontent` WHERE `messageId` = A.id) As ViewCount,
		(SELECT IFNull(Sum(`uniqueview`),0) FROM `tbl_basicontent` WHERE `messageId` = A.id) As uniqueviewCount
		FROM `tbl_messages` A WHERE A.user_id = '$usrId' AND A.profile_id=$profileId And A.campaignId=$id";
		//echo $sql;
		//echo $sql;		
		/* var_dump($sql);
		exit(); */
		return $this->getArrayResult($sql);
	}
	public function get_user_campaigndata($id,$usrId)
	{
		$arrCampaignCol=array('id','profile_id','campaign_name','campaign_desc');
		$where = " id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrCampaignCol,$where);
	}
	public function getMessageInfo($id,$usrId)
	{
		$arrMessageCol=array('id','profile_id','campaign_name','campaign_desc');
		$where="id='$id' AND user_id='$usrId'";
		$arrMessData=array('id','campaignId','profile_id','user_id','add_date','message','actionText','actionLink','popData');
		$campdata-=$this->delete(TABLE_CAMPAIGN, $where);
		$msgdata=$this->delete(TABLE_MESSAGES, $where);
		
	}
	public function DeleteMessageInfo($Msgid,$campaignId,$profileid,$usrId)
	{
		$arrDeleteMessage=array('id','campaignId','profile_id','user_id','add_date','message','actionText','actionLink','popData');
		$where="campaignId='$campaignId' AND user_id='$usrId' AND id='$Msgid' AND profile_id='$profileid'";
		$sqlup="Update `tbl_campaign` Set `messageCount` = IF(`messageCount`-1 <1,0,`messageCount`-1 ) Where `profile_id` = $profileid AND id = $campaignId";
		mysql_query($sqlup);
		return $this->delete(TABLE_MESSAGES, $where);
	}
	
	public function getEditMessage($id,$msgid,$usrId)
	{
		$arrMessage=array('id','campaignId','profile_id','user_id','add_date','message','actionText','actionLink','popData');
		$where = "campaignId='$id' AND user_id='$usrId' AND id='$msgid'";
		return $this->select(TABLE_MESSAGES,$arrMessage,$where);
		
	}
	public function getEditCampaignDetails($id,$usrId)
	{
		$arrMessageEditCol=array('id','profile_id','campaign_name','campaign_desc');
		$where="id='$id' AND user_id='$usrId'";
		return $this->select(TABLE_CAMPAIGN,$arrMessageEditCol,$where);
		
	}
	
	
	public function get_popup_html_default($campid,$pid,$userid)
	{
		$arrCampaignCol=array('id','popData');
		$where = " campaignId='$campid' AND profile_id='$pid' AND user_id='$userid' AND defaultMessage='1'";
		return $this->select(TABLE_MESSAGES,$arrCampaignCol,$where);

	}
	public function get_popup_html($campid,$pid,$userid)
	{
		$arrCampaignCol=array('id','popData');
		$where = " campaignId='$campid' AND profile_id='$pid' AND user_id='$userid'";
		return $this->select(TABLE_MESSAGES,$arrCampaignCol,$where);
	
	}
	public function get_popup_text($msgid)
	{
		$arrCampaignCol=array('id','popData');
		$where = " id='$msgid'";
		return $this->select(TABLE_MESSAGES,$arrCampaignCol,$where);
	}
	public function get_all_users_message($userid)
	{
		$sql = "SELECT A.id,A.campaignId,A.message,A.profile_id,
		(SELECT profile_name FROM `tbl_profile` Where id = A.profile_id) As profile_name,
		(SELECT campaign_name FROM `tbl_campaign` Where Id = A.campaignId) As campaign_name ,
		(Select IFNull(Sum(View),0) from tbl_basicontent Where messageId = A.id) As ViewCount,
		(Select IFNull(Sum(uniqueview),0) from tbl_basicontent Where messageId = A.id) As uniqueviewCount
		FROM `tbl_messages` A WHERE A.user_id='$userid'";
		//echo $sql;
		return $this->getArrayResult($sql);
	}
	
}