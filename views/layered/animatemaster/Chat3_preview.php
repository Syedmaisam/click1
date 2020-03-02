<?php include_once "../../../config/config.php"; ?>
<link rel="stylesheet" href="http://www.cliks.it/click/views/layered/animatemaster/animate.min.css">
<style>
body
{
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
    font-family: "arial",arial;
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
    font-family: "arial",arial;
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



*{
  font-family:'Helvetica Neue',Helvetica, sans-serif;
  font-size:14px;
  margin:0;
}
a{
  font-weight:bold;
  color:#fff;
  text-decoration:none;
}
.container{
  width:400px;
  display:block;
  margin:0 auto;
  box-shadow:0 2px 5px rgba(0,0,0,0.4);
}
.header{
  padding:20px 20px 18px 20px;
  background:#5FB471;
  color:#fff;
}
.header h2{
  font-size:16px;
  line-height:15px;
  display:inline-block;
}
.header a{
  display:inline-block;
  float:right;
  background:#3d8b4e;
  font-size:25px;
  line-height:20px;
  padding:3px 6px;
  margin-top:-5px;
  border-radius:2px;
}
.chat-box, .enter-message{
  background:#ECECEC;
  padding:0 20px;
  color:#a1a1a1;
}
.chat-box .message-box{
  padding:18px 0 10px;
  clear:both;
}
.message-box .picture{
  float:left;
  width:50px;
  display:block;
  padding-right:10px;
}
.picture img{
  width:43px;
  height:48px;
  border-radius:5px;
}
.picture span{
  font-weight:bold;
  font-size:12px;
  clear:both;
  display:block;
  text-align:center;
  margin-top:3px;
}
.message{
  background:#fff;
  display:inline-block;
  padding:13px;
  width:274px;
  border-radius:2px;
  box-shadow: 0 1px 1px rgba(0,0,0,.04);
  position:relative;
}
.message:before{
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
.message span{
  color:#555;
  font-weight:bold;
}
.message p{
  padding-top:5px;
}
.message-box.right-img .picture{
  float:right;
  padding:0;
  padding-left:10px;
}
.message-box.right-img .picture img{
  float:right;
}
.message-box.right-img .message:before{
  left:100%;
  margin-right:6px;
  margin-left:0;
  border-right:6px solid transparent;
  border-left:6px solid #fff;
  border-top: 6px solid transparent;
  border-bottom:6px solid transparent;
}
.enter-message{
  padding:13px 0px;
}
.enter-message input{
  border:none;
  padding:10px 12px;
  background:#d3d3d3;
  width:260px;
  border-radius:2px;
}
.enter-message a.send{
  padding:10px 15px;
  background:#6294c2;
  border-radius:2px;
  float:right;
}


</style>


	<div id='popupform_preview' style="display:none;"><div class="ulp-content" style="z-index:99999;width: 550px; height: 410px; margin:auto;position:fixed; left:28%; top:15%;">
		<div id="ulp-layer-141" class="ulp-layer animated bounceInDown" style="width: 550px; font-size: 24px; left: 0px; top:45px;">
        <div class="container">
        <div id="ulp-layer-142" class="header animated zoomInDown"><h2>Messages</h2></div>
		<div id="ulp-layer-143" class="chat-box">
		<div id="ulp-layer-144" class="message-box left-img  animated slideInLeft">
		<div class="picture">
        <img src="http://www.cliks.it/click/IMAGE/profile_pic.png" title="user name"/>
        <span class="time">10 mins</span>
		</div>
		<div class="message">
        <span>San Thomas</span>
        <p>Hey Mike, how are you doing?</p>
		</div>
		</div>
		<div id="ulp-layer-145" class="message-box right-img animated animated slideInRight">
		<div class="picture">
        <img src="http://www.cliks.it/click/IMAGE/profile_pic1.png" title="user name"/>
        <span class="time">2 mins</span>
		</div>
		<div class="message">
        <span>Randhir</span>
        <p>Pretty good, Eating nutella, nommommom</p>
      </div>
    </div>
    <div id="ulp-layer-146" class="enter-message animated bounceInDown">
      <input disabled='disabled' type="text" placeholder=""/>
      <a href="#" class="send">Send</a>
    </div>
  </div>
</div>
<div id="ulp-layer-148" class="ulp-layer" style="width: 32px; height: 32px; font-size: 32px; left: 428px; top: 0px;text-align:center; background:rgb(51, 51, 51);padding-top:5px;"><a onclick='return ulp_self_close();' href='#'>x</a></div>
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

var text= "hey friends.What are you doing.";
var arr=text.split("");
var looptimer;
var audio=new Audio("<?php echo SITE_ROOT_URL.'views/layered/' ?>animatemaster/Chat Welcome Alert 2.mp3");
		audio.play();
function frameLooper()
{
	
	if(arr.length>0)
	{
		value=arr.shift();
		$("#ulp-layer-146 input").attr('placeholder',$("#ulp-layer-146 input").attr('placeholder')+value);
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
				
				