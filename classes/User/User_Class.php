<?php
Class User_Class extends Database
{

	public function create_profile($param)
	{
		$arrInsertCol = array('profile_name'=>$param,'profile_image_path'=>$param,'profile_type'=>$param,'profile_link'=>$param);	
	}
}