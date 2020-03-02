<?php
include_once SOURCE_ROOT_CLASSES. '/basic/basicClass.php';

class basicController
{
	var $obj;
	
	public function __construct() {
		
		$this->obj = new basicClass();
		$this->userData = $_SESSION['user'];
	}

	public function saveBasicTab($param, $files='',$htmls)
	{
		return $this->obj->saveBasicContent($param,$files='',$this->userData['id'],$htmls);
	}
public function savePollTab($param, $files='',$htmls,$popanswer)
	{
		return $this->obj->savePollContent($param,$files='',$this->userData['id'],$htmls,$popanswer);
	}
public function saveFormsTab($param, $files='',$htmls,$customhtml)
	{
		
		return $this->obj->saveFormsContent($param,$files='',$this->userData['id'],$htmls,$customhtml);
	}
	
	public function getBasicDetailValue($id)
	{
		return $this->obj->getImageDetailContent($id);
	}
public function getFormsDetailValue($id)
	{
		return $this->obj->getImageFormsDetailContent($id);
	}
	public function editBasicContentClass($param,$Id,$htmls)
	{
		$this->obj->editBasicContent($param, $Id,$htmls);
	}
public function editFormsPollContent($param,$Id,$htmls,$popanswer,$htmlcodd)
	{
		$this->obj->editFormsPollContent($param, $Id,$htmls,$popanswer,$htmlcodd);
	}
	public function getBasicDetailValue_byProfileId($id)
	{
		return $this->obj->getBasicDetailByProfileId($id);
	}
public function getFormDetails($id)
	{
		return $this->obj->getFormsDetailByProfileId($id);
	}
	public function deleteBasicdata($id)
	{
		return $this->obj->deleteBasicDetails($id);
	}
public function deleteFormPollsdata($id)
	{
	
		return $this->obj->deleteFormPollsDetails($id);
	}
	public function getBasicDetailByRandomLink($randomlink)
	{
		return $this->obj->getBasicDetailByRandomLnk($randomlink);
	}
public function getFormPollDetailsValue($randomlink)
	{
		return $this->obj->getFormPollDetailsValue($randomlink);
	}
public function getFormPollDetails($randomlink)
	{
		return $this->obj->getFormPollDetailByRandomLnk($randomlink);
	}
public function getFormPollDetailsByRandomLink($id)
	{
		return $this->obj->getFormsPollContent($id);
	}
	public function change_status($status,$id)
	{
		$this->obj->change_status($status,$id);
	}
	public function getRandAnswerData($answer,$randUrl)
	{
		return  $this->obj->getRandAnswerData($answer,$randUrl);
	}
}