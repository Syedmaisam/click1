<?php
class Main_Class extends Database
{
	public function getLayredRand($RrandUrl)
	{
		$arrCol = array('layered_randUrl','link_url');
		$where = " layered_randUrl='$RrandUrl'";
		return  $this->select(TABLE_TABLE_LAYERED,$arrCol,$where);		
	}
	public function getBasicRand($RrandUrl)
	{
		$arrCol = array('randomlink','contenturl');
		$where = " randomlink='$RrandUrl'";
		return  $this->select(TABLE_BASIC_CONTENT,$arrCol,$where);

	}
	public function getJustRand($RrandUrl)
	{
		$arrCol = array('randUrl','destination_url');
		$where = " randUrl='$RrandUrl'";
		return  $this->select(TABLE_JUSTLINK,$arrCol,$where);
	}
	public function getImageRand($RrandUrl)
	{
		$arrCol = array('randomLink','contentUrl');
		$where = " randomLink='$RrandUrl'";
		return  $this->select(TABLE_TABLE_CONTENT,$arrCol,$where);
	}
public function getFormPollRand($randurl)
	{
		$arrCol = array('randomlink');
		$where = " randomlink='$randurl'";
		return  $this->select(TABLE_FORMS_POLL,$arrCol,$where);
	
	}
}