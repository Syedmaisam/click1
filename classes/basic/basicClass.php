<?php
include_once SOURCE_ROOT_CLASSES.'justLink/Justlink_Class.php';
class basicClass extends Database
{
	public function __construct()
	{
		$this->justlinkObj = new Justlink_Class();
	}
	public function saveBasicContent($param,$files='',$userId,$htmls)
	{
		$randomLink = $this->justlinkObj->randPass(5);
		$currentDate = date("Y-m-d H:i:s");
		$tablename = "tbl_basicontent";
		//$htmls = $param['pophtml'];
		$arrInsertCol = array('title'=>$param['inp_title'],'contenturl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'message'=>$param["messsage"],'yourUrl'=>$param['inp_YourUrl'],'calltoaction'=>$param['ctoa'],'popuphtml'=>$htmls,'userId'=>$userId,'created'=>$currentDate,'randomlink'=>$randomLink,'campaignId'=>$param['campId_hidden'],'messageId'=>$param['messageId_hidden']);
		$insertId = $this->insert($tablename,$arrInsertCol);
		$sql = "select *,(Select profile_name from tbl_profile where id = profile) As ProfileName,(Select profile_image_path from tbl_profile where id = profile) As ProfileImage from tbl_basicontent where id = '$insertId'";
		$resultData = $this->getArrayResult($sql);
		return $resultData;	
			
		
	}
public function savePollContent($param,$files='',$userId,$htmls,$popanswer)
	{
	
		$randomLink = $this->justlinkObj->randPass(5);
		$currentDate = date("Y-m-d H:i:s");
		$tablename = "tbl_formsandpoll";
		//$htmls = $param['pophtml'];
		$arrInsertCol = $arrInsertCol = array('title'=>$param['inp_title'],'contenturl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'message'=>$param["messsage"],'yourUrl'=>$param['inp_YourUrl'],'calltoaction'=>$param['ctoa'],'popuphtml'=>$htmls,'userId'=>$userId,'created'=>$currentDate,'randomlink'=>$randomLink,'campaignId'=>$param['campId_hidden'],'messageId'=>$param['messageId_hidden'],'Type'=>'Polls','AnswerCount'=>'0','PollAnswer'=>$popanswer);
		$insertId =  $this->insert($tablename,$arrInsertCol);
		$sql = "select *,(Select profile_name from tbl_profile where id = profile) As ProfileName,(Select profile_image_path from tbl_profile where id = profile) As ProfileImage from tbl_formsandpoll where id = '$insertId'";
		$resultData = $this->getArrayResult($sql);
		return $resultData;
	
	}
public function saveFormsContent($param,$files='',$userId,$htmls,$customhtml)
	{
		
		$randomLink = $this->justlinkObj->randPass(5);
		$currentDate = date("Y-m-d H:i:s");
		$tablename = "tbl_formsandpoll";
		$arrInsertCol = array('title'=>$param['inp_title'],'contenturl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'message'=>$param["messsage"],'yourUrl'=>$param['inp_YourUrl'],'calltoaction'=>$param['ctoa'],'popuphtml'=>$htmls,'userId'=>$userId,'created'=>$currentDate,'randomlink'=>$randomLink,'campaignId'=>$param['campId_hidden'],'messageId'=>$param['messageId_hidden'],'Type'=>'Forms','AnswerCount'=>'0','Custom_Html'=>$customhtml);
		$insertId =  $this->insert($tablename,$arrInsertCol);
		$sql = "select *,(Select profile_name from tbl_profile where id = profile) As ProfileName,(Select profile_image_path from tbl_profile where id = profile) As ProfileImage from tbl_formsandpoll where id = '$insertId'";
		$resultData = $this->getArrayResult($sql);
		return $resultData;
			
	
	}
	
	public function getImageDetailContent($Id)
	{
		$sql = "SELECT * FROM tbl_basicontent WHERE id = '$Id'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
public function getImageFormsDetailContent($Id)
	{
		$sql = "SELECT * FROM tbl_formsandpoll WHERE id = '$Id'";
		$result = $this->getArrayResult($sql);
		return $result;
	
	}
    public function editBasicContent($param,$userId,$htmls)
	{
		//$randomLink = $this->justlinkObj->randPass(5);
		$tablename = "tbl_basicontent";
		$where = " id ='$userId'";
		$arrInsertCol = array('title'=>$param['inp_title'],'contenturl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'message'=>$param["messsage"],'yourUrl'=>$param['inp_YourUrl'],'calltoaction'=>$param['ctoa'],'popuphtml'=>$htmls,'campaignId'=>$param['campId_hidden'],'messageId'=>$param['messageId_hidden']);
		return  $this->update($tablename, $arrInsertCol, $where);
	}
public function editFormsPollContent($param,$userId,$htmls,$popanswer,$htmlcodd)
	{
		$tablename = "tbl_formsandpoll";
		$where = " id ='$userId'";
		$arrInsertCol = array('title'=>$param['inp_title'],'contenturl'=>$param['inp_contentUrl'],'profile'=>$param["inp_Profile"],'message'=>$param["messsage"],'yourUrl'=>$param['inp_YourUrl'],'calltoaction'=>$param['ctoa'],'popuphtml'=>$htmls,'campaignId'=>$param['campId_hidden'],'messageId'=>$param['messageId_hidden'],'PollAnswer'=>$popanswer,'Custom_Html'=>$htmlcodd);
		return  $this->update($tablename, $arrInsertCol, $where);
	
	}
	public function getBasicDetailByProfileId($profileId)
	{
		$sql = "SELECT * FROM tbl_basicontent WHERE profile = '$profileId'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
public function getFormsDetailByProfileId($profileId)
	{
		$sql = "SELECT * FROM tbl_formsandpoll WHERE profile = '$profileId'";
		$result = $this->getArrayResult($sql);
		return $result;
	
	}
	public function deleteBasicDetails($id)
	{
		$tablename = "tbl_basicontent";
		
		$where = " id='$id'";
		$this->delete($tablename,$where);
	}
public function deleteFormPollsDetails($id)
	{
	
		$tablename = "tbl_formsandpoll";
		$where = " id='$id'";
		$this->delete($tablename,$where);
	
	}
	public function getBasicDetailByRandomLnk($randomlink)
	{
		$sql = "SELECT * FROM tbl_basicontent WHERE randomlink = '$randomlink'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
public function getFormPollDetailsValue($randomlink)
	{
		$sql = "SELECT * FROM tbl_basicontent WHERE randomlink = '$randomlink'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
public function getFormPollDetails($randomlink)
	{
		$sql = "SELECT * FROM tbl_formsandpoll WHERE randomlink = '$randomlink'";
		$result = $this->getArrayResult($sql);
		return $result;
	
	}
public function getFormPollDetailByRandomLnk($randomlink)
	{
	
		$sql = "SELECT * FROM tbl_formsandpoll WHERE randomlink = '$randomlink'";
		$result = $this->getArrayResult($sql);
		return $result;
	
	}
	public function getFormsPollContent($randomlink)
	{
		$sql = "SELECT * FROM tbl_formsandpoll WHERE randomlink = '$randomlink'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
	public function change_status($status,$id)
	{
		if($status!='' && $id!=''){
			$where = " id='$id'";
			$arrUpdateCol = array('status'=>$status);
			return $this->update(TABLE_BASIC_CONTENT,$arrUpdateCol,$where);
		}
	}
	public function getRandAnswerData($ans,$randUrl)
	{
		$arrGetCol = array('count(id)');
		$where = " poll_answer='$ans' AND poll_randurl='$randUrl'";
		return $this->select(TABLE_POLL_ANSWER_VOTE,$arrGetCol,$where);
	}
}