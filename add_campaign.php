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
                      <i class="fa fa-desktop"></i> Campaign
                        <small>Quick overview of stats and links created</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">Campaign</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 


<div class="contentpanel">
                 <div class="callout callout-info">
                                        <h4>Complete your profile </h4>
                                        <p>You need to have your profile completed if you want to get most of LINX - click here to complete your profile..</p>
                                    </div> 
              
       
       <div class="panel panel-default">
                <div class="panel-heading">
                    <div class="panel-btns" style="float:right;">
                        <a href="" class="minimize">−</a>
                    </div><!-- panel-btns -->
                    <h3 class="panel-title"><i class="fa fa-pencil"></i> Add campaign details</h3>
                </div>
      <div class="panel-body">
                
                    <div class="form-group" style="height:32px;">
                        <label class="col-sm-2 control-label"><label for="profileId">Campaigns for profile</label></label>
                        <div class="col-sm-10">
                            <select class="form-control input-sm" name="profileId"><option selected="selected" value="">Please Select Profile</option>
<option value="769">sanjeev kumar</option></select>                        </div>
                                            </div>  
                    <div class="form-group"  style="height:32px;">
                        <label class="col-sm-2 control-label"><label for="name">Campaign Name</label></label>
                        <div class="col-sm-10">
                            <input type="text" value="" placeholder="Enter campaign name" class="form-control" required name="name" aria-required="true">                        </div>
                                            </div>          
                    <div class="form-group"  style="height:80px;">
                        <label class="col-sm-2 control-label"><label for="description">Description</label></label>
                        <div class="col-sm-10">
                            <textarea placeholder="Enter Description" class="form-control" name="description"></textarea>                        </div>
                                            </div>
             
                <div class="mt10 text-center">
                    <button class="btn btn-primary" type="submit"  onclick="window.location.href='add_message.php'">Next: Create first message</button>
                    <button data-href="/campaigns" data-confirm-message="Are you sure want to cancel?" data-confirm-title="Cancel changes?" class="btn btn-default ui-confirm-cancel-link" name="cancel_changes" type="button">Cancel</button>
                </div>
         </div>          
                
                
                
            </div>
              
              
              
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once "js/javascript.php"; ?>

</body>
</html>
