<html>
<!-- Google Analytics Social Button Tracking -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

  ga('create', 'UA-60807101-1', 'auto');
  ga('send', 'pageview');

</script>
<script type="text/javascript"
	src="<?php echo SITE_ROOT_URL.'js/'?>ga_social_tracking.js"></script>
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
<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
<?php 
$regex_pattern_pdf = "/([.]pdf)/";
$regex_pattern_img = "/([.]png)|([.]gif)|([.]jpeg)|([.]psd)|([.]bit)|([.]bmp)|([.]tga)|([.]tiff)/";
$arrUrl = explode("/",$_SERVER["ORIG_PATH_INFO"]);
include_once SOURCE_ROOT.'controller/image/getHistoryController.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT.'curl.php';
require_once SOURCE_ROOT.'css.php';
$objHistoryController = new getHistoryController();
$arrLinkData = $objHistoryController->getImagedata('',$arrUrl[1]);
$doc = new DOMDocument();
@$doc->loadHTMLFile($arrLinkData[0]['contentUrl']);
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
// Cokie Code
echo "<meta property='og:type' content='website' /><meta property='og:url' content='".$arrLinkData[0]['contentUrl']."' /><meta property='og:title' content='".$title."' /><meta property='og:description' content='".$description."' />";
?>

<?php
if($arrLinkData[0]['status']==0)
{
	?>
<div class="alert alert-danger alert-dismissable"
	style="left: 20%; top: 45%; width: 40%; position: fixed; vertical-align: middle;">
	<i class="fa fa-ban"></i>
	<button type="button" class="close" data-dismiss="alert"
		aria-hidden="true"></button>
	<b>Alert!</b> The link is not published.
</div>
</div>

<?php 
exit;
}



if($arrUrl[1]!='' && $arrLinkData!=NULL){
	$linkData = $arrLinkData[0];
	?>
<div>
	<input id="typeid" type="hidden" value="<?php echo $linkData['id']; ?>">
</div>
<input type="hidden" value="<?php echo $linkData['popupTiming']; ?>"
	id="popup_timing">
<link rel="stylesheet" type="text/css"
	href="<?php echo SITE_ROOT_URL; ?>popup/css/style.css" />



<title><?php echo SITE_TITLE; ?></title>
<style type="text/css">
html,body {
	overflow-x: none !important;
}
</style>

<?php
$pwidth=$linkData['popupWidth']."px";
$pheight=$linkData['popupHeight']."px";

if($linkData['overlay']==1)
{
	$dison="0";
}
else
{
	$dison='0.6';
}

?>

<div id="img_black" style="position:fixed;width:100%; height:100%;top:0;left:0; background:#000; opacity:<?php echo $dison; ?>; z-index:1000;display:none;"></div>
<div id="img_screen" style="z-index:10000000;background:#fff;width:<?php echo $pwidth; ?>; height:<?php echo $pheight; ?>; display:none;">
	<a href="<?php echo $arrLinkData[0]['yourUrl']; ?>">
<?php if($arrLinkData[0]['imageLocation'] != '') {?> <img src="<?php  echo SITE_ROOT_URL.'images/basic/'.$arrLinkData[0]['imageLocation']; ?>" 
style="width:100%; height:100%; background:#fff; border:1px solid #ccc;">
<?php } else {?> <img alt="<?php echo $arrLinkData[0]['imageUrl'];?>" src="<?php echo $arrLinkData[0]['imageUrl']; ?>" style="background:#fff; border:1px solid #ccc; 
word-break:break-word; max-width:<?php echo $pwidth; ?>;"<?php }?></a>
		
		<a onClick="closeBox()" style="cursor: pointer;"><img
		src="<?php echo SITE_ROOT_URL; ?>img/close_button.png"
		style="position: absolute; right: -16px; top: -12px;"> </a>
</div>

<?php 
$url = $linkData['contentUrl'];
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
//$myhtml="<meta property='og:url' content='".$url."' /><link href='".$url."' rel='canonical'><base href='".$url."'>".$myhtml;
if($linkData['popupTiming']==1)
	{
		$curl = new Curl();
		//$doc = new DOMDocument();
		//$doc->loadHTMLFile($url);
		$myhtml = $curl->get($url);
		$myhtml="<meta property='og:url' content='".$url."' /><link href='".$url."' rel='canonical'><base href='".$url."'>".$myhtml;
		echo "<div style='display:none;'>".htmlspecialchars_decode($arrLayeredData[0]['autoresponder_html'])."</div>";
		echo htmlspecialchars_decode($myhtml);
	}
	else {
		echo "<iframe src='".$url."'  sandbox='allow-forms allow-scripts' style='height:100%;width:100%;border:none;margin:0;padding:0'></iframe>";
	}
}
?>
<div>
	<?php echo htmlspecialchars_decode($myhtml); ?>
</div>
<?php
 } ?>

<script
	src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"
	type="text/javascript"></script>
<script type="text/javascript">
$(document).ready(function(){

	var typeId = $('#typeid').val();
	//var typeId = document.getElementById("typeid").value;
	$.ajax({
		url:location.protocol + '//' + location.host+"/click/ajax/ipaddress/ipaddr.php",
		type:"post",
		 data: {
			    submit: "submit",
			    typeid: typeId,
			    type: "image",
			    tablename: "tbl_imagecontent"
			           
			   },
			   success: function(response) { 		
			   }		  
	
	});
	
	});


</script>
<style>
.centerpop {
	margin: auto;
	position: fixed;
	top: 0;
	left: 0;
	bottom: 0;
	right: 0;
}

.lefttoppop {
	margin: auto;
	position: fixed;
	top: 20px;
	left: 20px;
}

.leftbottom {
	margin: auto;
	position: fixed;
	left: 20px;
	bottom: 20px;
}

.righttoppop {
	margin: auto;
	position: fixed;
	top: 20px;
	right: 20px;
}

.rightbottom {
	margin: auto;
	position: fixed;
	right: 20px;
	bottom: 20px;
}
</style>

<script type="text/javascript">  


$(document).ready(function(){
	

$('#img_screen').click(function() 
        { 

	  $('#img_screen a').attr('target','_parent');
	
        });

var position=<?php echo $linkData['popup_position']; ?>;
	
var tm=<?php echo $linkData['popupTiming']; ?>+'000';

var Overlay = <?php echo $linkData['popupTiming']; ?>

if(tm=="-1000")
{
tm=5000;
}
tm=parseInt(tm)+500;


if(position==0)
{
	<?php if($linkData['popupTiming']==-1){?>
		function addEvent(obj, evt, fn) {
		    if (obj.addEventListener) {
		        obj.addEventListener(evt, fn, false);
		    }
		    else if (obj.attachEvent) {
		        obj.attachEvent("on" + evt, fn);
		    }
		}
		addEvent(window,"load",function(e) {
		    addEvent(document, "mouseout", function(e) {
		        e = e ? e : window.event;
		        var from = e.relatedTarget || e.toElement;
		        if (!from || from.nodeName == "HTML") {
		            // stop your drag event here
		            // for now we can just use an alert
		        	setTimeout(function() {
		        		$("#img_screen").addClass("centerpop");	
		        		$("#img_black").show();
		        		$("#img_screen").show();
		        			},000);
		        }
		    });
		});
		<?php }
	else if($linkData['popupTiming']==1) { ?>
	$(window).scroll(function(){
	$("#img_screen").addClass("centerpop");	
	$("#img_black").show();
	$("#img_screen").show();
		});
		<?php } else { ?>
	setTimeout(function() {		
	$("#img_screen").addClass("centerpop");	
	$("#img_black").show();
	$("#img_screen").show();
		},parseInt(tm));	

	<?php } ?>
}
if(position==1)
{
	<?php if($linkData['popupTiming']==-1){?>
		function addEvent(obj, evt, fn) {
		    if (obj.addEventListener) {
		        obj.addEventListener(evt, fn, false);
		    }
		    else if (obj.attachEvent) {
		        obj.attachEvent("on" + evt, fn);
		    }
		}
		addEvent(window,"load",function(e) {
		    addEvent(document, "mouseout", function(e) {
		        e = e ? e : window.event;
		        var from = e.relatedTarget || e.toElement;
		        if (!from || from.nodeName == "HTML") {
		            // stop your drag event here
		            // for now we can just use an alert
		        	setTimeout(function() {
		        		$("#img_screen").addClass("lefttoppop");	
		    			$("#img_black").show();
		    			$("#img_screen").show();
		    				},000);
		        }
		    });
		});
		<?php }
	else if($linkData['popupTiming']==1) { ?>
	$(window).scroll(function(){
		$("#img_screen").addClass("lefttoppop");	
		$("#img_black").show();
		$("#img_screen").show();
			});
		<?php } else { ?>
		setTimeout(function() {
			$("#img_screen").addClass("lefttoppop");	
			$("#img_black").show();
			$("#img_screen").show();
				},parseInt(tm));
	
<?php } ?>
}
if(position==2)
{

	<?php if($linkData['popupTiming']==-1){?>
		function addEvent(obj, evt, fn) {
		    if (obj.addEventListener) {
		        obj.addEventListener(evt, fn, false);
		    }
		    else if (obj.attachEvent) {
		        obj.attachEvent("on" + evt, fn);
		    }
		}
		addEvent(window,"load",function(e) {
		    addEvent(document, "mouseout", function(e) {
		        e = e ? e : window.event;
		        var from = e.relatedTarget || e.toElement;
		        if (!from || from.nodeName == "HTML") {
		            // stop your drag event here
		            // for now we can just use an alert
		        	setTimeout(function() {
		        		$("#img_screen").addClass("leftbottom");	
		    			$("#img_black").show();
		    			$("#img_screen").show();
		    				},000);
		        }
		    });
		});
		<?php }
	else if($linkData['popupTiming']==1) { ?>
	$(window).scroll(function(){
		$("#img_screen").addClass("leftbottom");	
		$("#img_black").show();
		$("#img_screen").show();
			});
		<?php } else { ?>
		setTimeout(function() {
			$("#img_screen").addClass("leftbottom");	
			$("#img_black").show();
			$("#img_screen").show();
				},parseInt(tm));
<?php } ?>
}
if(position==3)
{
	<?php if($linkData['popupTiming']==-1){?>
		function addEvent(obj, evt, fn) {
		    if (obj.addEventListener) {
		        obj.addEventListener(evt, fn, false);
		    }
		    else if (obj.attachEvent) {
		        obj.attachEvent("on" + evt, fn);
		    }
		}
		addEvent(window,"load",function(e) {
		    addEvent(document, "mouseout", function(e) {
		        e = e ? e : window.event;
		        var from = e.relatedTarget || e.toElement;
		        if (!from || from.nodeName == "HTML") {
		            // stop your drag event here
		            // for now we can just use an alert
		        	setTimeout(function() {
		        		$("#img_screen").addClass("righttoppop");	
		    			$("#img_black").show();
		    			$("#img_screen").show();
		    				},000);
		        }
		    });
		});
		<?php }
	else if($linkData['popupTiming']==1) { ?>
	 $(window).scroll(function(){
		 $("#img_screen").addClass("righttoppop");	
			$("#img_black").show();
			$("#img_screen").show();
				});
		<?php } 
		else { ?>
		setTimeout(function() {
			$("#img_screen").addClass("righttoppop");	
			$("#img_black").show();
			$("#img_screen").show();
				},parseInt(tm));
<?php } ?>
}
if(position==4)
{
	<?php if($linkData['popupTiming']==-1){?>
		function addEvent(obj, evt, fn) {
		    if (obj.addEventListener) {
		        obj.addEventListener(evt, fn, false);
		    }
		    else if (obj.attachEvent) {
		        obj.attachEvent("on" + evt, fn);
		    }
		}
		addEvent(window,"load",function(e) {
		    addEvent(document, "mouseout", function(e) {
		        e = e ? e : window.event;
		        var from = e.relatedTarget || e.toElement;
		        if (!from || from.nodeName == "HTML") {
		            // stop your drag event here
		            // for now we can just use an alert
		        	setTimeout(function() {
		        		$("#img_screen").addClass("rightbottom");	
		    			$("#img_black").show();
		    			$("#img_screen").show();
		    				},000);
		        }
		    });
		});
		<?php }
		else if($linkData['popupTiming']==1) { ?>
	 $(window).scroll(function(){
		 $("#img_screen").addClass("rightbottom");	
			$("#img_black").show();
			$("#img_screen").show();
				});
	
		<?php  }
		else { ?>
		setTimeout(function() {
			$("#img_screen").addClass("rightbottom");	
			$("#img_black").show();
			$("#img_screen").show();
				},parseInt(tm));
<?php } ?>
}


});
function closeBox()
{
	$("#img_black").hide();
	$("#img_screen").hide();
}
$(document).ready(function()
{
$("html body").css("overflow","hidden");
});

</script>

</html>