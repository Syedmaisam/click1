<?php
class HisotoryClass extends Database
{
	public function __construct()
	{
		
	}
	public function getHistoryMethod($userId)
	{
		$sql = "SELECT title,created FROM tbl_imagecontent WHERE userId = '$userId'";
		
		$result = $this->getArrayResult($sql);
		
		 if(count($result) > 0)
		 {
			$htmlResult="";
			
			for($i=0; $i < count($result); $i++)
			{
				$tit = $result[$i][title];
				$created = $result[$i][created];
				$created = date('d/m/Y',strtotime($created));
				$count = $i+1;
				$htmlResult .= "<tr><td>$count</td><td><a data-questions-array='' data-generator-action-link='#' data-generator-action-text='Techp' data-generator-message-text='$tit'";
				$htmlResult .= "data-link-profile='$tit' data-msg-white-label='0' data-msg-action-type='0' data-msg-link-bg='#00aeef' data-msg-link-color='#ffffff' data-msg-style='0'";
				$htmlResult .= "data-msg-text='#36393D' data-msg-opacity='5' data-msg-background='#ff0000' data-msg-position='0' data-generator-design='0' class='history-link' href='#'>$tit</a></td>";
				$htmlResult .= "<td>$created</td><td class='table-action'><a data-confirm-message='Do you want to edit this message?' data-confirm-title='Edit message' class='ui-confirm-edit-link' href='edit_image.php/$tit'><i class='fa fa-pencil'></i> </a>";
				$htmlResult .= "</td></tr>";
			}
				
	     } 
		return $htmlResult;
	}
	
}