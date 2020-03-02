<?php
include_once '../../config/config.php';
Class user_Class extends Database
{
	public function __construct()
	{
		
	}
	
	public function add_user($param)
	{
		$arrCheckData = $this->get_user($param['mailaddress']);
		if(count($arrCheckData) > 0)
		{
			$updatecoll = array(
					'name'=>$param['name'],
					'trialcode'=>"",
					'password'=>$param['pword']
					
			);
			$mailid=$param['mailaddress'];
			
			$where= "mailaddress ='$mailid'";
		$this->update(TABLE_USER,$updatecoll,$where);
			$arrMsg = "notreg";
		} else {
			$startdate=date("Y/m/d");
			$arrInsertCol = array('name'=>$param['name'],'password'=>$param['pword'],'mailaddress'=>$param['mailaddress'],'status'=>1,'userType'=>'user','startdate'=>$startdate);
			$arrMsg = $this->insert(TABLE_USER,$arrInsertCol);

$arrInsertColp = array('userId'=>$param['mailaddress'],'profile_name'=>$param['name']);
			$arrMsg = $this->insert(TABLE_TABLE_PROFILE,$arrInsertColp);

			$arrMsg="reg";
		}
		
		return $arrMsg;
	}
	public function add_user_trial($param)
	{
		$arrCheckData = $this->get_user($param['mailaddress']);
		if(count($arrCheckData) > 0)
		{
			$arrMsg = "notreg";
		} else {
				$startdate=date("Y/m/d");
			$arrInsertCol = array('name'=>$param['name'],'password'=>$param['pword'],'mailaddress'=>$param['mailaddress'],'status'=>1,'userType'=>'user','trialcode'=>$param['reqtoken'],'startdate'=>$startdate);
			$arrMsg = $this->insert(TABLE_USER,$arrInsertCol);
	
			$arrInsertColp = array('userId'=>$param['mailaddress'],'profile_name'=>$param['name']);
			$arrMsg = $this->insert(TABLE_TABLE_PROFILE,$arrInsertColp);
	
			$arrMsg="reg";
		}
	
		return $arrMsg;
	}
	public function get_user($mailaddress)
	{
	
		$arrSelectCol = array('id','name','username','password','status','userType');
		$where = "mailaddress='$mailaddress'";
		return $this->select(TABLE_USER,$arrSelectCol,$where);
	}
	public function user_login($param)
	{
		$usermail=$param['usermail'];
		$password=$param['upassword'];
	
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType', 'trialcode', 'startdate');
		$where = "mailaddress='$usermail' AND password='$password'  AND status='1'";
		$result= $this->select(TABLE_USER,$arrSelectCol,$where);
		// Check if user is trail
		
		if(isset($result[0]['trialcode']) && $result[0]['trialcode'] != "")
		{
			$startdate = $result[0]['startdate'];
			
			$trialdata = $this->getArrayResult("select trialdays, endurl from tbl_page_settings");
			$trialdays = $trialdata[0]['trialdays'];
			
			$currentdate = date('Y-m-d');			
			$passdate =  date('Y-m-d',date(strtotime("+$trialdays day", strtotime($startdate))));
			
			//var_dump($passdate);
			//var_dump($currentdate);
			
			if($passdate<$currentdate)
			{
				$result['url'] = $trialdata[0]['endurl'];
				$result['msg'] = 'trialuser';
				
				return	$result;
			}
			
			
		}
	
		return $result;
		
	}
	public function get_All_User()
	{
		//$sql = "select * from tbl_user";
		//return $this->getArrayResult($sql);
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType');
		return $this->select(TABLE_USER,$arrSelectCol);
	
	}
	public function save_custom_settings($params)
	{
		
		$updatecoll = array(
				'usermailid'=>$_SESSION['logeid'],
				'logoType'=>$params['logoType'],
				'logoTxt'=>$params['logoTxt'],
				'logoTxtColor'=>$params['logoTxtColor'],
				'TopBarBgColor'=>$params['tpbgcolor'],
				'TopBarTxtColor'=>$params['tpbartxtcolor'],
				'TopBarTxtHoverColor'=>$params['tpbarhovertxt'],
				'SideBarBgColor'=>$params['sidebarbgcolor'],
				'SideBarTxtColor'=>$params['sidebartxtcolor'],
				'SideBarTxtHoverColor'=>$params['sidebartxthovercolor'],
				'LoginPageBgColor'=>$params['loginpagbg'],
				'CopyRightTxtColor'=>$params['copytxtcolor'],
				'LandPColor'=>$params['logobgcolor'],
				'AppName'=>$params['appname'],
				'AdminEmail'=>$params['adminmail'],
				'SignupStatus'=>$params['signupstatus'],
				'SignupToken'=>$params['signuptoken'],
				'SupportLink'=>$params['supportlink'],
				'trialstatus'=>$params['trialstatus'],
				'trialdays'=>$params['trialdays'],
				'endurl'=>$params['endurl'],
				'trialcode'=>$params['trialcode']
		);
		$mailid=$_SESSION['logeid'];
		
		$where= "usermailid ='$mailid'";
		$value=$this->update(TABLE_PAGE_SETTINGS,$updatecoll,$where);
		return $value;
	}
	public function get_all_settings()
	{
		//$sql = "select * from tbl_user";
		//return $this->getArrayResult($sql);
		$arrSelectCol = array('usermailid','logoType','logoImage','logoTxt','logoTxtColor','TopBarBgColor','TopBarTxtColor','TopBarTxtHoverColor','SideBarBgColor','SideBarTxtColor','SideBarTxtHoverColor','LoginPageBgColor','CopyRightTxtColor','LandPColor','AppName','AdminEmail','SignupStatus','SignupToken','SupportLink','trialstatus','trialdays','endurl','trialcode');
		return $this->select(TABLE_PAGE_SETTINGS,$arrSelectCol);
	}
	public function get_User_Data($id)
	{
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType');
		$where = "id='$id'";
		return $this->select(TABLE_USER,$arrSelectCol,$where);
	}
	public function upduser($params)
	{
		if($params['passw']!="")
		{
		$updatecoll = array(
				
				'name'=>$params['fullname'],
				'password'=>$params['passw']
				
		);
		}
		else 
		{
			$updatecoll = array(
			
					'name'=>$params['fullname']
					
			
			);
		}
		$uid=$params['uid'];
		$where= "id ='$uid'";
		$value=$this->update(TABLE_USER,$updatecoll,$where);
		$_SESSION['username']=$params['fullname'];
		return $value;
	}
	public function verify_token($params)
	{
		
		$token=$params;
		$arrSelectCol = array('SignupToken','SignupStatus');
		$where = "SignupToken='$token'";
		return $this->select(TABLE_PAGE_SETTINGS,$arrSelectCol,$where);
	}
	public function verify_trial_token($params)
	{
	
		$token=$params;
		$arrSelectCol = array('trialcode','trialstatus');
		$where = "trialcode ='$token'";
		return $this->select(TABLE_PAGE_SETTINGS,$arrSelectCol,$where);
	}
	public function delrec($params)
	{
		$delid=$params['id'];
		$where = "id='$delid'";
		return $this->delete(TABLE_USER,$where);
	}
	public function login_subuser($params)
	{
		$id=$params['id'];
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType');
		$where = "id='$id'";
		return $this->select(TABLE_USER,$arrSelectCol,$where);
	}
	public function backtoadmin()
	{
		
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType');
		$where = "userType='admin'";
		return $this->select(TABLE_USER,$arrSelectCol,$where);
	}
	public function installadmin($param)
	{
		$name=explode('@', $param['adminemail']);
	
		$arrInsertCol = array('password'=>$param['adminpass'],'mailaddress'=>$param['adminemail'],'status'=>1,'userType'=>'admin');
			$arrMsg = $this->insert(TABLE_USER,$arrInsertCol);
			
			$arrInsertColp = array('userId'=>$param['adminemail'],'profile_name'=>$name[0]);
			$arrMsg = $this->insert(TABLE_TABLE_PROFILE,$arrInsertColp);
			
			$updatecoll = array(
					'usermailid'=>$param['adminemail'],
					'AdminEmail'=>$param['adminemail']
					
			);
			$mailid=$_SESSION['logeid'];
			$where= "usermailid ='$mailid'";
		    $arrMsg=$this->update(TABLE_PAGE_SETTINGS,$updatecoll,$where);

	
	}

        public function recoverpassword($params)
	
	{
                $id=$params['usermail'];
		$arrSelectCol = array('id','name','username','mailaddress','password','status','userType');
		$where = "mailaddress ='$id'";

                $arrayresult= $this->select(TABLE_USER,$arrSelectCol,$where);

               
if($arrayresult==NULL || $arrayresult=="")
{
$arrMsg="nosent";

}
else
{

$msg = "Hi,\n\n";
$msg .= "Your Login credentials are given below :\n\n";
$msg .= "Your email id/User id:".$arrayresult[0]['mailaddress']."\n";
$msg .= "Your Password:".$arrayresult[0]['password']."\n\n";
$msg .= "Thanks";

mail($id,"Your login credentials for Web application",$msg); 
$arrMsg="sent";

}
echo $arrMsg;

return $arrMsg;
}


public function checkrandomkey($param)
	{
		
$key=$param['randomkey'];
		$arrSelectCol = array('SignupToken');
		$where = "SignupToken='$key'";

                $arrayresult= $this->select(TABLE_PAGE_SETTINGS,$arrSelectCol,$where);

$arrMsg=$arrayresult[0]['SignupToken'];
echo $arrMsg;
return $arrMsg;
	
	}
public function checkrandomkeytrial($param)
	{
		
$key=$param['randomkey'];
		$arrSelectCol = array('trialcode');
		$where = "trialcode='$key'";

                $arrayresult= $this->select(TABLE_PAGE_SETTINGS,$arrSelectCol,$where);

$arrMsg=$arrayresult[0]['trialcode'];
echo $arrMsg;
return $arrMsg;
	
	}

}

