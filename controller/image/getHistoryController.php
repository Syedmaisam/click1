<?php
include_once SOURCE_ROOT_CLASSES.'image/class_getHistory.php';

class getHistoryController
{
	var $obj;
	public function __construct() {
		
		$this->obj = new HistoryClass();
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
}