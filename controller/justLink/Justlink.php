<?php
include_once SOURCE_ROOT_CLASSES. 'justLink/Justlink_Class.php';
class Justlink_Controller {
	var $objJustlink;
	var $objGenral;

	public function __construct($domianName='') {
		$this -> objJustlink = new Justlink_Class();
		$this->userData = $_SESSION['user'];
		$this->objGenral =  new General();
	}

	public function add_link($param)
	{
		$arrMsg = $this->objJustlink->add_link($param,$this->userData['id']);
		return $arrMsg;
		if($arrMsg=="Already exists!!")
		{
			$msg = $arrMsg;
	 	} else 
	 	{
	 		$msg = "Created successfully!";
	 	}
	 	return $msg;
	}
	public function get_jusLink($id='')
	{
		return $this->objJustlink->get_jusLink($id,$this->userData['id']);
	}
	public function get_jusLink_byRand($randUrl)
	{
		return $this->objJustlink->get_jusLink_byRand($randUrl,$this->userData['id']);
	}
	public function getfavicon($url)
	{
		return $this->objJustlink->getfavicon($url);
	}
	public function getTimes($date)
	{
		return $this->objJustlink->getTimes($date);
	}
public function getAnswerCount($id,$profile)
	{
		return $this->objJustlink->getAnswerCount($id,$profile);
	
	}
	public function delete_link($id)
	{
		return $this->objJustlink->delete_link($id);
	}

	public function update_link($param)
	{
		return $this->objJustlink->update_link($param,$this->userData['id']);
	}
	public function change_status($status,$id)
	{
		$this->objJustlink->change_status($status,$id);
	}
	public function save_view_stat($username,$cookie_value,$type)
	{
		if($type == "VisitorCount")
		{
			$this->objJustlink->save_view_stat_visitor($username,$cookie_value);
		}
		else
		{
			$this->objJustlink->save_view_stat_view($username,$cookie_value);
		}		
	}
	public function onLoad_GetStat($userid)
	{
		return $this->objJustlink->onLoad_GetViewStat($userid);
	}
	public function onLoad_GetDashBoardData($userid)
	{
		return $this->objJustlink->onLoad_GetDashBoardData($userid);
	}
	public function delete_link_Dashboard($id,$tableName)
	{		
		return $this->objJustlink->delete_link_Dashboard($id,$tableName);
	}
	public function change_status_Dashboard($status,$id,$table)
	{
		return $this->objJustlink->change_status_Dashboard($status,$id,$table);
	}
}