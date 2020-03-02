<?php
include_once SOURCE_ROOT_CLASSES. 'image/imageClass.php';
class imageController
{
	var $obj;
	public function __construct() {
		
		$this->obj = new imageClass();
		$this->userData = $_SESSION['user'];
	}
	public function saveImageTab($param,$files='')
	{
		$this->obj->saveImageContent($param,$files='',$this->userData['id']);
	}
	public function editImageTab($param,$files='',$Id)
	{
	  $this->obj->editImageContent($param,$files='',$Id);
	}
	public function editImageTabwithoOutImage($param,$Id)
	{
	  $this->obj->editImageContentwithOutImage($param,$Id);
	}	
	public function getImageDetailValue($id)
	{
		return $this->obj->getImageDetailContent($id);
	}
	public function change_status($status,$id)
	{
		$this->obj->change_status($status,$id);
	}
}