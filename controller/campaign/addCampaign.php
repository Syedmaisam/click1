<?php
include_once SOURCE_ROOT_CLASSES.'campaign/campaign_class.php';

class campaign_Controller {
	var $objCampaign;
	var $objGenral;
	
	public function __construct() {
		$this->objCampaign = new campaign_Class();
		$this->userData = $_SESSION['user'];
		$this->objGenral =  new General();
	}
	public function add_campaign($param)
	{
		$arrMsg = $this->objCampaign->add_campaign($param,$this->userData['id']);
		
		if($arrMsg=="Campaign Already Exist!!")
		{
			$msg = $arrMsg;
		} else
		{
			$msg = $arrMsg;
			
		}
		return $msg;
	}
	public function get_campaign($id)
		{
		
		return $this->objCampaign->get_campaign($id,$this->userData['id']);
	}
	public function getcampaignList($campaignId,$MsgId,$profileId)
	{
		return $this->objCampaign->getcampaignList($campaignId,$MsgId,$profileId,$this->userData['id']);
	}
	public function get_campaign_byRand($randUrl)
	{
		return $this->objCampaign->get_campaign_byRand($randUrl,$this->userData['id']);
	}
	public function get_user_campaigns($id)
	{
	
		return $this->objCampaign->get_user_campaigns($id,$this->userData['id']);
	}
	public function get_campaign_data($profileId)
	{
		return $this->objCampaign->get_campaign_data($profileId,$this->userData['id']);
	}
	
	public function getCampaignName($profileId)
	{
		return $this->objCampaign->getCampaignName($profileId,$this->userData['id']);
	}
	
	
	public function get_user_Message($id)
	{
		return $this->objCampaign->get_user_Message($id,$this->userData['id']);
	}
	public function get_User_EditCampaign($id)
	{
		return $this->objCampaign->get_User_EditCampaign($id,$this->userData['id']);
	}
	
	public function update_campaign($param)
	{
	
			return $this->objCampaign->update_campaign($param,$this->userData['id']);
	}
	public function update_Message($id)
	{
		return $this->objCampaign->update_Message($id,$this->userData['id']);
	}
	
	public function get_user_all_campaign($id,$type)	
	{		
		return $this->objCampaign->get_user_all_campaign($id,$this->userData['id'],$type);
	}
	public function getMessageCount($ProfileId,$CmpId)
	{
		return $this->objCampaign->getMessageCount($ProfileId,$CmpId,$this->userData['id']);
	} 
	public function get_Profile_name($profileId)
	{
		return $this->objCampaign->get_Profile_name($profileId, $this->userData['id']);
		
	}
	public function get_user_ProfileImage($id)
	{
		return $this->objCampaign->get_user_ProfileImage($id);
	}
	public function MessageUpdate($id,$campaignid)
	{
		return $this->objCampaign->MessageUpdate($id,$campaignid,$this->userData['id']);
	}	
	public function edit_campaign($param)
	{	
		return $this->objCampaign->edit_campaign($param,$this->userData['id']);
	}
	
	public function edit_Message($param)
	{
		return $this->objCampaign->edit_Message($param,$this->userData['id']);
	}
	public function get_user_messages_campaign($id,$profileId)	
	{	
		return $this->objCampaign->get_user_messages_campaign($id,$profileId,$this->userData['id']);
	}
	public function get_user_campaigndata($id)
	{
		return $this->objCampaign->get_user_campaigndata($id,$this->userData['id']);
	}
	
	public function getMessageInfo($id)
	{
		return $this->objCampaign->getMessageInfo($id,$this->userData['id']);
	}
	
	public function DeleteMessageInfo($Msgid,$campaignId,$profileid)
	{
		return $this->objCampaign->DeleteMessageInfo($Msgid,$campaignId,$profileid,$this->userData['id']);
	}
	
	public function getEditMessage($id,$msgid)
	{
		return $this->objCampaign->getEditMessage($id,$msgid,$this->userData['id']);
	}
	public function getEditCampaignDetails($id)
	{
		return $this->objCampaign->getEditCampaignDetails($id,$this->userData['id']);
	}
	public function get_popup_html($campid, $pid)
	{
		return $this->objCampaign->get_popup_html($campid,$pid,$this->userData['id']);
	}
	public function get_popup_html_default($campid, $pid)
	{
		return $this->objCampaign->get_popup_html_default($campid,$pid,$this->userData['id']);
	}
	public function get_popup_text($msgid)
	{
		return $this->objCampaign->get_popup_text($msgid);
	}
	public function get_all_users_message($userid)
	{
		return $this->objCampaign->get_all_users_message($userid);
	}
}
