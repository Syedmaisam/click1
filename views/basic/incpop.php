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
	/*max-width: 800px;
	min-width: 200px;*/
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
background:#fff;
}
</style>
<div id="popbasic">
 <div class="boxspeech msgbl tstylenorm" id="magic" style="left:0; bottom:0;">
    <div class="fold">
      <div class="picture"> <a title="Profile picture" href="#"><img id="user_profile_img" alt="Profile picture" src="<?php echo SITE_ROOT_URL.'images/profile/default.png'?>" style="border-color: rgb(204, 204, 204);"></a> </div>
      <div class="message" style="background-color: rgb(255, 255, 255); border-color: rgb(204, 204, 204);" id="pseudoCssId0">
        <div class="titler"> <a title="YourProfile Twitter" href="#" class="link" style="color: rgb(49, 51, 55);" id="txtlink">Profile Name</a>
          <div id="closeWrapper" style="width: 0px;">
            <div id="closeCall"> <a href="#" class="closeCall">x</a> </div>
          </div>
          <div class="label"> <a href="#"><img  alt="close" id="closebp" src="<?php echo SITE_ROOT_URL."images/close_btn.png"; ?>" onclick="closebpcall();"></a> </div>
        </div>
        <div class="texter">
          <p style="color: rgb(54, 57, 61);"><span id="mktmsg">Your marketing message here</span><a href="#" style="color: rgb(255, 255, 255); background-color: rgb(0, 174, 239);" id="linkbgcl">Click here</a></p>
        </div>
      </div>
    </div>
    <div style="display: none;" class="discusArea">
      <div class="discussHeader" style="background-color: rgb(0, 174, 239);">
        <div class="discussTitle">Discussion Title</div>
        <div id="discussActionToggle" class="discussAction clicked"></div>
      </div>
      <div style="display: none; border-left: 1px solid rgb(0, 174, 239); border-right: 1px solid rgb(0, 174, 239);" class="discussContent">
        <div id="discussCentral" class="discussBody">
          <div class="discussIntroduction">
            <p>There are no messages yet, so be the first to participate!</p>
          </div>
        </div>
        <div class="discussSubmit">
          <input placeholder="Type here and hit enter to send">
        </div>
        <div class="discussCopyright"> Powered by <a target="_blank" href="http://cliks.it">Cliks.it</a> </div>
      </div>
    </div>
  </div>
</div>

<script type="text/javascript">
$(document).ready(function() {
    
	
	$("#messsage").val($("#mktmsg").html());
	$("#ctoa").val($("#linkbgcl").html());
	
	
	
	
	$(document).on('change', '#msgPosition', function() {

	var bgcl=$("#magic").css("background-color");
	//alert(bgcl);	
	var val2=$("#msgPosition").val();
	//alert(val2);
	if(val2==0)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","0");
		$("#magic").css("bottom","0");
		$("#magic").css("background-color",bgcl);
	}
		if(val2==1)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","35%");
		$("#magic").css("bottom","0");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==2)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","auto");
		$("#magic").css("right","0");
		$("#magic").css("bottom","0");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==3)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","auto");
		$("#magic").css("right","0");
		$("#magic").css("top","40%");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==4)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","auto");
		$("#magic").css("right","0");
		$("#magic").css("top","0");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==5)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","35%");
		$("#magic").css("top","0");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==6)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","0");
		$("#magic").css("top","0");
		$("#magic").css("background-color",bgcl);
	}
	if(val2==7)
	{
		$("#magic").attr("style","");
		$("#magic").css("left","0");
		$("#magic").css("top","40%");
		$("#magic").css("background-color",bgcl);
	}


  

});
	
	
});
 function pbgcolor()
	{
		
	var bkgcolor="#"+$("#bkgcolor").val();
							//alert("SDFS");
	$("#pseudoCssId0").css("background-color",bkgcolor);
	//$("#pseudoCssId0:after").css("border-color",bkgcolor);
	$("#pseudoCssId0").append('<style>#pseudoCssId0:before{border-color:transparent '+bkgcolor+' !important;}</style>');
	$("#magic.boxspeech ").append('<style>.message:after{border-color:transparent '+bkgcolor+' !important;}</style>');
	$(".forfold").css("background-color",bkgcolor);
	$(".bslide").css("background-color",bkgcolor);
	
	}
	function txtcolor()
	{
		
	var txtcolor="#"+$("#textcolor").val();
							//alert("SDFS");
	$("#txtlink").css("color",txtcolor);
	$("#mktmsg").css("color",txtcolor);
	}
	function linkbg()
	{
		
	var linkbgcolor="#"+$("#linkbgcolor").val();
							//alert("SDFS");
	$("#linkbgcl").css("background-color",linkbgcolor);
	
	}
	function linktxt()
	{
	var linktxtcolor="#"+$("#linkcolor").val();
							//alert("SDFS");
	$("#linkbgcl").css("color",linktxtcolor);
	
	}
	function msgtxt()
	{
		var msgt=$("#messsage").val();
		$("#mktmsg").html(msgt);
	}
	function caltext()
	{
		
		var ch=$("#ctoa").val();
		
		$("#linkbgcl").html(ch);
	}
	function closebpcall()
	{
	
		$("#popbasic").html("");
	}
	function urlChange()
	{
		var ch=$("#inp_YourUrl").val();
		$("#linkbgcl").attr("href",ch);
	}
</script>