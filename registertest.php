<style>
body
{
	padding:0px;
	margin:0px;
}
.loginArea {
    background: none repeat scroll 0 0 #ffffff;
   /* border: 1px solid #bfbfbf;
    border-radius: 2px;
    box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);*/
    margin: 0 auto;
    padding: 40px;
    width: 70%;
    margin-top:5%;
}


.smlbutton {
    background-color: #00aeef;
    border: 1px solid #00aeef;
    border-radius: 2px;
    color: #ffffff !important;
    cursor: pointer;
    display: inline-block;
    font-size: 1.4em;
    margin-left: 0 !important;
    padding: 10px 5px;
    text-align: center;
    text-decoration: none;
    width: 200px !important;
}
.loginArea .helper {
    float: right;
    margin-top: 25px;
    width: 160px;
}
.loginArea .helper a {
    color: #a3a3a3;
}
.oAuthOptionsIcons {
    border-bottom: 1px solid #cecece;
    margin-bottom: 2em;
    padding-bottom: 2em;
}
.oAuthOptionsIcons h2 {
    margin-top: 0;
}
.loginArea h2 {
    margin-bottom: 1em;
    text-align: center;
}
h2 {
    font-family: "Lato",sans-serif;
    font-size: 1.6em;
    font-weight: 400;
    line-height: 1.3;
}

.stdForm input {
    border: 1px solid #bfbfbf;
    font-size: 1.0em;
    padding: 10px;
    width: 405.5px;
      margin-bottom:10px;
}
.clickregister
{
	width:45%;
	display:block;
	float:left;
	border-right:1px solid #ccc;
}
.socialregister
{
	width:45%;
	display:block;
	float:right;
	padding-top:148px;
}
.headertop
{
	width:100%;
	height:50px;
	background:#e4e4e4;
	padding:0px;
	margin:0px;
}
#loginsubmit:hover
{
	background:#04a6e3!important;
}
</style>
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js" type="text/javascript"></script>
<script type="text/javascript" src="social/js/oauthpopup.js"></script>
<?php  require_once 'social/config.php'; ?>
<?php

require_once 'google/config.php';
require_once 'google/lib/Google_Client.php';
require_once 'google/lib/Google_Oauth2Service.php';
require_once('twitteroauth/twitteroauth.php');

/* twitter login */

$connection = new TwitterOAuth(CONSUMER_KEY, CONSUMER_SECRET);

/* Get temporary credentials. */
$request_token = $connection->getRequestToken(OAUTH_CALLBACK);
/* Save temporary credentials to session. */
$_SESSION['oauth_token'] = $token = $request_token['oauth_token'];
$_SESSION['oauth_token_secret'] = $request_token['oauth_token_secret'];
/* If last connection failed don't display authorization link. */
switch ($connection->http_code) {
  case 200:
    /* Build authorize URL and redirect user to Twitter. */
   $url = $connection->getAuthorizeURL($token);
}

   /* End twitter login */

$client = new Google_Client();
$client->setApplicationName("Google UserInfo PHP Starter Application");

$client->setClientId(CLIENT_ID);
$client->setClientSecret(CLIENT_SECRET);
$client->setRedirectUri(REDIRECT_URI);
$client->setApprovalPrompt(APPROVAL_PROMPT);
$client->setAccessType(ACCESS_TYPE);

$oauth2 = new Google_Oauth2Service($client);

if (isset($_GET['code'])) {
  $client->authenticate($_GET['code']);
  $_SESSION['token'] = $client->getAccessToken();
  echo '<script type="text/javascript">window.close();</script>'; exit;
}

if (isset($_SESSION['token'])) {
 $client->setAccessToken($_SESSION['token']);
}

if (isset($_REQUEST['error'])) {
 echo '<script type="text/javascript">window.close();</script>'; exit;
}

if ($client->getAccessToken()) {
  $user = $oauth2->userinfo->get();

  // These fields are currently filtered through the PHP sanitize filters.
  // See http://www.php.net/manual/en/filter.filters.sanitize.php
  $email = filter_var($user['email'], FILTER_SANITIZE_EMAIL);
  $img = filter_var($user['picture'], FILTER_VALIDATE_URL);
  $personMarkup = "$email<div><img src='$img?sz=50'></div>";

  // The access token may have been updated lazily.
  $_SESSION['token'] = $client->getAccessToken();
  
?>
<script type="text/javascript">
$(document).ready(function(){
var name="<?php echo $user['name']; ?>";
var fname = name.split(" ");
 $("#first_name").val(fname[0]);
 $("#email").val("<?php echo  $email; session_destroy(); ?>");
 $( "#dap_direct_signup" ).submit();
});
</script>

<?php
} else {
  $authUrl = $client->createAuthUrl();
}

?>

<script type="text/javascript">
$(document).ready(function(){

  $('#facebookbtn').oauthpopup({
		path: 'social/login.php?facebook',
		width:600,
		height:300,
   });
   
 
	
	 $('a.login').oauthpopup({
            path: '<?php if(isset($authUrl)){echo $authUrl;}else{ echo '';}?>',
			width:650,
			height:350,
        });
		$('a.logout').googlelogout({
			redirect_url:'<?php echo $base_url; ?>logout.php'
		});
   
});
</script>

<div class="headertop">
<div style="width: 30%; float: right; text-align: right; font-family: arial; padding: 15px 60px 0px 0px; color: rgb(77, 76, 76);">Already Member on Cliks.it ? <a href="http://www.cliks.it/dap" style="background: none repeat scroll 0% 0% rgb(225, 88, 75); color: white; text-decoration: none; border-radius: 4px; font-size: 14px; padding: 6px 12px; cursor:pointer;">Login</a></div>
</div>
<div class="loginArea">
      <div class="clickregister">  
<img src="images/clikslogo.png">

<!-- Social integration --><!-- Social integration -->            
          
  <h2 style="text-align:left;">Free signup with your e-mail</h2>
        <!-- Login form start -->
                  
                        <form id="dap_direct_signup" name="dap_direct_signup" method="post" action="http://cliks.it/dap/signup_submit.php" class="stdForm" novalidate ><div class="input-container email"><input type="email" value="" autofocus placeholder="Enter your first name" maxlength="255" required id="first_name" class="field" name="first_name" aria-required="true"></div><div class="input-container email"><input type="text" value="" autofocus placeholder="email@example.com" maxlength="255" required id="email" class="field" name="email" aria-required="true"></div><input type="submit" value="Submit" class="smlbutton" id="loginsubmit" name="loginbtn" style="border:none; border-radius:6px;"><input type="hidden" value="6" name="productId"><input type="hidden" value="/dap/login.php?msg=SUCCESS_CREATION" name="redirect"><div class="helper"></div></form>        <!-- Login form end -->
        
       </div>
       
       <div class="socialregister">
       <h2 style="text-align:left;">Free signup with Social Media</h2>
       <div class="socialicon">
       
      <?php
 if(!isset($_SESSION['User'])) {   
 

 
 ?>
 <div  style="float:left;width:100%; text-align:left;">
 
  	 <img src='IMAGE/facebook.png' id='facebookbtn'  style='cursor:pointer;float:left;margin-right:10%;'  alt="Sign in with Facebook"/>


 
<?php
  if(isset($authUrl)) 
  {
 
    print "<a class='login' href='javascript:void(0);' style='float:left;margin-right:10%;display:block;'><img alt='Signin in with Google' src='IMAGE/google.png' /></a>";
  }
?>


   


 <?php  } else { 
    if(isset($_SESSION['facebook_logout'])){  
?>  

	 
	 <script type="text/javascript">
	 $(document).ready(function()
	 {

	 	 $("#first_name").val("<?php echo  $_SESSION['User']['name']; ?>");
		 $("#email").val("<?php echo  $_SESSION['User']['email']; session_destroy(); ?>");
		
		 $( "#dap_direct_signup" ).submit();
	 });
	 </script>
  
<?php }
    else{
  ?>
     <img src="<?php echo $_SESSION['User']['picture']; ?>" width="50" /><div><?php echo $_SESSION['User']['name'];?></div>
     <div><?php echo $_SESSION['User']['email']; ?></div>
       <a class='google_logout' href='javascript:void(0);'>Logout</a>
  <?php
	}
  }

   ?>

      <img alt='Signin in with twitter' src='IMAGE/twitter.png' id="tw" style="cursor:pointer;" onclick="window.open('<?php echo $url; ?>', 'Twitter Auth', 'width=500, height=600');" />
       </div>
      

   </div> 
       
       </div>
       <div style="display:block; clear:both;"></div>
</div>

<div style="display:block; width:100%; height:100%;left:0; top:0; position:fixed; background:#000;opacity:0.7; display:none;" id="blackscreen"></div>
<div style="width: 500px; height: 300px; position: fixed; top: 20%; left: 35%; margin: auto; z-index: 1000; border-radius: 10px; border: 5px solid #00aeef; background:#f8f8f8; padding:20px;display:none;" id="twindow">

<p style="text-align:center;font-family:'Arial'; font-size:30px; color:#00aeef;">Enter your email id to verify</p>
<p style="text-align:center;"><input type="text" name="twemail" id="twemail" style="border: 1px solid rgb(204, 204, 204); padding:5px; height: 45px; width: 90%; border-radius: 10px;"></p>
<p style="text-align:center;font-family:'Arial'; font-size:30px;"><input type="button" id="twsub" value="Submit" style="width: 70%; height: 50px;cursor:pointer; border-radius: 5px; color: rgb(255, 255, 255); border: 1px solid rgb(0, 174, 239); background: none repeat scroll 0% 0% rgb(0, 174, 239); font-size: 27px; text-transform: uppercase;"></p>
<p style="text-align: center; color: red; font-family: arial; padding: 5px; background: none repeat scroll 0% 0% rgb(238, 238, 238); border-radius: 5px; border: 1px solid rgb(204, 204, 204);display:none;" id="terror">Please enter valid email id</p>

</div>

<script type="text/javascript">
$(document).ready(function()
{
var tname="<?php echo $_SESSION['access_token']['screen_name']; ?>";
if(tname!="")
{
$("#blackscreen").show();
$("#twindow").show();
}

});


$("#twsub").click(function()
{
var tmail=$("#twemail").val();

var temail = document.getElementById('twemail');
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;

    if (!filter.test(temail.value)) {
    email.focus;
	$("#terror").show();
    return false;
	}
else
{
var tname="<?php echo $_SESSION['access_token']['screen_name']; ?>";
	$("#terror").hide();
	

$.ajax({
		type: "post",
		url:'twsession_destroy.php',
		data: {
		tname: tname,
			},
				
	success: function(response) {
	
	
$("#first_name").val(tname);
$("#email").val(tmail);
	 $( "#dap_direct_signup" ).submit();
	
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	});  



}



});
</script>
