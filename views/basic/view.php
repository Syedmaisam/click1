<html>
<head> 
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
//var_dump("Call hua"); exit;
include_once "../../config/config.php";
$regex_pattern_pdf = "/([.]pdf)/";
$regex_pattern_img = "/([.]png)|([.]gif)|([.]jpeg)|([.]psd)|([.]bit)|([.]bmp)|([.]tga)|([.]tiff)/";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$randUrl = explode("/",$_SERVER["REQUEST_URI"]);
$randUrl[1] = $randUrl[2];
$objProfile = new Profile_Controller();
$fbScript = $objProfile->Onload_SciptData($randUrl[1]);
$arrUrl = explode("/",$_SERVER["REQUEST_URI"]);
$arrUrl[1] = $arrUrl[2];
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT.'curl.php';
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
require_once SOURCE_ROOT.'css.php';
$objBasic = new basicController();
//var_dump($arrUrl); exit;
$arrLinkData = $objBasic->getBasicDetailByRandomLink($arrUrl[1]);
echo html_entity_decode($fbScript[0]['script']);
$doc = new DOMDocument();
@$doc->loadHTMLFile($arrLinkData[0]['contenturl']);
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
$analyticdata = $objProfile->GetAnalyticData();

// Cokie Code
?>
<?php 
echo "<meta property='og:type' content='website'/><meta property='og:url' content='". $arrLinkData[0]['contenturl']."'/><meta property='og:title' content='".$title."' /><meta property='og:description' content='".$description."' />";
?>
</head>

  <?php  if(isset($analyticdata[0]['trackcode'])){ echo html_entity_decode($analyticdata[0]['trackcode']); }?>

<script type="text/javascript" src="<?php echo SITE_ROOT_URL.'js/'?>ga_social_tracking.js"></script>
<script>
(function(){
var twitterWidgets = document.createElement('script');
twitterWidgets.type = 'text/javascript';
twitterWidgets.async = true;
twitterWidgets.src = 'http://platform.twitter.com/widgets.js';
// Setup a callback to track once the script loads.
twitterWidgets.onload = _ga.trackTwitter;
document.getElementsByTagName('head')[0].appendChild(twitterWidgets);
})();
</script>


<style>
#magic.boxspeech {
	min-width: 320px;
	padding: 10px;
}
#magic.msgbl {
	position: fixed;
}
#magic {
	background-color: transparent;
	color: #262626;
	display: table;
	font-family: Arial, Verdana, Helvetica, sans-serif;
	font-size: 12px;
	height: 80px;
	line-height: 1;
	margin: 0;
	padding: 0;
	text-align: center;
	z-index: 2147483647;
}
#magic.boxspeech .fold, #magic.boxsingle .fold, #magic.boxslide .fold {
	display: table;
	margin: 0 auto;
	max-width: 800px;
	min-width: 200px;
}
#magic.boxspeech .picture {
	border-radius: 5px;
	box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
	float: left;
	height: 80px;
	width: 80px;
}
#magic a:link {
	color: #4a4a4a;
}
#magic.boxspeech .picture img {
	border: 1px solid #9b9b9b;
	border-radius: 5px;
	height: 80px;
	width: 80px;
}
#magic.boxspeech .message:before {
	border-color: transparent #afafaf;
	border-style: solid;
	border-width: 10px 10px 10px 0;
	content: "";
	display: block;
	left: -11px;
	position: absolute;
	top: 11px;
	width: 0;
	z-index: 0;
}
#pseudoCssId0:before {
	border-color: transparent #cccccc !important;
}
*:before, *:after {
	box-sizing: border-box;
}
#magic.boxspeech .message:after {
	border-color: transparent #ffffff;
	border-style: solid;
	border-width: 10px 10px 10px 0;
	content: "";
	display: block;
	left: -10px;
	position: absolute;
	top: 11px;
	width: 0;
	z-index: 1;
}
*:before, *:after {
	box-sizing: border-box;
}
#magic.boxspeech .message {
	background-color: #ffffff;
	border: 1px solid #afafaf;
	border-radius: 5px;
	box-shadow: 0 3px 10px rgba(0, 0, 0, 0.3);
	display: table;
	height: 80px;
	margin-left: 95px;
	padding-right: 10px;
	position: relative;
}
#magic .message {
	margin: 0;
	padding: 0;
	width: auto;
}
#magic .message .titler {
	display: table;
	margin-top: 5px;
	text-align: left;
	width: 100%;
}
#magic .message .titler a.link {
	color: #7c7c7c;
	float: left;
	font-family: "Open Sans", "Arial", sans-serif;
	font-size: 1em;
	font-weight: 400;
	margin-left: 5px;
	padding: 5px;
	text-decoration: none;
}
#magic .message .titler #closeWrapper {
	display: block;
	float: right;
	margin: 0;
	overflow: hidden;
	padding: 0;
	width: 0;
}
#magic .message .titler #closeCall {
	float: right;
	margin: 3px 0 0;
	opacity: 0.5;
}
#magic .message .titler #closeCall a {
	background: none repeat scroll 0 0 rgba(60, 60, 60, 0.3);
	color: #ffffff;
	display: table;
	font-size: 11px;
	padding: 2px 3px;
	text-decoration: none;
}
#magic .message .titler .label {
	float: right;
	margin: 0 2px 0 0;
	padding: 0;
}
#magic .message .titler .label a {
	display: table;
	float: left;
	padding-top: 4px;
}
#magic a:link {
	color: #4a4a4a;
}
#magic .message .titler .label a img {
	margin: 0;
	padding: 0;
}
#magic.boxspeech .message .texter {
	display: table-footer-group;
	margin: 0;
}
#magic .message .texter {
	margin: 15px 0 0 10px !important;
	text-align: left;
}
#magic .message .texter p {
	color: #545454;
	font-family: "Open Sans", "Arial", sans-serif;
	font-size: 1.4em;
	font-weight: 400;
	line-height: 25px;
	margin: 0 0 8px 10px;
	padding: 0;
}
#magic .message .texter p a {
	background: none repeat scroll 0 0 #00aeef;
	border-radius: 5px;
	color: #ffffff;
	margin-left: 10px;
	padding: 4px 10px;
	text-decoration: none;
	white-space: nowrap;
}
.magicsb
{
width:100%!important;
}
.foldsb
{
width:100%!important;
}
.pseudoCssId0sb
{
width:93%!important;
}
.linkbgclsb
{
float:right!important;
}

/*********Box slide**************/

#magic.boxslide.msgbl {
    border: 1px solid #afafaf;
    border-top: 1px solid #afafaf;
    border-top-right-radius: 3px;
}
#magic.boxslide {
    min-height: 120px;
}
#magic.boxslide {
    display: table;
    float: left;
    height: 80px;
    padding: 0;
}
#magic.msgbl {
    bottom: 0;
    left: 0;
    position: fixed;
}
.bslide 
{
padding:20px!important;
}
#magic.msgbl.boxsingle {
    margin: 0 0 10px 10px;
}
#magic.boxsingle {
    padding: 0;
}
#magic.boxsingle .message {
    display: table;
    float: left;
    height: 80px;
    margin: 0;
    max-width: 715px;
    min-width: 200px;
    padding: 0 10px 0 0;
    position: relative;
}
#magic.boxsingle .picture img {
    border-bottom-left-radius: 3px;
    border-top-left-radius: 3px;
    height: 80px;
    width: 80px;
}
.cilcolor
{
background:#fff!important;
}
</style>

<?php 


//$objJustLink = new Justlink_Controller();
//$arrLinkData = $objJustLink->get_jusLink_byRand($arrUrl[1]);
//$arrUrl = explode("/",$_SERVER["PATH_INFO"]);

$arrUrlsNew = array('https://facebook.com','http://facebook.com','https://www.facebook.com','http://www.facebook.com','http://google.com','https://google.com','http://www.google.com','https://www.google.com');
//var_dump($arrLinkData); exit;
if($arrLinkData[0]['status']==0)
{
	?>
	<div class="alert alert-danger alert-dismissable" style="left: 20%;top: 45%;width: 40%;position:fixed; vertical-align:middle;">
                                        <i class="fa fa-ban"></i>
                                        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>
                                        <b>Alert!</b> The link is not published.
                                    </div>
                                    </div>
	
	<?php 
exit;
}


if($arrUrl[1]!='' && $arrLinkData!=NULL)
{
   $linkData = $arrLinkData[0];
 $url = $linkData['contenturl'];
   $popup = $linkData['popuphtml'];
   $popup = ltrim($popup,'n');
   $popup = rtrim($popup,'n');
   $typeId = $linkData['id'];
?>


<?php 
/*$ch = curl_init();
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch,CURLOPT_RETURNTRANSFER,true);
curl_setopt($ch,CURLOPT_SSLVERSION,false);
$myhtml = curl_exec($ch); */
//var_dump($myhtml);exit;

//if(in_array($url,$arrUrlsNew)){

$matched_pattern_data_pdf = preg_match($regex_pattern_pdf,$url);
$matched_pattern_data_img = preg_match($regex_pattern_img,$url);
if($matched_pattern_data_pdf > 0){
	
	echo "<div id='pdf'>
  <object width='100%' height='100%' type='application/pdf' data='".$url."' id='pdf_content'>
    <p>Insert your error message here, if the PDF cannot be displayed.</p>
  </object>
</div>";
	
} else if($matched_pattern_data_img > 0){
	
	echo "<img src='".$url."' width='100%' height='100%'>";
	
} else {

//$doc = new DOMDocument();
//$doc->loadHTMLFile($url);
//$myhtml = $doc->saveHTML();
//$curl = new Curl();
//$doc = new DOMDocument();
//$doc->loadHTMLFile($url);
//$myhtml = $curl->get($url);
//$myhtml="<meta property='og:url' content='".$url."' /><link href='".$url."' rel='canonical'><base href='".$url."'>".$myhtml;
echo "<meta property='og:url' content='".$url."' /><iframe src='".$url."' sandbox='allow-forms allow-scripts allow-same-origin' style='height:97.5%;width:100%;border:none;margin:0;padding:0'></iframe>";
//echo htmlspecialchars_decode($myhtml);
}
//} else {

//htmlspecialchars_decode($myhtml);
//}
?>

<div><input id="typeid" type="hidden" value="<?php echo $linkData['id']; ?>"></div>
<div><?php $replace_regex = "/(Openr)|(ope.nr)/"; echo html_entity_decode(preg_replace($replace_regex,'',$popup)); ?></div>
<div id="lkurl" style="display:none;"><?php echo $url = $linkData['link_url']; ?></div>

<?php

}
?>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var SITE_ROOT_URL = "<?php echo SITE_ROOT_URL; ?>";
</script>
<script type="text/javascript">
$(document).ready(function(){
$("html body").css("overflow","hidden");
	var typeId = $('#typeid').val();
	//var typeId = document.getElementById("typeid").value;
	$.ajax({
		url:SITE_ROOT_URL+'ajax/ipaddress/ipaddr.php',
		type:"post",
		 data: {
			    submit: "submit",
			    typeid: typeId,
			    type: "basic",
			    tablename: "tbl_basicontent"
			           
			   },
			   success: function(response) { 

				   		   
				   }	
	});	
 $('#linkbgcl').click(function() 
        { 

	  $('#linkbgcl').attr('target','_parent');
	
        });
	});
function closebpcall()
{
window.location="<?php echo $arrLinkData[0]['contenturl'] ; ?>";
}
</script>
</html>