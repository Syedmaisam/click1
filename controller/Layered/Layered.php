<?php
include_once SOURCE_ROOT_CLASSES. 'Layered/class_layered.php';
class Layered_Controller {
	var $objLayered;
	var $objGenral;

	public function __construct($domianName='') {
		$this -> objLayered = new Layered_class();
		$this->userData = $_SESSION['user'];
		$this->objGenral =  new General();
	}

	public function add_layered($param)
	{
		return $arrMsg = $this->objLayered->create_layered_popup($param,$this->userData['id']);
		if($arrMsg=="Already exists!!")
		{
			$msg = $arrMsg;
	 	} else 
	 	{
	 		$msg = "Created Successfully!";
	 	}
	 	return $msg;
	}
	
	public function update_layered($param)
	{
		$this->objLayered->update_layered_popup($param);
	}
	
	public function get_layered($p_id='',$profile_id='',$layered_name='',$limit='')
	{
		return  $this->objLayered->get_layered_popup($p_id,$this->userData['id'],$profile_id,$layered_name,$limit);
	}
	public function get_layered_rand($randurl)
	{
		return  $this->objLayered->get_layered_rand($randurl);
	}
	public function get_post_detail($arrId)
	{
		return  $this->objLayered->get_post_detail($arrId);
	}
	public function delete_layered($id)
	{
		$this->objLayered->delete_layered($id);
	}
	public function change_status($status,$id)
	{
		$this->objLayered->change_status($status,$id);
	}
	public function saveSubmitCount($id)
	{
		$this->objLayered->saveSubmitCount($id);
	}
	public function getSubmitCount($id)
	{
		return  $this->objLayered->getSubmitCount($id);
	}
	public function get_custom_popup_name()
	{
		return $this->objLayered->get_custom_popup_name($this->userData['id']);
	}
	public function onloadImpression($random_url)
	{
		return $this->objLayered->onloadImpression($random_url);
	}
        public function getMetaData($random_url)
	{
		return $this->objLayered->getMetaData($random_url);
	}
}
