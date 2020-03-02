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
                <h3 class="panel-title"><i class="fa fa-pencil"></i> Message Info</h3>
            </div>
            <div class="panel-body">
                <div class="form-group" style="height:35px;">
                    <label class="col-sm-2 control-label">
                        <label for="linkProfile">Campaigns for profile</label></label>
                    <div class="col-sm-10">
                                                <select class="form-control input-sm valid" id="linkProfile" name="profileId">
                            <option data-name="sanjeev kumar" data-photo="img/nopicture.png" selected="selected" value="769">sanjeev kumar</option><option value="addprofile">Add new profile</option>                        </select>
                    </div>
                                    </div>
                                    <div class="form-group" style="height:35px;">
                        <label class="col-sm-2 control-label"><label for="linkCampaign">Campaign</label></label>
                        <div class="col-sm-10">
                            <span style="display: none;" id="allCampaigns">
                                <option data-name="camp 3" data-profileid="769" value="137">camp 3</option>                            </span>
                            <select class="form-control input-sm valid" id="linkCampaign" name="campaignId" aria-required="true" aria-invalid="false">
                                <option value="">Select campaign</option>
                                <option data-name="camp 3" data-profileid="769" selected="selected" value="137">camp 3</option>                            </select><label id="linkCampaign-error" class="error" for="linkCampaign" style="display: inline-block;"></label>
                                                    </div>
                    </div>

                                <div class="form-group" style="height:35px;">
                    <label class="col-sm-2 control-label"><label for="generatorMessageText">Message</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="" placeholder="e.g. We offer an awesome product" id="generatorMessageText" class="form-control" required name="messageText" aria-required="true">                    </div>
                                    </div>

                <div class="form-group" style="height:35px;">
                    <label class="col-sm-2 control-label"><label for="generatorActionText">Action Text</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="" placeholder="e.g. Try it now" id="generatorActionText" class="form-control" required name="actionText" aria-required="true">                    </div>
                                    </div>

                <div class="form-group" style="height:35px;">
                    <label class="col-sm-2 control-label"><label for="generatorActionLink">Action Link</label></label>
                    <div class="col-sm-10">
                        <input type="text" value="" placeholder="e.g. http://www.mycompany.com/signup" id="generatorActionLink" class="form-control" required name="actionLink" aria-required="true">                    </div>
                                    </div>
            </div>
        </div>
      
         
  <div style="height:30px;"></div>       
         
         
   <div class="panel panel-default">
            <div class="panel-heading">
                <div class="panel-btns" style="text-align:right;">
                    <a href="" class="minimize">−</a>
                </div><!-- panel-btns -->
                <h3 class="panel-title"><i class="fa fa-cube"></i> Message Design</h3>
            </div>
            <div class="panel-body">      

                <div class="row mb10" style="height:75px;">
                    <div class="col-sm-6">
                        <label for="generatorDesign" class="col-sm-6 control-label" style="padding-left:0px;">Design</label>                        <select id="generatorDesign" class="form-control input-sm" name="design"><option selected="selected" value="0">Speech Box</option>
<option value="1">Single Box</option>
<option value="2">Bar</option>
<option value="3">Side Box</option></select>                                            </div>
                    <div class="col-sm-6">
                        <label for="msgPosition" class="col-sm-6 control-label" style="padding-left:0px;">Position</label>                        <select id="msgPosition" class="form-control input-sm" name="position"><option selected="selected" value="0">Bottom Left</option>
<option value="1">Bottom</option>
<option value="2">Bottom Right</option>
<option value="3">Right</option>
<option value="4">Top Right</option>
<option value="5">Top</option>
<option value="6">Top Left</option>
<option value="7">Left</option></select>                                            </div>
                </div>
                <div class="row mb10">
                    <div class="col-sm-6">
                        <label for="msgBackground" class="col-sm-6 control-label" style="padding-left:0px;">Background</label>                        <input class="color boxcolor" value="66ff00" id="bkgcolor" >                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-6 control-label" style="padding-left:0px;">
                            <label class="control-label" style="padding-left:0px;">Opacity</label>
                        </div>
                        <div class="col-sm-4">
                            <div aria-disabled="false" id="generatorOpacity" class="slider-primary ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 100%;"></div><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></a></div>
                            <input type="hidden" value="5" data-slider-tooltip="hide" data-slider-selection="after" data-slider-orientation="horizontal" data-slider-value="4" data-slider-step="1" data-slider-max="5" data-slider-min="1" id="msgOpacity" name="opacity">                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb10" style="height:75px;">
                    <div class="col-sm-6">
                        <label for="msgText" class="col-sm-6 control-label" style="padding-left:0px;">Text Color</label>                        <input class="color boxcolor" value="66ff00" id="textcolor" >                    </div> 
                    <div class="col-sm-6">
                        <label for="msgStyle" class="col-sm-6 control-label" style="padding-left:0px;">Style</label>                        <select id="msgStyle" class="form-control input-sm" name="style"><option selected="selected" value="0">Normal</option>
<option value="1">Light</option>
<option value="2">Bold</option></select>                    </div>
                </div>
                <div class="row mb10">
                    <div class="col-sm-6">
                        <label for="msgLinkColor" class="col-sm-6 control-label" style="padding-left:0px;">Link Color</label>                      <input class="color boxcolor" value="66ff00" id="linktxtcolor" >                    </div>
                    <div class="col-sm-6">
                        <label for="msgLinkBg" class="col-sm-6 control-label" style="padding-left:0px;">Link Background</label>                       <input class="color boxcolor" value="66ff00" id="linkbgcolor" >                    </div>
                </div>			
                <hr>
                <div class="row mb10" style="height:75px;">
                    <div class="col-sm-6">
                        <label for="msgActionType" class="col-sm-6 control-label" style="padding-left:0px;">Action Type</label>                        <select id="msgActionType" class="form-control input-sm" name="actiontype"><option selected="selected" value="0">Button</option>
<option value="1">Link</option>
<option value="2">Poll</option>
<option value="3">Form</option></select>                    </div>
                    <div class="col-sm-6">
                        <label for="hidelabel" class="col-sm-6 control-label" style="padding-left:0px;">Hide Label</label>                        <select class="form-control input-sm" name="hidelabel"><option selected="selected" value="0">Show</option>
<option value="1">Hide</option></select>                    </div>
                </div>
                <div style="display:none;" id="questionsFacility">
                    <hr>         
                    <div class="row mb10">
                        <label class="col-sm-3 control-label"><label for="questionsArray">Poll answers</label></label>
                        <div class="col-sm-7">
                            <input type="text" value="" class="form-control" id="questionsArray" name="questionsArray" style="display: none;"><div class="tagsinput" id="questionsArray_tagsinput" style="width: auto; height: 100px;"><div id="questionsArray_addTag"><input data-default="add an answer" value="" id="questionsArray_tag" style="color: rgb(102, 102, 102); width: 68px;" name="tmp_questionsArray_tags"></div><div class="tags_clear"></div></div>                        </div>
                        <input type="hidden" id="questionsArray_tags" name="questionsArray_tags">
                    </div>
                </div>
            </div><!-- col-md-6 -->
        </div>      
         
   
   
   <div class="row text-center mb100" style="margin-top:30px;">
        <button type="submit" class="btn btn-primary">Save Changes</button>
        <button data-href="/campaigns" data-confirm-message="Are you sure want to cancel?" data-confirm-title="Cancel changesx?" class="btn btn-default ui-confirm-cancel-link" name="cancel_changes" type="button">Cancel</button>
    </div>      
              
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once "js/javascript.php"; ?>

</body>
</html>
