<?php
include_once SOURCE_ROOT . 'classes/Domain_masking/domain_masking_classes.php';
class Domain_Controller {
	public $objDomain;
	public $userData;
	public function __construct()
	{
		$this->objDomain = new Domain_Class(MASKING_DOMAIN,MASKING_USER_NAME,MASKING_USER_PASSWORD,MASKING_IP,MASKING_PORT);
		$this->userData = $_SESSION['user'];
	}
	public function addOnDomain($domianName)
	{
		//echo MASKING_DOMAIN.",".MASKING_USER_NAME.",".MASKING_USER_NAME.",".MASKING_IP.",".MASKING_PORT;
		$retunData = $this->objDomain->addOnDomain($domianName,$this->userData['id']);
		return $retunData;
		
	}
	public function extractDomain($web_dir_name)
	{
		$this->objDomain->extractDomain($web_dir_name);
	}
	public function get_domain()
	{
		return  $this->objDomain->get_domain($this->userData['id']);
	}
	public function update_status($param)
	{
		return  $this->objDomain->update_status($param);
	}
	public function uploadFiles($param)
	{
		return  $this->objDomain->uploadFiles($param,$this->userData['id']);
	}
       	public function getUploadedFiles($files_name='')
	{
		return $this->objDomain->getUploadedFiles($files,$this->userData['id']);
	}
}
?>