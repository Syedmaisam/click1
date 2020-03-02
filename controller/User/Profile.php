<?php
include_once SOURCE_ROOT_CLASSES. 'User/Profile_Class.php';

class Profile_Controller {
	var $objProfile;
	var $objGenral;

	public function __construct($domianName='') {
		$this -> objProfile = new Profile_Class();
		$this->userData = $_SESSION['user'];
		$this->objGenral =  new General();
	}

	public function create_profile($param,$files='')
	{
		$this->objProfile->create_profile($param,$files,$this->userData['id']);
	}

	public function edit_profile($param,$files='')
	{
		$this->objProfile->edit_profile($param,$files,$this->userData['id']);
	}
	public function save_img_logo($param,$files='')
		{
			
		$this->objProfile->save_img_logo($param,$files);
		
	}

	public function get_profile($profileId='')
	{
		return $this->objProfile->get_profile($this->userData['id'],$profileId);
	}
	
	public function get_profileImage($profilename)
	{
		return $this->objProfile->get_profileImage ($this->userData['id'], $profilename);
	}
	public function get_profilepicpath()
	{
		return $this->objProfile->get_profilepicpath();
	}
	public function deleteProfile($profileId)
	{
		return $this->objProfile->deleteProfile($profileId);
	}
	public function get_profile_stats($profileId)
	{
		return $this->objProfile->get_profile_stats($profileId);
	}
	public function get_profile_links($profileId)
	{
		return $this->objProfile->get_profile_links($profileId);
	}
	public function get_all_profile_links($userId)
	{
		return $this->objProfile->get_all_profile_links($userId);
	}
	public function get_campaign_links($campId)
	{
		return $this->objProfile->get_campaign_links($campId);
	}
	public function get_campaign_msg_links($msgId)
	{
		return $this->objProfile->get_campaign_msg_links($msgId);
	}
	public function save_SciptData($userId,$script)
	{
		return $this->objProfile->save_SciptData($userId,$script);
	}
	public function get_SciptData($userId)
	{
		return $this->objProfile->get_SciptData($userId);
	}
	public function Onload_SciptData($randurl)
	{
		return $this->objProfile->Onload_SciptData($randurl);
	}
	public function SaveAnalyticData($param, $path)
	{
		return $this->objProfile->SaveAnalyticData($param, $path);
	}
	public function GetAnalyticData()
	{
		return $this->objProfile->GetAnalyticData();
	}
	
}