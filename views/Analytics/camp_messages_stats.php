<?php
include_once "../../config/config.php";
//$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$objCampaign = new campaign_Controller();
$objProfile = new Profile_Controller();
$userid = $_SESSION['user']['id'];
$arrData = $objProfile->get_profile();
$arr_camp_message = $objCampaign->get_all_users_message($userid);
//var_dump($arr_camp_message);
//echo "<pre>";
//var_dump($arrCampaignData); exit;
$arrgetData=$objCampaign->get_user_campaigndata($arrUrl[1]);
//var_dump($arrgetData);
//exit;

if($_POST['submit']=="delete" && $_POST['campaign']!='' )
{
	$objJustLink->delete_link($_POST['campaign']);
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
						<input type="hidden" name="id" id="id" value="<?php echo $campaignData['id']; ?>"/>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<div class="contentpanel">
     <div class="content-js-nocss">
                        
    <div class="panel panel-default">
        <div class="panel-heading">Campaign messages
           
            <!-- <h3 class="panel-title">my campaingn</h3> -->
             <?php    foreach ($arrgetData as $arrget){ ?>
                    
            <h3 class="panel-title"><?php echo $arrget['campaign_name']?></h3>
            <p><?php echo $arrget['campaign_desc']?></p>
              <?php } ?>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-hidaction table-hover mb30">
                    <thead>
                        <tr>
                            <th>Campaign</th>
                            <th>Profile</th>
                            <th>Message</th>
                            <th>Views</th>
                            <th>Unique Views</th>
                            <th class="min-wid-115"></th>
                        </tr>
                    </thead>
<?php
//if($arrgetData!=NULL)
//{
?>
                    <tbody>
                <?php    foreach ($arr_camp_message as $campData){
if($campData['campaign_name']) 
{?>
                    
                                         <tr>
                                         
                            <td><?php echo $campData['campaign_name']; ?></td>
                            <td><?php echo $campData['profile_name']; ?></td>
                            <td><?php echo $campData['message']; ?></td> 
                            <td><span><i class="fa fa-eye"></i> <?php echo $campData['ViewCount'];?></span></td> 
                            <td><span><i class="fa fa-user"></i> <?php echo $campData['uniqueviewCount'];?></span></td> 
                           
                                     
                            <td>
                                <div class="btn-group pull-right  mr10">
                                    <a class="btn btn-primary" href="<?php echo SITE_ROOT_URL.'views/campaign/editMessage.php/'.$campData['campaignId'].'/'.$campData['id'].'/'.$campData['profile_id'];?>">Edit</a>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo SITE_ROOT_URL.'views/campaign/editMessage.php/'.$campData['campaignId'].'/'.$campData['id'].'/'.$campData['profile_id'];?>">Edit</a></li>
                              <!--          <li><a href="/campaigns/message/duplicate/1606/125">Duplicate</a></li>
                                        <li><a href="/analytics/messages/1606">Analytics</a></li>-->
                                        <li class="divider"></li>
                                        <li><a href="<?php echo SITE_ROOT_URL.'views/campaign/DeleteMessage.php/'.$campData['id'].'/'.$campData['campaignId'].'/'.$campData['profile_id'];?>">Delete</a></li>
                                        <li class="divider"></li>
                        <li><a href="<?php echo SITE_ROOT_URL.'views/Analytics/camp_messages_stats_views.php?id='. $campData['id']; ?>" ><i class="fa fa-bar-chart-o"></i>Analytics</a></li>
                                    </ul>
                                </div><!-- btn-group -->
                            </td>
                        </tr>
                        
                        <?php }
} ?>
                                                               </tbody>
<?php
//}
?>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div><!-- panel -->

    <div class="row text-center">
        <a href="<?php echo SITE_ROOT_URL.'views/campaign/'?>" class="btn btn-primary">Add new message</a>
    </div>

<script>
</script>


                     </div>
     </div>    
   
                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

<script type="text/javascript">
$(document).ready(function(){
	$(".blackscreen").show();
	$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: location.protocol + '//' + location.host+'/click/ajax/campaign/getCampaignData.php',
		data: {
		id:1
	},			
	success: function(response) {
		
		if(response!=''){
			$("#campaignAllData").html(response);
			} else 
			{
				var trData = "<td colspan='6' style='text-align: center;'>No Record Found!</td>";
				$("#campaignAllData").html(trData);
			}
		
//		$("#linktbody").html(response);
		$(".blackscreen").hide();
		$(".loader_popup").hide();
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	}); 
});
	function setdefaultmsg(id ,campid)
	{
		
		 $.ajax({
			type: "post",
			url: location.protocol + '//' + location.host+'/click/ajax/campaign/MessageUpdate.php',
			data: {
			id:id,
			campaignid:campid
		},			
		success: function(response) {
			if(response!=''){
			
			
		}
		},

		 });
    }  

	



</script>

</body>
</html>