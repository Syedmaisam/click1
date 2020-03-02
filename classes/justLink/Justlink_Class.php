<?php
Class Justlink_Class extends Database
{
	public function __construct()
	{
		
	}
	public function add_link($param,$usrId)
	{
		$randUrl = $this->randPass(5);
		$currentDate = date("Y-m-d H:i:s");
		//$arrCheckData = $this->get_jusLink('',$usrId,$param['link_name']);
		if(count($arrCheckData) > 0)
		{
			$arrMsg = "Already registered!!";
		} else {
			$arrInsertCol = array('randUrl'=>$randUrl,'link_name'=>$param['link_name'],'destination_url'=>$param['d_url'],'link_url'=>$param['ururl'],'profile_id'=>$param['linkProfile'],'user_id'=>$usrId,'masking'=>$param['masking'],'add_date'=>$currentDate);
			$arrMsg = $this->insert(TABLE_JUSTLINK,$arrInsertCol);
			$sql = "Select *,(Select profile_name from tbl_profile where id = profile_id) As ProfileName,(Select profile_image_path from tbl_profile where id = profile_id) As ProfileImage from tbl_justlink where id = '$arrMsg'";	
			$arrMsg = $this->getArrayResult($sql);
		}
		return $arrMsg;
	}
	public function update_link($param='',$usrId)
	{
		$ids = $param['id'];
		$paramId = ($param['id']!='')?" AND id='$ids'":'';
		$where = " user_id='$usrId'{$paramId}";
		$arrUpdateCol = array('masking'=>$param['masking'],'link_name'=>$param['link_name'],'destination_url'=>$param['d_url'],'link_url'=>$param['ururl'],'profile_id'=>$param['linkProfile']);
		return $this->update(TABLE_JUSTLINK,$arrUpdateCol,$where);
	}
	public function get_jusLink($id='',$usrId,$name='')
	{
		$arrSelectCol = array('status','masking','randUrl','link_name','destination_url','link_url','profile_id','user_id','add_date','id','add_date','modified_date','view','uniqueview');
		$whereId = ($id!='')?" AND id='$id'":'';
		$nameId = ($name!='')?" AND link_name='$name'":'';
		$where = " user_id='$usrId' {$nameId} {$whereId}";
		return $this->select(TABLE_JUSTLINK,$arrSelectCol,$where);
	}
	public function get_jusLink_byRand($rand='',$usrId)
	{
		$arrSelectCol = array('masking','randUrl','link_name','destination_url','link_url','profile_id','user_id','add_date','id','add_date','modified_date','status');
		$whereRand= ($rand!='')?" AND randUrl='$rand'":'';
		$whereuser = ($usrId!='')?" AND user_id='$usrId'":" ";
		$where = " 1 {$whereuser}{$whereRand}";
		return $this->select(TABLE_JUSTLINK,$arrSelectCol,$where);
	}
	public function randPass($length, $strength=8) {
		$vowels = 'aeuy';
		$consonants = 'bdghjmnpqrstvz';
		if ($strength >= 1) {
			$consonants .= 'BDGHJLMNPQRSTVWXZ';
		}
		if ($strength >= 2) {
			$vowels .= "AEUY";
		}
		if ($strength >= 4) {
			$consonants .= '23456789';
		}
		if ($strength >= 8) {
			$consonants .= 'ABC123456';
		}

		$password = '';
		$alt = time() % 2;
		for ($i = 0; $i < $length; $i++) {
			if ($alt == 1) {
				$password .= $consonants[(rand() % strlen($consonants))];
				$alt = 0;
			} else {
				$password .= $vowels[(rand() % strlen($vowels))];
				$alt = 1;
			}
		}
		return $password;
	}

	public function getfavicon($url)
	{
		libxml_use_internal_errors(true);
		$url = $url;
	//	$doc = new DOMDocument();
	//	$data = file_get_contents($url);
	//	$doc->strictErrorChecking = FALSE;
		//$doc->loadHTML($data);
	//	$xml = simplexml_import_dom($doc);
	//	$arr = $xml->xpath('//link[@rel="shortcut icon"]');
		//var_dump($xml);exit;
//		if(count($arr) == 0)
//		{
//			$arr = $xml->xpath('//link[@rel="icon"]');
//		}
		$urlData = parse_url($url);
		return  $urlData['scheme']."://".$urlData['host']."/favicon.ico";//:$urlData;
	}
	
	public function getTimes($date)
	{
		$to_time = strtotime($date);
		$from_time = strtotime(date("Y-m-d H:i:s"));
		$checkTimesData =  round(abs($to_time - $from_time) / 60);
		if($checkTimesData <= 1)
		{
			$returnTime = "Just Now";
		} elseif($checkTimesData > 1 && $checkTimesData < 60)
		{
			$returnTime = $checkTimesData." minute ago";
		} elseif($checkTimesData > 60 && $checkTimesData < 1440)
		{
			$returnTime = round($checkTimesData/60)." hours ago";
		} elseif($checkTimesData > 1440)
		{
			$returnTime = round($checkTimesData/1440)." days ago";
		}
		return $returnTime;
	}
public function getAnswerCount($id,$profile)
	{
	
		$sql="Select AnswerCount from tbl_formsandpoll where id='$id' and profile='$profile'";
		$result = $this->getArrayResult($sql);
		$count=$result[0]['AnswerCount'];
		/* $count=$count+1;
			$update="update tbl_formsandpoll set AnswerCount='$count' where id='$id' and profile='$profile' and randomlink='$randomlink'";
			$val=$this->getArrayResult($update);
		*/
	
		return $count;
	
	
	
	
		/* return $this->update(TABLE_FORMS_POLL,$arrupdateCol,$where);  */
		/* return $this->getArrayResult($update); */
	
	
	
	}
	public function delete_link($id)
	{
		$where = " id='$id'";
		return $this->delete(TABLE_JUSTLINK,$where);
	}
	public function change_status($status,$id)
	{
		if($status!='' && $id!=''){
			$where = " id='$id'";
			$arrUpdateCol = array('status'=>$status);
			return $this->update(TABLE_JUSTLINK,$arrUpdateCol,$where);
		}
	}	
	public function save_view_stat_visitor($username,$cookie_value)
	{
		$created_date = date("Y-m-d");
		$arrInsertCol = array('views_count'=>'1','visitor_count'=>'1','user_id'=>$username,'random_url'=>$cookie_value,'created_date'=>$created_date);
		//$arrMsg = $this->insert(TABLE_TABLE_VIEWSTAT,$arrInsertCol);
	}
	public function save_view_stat_view($username,$cookie_value)
	{		
		$created_date = date("Y-m-d");
		$arrInsertCol = array('views_count'=>'1','visitor_count'=>'0','user_id'=>$username,'random_url'=>$cookie_value,'created_date'=>$created_date);
		//$arrMsg = $this->insert(TABLE_TABLE_VIEWSTAT,$arrInsertCol);
	}
	public function onLoad_GetViewStat($userid)
	{
		$previous_time = date("Y-m-d",strtotime(' -1 days'));
		$now_time = date("Y-m-d");
		$sql = "Select COUNT(CASE 
                WHEN views_count = 1 THEN 1                
               END) AS viewscount ,
              COUNT(CASE 
                WHEN visitor_count = 1 THEN 1                
            END) AS visitorcount 
            From `tbl_viewstats` 
            Where `created_date` >= '$previous_time' AND `created_date` <= '$now_time' 
		            AND `user_id` = '$userid'";
		return $result = $this->getArrayResult($sql);
	}
	public function onLoad_GetDashBoardData($userid)
	{
		$sql = "(SELECT id,link_name,destination_url,randUrl,view,uniqueview,`add_date`,'justlink' As tablename,status,'' As message,'' As imageLocation,(Select profile_name from tbl_profile Where Id = Profile_ID) As ProfileName FROM `tbl_justlink` A where user_id = '$userid')
		UNION ALL
		(Select id,title As link_name,contenturl As destination_url,randomlink As randUrl ,view,uniqueview,`created` As add_date,'basic' As tablename,status,message As message,'' As imageLocation,(Select profile_name from tbl_profile Where Id = Profile) As ProfileName From tbl_basicontent where userId = '$userid')
		UNION All
		(SELECT id,title As link_name,contentUrl As destination_url,randomLink As randUrl,view,uniqueview,`created` As add_date, 'imagecontent' As tablename,status,'' As message, imageLocation As imageLocation,(Select profile_name from tbl_profile Where Id = Profile) As ProfileName  FROM tbl_imagecontent where userId = '$userid')
		order by add_date desc limit 10";
		//var_dump($sql); exit;
		return $this->getArrayResult($sql);
	}
	public function delete_link_Dashboard($id,$tableName)
	{
		if($tableName == "basic")
		{
			$where = " id='$id'";
			return $this->delete(TABLE_BASIC_CONTENT,$where);
		}
		elseif ($tableName == "justlink")
		{
			$where = " id='$id'";
			return $this->delete(TABLE_JUSTLINK,$where);
		}
		elseif ($tableName == "imagecontent")
		{
			$where = " id='$id'";
			return $this->delete(TABLE_TABLE_CONTENT,$where);
		}
	}
	public function change_status_Dashboard($status,$id,$tableName)
	{
		
		if($tableName == "basic")
		{
			if($status!='' && $id!=''){
				$where = " id='$id'";
				$arrUpdateCol = array('status'=>$status);
				return $this->update(TABLE_BASIC_CONTENT,$arrUpdateCol,$where);
			}

		}
		elseif ($tableName == "justlink")
		{
			if($status!='' && $id!=''){
				$where = " id='$id'";
				$arrUpdateCol = array('status'=>$status);
				return $this->update(TABLE_JUSTLINK,$arrUpdateCol,$where);
			}
		}
		elseif ($tableName == "imagecontent")
		{
			if($status!='' && $id!=''){				
//echo "UPDATE tbl_imagecontent SET status=$status where id=$id";

//mysqli_query("UPDATE tbl_imagecontent SET status=$status where id=$id");
         
	$where = " id='$id'";
        $arrUpdateCol = array('status'=>$status);
       return $this->update(TABLE_TABLE_CONTENT,$arrUpdateCol,$where);
			}				
		}
	}
}