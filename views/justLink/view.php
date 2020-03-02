<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
$regex_pattern_pdf = "/([.]pdf)/";
$regex_pattern_img = "/([.]png)|([.]gif)|([.]jpeg)|([.]psd)|([.]bit)|([.]bmp)|([.]tga)|([.]tiff)/";
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$objProfile = new Profile_Controller();
$fbScript = $objProfile->Onload_SciptData($randUrl[1]);
echo html_entity_decode($fbScript[0]['script']);
$arrUrl = explode("/",$_SERVER["ORIG_PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink_byRand($arrUrl[1]);
$doc = new DOMDocument();
@$doc->loadHTMLFile($arrLinkData[0]['destination_url']);
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
?>
<?php 
echo "<meta property='og:type' content='website' /><meta property='og:url' content='".$arrLinkData[0]['destination_url']."' /><meta property='og:title' content='".$title."' /><meta property='og:description' content='".$description."' />";
?>
</head>
<!-- Google Analytics Social Button Tracking -->
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

<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60807101-1', 'auto');
  ga('send', 'pageview');

</script>
<style type="text/css">
	#clicker{
		/*background-color: red;*/
		position:absolute;
		opacity: 0.1;
		filter:alpha(opacity=10);
		width: 90%; 
		height: 100%;
		
	}
	
	.clicker iframe{  
	
	height:800px!important; overflow-y: scroll;
	 
	}  
	
.nd{padding: 0px ! important; margin: 0px; overflow-x: hidden;} 
	
	
	 
</style>

<?php

//
if($arrLinkData[0]['status']==0)
{
require_once SOURCE_ROOT.'css.php';
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

if($arrUrl[1]!='' && $arrLinkData!=NULL){
$linkData = $arrLinkData[0];
$url = $linkData['destination_url'];
$matched_pattern_data_pdf = preg_match($regex_pattern_pdf,$url);
$matched_pattern_data_img = preg_match($regex_pattern_img,$url);
?>

<?php 
if($matched_pattern_data_pdf > 0){
	
	echo "<div id='pdf'>
  <object width='100%' height='100%' type='application/pdf' data='".$url."' id='pdf_content'>
    <p>Insert your error message here, if the PDF cannot be displayed.</p>
  </object>
</div>";
	
} else if($matched_pattern_data_img > 0){
	
	echo "<img src='".$url."' width='100%' height='100%'>";
	
} else {
//if(in_array($url,$arrUrls)){
//$doc = new DOMDocument();
//@$doc->loadHTMLFile($url);
//$myhtml = $doc->saveHTML();
//$myhtml="<meta property='og:url' content='".$url."' /><link href='".$url."' rel='canonical'><base href='".$url."'>".$myhtml;
?> <div id='clicker' onclick="window.location='<?php echo $linkData['link_url'] ?>'"></div><?php 
echo "<iframe sandbox='allow-same-origin allow-forms allow-scripts' src='".$url."' style='height:100%;width:100%;border:none;margin:0;padding:0'></iframe>";
// include_once "test_view.php";
//$doc = new DOMDocument();
//$doc->loadHTMLFile($url);
//$myhtml = $doc->saveHTML();
//$myhtml="<base href='".$url."'>".$myhtml;
//echo htmlspecialchars_decode($myhtml);
}
?>

<div><input id="typeid" type="hidden" value="<?php echo $linkData['id']; ?>"></div>
<div id="lkurl" style="display:none;"><?php echo $url = $linkData['link_url']; ?></div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript">
var linkurl=$("#lkurl").html();
	var mask=<?php echo $linkData['masking']; ?>;

$(document).ready(function()
{
	
//var ss=$(this).attr('src');
//$('img').attr('src', 'http://www.google.com'+$(this).attr('src'));


//var imgarr=$('html img').attr('src');

$('a').each(function(){
if(mask==0)
{	

$(this).prop('href',linkurl);
}
if(mask==1)
{

	$(this).attr("onclick","plink(); return false;");
	$(this).attr("href","");
}

});

});
function plink()
{
window.location.assign(linkurl);
}


</script> 
<?php
}
?>

<script type="text/javascript">
$(document).ready(function(){
$("html body").css("overflow","hidden");
	var typeId = $('#typeid').val();
        //alert(typeId);
	//var typeId = document.getElementById("typeid").value;
	$.ajax({
		url:location.protocol + '//' + location.host+"/click/ajax/ipaddress/ipaddr.php",
                 //alert(url);
                //url:"http://cliks.it/click/ajax/ipaddress/ipaddr.php",
		type:"post",
		 data: {
			    submit: "submit",
			    typeid: typeId,
			    type: "justlink",
			    tablename: "tbl_justlink"
			           
			   },
			   success: function(response) { 

				   //alert("ok");
				   //if(response ==true)
				   //{
					   //alert("ip already exist in db");
					  
				   //}
				   //else
				   //{
					  
				   //}
				   
				   }
	
	});
	
	});


</script>
</html>

