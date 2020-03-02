<?php
Class Domain_Class extends Database
{
	public $domianName;
	public $cUserName;
	public $cPassword;
	public $cIp;
	public $userId;
	public $port;

	public function __construct($domianName='',$cUserName='',$cPassword='',$cIp='',$port='')
	{
		$this->domianName = $domianName;
		$this->cUserName = $cUserName;
		$this->cPassword = $cPassword;
		$this->cIp = $cIp;
		$this->port = $port;
		$this->userId =$_SESSION['user']['id'];
	}
	public function addOnDomain($createDomain,$user_id)
	{
		$domian = $this->domianName;
		$ip= $this->cIp;
		$port = $this->port;
		$cPaneluserName =$this->cUserName;
		$cPanelPassword =$this->cPassword;
		$subDomain = $createDomain['domain_name'];
		$arrDom = explode('.',$createDomain['domain_name']);
		$root_path = "public_html";
		require_once(SOURCE_ROOT.'xmlApi.php');
		$cpanelusr = $cPaneluserName;
		$cpanelpass = $cPanelPassword;
		$xmlapi = new xmlapi($domian,$cPaneluserName,$cPanelPassword);
		$xmlapi->set_port( $port );
		$xmlapi->password_auth($cpanelusr,$cpanelpass);
		$xmlapi->set_debug(0); //output actions in the error log 1 for true and 0 false
		$data = $xmlapi->api2_query($cPaneluserName, "AddonDomain", "addaddondomain", array('newdomain'=>$createDomain['domain_name'], 'dir'=>"public_html/".$arrDom[0], 'subdomain'=>$arrDom[0], 'pass'=>"maneesh007") );
		
		$this->extractDomain($arrDom[0]);
		if($data->error!='')
		{
			$dataRe = "already";
		} else
		{
			$this->addDomainDatabase($createDomain,$user_id);
			$dataRe = "added";
		}
		return $dataRe;
	}
	public function addDomainDatabase($domian_data,$user_id)
	{
		$arrSelect = array('id','user_id','domain_name','domain_status','created_date');
		$where = " user_id='$user_id'";
		$arrDomainData = $this->select('tbl_domain',$arrSelect,$where);
		if(count($arrDomainData) > 0)
		{
				$arrUpdateCol = array('domain_name'=>$domian_data['domain_name']);
				$whereUp = " user_id='$user_id'";
				$arrUpdate = $this->update(TABLE_DOMAIN,$arrUpdateCol,$whereUp);
		} else
		{
			$arrInsertCol = array('user_id'=>$user_id,'domain_name'=>$domian_data['domain_name'],'created_date'=>date("Y-m-d H:i:s"));
			$arInsertCol = $this->insert(TABLE_DOMAIN,$arrInsertCol);
			
		}
	}

	public function extractDomain($web_dir_name)
	{
		$zip = new ZipArchive;
		if ($zip->open('wzip.zip') === TRUE) {
			$zip->extractTo('../../'.$web_dir_name);
			$zip->close();

		} else {
			 
		}
	}
	
		public function get_domain($user_id)
	{
		$arrSelect = array('id','user_id','domain_name','domain_status','created_date');
		$where = " user_id='$user_id'";
		$arrDomainData = $this->select('tbl_domain',$arrSelect,$where);
		return $arrDomainData;
	}
	
	public function update_status($param)
	{
		$arrUpdateCol = array('domain_status'=>$param['status']);
		$id = $param['id'];
		$where = " id='$id'";
		$arrDomainData = $this->update(TABLE_DOMAIN,$arrUpdateCol,$where);
		return $arrDomainData;
	}
        public function uploadFiles($param,$userId)
	{
		if($userId!=''){
		$arrInsertCol = array('domain_name'=>$param['domain_name'],'file_name'=>$param['file_name'],'user_id'=>$userId);
		$arrDomainData = $this->insert(TABLE_DOMAIN_FILES,$arrInsertCol);
$_SESSION['file_msg'] = "upload";
		}
		return $arrDomainData;
	}

     	public function getUploadedFiles($files_name='',$userId)
	{
		$arrSelect = array('id','domain_name','file_name','user_id','uploaded_date');
		if($files_name!=''){
		$AndWhere = " AND file_name='$files_name'";
		}
		$where = " user_id='$userId' $AndWhere";
		$arrDomainData = $this->select(TABLE_DOMAIN_FILES,$arrSelect,$where);
		return $arrDomainData;
	}

}