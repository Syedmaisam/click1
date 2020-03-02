<?php
include_once SOURCE_ROOT_CLASSES. "Apis/mailchimp_class.php";
class Mailchimp_Controller {
	var $objmailchimp;
	var $apikey;

	public function __construct($apikey) {
		$this->apikey = $apikey;
		$this->objmailchimp = new Mailchimp_class($this->apikey);
	}

	public function getList()
	{
		return $this->objmailchimp->getLists();
	}
	public function listSuscribe($listId,$emailId)
	{
		return  $data  = $this->objmailchimp->listSuscribe($listId,$emailId);	
	}
}
