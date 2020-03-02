<?php
include_once "config/config.php";
include_once 'controller/Layered/Layered.php';
$objLayered = new Layered_Controller();
$arrLayeredData = $objLayered->getMetaData($arrUrl[1]);
//var_dump($arrLayeredData ); 
$doc = new DOMDocument();
@$doc->loadHTMLFile($arrLayeredData[0]['contenturl']);
$nodes = $doc->getElementsByTagName('title');
//get and display what you need:
$title = $nodes->item(0)->nodeValue;
$metas = $doc->getElementsByTagName('meta');
for ($i = 0; $i < $metas->length; $i++)
{
	$meta = $metas->item($i);
	if($meta->getAttribute('name') == 'description')
		$description = $meta->getAttribute('content');
	if($meta->getAttribute('name') == 'keywords')
		$keywords = $meta->getAttribute('content');
}

	echo "<meta property='og:type' content='website' />
	<meta property='og:url' content='".$arrLayeredData[0]['contenturl']."' />
	<meta property='og:title' content='".$title."' />
	<meta property='og:description' content='".$description."' />";