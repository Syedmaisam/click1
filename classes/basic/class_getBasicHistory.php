<?php
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
class basHisotoryClass extends Database
{
	public $objJustLink;
	
	public function __construct()
	{
       $this->objJustLink = new Justlink_Controller();
	}

	public function getImagedata($userId,$profileId='',$randId='')
	{
		$arrSelectCol = array('randomLink','userId','id','title','contentUrl','profile','imageLocation','imageUrl','yourUrl','popupHeight','popupWidth','popupTiming','created');
		$andWhere = ($profileId!='')?" AND profile='$profileId'":'';
		$andrandWhere = ($randId!='')?" AND randomLink='$randId'":'';
		$where =" userId='$userId'{$andWhere}{$andrandWhere}";
		return $this->select(TABLE_TABLE_CONTENT,$arrSelectCol,$where);
	}
	
	public function deleteImagedata($id)
	{
		$where = " id='$id'";
		$this->delete(TABLE_TABLE_CONTENT,$where);
	}

	public function getHistoryMethod($userId)
	{
		$sql = "SELECT id,title,created FROM tbl_basicontent WHERE userId = '$userId'";

		$result = $this->getArrayResult($sql);

		if(count($result) > 0)
		{
			$htmlResult="";
				
			for($i=0; $i < count($result); $i++)
			{
				$tit = $result[$i][title];
				$created = $result[$i][created];
				$createddate = $this->objJustLink->getTimes($created);
				$id = $result[$i][id];
				//$created = date('d/m/Y',strtotime($created));
				$count = $i+1;
				$routing = SITE_ROOT_URL.'views/basic/edit.php/'.$id;
				$htmlResult .= "<tr><td>$count</td><td><a data-questions-array='' data-generator-action-link='#' data-generator-action-text='Techp' data-generator-message-text='$tit'";
				$htmlResult .= "data-link-profile='$tit' data-msg-white-label='0' data-msg-action-type='0' data-msg-link-bg='#00aeef' data-msg-link-color='#ffffff' data-msg-style='0'";
				$htmlResult .= "data-msg-text='#36393D' data-msg-opacity='5' data-msg-background='#ff0000' data-msg-position='0' data-generator-design='0' class='history-link' href='#'>$tit</a></td>";
				$htmlResult .= "<td>$createddate</td><td class='table-action'><a data-confirm-message='Do you want to edit this message?' data-confirm-title='Edit message' class='ui-confirm-edit-link' href='$routing'><i class='fa fa-pencil'></i> </a>";
				$htmlResult .= "</td></tr>";
			}

		}
		return $htmlResult;
	}
public function getFormsContentHistory($userId)
	{
			
	
		$sql = "SELECT id,title,created FROM tbl_formsandpoll WHERE userId = '$userId'";
	
		$result = $this->getArrayResult($sql);
	
		if(count($result) > 0)
		{
			$htmlResult="";
	
			for($i=0; $i < count($result); $i++)
			{
			$tit = $result[$i][title];
			$created = $result[$i][created];
			$createddate = $this->objJustLink->getTimes($created);
			$id = $result[$i][id];
			//$created = date('d/m/Y',strtotime($created));
			$count = $i+1;
			$routing = SITE_ROOT_URL.'views/basic/EditFormsAndPoll.php/'.$id;
			$htmlResult .= "<tr><td>$count</td><td><a data-questions-array='' data-generator-action-link='#' data-generator-action-text='Techp' data-generator-message-text='$tit'";
			$htmlResult .= "data-link-profile='$tit' data-msg-white-label='0' data-msg-action-type='0' data-msg-link-bg='#00aeef' data-msg-link-color='#ffffff' data-msg-style='0'";
			$htmlResult .= "data-msg-text='#36393D' data-msg-opacity='5' data-msg-background='#ff0000' data-msg-position='0' data-generator-design='0' class='history-link' href='#'>$tit</a></td>";
			$htmlResult .= "<td>$createddate</td><td class='table-action'><a data-confirm-message='Do you want to edit this message?' data-confirm-title='Edit message' class='ui-confirm-edit-link' href='$routing'><i class='fa fa-pencil'></i> </a>";
			$htmlResult .= "</td></tr>";
			}
	
			}
		return $htmlResult;
	
		}

	
}