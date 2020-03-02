<?php
require_once SOURCE_ROOT."classes/Apis/constant_class.php";
	class constant_Controller
	{
		public $objConstantClass;
		public $api_key;
		public $access_token;
		public  function __construct( $api_key, $accesstoken )
		{	
			
			$this->api_key = $api_key;
			$this->access_token = $accesstoken;
			$this->objConstantClass = new constant_Lists($this->api_key,$this->access_token);
		}

		public  function getAllConstant( $data = null )
		{
			return $this->objConstantClass->getList($this->access_token);
		}
	
		public  function addConstantSubscriber($subscriber,$camp_id)
		{
		
			return $this->objConstantClass->addConstantSubscriber($this->api_key,$this->access_token,$subscriber,$camp_id);
		}
		
	}
