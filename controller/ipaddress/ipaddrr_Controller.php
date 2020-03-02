<?php
include_once SOURCE_ROOT_CLASSES. '/ipaddress/ipaddressClass.php';
class ipaddr_Controller
{
	public function __construct()
	{
		$this->obj = new ipaddress_class();
	}
	public function getipaddr($ipaddr,$type,$typeid,$insertTable)
	{
		return $this->obj->getipaddress($ipaddr,$type,$typeid,$insertTable);
	}
	public function dashboardViewStat($ipaddr,$randUrl,$userId)
	{	
		return $this->obj->dashboardViewStat($ipaddr,$randUrl,$userId);
	}
public function SaveFormPollAnswerCountByRandomLink($insertTable, $randUrl,$post)
	{
		return $this->obj->SaveFormPollAnswerCountByRandomLink($insertTable, $randUrl,$post);
	}
}