<?php

class getProfileClass extends Database
{
	public function __construct()
	{
		
	}
	public function getProfileVal($userId)
	{
		$sql = "SELECT id,profile_name,profile_image_path FROM tbl_profile WHERE userId = '$userId'";
		
		$result = $this->getArrayResult($sql);
		
		/* if(count($result) > 0)
		{
			$htmlResult="<option value='addprofile'>Add new profile</option>";
			
			for($i=0; $i < count($result); $i++)
			{
				$profile = $result[$i][profile_name];
				$htmlResult .= "<option data-name=".$profile." value=".$profile.">$profile</option>";
			}
			
		}  */
		return $result;
	}
public function getProfileImageDB($userId)
	{
		$sql = "select * from tbl_profile where userId = '$userId'";
		return $this->getArrayResult($sql);
	}
}