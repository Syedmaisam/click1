<?php
include_once "../../config/config.php";
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objProfile = new Profile_Controller();
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink($arrUrl[1]);
$linkdata = $arrLinkData[0];
$arrData = $objProfile->get_profile();
if($arrUrl[1]!='' && count($arrLinkData) > 0){
if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
	$objJustLink->update_link($_POST);
}
?>

<html>
<head>
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
                      <i class="fa fa-link"></i> Links
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Links</a></li>
						<input type="hidden" name="id" id="id" value="<?php echo $linkdata['id']; ?>"/>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<div class="contentpanel">
           <div style="height:40px;"></div>
                                    
                                    <div class="col-sm-12 col-sm-12">
                                    <div style="width:60%; margin:auto;" >
                                    
                                    <div class="nav-tabs-custom" style="box-shadow:2px 1px 20px rgba(20, 9, 12, 0.19);">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-pencil"></i> Customize</a></li>
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active custurl" id="tab_1">
                                  
               <div  class="input-group col-sm-12">
                 <label for="generatorSource">Campaign Name <small style="color: red;">*</small> </label>
                 <small id="link_name_req" style="color: red;display: none;"> Required</small>
                 <input type="text" value="<?php echo $linkdata['link_name']; ?>" placeholder="e.g. The content or article you want to share" class="form-control required" id="link_name" name="link_name" aria-required="true">
                                                                   
               </div>
  <div class="input-group col-sm-12">
   <label for="generatorSource">Profile <small style="color: red;">*</small> </label>
   <small id="linkProfile_req" style="color: red;display: none;"> Required</small>
                        <select class="form-control input-sm valid" id="linkProfile" name="profile" aria-required="true" aria-invalid="false">
                        <option value="">Select Profile</option>
						<?php foreach ($arrData as $dataP){ ?>
                            <option value="<?php echo ($dataP['id']); ?>" <?php echo ($dataP['id']==$linkdata['profile_id'])?'selected':''; ?>><?php echo $dataP['profile_name']; ?></option>
                            <?php } ?>
                            </select>
                                    </div>    
                                    
                                     <div  class="input-group col-sm-12">
                 <label for="generatorSource">Destination Url <small style="color: red;">*</small> </label>
                 <small id="d_url_req" style="color: red;display: none;"> Required</small>
                 <small id="invalidurl_req" style="color: red;display: none;">Invalid Url</small>
                 <input type="text" value="<?php echo $linkdata['destination_url']; ?>"  class="form-control" id="d_url" name="d_url" aria-required="true" placeholder="e.g. http://example.com" onBlur="linkBlurJustLink()">
                                                                   
               </div>                    
                <div  class="input-group col-sm-12">
                 <label for="generatorSource">Link URL <small style="color: red;">*</small> </label>
                 <small id="ururl_req" style="color: red;display: none;"> Required</small>
                 <small id="validurl_req" style="color: red;display: none;">Invalid Url</small>
                 <input type="text" value="<?php echo $linkdata['link_url']; ?>"  class="form-control" id="ururl" name="source" aria-required="true" placeholder="e.g. http://www.awesomeproduct.com" onBlur="linkBlurJustLinkYourUrl()>
                                                                   
               </div>   
               
               <div  class="input-group col-sm-12" style="padding-top:10px; padding-bottom:10px;"> 
                <input type="checkbox" <?php echo ($linkdata['masking']==1)?"checked":""; ?> name="mask" id="mask" style="opacity:1!important;" > Enable Mask
                </div> 
               <div  class="input-group col-sm-12" style="padding-top:10px; padding-bottom:10px;"> 
                <input type="button" value="Update" onClick="update_link_validation()"  class="btn btn-primary mb10" name="submit" style="width:100%;">                                                   </div>             
                                   
                                    </div>
                                    
                                                  
                                </div><!-- /.tab-content -->
                            </div>
                                    <div style="clear:both"></div>
                                    </div>
                                    
                                    </div>
                                    
                                    </div>

                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
</html>
<?php } ?>