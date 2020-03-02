<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT_CLASSES.'basic/class_getBasicHistory.php';

class getBasicHistoryController
{
	var $obj;
	public function __construct() {

		$this->obj  = new basHisotoryClass();
		$this->userData = $_SESSION['user'];
	}
	public function getHistory()
	{
		return $this->obj->getHistoryMethod($this->userData['id']);
	}
	public function getImagedata($profileId='',$rand='')
	{
		return $this->obj->getImagedata($this->userData['id'],$profileId,$rand);
	}
	public function deleteImagedata($id)
	{
		return $this->obj->deleteImagedata($id);
	}
public function getFormsContentHistory()
	{
	
		return $this->obj->getFormsContentHistory($this->userData['id']);
			
	}
}