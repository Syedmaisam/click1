<?php
require_once SOURCE_ROOT."classes/Apis/mailerlite_class.php";
require_once SOURCE_ROOT."classes/Apis/ML_Subscribers.php";
	class Mailerlite_Controller
	{
		public $objMailerClass;
		public $objMailerSubiscriberClass;
		public $api_key;
		public  function __construct( $api_key )
		{	
			$this->api_key = $api_key;
			$this->objMailerClass = new ML_Lists($this->api_key);
			$this->objMailerSubiscriberClass = new ML_Subscribers($this->api_key);
		}

		public  function getAll( $data = null )
		{
			return json_decode($this->objMailerClass->getAll());
		}
		public function addSubscriber($subscriber,$id)
		{
			return $this->objMailerSubiscriberClass->setId($id)->add($subscriber);
		}
	}
