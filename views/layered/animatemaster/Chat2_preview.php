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
    text-align: center;
    z-index: 1000007;
}
#ulp-layer-141, #ulp-layer-141 p, #ulp-layer-141 a, #ulp-layer-141 span, #ulp-layer-141 li, #ulp-layer-141 input, #ulp-layer-141 button, #ulp-layer-141 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 700;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
#ulp-layer-142 {
    background-color: rgba(255, 67, 0, 0.9);
    text-align: left;
    z-index: 1000008;
}
#ulp-layer-142, #ulp-layer-142 p, #ulp-layer-142 a, #ulp-layer-142 span, #ulp-layer-142 li, #ulp-layer-142 input, #ulp-layer-142 button, #ulp-layer-142 textarea {
    color: #000000;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
#ulp-layer-143 {
    text-align: center;
    z-index: 1000007;
}
#ulp-layer-143, #ulp-layer-143 p, #ulp-layer-143 a, #ulp-layer-143 span, #ulp-layer-143 li, #ulp-layer-143 input, #ulp-layer-143 button, #ulp-layer-143 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
#ulp-layer-144 {
    text-align: left;
    z-index: 1000009;
}
#ulp-layer-144, #ulp-layer-144 p, #ulp-layer-144 a, #ulp-layer-144 span, #ulp-layer-144 li, #ulp-layer-144 input, #ulp-layer-144 button, #ulp-layer-144 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}

#ulp-layer-144 input.ulp-input {
    padding-left: 34px !important;
}
#ulp-ZmwusaSkhcNxxjsL .ulp-input, #ulp-ZmwusaSkhcNxxjsL .ulp-input:hover, #ulp-ZmwusaSkhcNxxjsL .ulp-input:active, #ulp-ZmwusaSkhcNxxjsL .ulp-input:focus {
    background-color: rgba(0, 0, 0, 0) !important;
    border-color: #ff4300;
    border-radius: 0 !important;
    border-width: 2px !important;
}
#ulp-layer-144, #ulp-layer-144 p, #ulp-layer-144 a, #ulp-layer-144 span, #ulp-layer-144 li, #ulp-layer-144 input, #ulp-layer-144 button, #ulp-layer-144 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-input {
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0);
    border-radius: 2px !important;
    border-spacing: 0 !important;
    border-style: solid !important;
    border-width:2px !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
    clear: both !important;
    font-size: inherit !important;
    height: 100% !important;
    line-height: 1.5 !important;
    margin: 0 !important;
    padding: 0 6px !important;
    vertical-align: middle !important;
    width: 100% !important;
	border-color:#ff4300;
}
input:-moz-read-write, textarea:-moz-read-write {
    -moz-user-modify: read-write !important;
}
input {
    -moz-appearance: textfield;
    -moz-binding: url("chrome://global/content/platformHTMLBindings.xml#inputFields");
    -moz-user-select: text;
    cursor: text;
    font: ;
    letter-spacing: normal;
    line-height: normal;
    padding: 1px;
    text-align: start;
    text-indent: 0;
    text-rendering: optimizelegibility;
    text-shadow: none;
    text-transform: none;
    word-spacing: normal;
}
textarea > .anonymous-div, input > .anonymous-div, input::-moz-placeholder, textarea::-moz-placeholder, *|*::-moz-button-content, *|*::-moz-display-comboboxcontrol-frame, optgroup:before {
    text-overflow: inherit;
    unicode-bidi: inherit;
}
input::-moz-placeholder, textarea::-moz-placeholder {
    display: inline-block !important;
    opacity: 0.54;
    overflow: hidden !important;
    pointer-events: none !important;
    resize: none !important;
}
textarea > .anonymous-div, input > .anonymous-div, input::-moz-placeholder, textarea::-moz-placeholder {
    -moz-control-character-visibility: visible;
    border: 0 none !important;
    display: inline-block;
    ime-mode: inherit;
    margin: 0;
    overflow: auto;
    padding: inherit !important;
    resize: inherit;
    text-decoration: inherit;
    white-space: pre;
}
input > .anonymous-div, input::-moz-placeholder {
    line-height: -moz-block-height;
    word-wrap: normal !important;
}
.ulp-fa-input-table {
    display: table;
    height: 100%;
    left: 0;
    line-height: 100%;
    position: absolute;
    top: 0;
    vertical-align: middle;
}

#ulp-layer-144 div.ulp-fa-input-cell {
    padding-left: 4px !important;
    width: 30px !important;
}
.ulp-fa-input-cell {
    display: table-cell;
    opacity: 0.7;
    text-align: center;
    vertical-align: middle;
}
.fa-user:before {
    content: "";
}
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}
#ulp-layer-145 {
    text-align: left;
    z-index: 1000009;
}
#ulp-layer-145, #ulp-layer-145 p, #ulp-layer-145 a, #ulp-layer-145 span, #ulp-layer-145 li, #ulp-layer-145 input, #ulp-layer-145 button, #ulp-layer-145 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
#ulp-layer-145 input.ulp-input {
    padding-left: 34px !important;
}
#ulp-ZmwusaSkhcNxxjsL .ulp-input, #ulp-ZmwusaSkhcNxxjsL .ulp-input:hover, #ulp-ZmwusaSkhcNxxjsL .ulp-input:active, #ulp-ZmwusaSkhcNxxjsL .ulp-input:focus {
    background-color: rgba(0, 0, 0, 0) !important;
    border-color: #ff4300;
    border-radius: 0 !important;
    border-width: 2px !important;
}
#ulp-layer-145, #ulp-layer-145 p, #ulp-layer-145 a, #ulp-layer-145 span, #ulp-layer-145 li, #ulp-layer-145 input, #ulp-layer-145 button, #ulp-layer-145 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-input {
    background: none repeat scroll 0 0 rgba(255, 255, 255, 0);
    border-radius: 2px !important;
    border-spacing: 0 !important;
    border-style: solid !important;
    border-width: 2px !important;
    box-shadow: none !important;
    box-sizing: border-box !important;
    clear: both !important;
    font-size: inherit !important;
    height: 100% !important;
    line-height: 1.5 !important;
    margin: 0 !important;
    padding: 0 6px !important;
    vertical-align: middle !important;
    width:84% !important;
    margin: 0 0 0 15px !important;
	
}
input:-moz-read-write, textarea:-moz-read-write {
    -moz-user-modify: read-write !important;
}
input {
    -moz-appearance: textfield;
    -moz-binding: url("chrome://global/content/platformHTMLBindings.xml#inputFields");
    -moz-user-select: text;
    cursor: text;
    font: ;
    letter-spacing: normal;
    line-height: normal;
    padding: 1px;
    text-align: start;
    text-indent: 0;
    text-rendering: optimizelegibility;
    text-shadow: none;
    text-transform: none;
    word-spacing: normal;
}
textarea > .anonymous-div, input > .anonymous-div, input::-moz-placeholder, textarea::-moz-placeholder, *|*::-moz-button-content, *|*::-moz-display-comboboxcontrol-frame, optgroup:before {
    text-overflow: inherit;
    unicode-bidi: inherit;
}
input::-moz-placeholder, textarea::-moz-placeholder {
    display: inline-block !important;
    opacity: 0.54;
    overflow: hidden !important;
    pointer-events: none !important;
    resize: none !important;
}
textarea > .anonymous-div, input > .anonymous-div, input::-moz-placeholder, textarea::-moz-placeholder {
    -moz-control-character-visibility: visible;
    border: 0 none !important;
    display: inline-block;
    ime-mode: inherit;
    margin: 0;
    overflow: auto;
    padding: inherit !important;
    resize: inherit;
    text-decoration: inherit;
    white-space: pre;
}
input > .anonymous-div, input::-moz-placeholder {
    line-height: -moz-block-height;
    word-wrap: normal !important;
}
#ulp-layer-145 div.ulp-fa-input-cell {
    padding-left: 4px !important;
    width: 30px !important;
}
.ulp-fa-input-cell {
    display: table-cell;
    opacity: 0.7;
    text-align: center;
    vertical-align: middle;
}
.fa-envelope:before {
    content: "";
}
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}
#ulp-layer-146 {
    text-align: center;
    z-index: 1000009;
}
#ulp-layer-146, #ulp-layer-146 p, #ulp-layer-146 a, #ulp-layer-146 span, #ulp-layer-146 li, #ulp-layer-146 input, #ulp-layer-146 button, #ulp-layer-146 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
.ulp-inherited:before {
    content: "";
    display: inline-block;
    height: 100%;
    padding-top: 3px;
    vertical-align: middle;
}
#ulp-ZmwusaSkhcNxxjsL .ulp-submit, #ulp-ZmwusaSkhcNxxjsL .ulp-submit:visited {
    background: none repeat scroll 0 0 #ff4300;
    border: 1px solid #ff4300;
    border-radius: 0 !important;
    box-shadow: -4px -4px 0 rgba(0, 0, 0, 0.1) inset;
}
#ulp-layer-146, #ulp-layer-146 p, #ulp-layer-146 a, #ulp-layer-146 span, #ulp-layer-146 li, #ulp-layer-146 input, #ulp-layer-146 button, #ulp-layer-146 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-window a {
    text-decoration: none !important;
}
.ulp-inherited {
    box-sizing: border-box !important;
    display: block !important;
    height: 100% !important;
}
.ulp-submit, .ulp-submit:visited, .ulp-submit-button, .ulp-submit-button:visited {
    border-radius: 2px;
    cursor: pointer;
    display: inline-block;
    font-size: inherit !important;
    height: auto;
    line-height: 1.5;
    margin: 0;
    padding: 5px 20px;
    position: relative;
    text-decoration: none !important;
    text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
    transition-duration: 0.3s;
    white-space: nowrap;
    width: auto;
}
a, a:active, a:hover {
    outline: medium none;
}
.fa-check-square-o:before {
    content: "";
}
.fa {
    display: inline-block;
    font-family: FontAwesome;
    font-feature-settings: normal;
    font-kerning: auto;
    font-language-override: normal;
    font-size: inherit;
    font-size-adjust: none;
    font-stretch: normal;
    font-style: normal;
    font-synthesis: weight style;
    font-variant: normal;
    font-weight: normal;
    line-height: 1;
    text-rendering: auto;
}
#ulp-layer-146, #ulp-layer-146 p, #ulp-layer-146 a, #ulp-layer-146 span, #ulp-layer-146 li, #ulp-layer-146 input, #ulp-layer-146 button, #ulp-layer-146 textarea {
    color: #ffffff;
}
.ulp-submit, .ulp-submit:visited, .ulp-submit-button, .ulp-submit-button:visited {
    cursor: pointer;
    font-size: inherit !important;
    text-shadow: 0 -1px 1px rgba(0, 0, 0, 0.25);
    white-space: nowrap;
}
#ulp-layer-147 {
    text-align: center;
    z-index: 1000007;
}
#ulp-layer-147, #ulp-layer-147 p, #ulp-layer-147 a, #ulp-layer-147 span, #ulp-layer-147 li, #ulp-layer-147 input, #ulp-layer-147 button, #ulp-layer-147 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
	
}
.ulp-layer {
    box-sizing: border-box;
    line-height: 1.475;
    position: absolute;
}
#ulp-layer-148 {
    background-color: rgba(255, 67, 0, 0.9);
    line-height: 32px;
    text-align: center;
    z-index: 1000009;
}
#ulp-layer-148, #ulp-layer-148 p, #ulp-layer-148 a, #ulp-layer-148 span, #ulp-layer-148 li, #ulp-layer-148 input, #ulp-layer-148 button, #ulp-layer-148 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-layer {
    box-sizing: border-box;
    position: absolute;
}
#ulp-layer-148, #ulp-layer-148 p, #ulp-layer-148 a, #ulp-layer-148 span, #ulp-layer-148 li, #ulp-layer-148 input, #ulp-layer-148 button, #ulp-layer-148 textarea {
    color: #ffffff;
    font-family: "arial",arial;
    font-weight: 400;
}
.ulp-window a {
    text-decoration: none !important;
}
a, .contactForm input[type="text"]:focus, .contactForm input[type="email"]:focus, .contactForm textarea:focus, input#formSubmit, .errorForm, #subscribe input[type="email"]:focus, .errorSubs, .servSingle, #toTop i, #notForm input[type="email"]:focus, .contactForm input#submit, #loginForm input, #loginForm input[type="text"]:focus, #loginForm input[type="password"]:focus {
    transition: all 0.5s ease 0s;
}
a, a:active, a:hover {
    outline: medium none;
}

.ulp-submit{
    background: none repeat scroll 0 0 #ff4300;
    border: 1px solid #ff4300;
    border-radius: 0 !important;
    box-shadow: -4px -4px 0 rgba(0, 0, 0, 0.1) inset;
}

</style>


<div id='popupform_preview' style="display:none;"><div class="ulp-content" style="z-index:99999;width: 550px; height: 410px; margin:auto;position:fixed; left:28%; top:15%;">
							<div id="ulp-layer-139" class="ulp-layer" style="width: 550px; height: 410px; font-size: 14px; left: 0px; top: 0px; display: block; background:#34495e;"></div>
							<div id="ulp-layer-140" class="ulp-layer" style="width: 550px; height: 410px; font-size: 14px; left: 0px; top: 0px; display: block;"></div>
							<div id="ulp-layer-141" class="ulp-layer animated bounceInDown" style="width: 550px; left: 0px; font-size: 30px; top: 35px;">Customer Service</div>
							<div id="ulp-layer-144" class="ulp-layer animated fadeInLeftBig" style="font-size: 15px; top: 115px; float: right; width: 264px; height: 190px; left: 248px;">
                            <img src="http://www.cliks.it/click/IMAGE/side img.png"/ style="float: left; left: 16px; height: 242px; margin-left: -218px; border: 1px solid rgb(255, 255, 255); border-radius:4px;">
                            <textarea disabled='disabled' id="prview_textarea" class="ulp-input" name="ulp-message" placeholder="50% off this product today" onfocus="jQuery(this).removeClass('ulp-input-error');" style="border-radius: 6px ! important; background:#f9fafe; color:#000; font-size:16px!important; padding:12px!important; border:1px solid#e0e0e0;"></textarea><div class="ulp-fa-input-table"><div class="ulp-fa-input-cell"></div></div></div>
							<div id="ulp-layer-146" class="ulp-layer animated lightSpeedIn" style="height: 42px; font-size: 17px; top: 315px; width:95px; left: 290px;"><a data-loading="PLEASE WAIT!" data-label="SUBSCRIBE NOW!" data-icon="fa-check-square-o" onclick="return ulp_subscribe(this);" class="ulp-submit ulp-inherited" style="padding-left: 6px; background: none repeat scroll 0% 0% rgb(92, 50, 108); border: 1px solid rgb(255, 255, 255);">&nbsp; CHAT</a></div>
							<div id="ulp-layer-148" class="ulp-layer" style="width: 32px; height: 32px; font-size: 32px; left: 518px; top: 0px;  background:rgb(51, 51, 51);"><a onclick="return ulp_self_close();" href="#">x</a></div>
						</div>

			
					
						
					<div id="blackscreen" style='width:100%; height:100%; background:#000; opacity:0.7; top:0; left:0; position:fixed; z-index:20000; display:none;'></div>
					</div>
						
<script>
function ulp_self_close()
{
	$("#popupform_preview").hide();
	$("#blackscreen").hide();
	$("#popup_content_data").html('');
}
</script>
				<script type="text/javascript" lang="javascript">

var text= "50% off this product today.";
var arr=text.split("");
var looptimer;
var audio=new Audio("<?php echo SITE_ROOT_URL.'views/layered/' ?>animatemaster/Chat Welcome Alert 2.mp3");
		audio.play();
function frameLooper()
{
	
	if(arr.length>0)
	{
		value=arr.shift();
		$("#ulp-layer-144  #prview_textarea").append(value);
		$("#Textbox_txt").val($("#Textbox_txt").val());
		
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
            