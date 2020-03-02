<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objProfile = new Profile_Controller();
$objCampaign = new campaign_Controller();
//$arrLinkData = $objCampaign->get_campaign();
$arrData = $objProfile->get_profile();

 $profile_id=$arrData[0]['id'];
 $profile_email=$arrData[0]['userId'];

include_once SOURCE_ROOT.'campaign_dap_validation.php';


if(isset($_POST['submit']) && $_POST['submit']!='')
{
	$objCampaign->add_campaign($_POST);
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
                        <li><a href="#">Campaign</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 

<div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns" style="float: right;">
                        <a href="" class="minimize"></a>
                    </div><!-- panel-btns -->
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Add campaign details</h3>
                </div>
      <div class="panel-body">
                <div id="message" style="color: red;height: 40px;text-align: center;"></div>
                
                    <div class="form-group" style="height:40px;">
                      
               
                        <label class="col-sm-3 control-label"><label for="profileId">Campaigns for profile</label></label>
                       
                        <div class="col-sm-9">
                        <div ><small id="campaignSel_req" style="color: red;display: none;"> Required</small></div>
                            <select class="form-control input-sm" name="profileId" id="campaignProfile">
                             <option value="">Select Profile</option>
						<?php foreach ($arrData as $dataP){ ?>
                            <option value="<?php echo $dataP['id']; ?>"><?php echo $dataP['profile_name']; ?></option>
                            <?php } ?>
                            </select>                      </div>
                                            </div>  
                 
                    <div class="form-group"  style="height:40px;">
                    
                      <label class="col-sm-3 control-label"><label for="profileId">Campaigns Name</label></label>
                        <div class="col-sm-9">
                         <div><small id="campaignName_req" style="color: red;display: none;"> Required</small> </div>
                            <input type="text" id="campaignName" value="" placeholder="Enter campaign name" class="form-control" required name="name" aria-required="true">                        </div>
                                            </div>          
                    <div class="form-group"  style="height:40px;">
                    
               
                        <label class="col-sm-3 control-label"><label for="description">Description</label></label>
                        <div class="col-sm-9">
                         <div><small id="campaignDesc_req" style="color: red;display: none;"> Required</small></div>
                            <textarea placeholder="Enter Description" class="form-control" name="description" id="campaignMessage"></textarea>                        </div>
                                            </div>
             
                <div class="mt10 text-center" style="margin-top:50px;">
                    <button class="btn btn-primary" type="submit" onClick="add_campaign_validation();" id="save">Next: Create first message</button>

                </div>
         </div>          
                
                
                
            </div>
                </section><!-- /.content -->
            </aside><!-- /.right-side -->
			
</div>



<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
</html>
