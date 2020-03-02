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
		return $result;
	}
	
	public function getProfileValueById($userId,$id)
	{
		$sql = "SELECT id,profile_name FROM tbl_profile WHERE userId = '$userId' id='$id'";
		$result = $this->getArrayResult($sql);
		return $result;
	}
}