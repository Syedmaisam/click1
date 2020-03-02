<?php
require_once SOURCE_ROOT.'mailchimpApi/examples/inc/MCAPI.class.php';
require_once SOURCE_ROOT.'mailchimpApi/examples/inc/config.inc.php';
class Mailchimp_class extends Database
{
	public $apikey;
	public $objMailChimp;
	
	public function __construct($apikey)
	{
		$this->apikey = $apikey	;
		$this->objMailChimp = new MCAPI($this->apikey);
	}
	public function getLists()
	{
		$data  = $this->objMailChimp->lists();
		return $data;
	}
	public function listSuscribe($listId,$emailId)
	{
		$data  = $this->objMailChimp->listSubscribe($listId,$emailId);	
	}
}