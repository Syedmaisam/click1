<?php
include_once SOURCE_ROOT_CLASSES.'User/adduser.php';

class user_Controller {
	var $objUser;
	var $objGenral;
	
	public function __construct() {
		$this->objUser = new user_Class();
		$this->objGenral =  new General();
	}
	public function add_user($param)
	{
		$arrMsg = $this->objUser->add_user($param);
		
		if($arrMsg=="notreg")
		{
			$msg = $arrMsg;
		} else
		{
			$msg = $arrMsg;
			
		}
		return $msg;
	}
	public function add_user_trial($param)
	{
		$arrMsg = $this->objUser->add_user_trial($param);
	
		if($arrMsg=="notreg")
		{
			$msg = $arrMsg;
		} else
		{
			$msg = $arrMsg;
				
		}
		return $msg;
	}
	public function user_login($param)
	{
		$arrMsg = $this->objUser->user_login($param);
		
				if ($arrMsg['msg']=='trialuser')
				{					
					$_SESSION['trialuser']=$arrMsg['url'];
					$_SESSION['logeid']=$arrMsg[0]['mailaddress'];
					$_SESSION['usertype']=$arrMsg[0]['userType'];
					$_SESSION['user']=array('id'=>$arrMsg[0]['mailaddress']);
					$_SESSION['username']=$arrMsg[0]['name'];
					$msg=$arrMsg['msg'];
					$url=$arrMsg['url'];
					$dta=  array('msg' => $msg, 'url' => $url); 
					echo json_encode($dta);
					exit;
				}
				if($arrMsg>0)
				{
						
					$_SESSION['logeid']=$arrMsg[0]['mailaddress'];
					$_SESSION['usertype']=$arrMsg[0]['userType'];
					$_SESSION['user']=array('id'=>$arrMsg[0]['mailaddress']);
					$_SESSION['username']=$arrMsg[0]['name'];
					$dta=  array('msg' => 'success');
					echo json_encode($dta);
					exit;
				}
				else
				{
					$dta=  array('msg' => 'wrong');
					echo json_encode($dta);
				}
	
	}
	public function get_All_User()
	{
		$arrMsg = $this->objUser->get_All_User();
		return $arrMsg;
	}
	public function save_custom_settings($params)
	{
		$arrMsg = $this->objUser->save_custom_settings($params);
         return $arrMsg;
		}
	public function get_all_settings()
	{
		$arrMsg = $this->objUser->get_all_settings();
		return $arrMsg;
	}
	public function get_User_Data($iduser)
	{
		$arrMsg = $this->objUser->get_User_Data($iduser);
		return $arrMsg;
	}
	public function upduser($params)
	{
		$arrMsg = $this->objUser->upduser($params);
		return $arrMsg;
	}
	public function verify_token($params)
	{
		$arrMsg = $this->objUser->verify_token($params);
		return $arrMsg;
	}
	public function verify_trial_token($params)
	{
		$arrMsg = $this->objUser->verify_trial_token($params);
		return $arrMsg;
	}
	public function delrec($params)
	{
		$arrMsg = $this->objUser->delrec($params);
		return $arrMsg;
	}
	public function login_subuser($params)
	{
		$arrMsg = $this->objUser->login_subuser($params);
		
		$_SESSION['logeid']=$arrMsg[0]['mailaddress'];
		$_SESSION['usertype']=$arrMsg[0]['userType'];
		$_SESSION['user']=array('id'=>$arrMsg[0]['mailaddress']);
		$_SESSION['username']=$arrMsg[0]['name'];
		$_SESSION['user_control']='0';
	}
	public function backtoadmin()
	{
		$arrMsg = $this->objUser->backtoadmin();
	
		$_SESSION['logeid']=$arrMsg[0]['mailaddress'];
		$_SESSION['usertype']=$arrMsg[0]['userType'];
		$_SESSION['user']=array('id'=>$arrMsg[0]['mailaddress']);
		$_SESSION['username']=$arrMsg[0]['name'];
		$_SESSION['user_control']='';
		unset($_SESSION['user_control']);
	}
	public function installadmin($params)
	
	{
		$arrMsg = $this->objUser->installadmin($params);
	
		return $arrMsg;
	}
public function recoverpassword($params)
	
	{
		$arrMsg = $this->objUser->recoverpassword($params);
	
		return $arrMsg;
	}
public function checkrandomkey($params)
	
	{
		$arrMsg = $this->objUser->checkrandomkey($params);
	
		return $arrMsg;
	}
public function checkrandomkeytrial($params)
	
	{
		$arrMsg = $this->objUser->checkrandomkeytrial($params);
	
		return $arrMsg;
	}

	
}
