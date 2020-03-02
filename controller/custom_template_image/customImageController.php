<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CLASSES. 'custom_template_image/customImageClass.php';


class customImageController
{
	var $obj;
	public function __construct() {

		$this->obj = new customImageClass();
		$this->userData = $_SESSION['user'];
	}
	public function saveCustomImageTab($param,$files='')
	{

		return $this->obj->saveImageContent($param,$files='',$this->userData['id']);
	}
	public function getImageTab()
	{
		return $this->obj->getImageTab($this->userData['id']);
	}
	public function saveCustomPopupHtml($user_id,$pophtml,$popup_name)
	{
		return $this->obj->saveCustomPopupHtml($user_id,$pophtml,$popup_name);
	}
	public function updateCustomPopupHtml($user_id,$pophtml,$popup_name)
	{
		return $this->obj->updateCustomPopupHtml($user_id,$pophtml,$popup_name);
	}
	public function get_custom_popup_html($id)
	{
		return $this->obj->get_custom_popup_html($id,$this->userData['id']);
	}
	public function get_custom_popup_html_for_edit($id)
	{
		return $this->obj->get_custom_popup_html_for_edit($id,$this->userData['id']);
	}

	public function delete_and_getimage_again($img_id)
	{
		return $this->obj->delete_and_getimage_again($img_id,$this->userData['id']);
	}
}