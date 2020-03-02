<?php
include_once "config/config.php";
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

<?php include_once "header.php"; ?>
<div class="wrapper row-offcanvas row-offcanvas-left"><!-- Left side column. contains the logo and sidebar -->
<?php include_once "sidebar.php"; ?> 


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
                                        <h4>Complete your profile </h4>
                                        <p>You need to have your profile completed if you want to get most of LINX - click here to complete your profile..</p>
                                    </div> 
                     <div class="content-js-nocss">
                        


        <div class="panel panel-default widget-profile">
            <div class="panel-heading">
                <div class="panel-btns" style="text-align:right;">
                    <a class="minimize" href="">−</a>
                    <a data-toggle="modal-csv-export" href="/export?action=profiles-csv" data-original-title="Expor to CSV" data-placement="bottom" class="btn btn-white btn-xs tooltips"><i class="fa fa-table"></i></a>
                </div><!-- panel-btns -->
                <h3 class="panel-title">sanjeev kumar </h3>
            </div>
            

              

                <div class="row">
				<div class="col-xs-3 text-center" style="padding:18px; padding-left:30px;"> <img class="widget-profile-img thumbnail" src="img/nopicture.png" alt="80x80"> </div>
                    <div class="col-xs-2 text-center" style="padding:40px;">
                        <span><i class="fa fa-link"></i> 2 links</span>
                    </div>
                    <div class="col-xs-2 text-center"  style="padding:40px;">
                        <span><i class="fa fa-user"></i> 2 visitors</span>
                    </div>                
                    <div class="col-xs-2 text-center"  style="padding:40px;">
                        <span><i class="fa fa-heart"></i> 2 clicks</span>
                    </div>  
 <div class="col-xs-3 text-center">
 <div class="panel-body">
                <div class="btn-group mr5 pull-right mt15 mr10">
                    <a class="btn btn-primary" href="/account/profiles/edit/769">Edit</a>
                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                        <span class="caret"></span>
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <ul role="menu" class="dropdown-menu">
                        <li><a href="/account/profiles/edit/769">Edit</a></li>
                                                    <li><a data-href="/account/profiles/default-profile/769" data-confirm-message="Make default?" data-confirm-title="Make default?" class="ui-confirm-profile-default" href="javascript:void(0);">Make default?</a></li>
                                                <li><a href="/analytics/profile/769">Analytics</a></li>
                        <li><a href="/account/profiles/users/769">User access</a></li>
                        <li class="divider"></li>
                        <li><a href="/account/profiles/delete/769">Delete</a></li>
                    </ul>
                </div><!-- btn-group -->
               
 </div>

					</div>
            </div>
        </div><!-- panel -->

        
<div class="row text-center">
    <a class="btn btn-primary" href="add_profile.php">Add profile</a>
</div>

                    </div>
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once "js/javascript.php"; ?>

</body>
</html>
