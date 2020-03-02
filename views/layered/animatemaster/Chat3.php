<link rel="stylesheet" href="animate.min.css">
<script type="text/javascript" src="<?php echo SITE_ROOT_URL; ?>colorjs/jscolor.js"></script>
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
table
{
	margin:20px;
	background:#f8f8f8;
	
}
table td
{
	padding:10px;
	border:1px solid #ccc;
}
table td label
{
	font-family:Arial, Helvetica, sans-serif;
	font-size:14px;
	font-weight:normal;
}
table td input[type='text']
{
	border:none;
	padding:10px;
	font-size:12px;
	font-weight:normal;
	border:1px solid #ccc;
	width:300px;
}
table td textarea
{
	width:300px;
	font-size:12px;
}

*{
  font-family:'Helvetica Neue',Helvetica, sans-serif;
  font-size:14px;
  margin:0;
}

.container{
  width:400px;
  display:block;
  margin:0 auto;
  box-shadow:0 2px 5px rgba(0,0,0,0.4);
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

<?php 
	 $txthtml="<div id='popupform' style='position:relative;'><div class='ulp-content' style='width: 550px; height: 410px; margin: 10% auto auto;'>
		<a class='linkanchor' href='http://www.google.com'><div id='ulp-layer-141' class='ulp-layer animated bounceInDown' style='width: 550px; font-size: 24px; left: 0px; top:45px;'>
        <div style=' box-shadow: 0 2px 5px rgba(0, 0, 0, 0.4);display: block;margin: 0 auto;width: 400px;'>
        <div id='ulp-layer-142' class=' animated zoomInDown' style='background: none repeat scroll 0px 0px rgb(95, 180, 113); color: rgb(255, 255, 255); padding: 15px; font-weight: bold; line-height: 26px;'><h2 style='display: inline-block; margin-bottom: 10px; margin-top: 10px; margin-left: 13px;  font-weight: bold; font-size: 16px;'>Messages</h2></div>
		<div id='ulp-layer-143' class='chat-box' style='background: none repeat scroll 0 0 #ececec;'>
		<div id='ulp-layer-144' class='message-box left-img  animated slideInLeft'>
		<div class='picture' style='margin-left:30px;'>
        <img src='http://www.cliks.it/click/IMAGE/profile_pic.png' title='user name'/>
        <span class='time'>10 mins</span>
		</div>
		<div class='message'>
        <span>San Thomas</span>
        <p>Hey Mike, how are you doing?</p>
		</div>
		</div>
		<div id='ulp-layer-145' style='margin-left: 30px' class='message-box right-img animated animated slideInRight'>
		<div class='picture' style='margin-right: 45px;'>
        <img src='http://www.cliks.it/click/IMAGE/profile_pic1.png' title='user name'/>
        <span class='time'>2 mins</span>
		</div>
		<div class='message'>
        <span>Randhir</span>
        <p>Pretty good, Eating nutella, nommommom</p>
      </div>
    </div>
    <div id='ulp-layer-146' class='enter-message animated bounceInDown'>
      <input disabled='disabled' type='text' style='margin-left: 0px;' placeholder='hey friendss.what are you doing'/>
      <a href='#' class='send' style='color:#fff;margin-right: 30px;'>Send</a>
    </div>
  </div>
</div>
<div id='ulp-layer-148' class='ulp-layer' style='width: 32px; height: 32px; font-size: 32px; left: 443px; top: 0px;text-align:center;  background:rgb(51, 51, 51);'><a onclick='return ulp_self_close();'href='#'>x</a></div>
	</div>
		</div></a>
		</div>";
	 
echo $txthtml; 
	?>
						
<table width="97%" border="0">
  <tr>
  <td><label>Popup Background Color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="popbgcolor" onchange="popup_bg();"></td>
      <td><label>Popup Background Text :</label></td>
    <td><input type="text" value="" id="popup_txt" onkeyup="popup_txt();" onblur="popup_txt();" maxlength="50" /></td>
    </tr>
    <tr>
     <td><label>PopUp Color:</label></td>
    <td><input class="color boxcolor" value="66ff00" id="popup_color" onchange="popup_color();"></td>
     <td><label>Popup Background Text Color :</label></td>
     <td><input class="color boxcolor" value="66ff00" id="popuptxt_color" onchange="popuptxt_color();"></td>
    </tr>
    <tr>
    <td><label>Layer one Color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="layer1_color" onchange="layer1_color();"></td>
    <td><label>Layer One Text :</label></td>
    <td><input type="text" value="" id="layer1_txt" onkeyup="layer1_txt();" onblur="layer1_txt();" maxlength="30" /></td>
     </tr>
      <tr>
      <td><label>Layer one PlaceholderColor :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="layer1_placeholdercolor" onchange="layer1_placeholdercolor();"></td>
     <td><label>Layer One PlaceholderText :</label></td>
    <td><input type="text" value="" id="layer1_placeholdertxt" onkeyup="layer1_placeholdertxt();" onblur="layer1_placeholdertxt();" maxlength="30" /></td>
    </tr>
    <tr>
    <td><label>Layer two PlaceholderColor :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="layer2_placeholdercolor" onchange="layer2_placeholdercolor();"></td>
    <td><label>Layer two PlaceholderText :</label></td>
    <td><input type="text" value="" id="layer2_placeholdertxt" onkeyup="layer2_placeholdertxt();" onblur="layer2_placeholdertxt();" maxlength="30" /></td>
   </tr>
  
   <tr>
    <td><label>Layer two Color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="layer2_color" onchange="layer2_color();"></td>
    <td><label>Layer two Text :</label></td>
    <td><input type="text" value="" id="layer2_txt" onkeyup="layer2_txt();" onblur="layer2_txt();" maxlength="30" /></td>
    
  </tr>
  
  
 <tr>
     <td><label>Placeholder text color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="placeholdertxt_color" onchange="placeholdertxt_color();"></td>
     <td><label>Placeholder background color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="placeholderbg_color" onchange="placeholderbg_color();"></td>
    </tr>
    <tr>
    <td><label>Button Text Color:</label></td>
    <td><input class="color boxcolor" value="66ff00" id="button1_color" onchange="button1_color();"></td>
    <td><label>Button Background Color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="button1_bkgcolor" onchange="button1_bkgcolor();"></td>
    </tr>
    <tr>
    <td><label>Button Text :</label></td>
    <td><input type="text" value="" id="button1_txt" onkeyup="button1_txt();" onblur="button1_txt();" maxlength="6"/></td>
    <td><label>Button Close Color :</label></td>
    <td><input class="color boxcolor" value="66ff00" id="buttonclose_bkgcolor" onchange="buttonclose_bkgcolor();"></td>
  
  </tr>
  <tr>
  <td><label>Image Url1 :</label></td>
    <td><input type="text" value="" id="img1_txt" onkeyup="img1_txt();" onblur="img1_txt();" /></td>
      <td><label>Textbox Text :</label></td>
    <td><input type="text" value="" id="Textbox_txt" onkeyup="Textbox_txt();" onblur="Textbox_txt();" /></td>
   </tr>
   
    <tr>
  <td><label>Image Url2 :</label></td>
    <td><input type="text" value="" id="img2_txt" onkeyup="img2_txt();" onblur="img2_txt();" /></td>
     <td><label>Destination Url :</label></td>
    <td><input type="text" value="" id="DestinationUrl_txt" onkeyup="Destination_txt();" onblur="Destination_txt();" /></td>
   </tr>
 
</table>
    
<script type="text/javascript">
function pop_layer_data()
{
	var popuptext=$("#ulp-layer-142").text();
	var layer1_txt=$("#ulp-layer-144 .message span").html();
	var layer2_txt=$("#ulp-layer-145 .message span").html();
	var layer1_placeholdertext=$("#ulp-layer-144 .message p").html();
	var layer2_placeholdertext=$("#ulp-layer-145 .message p").html();
	var imageurl1=$("#ulp-layer-144 img").attr('src');
	var imageurl2=$("#ulp-layer-145 img").attr('src');
	var url_txt=$(".linkanchor").attr('href');
	$("#DestinationUrl_txt").val(url_txt);

	var button1_txt=$("#ulp-layer-146 .send").html();
	 var txtvalue=$("#ulp-layer-146 input").attr('placeholder');
    $("#Textbox_txt").val(txtvalue);
    $("#popup_txt").val(popuptext);
	$("#layer1_txt").val(layer1_txt);
	$("#layer1_placeholdertxt").val(layer1_placeholdertext);
	$("#layer2_placeholdertxt").val(layer2_placeholdertext);
	$("#layer2_txt").val(layer2_txt);
	$("#img1_txt").val(imageurl1);
	$("#img2_txt").val(imageurl2);
	
	$("#button1_txt").val(button1_txt);

}
var Pathname =  window.location.pathname;
						function popup_bg()
						{
							
							var popbgcolor="#"+$("#popbgcolor").val();
							$("#ulp-layer-142").css("background-color",popbgcolor);
						}
						function popup_color()
						{
							var popup_color="#"+$("#popup_color").val();
							$("#ulp-layer-143").css("background-color",popup_color);
						}
						function popup_txt()
						{
							var layer1_txt=$("#popup_txt").val();
							$("#ulp-layer-142").html(layer1_txt);
						}
						function popuptxt_color()
						{
							var fcolor="#"+$("#popuptxt_color").val();
							$("#ulp-layer-142").css("color",fcolor);
							
						}
						
						function layer1_color()
						{
							var fcolor="#"+$("#layer1_color").val();
							$("#ulp-layer-144 .message span").css("color",fcolor);
						}
						function layer1_txt()
						{
							var layer1_txt=$("#layer1_txt").val();
							$("#ulp-layer-144 .message span").html(layer1_txt);
						}
						function layer1_placeholdercolor()
						{
							var fcolor="#"+$("#layer1_placeholdercolor").val();
							$("#ulp-layer-144 .message p").css("color",fcolor);
							
						}
						function layer1_placeholdertxt()
						{
							var layer1_txt=$("#layer1_placeholdertxt").val();
							$("#ulp-layer-144 .message p").html(layer1_txt);
							
						}
						function layer2_placeholdercolor()
						{
							var fcolor="#"+$("#layer2_placeholdercolor").val();
							$("#ulp-layer-145 .message p").css("color",fcolor);
							
						}
						function layer2_placeholdertxt()
						{
							var layer2_txt=$("#layer2_placeholdertxt").val();
							$("#ulp-layer-145 .message p").html(layer2_txt);
						}

						function layer2_color()
						{
							var fcolor="#"+$("#layer2_color").val();
							$("#ulp-layer-145 .message span").css("color",fcolor);
						}
						function layer2_txt()
						{
							var layer2_txt=$("#layer2_txt").val();
							$("#ulp-layer-145 .message span").html(layer2_txt);
						}
						function placeholder1_txt()
						{
							var placeholder1_txt=$("#placeholder1_txt").val();
							$("#ulp-layer-146 input").attr('placeholder',placeholder1_txt);
						}
						function placeholdertxt_color()
						{
							var fcolor="#"+$("#placeholdertxt_color").val();
							$("#ulp-layer-146 input").css("color",fcolor);
							
						}
						function placeholderbg_color()
						{

							var popbgcolor="#"+$("#placeholderbg_color").val();
							$("#ulp-layer-146 input").css("background-color",popbgcolor);
							
						}
						function img1_txt()
						{
							var image1_txt=$("#img1_txt").val();
							$("#ulp-layer-144 img").attr('src',image1_txt);
						}
						function img2_txt()
						{
							var image2_txt=$("#img2_txt").val();
							$("#ulp-layer-145 img").attr('src',image2_txt);
						} 
						function button1_color()
						{
							var fcolor="#"+$("#button1_color").val();
							$("#ulp-layer-146 .send").css("color",fcolor);
						}
						function button1_bkgcolor()
						{
							var button1_bkgcolor="#"+$("#button1_bkgcolor").val();
							$("#ulp-layer-146 .send").css('background',button1_bkgcolor);
						}
						function button1_txt()
						{
							var button1_txt=$("#button1_txt").val();
							$("#ulp-layer-146 .send").html(button1_txt);
						}
						function Textbox_txt()
						{
							var fetch_txt=$("#Textbox_txt").val();
							$("#ulp-layer-146 input").attr('placeholder',fetch_txt);
						    var audio=new Audio("http://www.cliks.it/click/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
							audio.play();
						
						}
						function Destination_txt()
						{
							var url_txt=$("#DestinationUrl_txt").val();
							$(".linkanchor").attr('href',url_txt);	
						}
						
						
						
						
						function buttonclose_bkgcolor()
						{
							var bkgcolor="#"+$("#buttonclose_bkgcolor").val();
							//alert(bgcolor);
							$("#ulp-layer-148").css("background-color",bkgcolor);
						}
						</script>
					<script type="text/javascript" lang="javascript">
					
										var textval= $("#ulp-layer-146 input").attr('placeholder')//"Hey Friends .How Are you. Everything is Ok? What are you doing.";
										var arr=textval.split("");
										var looptimer;
										audio=new Audio(SITE_ROOT_URL + "/views/layered/animatemaster/Chat Welcome Alert 2.mp3");
										audio.play();
										function frameLooper()
										{
											var audio;
											
										  if(Pathname == "/click/views/layered/add.php")
										    { 
												
											    if(arr.length>0)
												{
													value=arr.shift();
													$("#ulp-layer-146 input").attr('placeholder'+value);
													//$("#ulp-layer-146 input").attr('placeholder',$("#ulp-layer-146 input").attr('placeholder')+value);
													
												}
												else
												{
													clearTimeout(looptimer);
												}
											    looptimer=setTimeout('frameLooper()',80);
											}
										}
										frameLooper();
						

</script>	
						