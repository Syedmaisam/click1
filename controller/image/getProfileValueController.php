<?php
include_once SOURCE_ROOT_CLASSES. 'image/getProfileClass.php';
class getProfileValueController
{
	var $obj;
	public function __construct() 
	{		
		$this->obj = new getProfileClass();
		$this->userData = $_SESSION['user'];
	}
	public function getProfileValue()
	{
		return $this->obj->getProfileVal($this->userData['id']);
	}
	public function getProfileValueById($id)
	{
		return $this->obj->getProfileValueById($this->userData['id'],$id);
	}
	public function onLoadDashBoardData()
	{
		return $this->obj->onLoadDashBoardData($this->userData['id']);
	}
public function getProfileImage()
	{
		return $this->obj->getProfileImageDB($this->userData['id']);
	}
}