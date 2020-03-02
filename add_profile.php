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
                  
				  
				  <div class="panel panel-default">

    <div class="panel-heading">
        
        <h4 class="panel-title">Basic info</h4>
    </div>

    <form id="profileForm" class="form-bordered" enctype="multipart/form-data" name="profileForm" method="post" action="/account/profiles/add" novalidate><input type="hidden" value="" class="field" id="profileid" name="id"><input type="hidden" value="20a8e610444c0ee5dd407d2e65aeba3b-52a336cb309cb2c9533207a056140a52" name="profilecsrf">    <div class="panel-body">
        <div class="form-group">
            
            <div class="col-sm-12">
			<label class="ccontrol-label">Profile name</label>
                <input type="text" value="" placeholder="e.g. Awesome company" class="form-control required" id="profilename" name="name" aria-required="true">                <span class="help-block">Enter the profile name or title. It will be visible on your LINX window.</span>
            </div>
                   </div>


        <div class="form-group">
            
            <div class="col-sm-12">
			<label class="control-label">Profile link</label>
                <input type="text" value="" placeholder="e.g. http://www.awesomecompany.com" class="form-control required" id="profilelink" name="link" aria-required="true">                <span class="help-block">Enter a link for your profile (this is link that will be linked from profile name)</span>
            </div>
        </div>        

        <div class="form-group">

            
            <div class="col-sm-12">
			<label class="control-label">Profile picture</label>
                 <div id="logoFile_preview" class="imagefielddisplay">
                <div class="media">
                    <a href="javascript:void(0);" class="pull-left">
                        <div class="image"></div>
                    </a>
                    <div class="media-body">
                        <button data-value="" data-qid="logoFile" data-profileid="0" data-name="logoFilelink" data-height="200" data-width="200" data-href="/image/imgupload?task=imageForm&amp;profileid=0&amp;qid=logoFile&amp;elmName=logoFile&amp;w=200&amp;h=200&amp;itype=logo" data-target=".bs-example-modal" data-toggle="modal" class="btn btn-primary mr5 uiimguploadlnk" id="profileLogoUploadBtn" type="button">Upload profile picture</button>
                            <span class="help-block">(200x200 px)</span>
                     
                    </div>
                </div>
            </div>            </div>
        </div>


        <div class="form-group">
            
            <div class="col-sm-12">
			<label class="control-label">Profile type</label>
                <select class="form-control input-sm mb15" id="profileType" name="profileType"><option value="">Select profile type</option>
<option value="0">Website</option>
<option value="1">Twitter</option>
<option value="2">Facebook</option>
<option value="3">LinkedIn</option>
<option value="4">Google+</option>
<option value="5">Vkontakte</option></select>                <span class="help-block">Selecting the right type of profile helps us target your customers better.</span>
            </div>
        </div>
            </div>
    <div class="panel-footer">
        <div class="row text-center">
            <div class="btn-group">
                <button class="btn btn-primary" type="submit">Add new profile</button>
                <button data-href="/account/profiles" data-confirm-message="Are you sure want to cancel?" data-confirm-title="Cancel changes?" class="btn btn-default ui-confirm-cancel-link" name="cancel_changes" type="button">Cancel</button>
            </div>
        </div>
    </div>
    </form>   
</div>
				  
				  
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once "js/javascript.php"; ?>

</body>
</html>
