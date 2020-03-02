<?php include_once "../../../config/config.php"; ?>
<link rel="stylesheet" href="http://www.cliks.it/click/views/layered/animatemaster/animate.min.css">
<style>
body {
	margin:0px;
	padding:0px;
}
.ulp-content {
	position: relative;
}
.ulp-window {
	text-align: left;
}
#ulp-layer-139 {
	background-color: rgba(255, 255, 255, 0.9);
	box-shadow: 0 4px 30px rgba(32, 32, 32, 1);
	text-align: left;
	z-index: 1000002;
}
#ulp-layer-139, #ulp-layer-139 p, #ulp-layer-139 a, #ulp-layer-139 span, #ulp-layer-139 li, #ulp-layer-139 input, #ulp-layer-139 button, #ulp-layer-139 textarea {
	color: #000000;
	font-family: "arial", arial;
	font-weight: 400;
}
.ulp-layer {
	box-sizing: border-box;
	line-height: 1.475;
	position: absolute;
}
ulp-layer img {
	border: medium none !important;
	box-shadow: none !important;
	margin: 0 !important;
	max-width: 100% !important;
	min-width: 0 !important;
	padding: 0 !important;
}
img {
	max-width: 100%;
}
#ulp-layer-140 {
	background-color: rgba(0, 0, 0, 0.7);
	text-align: left;
	z-index: 1000006;
}
#ulp-layer-140, #ulp-layer-140 p, #ulp-layer-140 a, #ulp-layer-140 span, #ulp-layer-140 li, #ulp-layer-140 input, #ulp-layer-140 button, #ulp-layer-140 textarea {
	color: #000000;
	font-family: "arial", arial;
	font-weight: 400;
}
.ulp-layer {
	box-sizing: border-box;
	line-height: 1.475;
	position: absolute;
}
#ulp-layer-141 {
	text-align: left;
	z-index: 1000007;
}
* {
	font-family:'Helvetica Neue', Helvetica, sans-serif;
	font-size:13px;
	margin:0;
}
a {
	font-weight:bold;
	color:#fff;
	text-decoration:none;
}
.container_112 {
	width:400px;
	display:block;
	margin:0 auto;
	box-shadow:0 2px 5px rgba(0,0,0,0.4);
}
.header_11 {
	padding:20px 20px 12px 20px;
	background:#eeeded;
	color:#fff;
	border-bottom:1px solid#7b7a7a;
}
.header_11 h2 {
	font-size:16px;
	line-height:15px;
	display:inline-block;
}
.header_11 a {
	display:inline-block;
	float:right;
	background:#3d8b4e;
	font-size:25px;
	line-height:20px;
	padding:3px 6px;
	margin-top:-5px;
	border-radius:2px;
}
.chat-box, .enter-message_1 {
	background:#fff;
	padding:0 20px;
	color:#33353a;
}
.chat-box .message_1-box {
	padding:0px 0 6px;
	clear:both;
	border-bottom:1px solid#d2d2d2;
}
.message_1-box .picture {
	float:left;
	width:50px;
	display:block;
	padding-right:10px;
}
.picture img {
	width:43px;
	height:48px;
	border-radius:5px;
}
.picture span {
	font-weight:bold;
	font-size:12px;
	clear:both;
	display:block;
	text-align:center;
	margin-top:3px;
}
.message_1 {
	background:#fff;
	display:inline-block;
	padding:13px;
	width:274px;
	border-radius:2px;
	position:relative;
}
.message_1:before {
	content:"";
	position:absolute;
	display:block;
	left:0;
	border-right:6px solid #fff;
	border-top: 6px solid transparent;
	border-bottom:6px solid transparent;
	top:10px;
	margin-left:-6px;
}
.message_1_1 span {
	color:#555;
	font-weight:bold;
}
.message_1 p {
	padding-top:5px;
}
.message_1-box.right-img .picture {
	float:right;
	padding:0;
	padding-left:10px;
}
.message_1-box.right-img .picture img {
	float:right;
}
.message_1-box.right-img .message_1:before {
	left:100%;
	margin-right:6px;
	margin-left:0;
	border-right:6px solid transparent;
	border-left:6px solid #fff;
	border-top: 6px solid transparent;
	border-bottom:6px solid transparent;
}
.enter-message_1 {
	padding:13px 0px;
}
.enter-message_1 input {
	border:none;
	padding:10px 12px;
	width:260px;
	border-radius:2px;
	background: none repeat scroll 0% 0% rgb(244, 243, 243);
	border: 1px solid rgb(123, 122, 122);
}
.enter-message_1 a.send {
	padding:10px 15px;
	background:#eeeded;
	border-radius:2px;
	float:right;
	border:1px solid#7b7a7a;
	color: rgb(51, 53, 58);
}
.message_1-box .picture_1 {
	float:left;
	width:50px;
	display:block;
	padding-right:10px;
}
.picture_1 img {
	width:95px;
	height:100px;
	border-radius:0px;
}
.picture_1 span {
	font-weight:bold;
	font-size:12px;
	clear:both;
	display:block;
	text-align:left;
	margin-top:12px;
	cursor:pointer;
}
.picture_1 span img {
	weight:98px;
	height:28px;
	border-radius:25px;
}
.ulp_l_112 {
	color: #504b4b;
	float: right;
	padding-right: 122px;
	padding-top: 10px;
	position: relative;
	width:245px;
}
.ulp_l_112 img {
	height: auto;
	width: 12px;
	padding-right: 5px;
}
.ulp_2_112 {
    color: #504b4b;
    float: left;
    margin-top: 40px;
    padding-left: 115px;
    position: absolute;
    width: auto;
}
.ulp_2_112 img {
	height: auto;
	width: 12px;
}


</style>



		<div id='popupform_preview' style="display:none;"><div class='ulp-content' style='z-index:99999;width: 550px; height: 410px; margin:auto;position:fixed; left:28%; top:5%;'>
  <div id='ulp-layer-141' class='ulp-layer animated bounceInDown' style='width: 550px; font-size: 24px; left: 0px; top:45px;'>
    <div class='container_112'>
      <div id='ulp-layer-142' class='header_11 animated zoomInDown picture_1'>
        <p class='ulp_l_112'><img  src='http://www.cliks.it/click/IMAGE/star_p.png'/>Randhir Kumar</p>
        <p class='ulp_2_112'><img  src='http://www.cliks.it/click/IMAGE/online.png'/> Online</p>
        <img class='profilepicimage' src='http://www.cliks.it/click/IMAGE/profile_pic.png' title='user name'/> <span class='videocal'><img src='http://www.cliks.it/click/IMAGE/videocalling.png'/></span> <span class='callbtn' style='margin-left: 103px; margin-top: -28px;'><img src='http://www.cliks.it/click/IMAGE/CallButton.png'/></span> </div>
      <div id='ulp-layer-143' class='chat-box'>
        <div id='ulp-layer-144' class='message_1-box left-img  animated fadeInDown'>
          <div class='message_1'> <span>San Thomas</span>
            <p>Hey Mike, how are you doing?</p>
          </div>
        </div>
        <div id='ulp-layer-145' class='message_1-box right-img animated animated slideInRight'>
          <div class='message_1'> <span>Randhir</span>
            <p>Pretty good, Eating nutella, nommommom</p>
          </div>
        </div>
        <div id='ulp-layer-146' class='message_1-box right-img animated animated slideInLeft'>
          <div class='message_1'> <span>Randhir</span>
            <p>Pretty good, Eating nutella, nommommom</p>
          </div>
        </div>
        <div id='ulp-layer-147' class='enter-message_1 animated bounceInDown'>
          <input disabled='disabled' type='text' placeholder=''/>
          <a href='#' class='send'>Send</a> </div>
      </div>
    </div>
    <div id='ulp-layer-148' class='ulp-layer' style='width: 32px; height: 32px; font-size: 32px; left: 475px; top: 0px;  background:rgb(51, 51, 51);text-align:center;padding-top:5px;'><a onclick='return ulp_self_close();' href='#'>x</a></div>
  </div>
		</div>

		</div>				
					<div id="blackscreen" style='width:100%; height:100%; background:#000; opacity:0.7; top:0; left:0; position:fixed; z-index:20000; display:none;'></div>
											
<script>
function ulp_self_close()
{
	$("#popupform_preview").hide();
	$("#blackscreen").hide();
	$("#popup_content_data").html('');
}
</script> 
				<script type="text/javascript" lang="javascript">

var text= "hey friends.how are u.";
var arr=text.split("");
var looptimer;
var audio=new Audio("<?php echo SITE_ROOT_URL.'views/layered/' ?>animatemaster/Chat Welcome Alert 2.mp3");
		audio.play();
function frameLooper()
{
	
	if(arr.length>0)
	{
		value=arr.shift();
		$("#ulp-layer-147 input").attr('placeholder',$("#ulp-layer-147 input").attr('placeholder')+value);
		//$("#Textbox_txt").val($("#Textbox_txt").val()+ value);
		
		//document.getElementById("sound").innerHTML='<audio autoplay="autoplay" type="audio/mpeg"><source src="typewriterkey.mp3" type="audio/ogg"><embed hidden="true" autostart="true" loop="false" src="typewriterkey.mp3" /></audio>';
	}
	else
	{
		clearTimeout(looptimer);
	}
	looptimer=setTimeout('frameLooper()',80);	
}
frameLooper();

</script>	