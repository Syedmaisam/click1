<?php
include_once SOURCE_ROOT_CLASSES. 'User/User_Class.php';

class User_Controller {
	var $objUserAuth;
	var $objGenral;

	public function __construct($domianName='') {
		$this -> objUserAuth = new User_Class();
		$this->userData = $_SESSION['user'];
		$this->objGenral =  new General();
	}

	public function user_login($param)
	{
		$returndata = $this->objUserAuth->user_login($param);
		if(count($returndata) > 0)
		{
			$this->objGenral->setSession('user',$returndata);
			$this->objGenral->standardRedirect(SITE_ROOT_URL);

		} else
		{
			$this->objGenral->setSession("msg","Encorrect user name and password!");
			$this->objGenral->standardRedirect(SITE_ROOT_URL.'login.php');
		}
	}
	public function check_user_login()
	{
		$arrSesData = $this->objGenral->getSession('user');
		if(count($arrSesData) > 0)
		{
			return count($arrSesData);
		} else
		{
			//$this->objGenral->standardRedirect(SITE_ROOT_URL.'login.php');
			return "logout";
		}
	}
	public function user_logot()
	{
		$arrSesData = $this->objGenral->unsetSession('user');
		$this->objGenral->standardRedirect(SITE_ROOT_URL.'login.php');
	}
	public function user_register($param)
	{
		$arrSesData = $this->objUserAuth->user_register($param);
		$msg = ($arrSesData=="add")?"Register SuccessFully!":"This Email Is Already Exists!";
		$this->objGenral->setSession('msg',$msg);
		$this->objGenral->standardRedirect(SITE_ROOT_URL.'login.php');
	}
}
