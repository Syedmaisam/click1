<?php
include_once "../../config/config.php";

if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
//include_once SOURCE_ROOT.'session_redirect.php';
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$objProfile = new Profile_Controller();



if(isset($_POST['submit']) && $_POST['submit']=='save')
{

	$objProfile->save_img_logo($_POST,$_FILES);
	
	$objGenral->standardRedirect(SITE_ROOT_URL.'views/settings');
}

?>

<html>
<head>
<style>
.box-header h3
{
	border-bottom:1px solid #eee;
	background:rgb(40, 55, 88);
color:#fff;
padding-left:10px;
line-height:35px;
border-radius:2px;
font-size:20px;
}
</style>

<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
<?php require_once SOURCE_ROOT.'css.php'; ?>
</head>
<body class="skin-blue">

<?php include_once SOURCE_ROOT."header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once SOURCE_ROOT."sidebar.php"; ?> 


   <!-- Right side column. Contains the navbar and content of the page -->
            <aside class="right-side">                
                <!-- Content Header (Page header) -->
                <section class="content-header">
                    <h1>
                      <i class="fa fa-desktop"></i> Installation Settings
                        <small>Setup your Theme Settings</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Settings</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 
<?php 
$backgroundImage = SITE_ROOT_URL.'images/'.$colorData[0]['logoImage'];
?>

<div class="contentpanel" style="background:#fff;border:1px solid #eee;">
                 <div class="callout callout-success alert-success altmsg" style="display:none;">
                                        <h4>Settings saved successfully...</h4>
                                        <p></p>
                                    </div> 
                     <div class="content-js-nocss">

<div class="col-md-6">
                <div class="box-header">
                  <h3 class="box-title">Manage header</h3>
                </div>
                <div class="box-body">
                  <!-- Color Picker -->
                  <div class="row">
                                  
                  <div class="form-group col-md-8">
                      <label>Select Type of Logo</label>
                      <select class="form-control" id="logoType">
                    
                        <option <?php if($colorData[0]['logoType']=="Text"){ echo "selected='selected'"; } ?> >Text</option>
                        <option <?php if($colorData[0]['logoType']=="Image"){ echo "selected='selected'"; } ?>>Image</option>
                  
                      </select>
                    </div>
                  </div>
                  <!-- Color Picker -->
                  <div class="row imgtypebox"  style="<?php if($colorData[0]['logoType']=="Image"){echo 'display:block';} else {echo 'display:none';} ?>">
                   <div class="form-group col-md-6">
                    <label>Select Logo Image( jpg, png 410px X 160px)</label>
                    <div class="input-group ">
                    <form id="imglogopre" class="form-bordered"
	enctype="multipart/form-data" name="imglogopre" method="post"
	action="<?php echo $_SERVER['PHP_SELF']; ?>">
                      <input type="file" class="form-control" id="logoimage" style="padding-bottom:40px;" name="logoimage">
                      <input type="submit" name="submit" value="save" id="igmload" style="display:none;">
              </form>
                      
                    </div><!-- /.input group -->
                  </div>
                  <div class="form-group col-md-6" style="padding-top:20px;" id="gimgpreview" style="height: 300px;width: 129px;background:url('<?php echo $backgroundImage; ?>')">
                 <img src="<?php echo $backgroundImage; ?>" style="height: 77px; width: 245px;">
                  </div>
                  </div>
                  <div class="row txttypebox"   style="<?php if($colorData[0]['logoType']=="Text"){echo 'display:block';} else {echo 'display:none';} ?>">
                  <div class="form-group col-md-4">
                    <label>Logo Text</label>
                    <div class="input-group my-colorpicker2 colorpicker-element">
                      <input type="text" class="form-control" id="logoTxt" value="<?php echo $colorData[0]['logoTxt']; ?>">
                      <div class="input-group-addon">
                        <i style="background-color: rgb(166, 115, 115);"></i>
                      </div>
                    </div><!-- /.input group -->
                  </div><!-- /.form group -->

                  <!-- time Picker -->
                  
                    <div class="form-group col-md-4">
                      <label>Logo Text Color</label>
                      <div class="input-group">
                        <input type="text" class="form-control timepicker color " id="logoTxtColor">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div><!-- /.input group -->
                    </div><!-- /.form group -->
                     
                    
                    </div>
                  </div>
                </div><!-- /.box-body -->
                
                <div class="col-md-6 stylesettingsbox">
                <div class="box-header">
                  <h3 class="box-title">Layout Design Settings</h3>
                </div>
                <div class="box-body">
                  <!-- Color Picker -->
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label>Top Bar Color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color tpbgcolor" onChange="tpbgcolor()">
                        <div class="input-group-addon">
                          <i class="fa fa-tachometer"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Top Bar Text Color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color tpbartxtcolor">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-md-6">
                      <label>Sidebar Tree View  Menu Background</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color treeviewcl" onChange="treeviewcl()">
                        <div class="input-group-addon">
                          <i class="fa fa-tachometer"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Sidebar text hover and active color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color sidebartxthovercolor" onChange="sidehovertxt()">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6" style="display:none;">
                      <label>Top bar text hover color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color tpbarhovertxt">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div>
                    </div>
                  </div>
                    <div class="row">
                  <div class="form-group col-md-6">
                      <label>Sidebar Color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color sidebarbgcolor" onChange="sidebarbgcolor()">
                        <div class="input-group-addon">
                          <i class="fa fa-tachometer"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Sidebar Text Color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color sidebartxtcolor" onChange="sidebartxtcolor()">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div>
                    </div>
                    
                  </div>
                   <div class="row">
                  <div class="form-group col-md-6">
                      <label>Login page background color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color loginpagbg">
                        <div class="input-group-addon">
                          <i class="fa fa-tachometer"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6" style='display: none;'>
                      <label>Login page copyright text color</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color copytxtcolor">
                        <div class="input-group-addon">
                          <i class="fa fa-font"></i>
                        </div>
                      </div>
                    </div>
                     <div class="form-group col-md-6">
                      <label>Logo & Profile Background</label>
                     <div class="input-group">
                        <input type="text" class="form-control timepicker color logobgcolor" onChange="logobgcolor()">
                        <div class="input-group-addon">
                          <i class="fa fa-tachometer"></i>
                        </div>
                      </div>
                    </div>
                     
                  </div>
                  <!-- Color Picker -->
                  
                  </div>
                </div><!-- /.box-body -->
                 <div class="col-md-12">
                   <div class="box-header"> <h3 class="box-title">Manage Application Settings</h3></div>
                </div>
                
                <div class="col-md-6">
                
                  <h3 class="box-title"  style="border-bottom: 1px solid rgb(204, 204, 204); padding-bottom: 10px;">Full membership</h3>
                
                <div class="box-body">
                  <!-- Color Picker -->
<div class="row">
                  <div class="form-group col-md-12">
                      <?php 
                      if($colorData[0]['SignupStatus']=="Signup Enabled")
                      {
                      ?>
                     <input type="checkbox" class="form-control signupstatus" checked="">
                     <?php 
                      }
                      else 
                      {
                     ?>
                      <input type="checkbox" class="form-control signupstatus">
                      <?php 
                      }
                      ?>
                       <label>Signup Active</label> 
                    </div>
                    </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label>Application Name</label>
                     <input type="text" class="form-control appname"  value="<?php echo $colorData[0]['AppName']; ?>">
                      
                    </div>
                    <div class="form-group col-md-6">
                      <label>Add Your Support URL</label>
                     <input type="text" class="form-control supportlink" value="<?php echo $colorData[0]['SupportLink']; ?>">
                      
                    </div>
                    </div>
                    
                     <div class="row">
                     <div class="form-group col-md-6">
                      <label>Admin Email</label>

                     <input type="text" class="form-control adminmail"   value="<?php echo $colorData[0]['AdminEmail']; ?>">
                      
                    </div>
<div class="form-group col-md-6">
                      <label>Thank You Page</label>

                     <input type="text" class="form-control thankyoupage"   value="<?php if($colorData[0]['SignupToken']!=''){echo SITE_ROOT_URL.'registration.php?regcode='.$colorData[0]['SignupToken']; } ?>" disabled="disabled">
<span
				class="input-group-btn"  style="display: block; width: 105px; position: absolute; right: 10px; margin-top: 10px;">
                    <a 
						 type="button"
						data-toggle="tooltip" data-placement="bottom"
						data_tip='<?php echo SITE_ROOT_URL."registration.php?regcode=".$colorData[0]['SignupToken']; ?>'
						class="link-copy-btn btn btn-primary mr10 button-right" id="cpy-dmc" style=""><i
						class="fa fa-arrow-left"></i> <span>Copy Page</span></a> </span>
                      
                    </div>
              
                    </div>
                    <div class="row" style="margin-top:35px;">
                     <div class="form-group col-md-12">
                    <label>Thank You Page Code</label>
                    </div>
                  <div class="form-group col-md-12">
                      
                     <input type="text" class="form-control signuptoken" value="<?php echo $colorData[0]['SignupToken']; ?>">
                     </div>
                      <div class="form-group col-md-12"><button class="btn btn-block btn-default" onClick="genrandom()">Generate Thank You Page</button></div>
                    <div class="form-group col-md-12"> 
                    
                    <!--  <button class="btn btn-block btn-primary" ><i class="fa fa-link"></i> Copy Signup Link to Clickboard</button></div> -->
                      </div>
                    </div>
                   
                    
                    
                  </div>
             
                  </div>
                   
                   <div class="row">
                
                    <div class="form-group col-md-12">
               
                     
                 <button class="btn btn-block btn-success"  onclick="savesettings()" value="save" name="submit" type="submit" >SAVE CHANGES</button>
                      
                    </div>
                    </div>
                </div><!-- /.box-body -->
               <div style="clear:both;"></div>
              </div>
       
  
        <!-- panel -->


                    </div>
                   
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script>
$(document).ready(function(){
	var loginbgcolor="<?php echo $colorData[0]['LoginPageBgColor']; ?>";
	var sidebarcolor=$(".left-side").css("background-color");
	var topbarcolor=$(".navbar-static-top").css("background-color");
	var topbartxtcolor="<?php echo $colorData[0]['TopBarTxtColor']; ?>";
	var topbartxthovercolor="<?php echo $colorData[0]['TopBarTxtHoverColor']; ?>";
	var sidebartxtcolor="<?php echo $colorData[0]['sidebartxtcolor']; ?>";
	var sidebartxtcolor="<?php echo $colorData[0]['SideBarTxtColor']; ?>";
	var sidebartxthovercolor="<?php echo $colorData[0]['SideBarTxtHoverColor']; ?>";
	var CopyRightTxtColor="<?php echo $colorData[0]['CopyRightTxtColor']; ?>";
	var LandPColor="<?php echo $colorData[0]['LandPColor']; ?>";
	var logotxtcolor="<?php echo $colorData[0]['logoTxtColor']; ?>";
	var snpstats="<?php echo $colorData[0]['SignupStatus']; ?>";
        var trialst="<?php echo $colorData[0]['trialstatus']; ?>";

	setTimeout(function(){ 
		
		$(".stylesettingsbox input").val("");
	
		$(".sidebarbgcolor").css("background-color",sidebarcolor);
		$(".tpbgcolor").css("background-color",topbarcolor);
    	$(".loginpagbg").css("background-color",loginbgcolor);
    	$(".tpbartxtcolor").css("background-color",topbartxtcolor);
    	$(".treeviewcl").css("background-color",topbartxthovercolor);
    	$(".sidebartxtcolor").css("background-color",sidebartxtcolor);
    	$(".sidebartxthovercolor").css("background-color",sidebartxthovercolor);
    	$(".copytxtcolor").css("background-color",CopyRightTxtColor);
    	$(".logobgcolor").css("background-color",LandPColor);
    	$("#logoTxtColor").css("background-color",logotxtcolor);
    	
if(snpstats=="Signup Enabled")
{
$(".signupstatus").parent().attr('aria-checked','true');
}	
if(trialst=="true")
{
$(".activetrial").parent().attr('aria-checked','true');
}	
	
	}, 500);

	//$(".sidebar-menu li a:hover").css("background-color",sidebartxthovercolor);


	
	$("#logoType").on("change",function(){
		if($("#logoType").val()=="Text")
		{
			$(".imgtypebox").css("display","none");
			$(".txttypebox").css("display","block");
		}
		else
		{
			$(".imgtypebox").css("display","block");
			$(".txttypebox").css("display","none");
		}
	});
});
$("a#cpy-dmc").zclip({
	   path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
    copy:function(){return $(this).attr('data_tip');}
 });

$("a#cpy-dmc-trial").zclip({
	   path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
 copy:function(){return $(this).attr('data_tip');}
});

</script>

<script type="text/javascript">
$(function() {
    $("#logoimage").on("change", function()
    {
        $("#gimgpreview").html("");
        var files = !!this.files ? this.files : [];
     
        if (!files.length || !window.FileReader) return; // no file selected, or no FileReader support
        
        if (/^image/.test( files[0].type)){ // only image file
            var reader = new FileReader(); // instance of the FileReader
            reader.readAsDataURL(files[0]); // read the local file
            
            reader.onloadend = function(){ // set image data as background of div
                $("#gimgpreview").css("background-image", "url("+this.result+")");
                $("#gimgpreview").css("height",300);
                $("#gimgpreview").css("width",100);
                
            }
          
            $("#igmload").click();
       
        }
       
    });
   
});
</script>
</body>
</html>
