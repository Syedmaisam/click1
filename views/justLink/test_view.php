<?php 
$xml = new DOMDocument( );
//$url = 'https://www.easports.com';
$xmlHtml = @$xml->loadHTMLFile($url);
//$xml->find('head')->append("<base href='".$url."'>");
echo "<base href='".$url."'>";
echo htmlspecialchars_decode($xml->saveHTML())."<meta property='og:url' content='".$url."' /><base href='".$url."'>";
//exit;
?>