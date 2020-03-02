<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->get_user_all_campaign();
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
                        <li><a href="#">Links</a></li>
						<input type="hidden" name="id" id="id" value="<?php echo $campaignData['id']; ?>"/>
                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">

<div class="contentpanel">
         <div class="panel panel-default">
        <div class="panel-heading">
           
            <h3 class="panel-title">
                sanjeev kumar                            </h3>
        </div>
        <div class="panel-body">

            <div class="table-responsive">
                <table class="table table-hidaction table-hover mb30">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Description</th>
                            <th>Messages</th>
                            <th>Views</th>
                            <th>Unique Views</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody id="campaignAllData">
                       
                                             </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
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
</script>

</body>
</html>