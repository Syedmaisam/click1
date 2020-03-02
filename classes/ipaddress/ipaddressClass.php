<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CLASSES.'justLink/Justlink_Class.php';
class ipaddress_class extends Database
{
	public function __construct()
	{
		
	}
	public function getipaddress($ipaddr,$type,$typeid,$insertTable)
	{
		$isfound = false;
		$sql = "SELECT * FROM tbl_typeipadress WHERE typeid = '$typeid' and ipaddress = '$ipaddr' and type = '$type'";
		$result = $this->getArrayResult($sql);
		if(count($result) > 0)
		{
			$isfound = true;
				
		}
		else
		{
			//else if not get an ipaddress, then insert the new ip address in the table
				
			$tablename = "tbl_typeipadress";
			$arrInsertCol = array('typeid'=>$typeid,'ipaddress'=>$ipaddr,'type'=>$type);
			$res = $this->insert($tablename,$arrInsertCol);
				
			$unqView = $this->getuniqueView($typeid,$insertTable);
			$unqView = $unqView + 1;
			$isIncreasedView = $this->increaseUniqueView($typeid,$unqView,$insertTable);
	
				
		}
		$View = $this->getNormalView($typeid,$insertTable);
		$View = $View + 1;
		$isIncreasedView = $this->increaseNormalView($typeid,$View,$insertTable);
		return $isfound;
	}
	public function getuniqueView($typeid,$insertTable)
	{   //var_dump($result);
	$sql = "SELECT uniqueview FROM $insertTable WHERE id = '$typeid'";
	$result = $this->getArrayResult($sql);
	
	$viewcount = $result[0]['uniqueview'];
	
	return $viewcount;
	}
	public function increaseUniqueView($typeid,$unqView,$insertTable)
	{
		//$tablename = "tbl_basicontent";
		$where = " id ='$typeid'";
		$arrInsertCol = array('uniqueview'=>$unqView);
		return  $this->update($insertTable, $arrInsertCol, $where);
	}
	public function getNormalView($typeid,$insertTable)
	{   //var_dump($result);
	$sql = "SELECT view FROM $insertTable WHERE id = '$typeid'";
	$result = $this->getArrayResult($sql);
	
	$viewcount = $result[0]['view'];
	
	return $viewcount;
	}
	public function increaseNormalView($typeid,$View,$insertTable)
	{
		
		$where = " id ='$typeid'";
		$arrInsertCol = array('view'=>$View);
		return  $this->update($insertTable, $arrInsertCol, $where);
	}
	public function dashboardViewStat($ipaddr,$randUrl,$userId)
	{
	
		if($randUrl != '' && $userId != '' && $ipaddr != '')
		{
			$created_date = date("Y-m-d");
			$sql = "select ip from tbl_viewstats where ip = '$ipaddr' and created_date = '$created_date' and visitor_count = 1 and random_url = '$randUrl'";
			
			$result = $this->getArrayResult($sql);

			/* if(count($result) > 0)
			{
				$this->save_view_stat_view($userId, $randUrl, $ipaddr);
			}
			else
			{
				$this->save_view_stat_visitor($userId, $randUrl, $ipaddr);
			} */
			
			if(count($result) > 0)
			{
				$sql = "insert into tbl_viewstats (views_count,visitor_count,user_id,random_url,created_date,ip) values('1','0','$userId','$randUrl','$created_date','$ipaddr')";
				$this->getArrayResult($sql);
			}
			else
			{
				$sql = "insert into tbl_viewstats (views_count,visitor_count,user_id,random_url,created_date,ip) values('1','1','$userId','$randUrl','$created_date','$ipaddr')";
				$this->getArrayResult($sql);
			}
		}
	}
	public function save_view_stat_visitor($userId,$randUrl, $ipaddr)
	{
		$created_date = date("Y-m-d");
		$arrInsertCol = array('views_count'=>'1','visitor_count'=>'1','user_id'=>$userId,'random_url'=>$randUrl,'created_date'=>$created_date, 'ip' =>$ipaddr);
		$arrMsg = $this->insert(TABLE_TABLE_VIEWSTAT,$arrInsertCol);
	}
	public function save_view_stat_view($userId,$randUrl, $ipaddr)
	{
		$created_date = date("Y-m-d");
		$arrInsertCol = array('views_count'=>'1','visitor_count'=>'0','user_id'=>$userId,'random_url'=>$randUrl,'created_date'=>$created_date, 'ip' =>$ipaddr);
		$arrMsg = $this->insert(TABLE_TABLE_VIEWSTAT,$arrInsertCol);
	}
public function SaveFormPollAnswerCountByRandomLink($insertTable, $randUrl,$post)
	{
		$sql = "SELECT * FROM $insertTable WHERE randomlink = '$randUrl'";
		$result = $this->getArrayResult($sql);
		$Id = $result[0]["id"];
		$anscount = $result[0]["AnswerCount"];
		$anscounts = $anscount+1;
		$where = " id = '$Id'";
                $arrInsertVoteCol = array('poll_randurl'=>$post['randomurl'],'poll_answer'=>$post['ans'],'created_date'=>date('Y-m-d H:i:s'));
		$this->insert(TABLE_POLL_ANSWER_VOTE, $arrInsertVoteCol);
		$arrInsertCol = array('AnswerCount'=>$anscounts);
		return  $this->update($insertTable, $arrInsertCol, $where);
	}
}