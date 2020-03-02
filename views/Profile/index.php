<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
//include_once SOURCE_ROOT.'session_redirect.php';
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
$objProfile = new Profile_Controller();
$arrData = $objProfile->get_profile();

if($_REQUEST['q']=='delete' && $_REQUEST['i']!='')
{
	$objProfile->deleteProfile($_REQUEST['i']);
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
                      <i class="fa fa-desktop"></i> Profile
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Profile</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 


<div class="contentpanel">
                 <div class="callout callout-info">
                                        <h4>profile Information</h4>
                                        <p><?php echo $_SESSION['profile_msg']; $_SESSION['profile_msg']=""; ?></p>
                                    </div> 
                     <div class="content-js-nocss">
                        
<?php
foreach ($arrData as $data){
	$profilestat = $objProfile->get_profile_stats($data['id']);
	
?>

        <div class="panel panel-default widget-profile" id="profile_<?php echo $data['id']; ?>">
            <div class="panel-heading">
                <div class="panel-btns" style="text-align:right;">              
                    
                </div><!-- panel-btns -->
                <h3 class="panel-title"><?php echo $data['profile_name']; ?> </h3>
            </div>
            <div class="row">
				<div class="col-xs-3 text-center" style="padding:18px; padding-left:30px;"> <img class="widget-profile-img thumbnail" src="<?php echo SITE_ROOT_URL; ?>images/profile/<?php if($data['profile_image_path'] != ''){echo $data['profile_image_path'];} else {echo "default.png";} ?>" alt="80x80" style="width: 100px;"> </div>
                    <div class="col-xs-2 text-center" style="padding:40px;">
                        <span><i class="fa fa-link"></i> <?php echo $profilestat[0]; ?> links</span>
                    </div>
                    <div class="col-xs-2 text-center"  style="padding:40px;">
                        <span><i class="fa fa-user"></i><?php echo $profilestat[1]; ?> Views</span>
                    </div>                
                    <div class="col-xs-2 text-center"  style="padding:40px;">
                        <span><i class="fa fa-heart"></i> <?php echo $profilestat[2]; ?> Unique Views</span>
                    </div>  
 <div class="col-xs-3 text-center">
 <div class="panel-body">
                <div class="btn-group mr5 pull-right mt15 mr10">
                    <a class="btn btn-primary" href="<?php echo SITE_ROOT_URL.'views/Profile/edit.php/'.$data['id']; ?>"><i class="fa fa-fw fa-edit"></i> Edit</a>
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                        <li><a title="Edit" href="<?php echo SITE_ROOT_URL.'views/Profile/edit.php/'.$data['id']; ?>"><i class="fa fa-fw fa-edit"></i> Edit</a></li>
<!--                                                    <li><a data-href="/account/profiles/default-profile/769" data-confirm-message="Make default?" data-confirm-title="Make default?" class="ui-confirm-profile-default" href="javascript:void(0);">Make default?</a></li>-->
<!--                                                <li><a href="/analytics/profile/769">Analytics</a></li>-->
<!--                        <li><a href="/account/profiles/users/769">User access</a></li>-->
                        <li class="divider"></li>
                        <li><a style="cursor: pointer;" title="Delete" onClick="deleteProfile('<?php echo $data['id']; ?>')"><i class="fa fa-fw fa-trash-o"></i> Delete</a></li>
                    </ul>
                </div><!-- btn-group -->
               
 </div>

					</div>
            </div>
        </div>
        <?php  } ?>
        <!-- panel -->

<?php
if(($_SESSION['product_level']==5))
{
?>        
<div class="row text-center">
    <a class="btn btn-primary" href="<?php echo SITE_ROOT_URL.'views/Profile/' ?>add_profile.php">Add profile</a>
</div>
<?php }?>
                    </div>
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
</html>
