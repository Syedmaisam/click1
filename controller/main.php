<?php
include_once SOURCE_ROOT_CLASSES. "main_class.php";
class Main_Controller {
	var $objMainClass;

	public function __construct()
	{
		$this->objMainClass = new Main_Class();
	}
	
	public function getLayredRand($RrandUrl)
	{
		return  $this->objMainClass->getLayredRand($RrandUrl);		
	}
	public function getBasicRand($RrandUrl)
	{
		return  $this->objMainClass->getBasicRand($RrandUrl);	

	}
	public function getJustRand($RrandUrl)
	{
		return  $this->objMainClass->getJustRand($RrandUrl);	
	}
	public function getImageRand($RrandUrl)
	{
		return  $this->objMainClass->getImageRand($RrandUrl);	
	}
public function getFormPollRand($randurl)
	{
		return  $this->objMainClass->getFormPollRand($randurl);
	}

}
