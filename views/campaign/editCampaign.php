<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objProfile = new Profile_Controller();
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->get_campaign($arrUrl[1]);
$campaignData = $arrCampaignData[0];
$arrData = $objProfile->get_profile();
$arrUserCampaignData = $objCampaign->get_user_campaigns($arrData[0]['id']);
if($arrUrl[1]!='' && count($arrCampaignData) > 0){
if(isset($_POST['submit']) && $_POST['submit']=='Update')
{
	$objCampaign->update_Campaign($_POST);
}
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
                      <i class="fa fa-briefcase"></i> Campaign
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Links</a></li>
						<input type="hidden" name="id" id="id" value="<?php echo $campaignData['id']; ?>"/>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns" style="float: right;">
                        <a href="" class="minimize"></a>
                    </div><!-- panel-btns -->
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Edit campaign details</h3>
                </div>
      <div class="panel-body">
                <div id="message" style="color: red;height: 40px;text-align: center;"></div>
                
                    <div class="form-group" style="height:40px;">
                      <div style="margin-left:17.8%;"><small id="campaignSel_req" style="color: red;display: none;"> Required</small></div>
               
                        <label class="col-sm-2 control-label"><label for="profileId">Campaigns for profile</label></label>
                       
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="profileId" id="campaignProfile">
                             <option value="">Select Profile</option>
						<?php foreach ($arrData as $dataP){ ?>
                            <option value="<?php echo $dataP['id']; ?>" selected= <?php if($dataP['id']==$arrUrl[1]) { echo 'selected'; } ?>><?php echo $dataP['profile_name']; ?></option>
                            <?php } ?>
                            </select>                      </div>
                                            </div>  
                 
                    <div class="form-group"  style="height:40px;">
                     <div style="margin-left:17.8%;"><small id="campaignName_req" style="color: red;display: none;"> Required</small> </div>
                      <label class="col-sm-2 control-label"><label for="profileId">Campaigns Name</label></label>
                        <div class="col-sm-10">
                            <input type="text" id="campaignName" value="<?php echo $arrCampaignData[0]['campaign_name'];  ?>" placeholder="Enter campaign name" class="form-control" required name="name" aria-required="true">                        </div>
                                            </div>          
                    <div class="form-group"  style="height:40px;">
                     <div style="margin-left:17.8%;"><small id="campaignDesc_req" style="color: red;display: none;"> Required</small></div>
               
                        <label class="col-sm-2 control-label"><label for="description">Description</label></label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Description" class="form-control" name="description" id="campaignMessage"><?php echo $arrCampaignData[0]['campaign_desc'];  ?></textarea>                        </div>
                                            </div>
             
                <div class="mt10 text-center" style="margin-top:50px;">
                    <button class="btn btn-primary" type="submit" onClick="edit_campaign_validation();" id="save">Update</button>
                    <button data-href="/campaigns" data-confirm-message="Are you sure want to cancel?" data-confirm-title="Cancel changes?" class="btn btn-default ui-confirm-cancel-link" name="cancel_changes" type="button">Cancel</button>
                </div>
         </div>          
                
                
                
            </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>


</body>
</html>