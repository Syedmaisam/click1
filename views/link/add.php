<?php
include_once "../../config/config.php";
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
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-pencil"></i> Custimize</a></li>
                                    <li><a href="#tab_2" data-toggle="tab"><i class="fa fa-cube"></i> Modify Design</a></li>
                                    <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-history"></i> History</a></li>
                                   
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active custurl" id="tab_1">
                                  
               <div  class="input-group col-sm-12">
                 <label for="generatorSource">Content URL</label>
                 <input type="text" value="" placeholder="e.g. The content or article you want to share" class="form-control required" id="generatorSource" name="source" aria-required="true">
                                                                   
               </div>
  <div class="input-group col-sm-12">
   <label for="generatorSource">Profile</label>
                        <select class="form-control input-sm valid" id="linkProfile" name="profile" aria-required="true" aria-invalid="false">
                            <option data-name="sanjeev kumar" value="769">sanjeev kumar</option><option value="addprofile">Add new profile</option>                        </select><label id="linkProfile-error" class="error" for="linkProfile" style="display: inline-block;"></label>
                                    </div>    
                                    
                                     <div  class="input-group col-sm-12">
                 <label for="generatorSource">Message</label>
                 <input type="text" value=""  class="form-control required" id="messsage" name="source" aria-required="true" placeholder="e.g. We offer Awesome Product">
                                                                   
               </div>                    
                <div  class="input-group col-sm-12">
                 <label for="generatorSource">Your URL</label>
                 <input type="text" value=""  class="form-control required" id="ururl" name="source" aria-required="true" placeholder="e.g. http://www.awesomeproduct.com">
                                                                   
               </div>     
                <div  class="input-group col-sm-12">
                 <label for="generatorSource">Call To Action</label>
                 <input type="text" value=""  class="form-control required" id="ctoa" name="source" aria-required="true" placeholder="e.g. Try it now">
                                       
                                      
               </div>       
               <div  class="input-group col-sm-12" style="padding-top:10px; padding-bottom:10px;"> 
                <input type="button" value="Create" class="btn btn-primary mb10" name="createmessage" style="width:100%;">                                                   </div>             
                                   
                                    </div><!-- /.tab-pane -->
                                    <div class="tab-pane" id="tab_2">
                                                         
                          
                          
                          
                          
                          
                          
                          
                          
<div id="custom" class="tab-pane form-inline active">
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="generatorDesign">Design</label></label>
                        <select class="form-control input-sm" id="generatorDesign" name="design"><option selected="selected" value="0">Speech box</option>
<option value="1">Single box</option>
<option value="2">Bar</option>
<option value="3">Side box</option></select>                    </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgPosition">Position</label></label>
<select class="form-control input-sm" id="msgPosition" name="position"><option selected="selected" value="0">Bottom left</option>
<option value="1">Bottom</option>
<option value="2">Bottom right</option>
<option value="3">Right</option>
<option value="4">Top right</option>
<option value="5">Top</option>
<option value="6">Top left</option>
<option value="7">Left</option></select>                    </div>
                </div>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgBackground">Background</label></label>
<input class="color boxcolor" value="66ff00" id="bkgcolor">                    </div>
                    <div class="col-sm-6">
                        <div class="col-sm-6 control-label">
                            <label class="control-label"><label for="msgOpacity">Opacity</label></label>
                        </div>
                        <div class="col-sm-4">
<input type="hidden" value="5" data-slider-tooltip="hide" data-slider-selection="after" data-slider-orientation="horizontal" data-slider-value="4" data-slider-step="1" data-slider-max="5" data-slider-min="1" id="msgOpacity" name="opacity">                            <div class="slider-primary mb20 ui-slider ui-slider-horizontal ui-widget ui-widget-content ui-corner-all" id="generatorOpacity" aria-disabled="false"><div class="ui-slider-range ui-widget-header ui-corner-all ui-slider-range-min" style="width: 100%;"></div><a href="#" class="ui-slider-handle ui-state-default ui-corner-all" style="left: 100%;"></a></div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">

                        <label class="col-sm-6 control-label"><label for="msgText">Text</label></label>
<input class="color boxcolor" value="66ff00" id="textcolor"> </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgStyle">Style</label></label>
<select class="form-control input-sm" id="msgStyle" name="style"><option selected="selected" value="0">Normal</option>
<option value="1">Light</option>
<option value="2">Bold</option></select>                    </div>
                </div>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgLinkColor">Link</label></label>
<input class="color boxcolor" value="66ff00" id="linkcolor">  </div>
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgLinkBg">Link background</label></label>
<input class="color boxcolor" value="66ff00" id="linkbgcolor">    </div>
                </div>
                <hr>
                <div class="row mb10" style="height:50px;">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgActionType">Action</label></label>
<select class="form-control input-sm" id="msgActionType" name="actiontype"><option selected="selected" value="0">Button</option>
<option value="1">Link</option>
<option value="2">Poll</option>
<option value="3">Form</option></select>                    </div>
                   
                </div>
                <div class="row mb10" style="display:none;" id="accesstypefld">
                    <div class="col-sm-6">
                        <label class="col-sm-6 control-label"><label for="msgAccessType">Access type</label></label>
<select class="form-control input-sm" id="msgAccessType" name="accesstype"><option value="1">Public</option>
<option value="2">Everyone with the link</option>
<option value="3">Profile users</option></select>                    </div>
                </div>
                <div style="display:none;" id="questionsFacility">
                    <hr>         
                    <div class="row mb10">
                        <label class="col-sm-3 control-label"><label for="questionsArray">Poll answers</label></label>
                        <div class="col-sm-7">
<input type="text" value="" class="form-control" id="questionsArray" name="questionsArray" style="display: none;"><div class="tagsinput" id="questionsArray_tagsinput" style="width: auto; height: 100px;"><div id="questionsArray_addTag"><input data-default="add an answer" value="" id="questionsArray_tag" style="color: rgb(102, 102, 102); width: 68px;" name="tmp_questionsArray_tags"></div><div class="tags_clear"></div></div>                        </div>
                    </div>
                </div>
            </div>                          
                          
        <div class="panelcreatemessage" style="height:55px;">
            <div class="text-center">
                <input type="hidden" value="" name="clickedbtn">
                <input type="button" value="Create" class="btn btn-primary mb10" name="createmessage">
                 
                <input type="button" value="Save Draft" class="btn btn-default mb10" name="savedraft">
                            </div>
        </div>                  
                          
                          
                          
                          
                          
                          
                          
                          
                            
							
                                    </div><!-- /.tab-pane -->
                                    
                                          <div class="tab-pane" id="tab_3">
                          <div class="table-responsive">
                        <table class="table mb30">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Message</th>
                                    <th>Created</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                                                    <tr>
                                        <td>1</td>
                                        <td><a data-questions-array="" data-generator-action-link="#" data-generator-action-text="Techp" data-generator-message-text="welcome to my dashboard" data-link-profile="769" data-msg-white-label="0" data-msg-action-type="0" data-msg-link-bg="#00aeef" data-msg-link-color="#ffffff" data-msg-style="0" data-msg-text="#36393D" data-msg-opacity="5" data-msg-background="#ff0000" data-msg-position="0" data-generator-design="0" class="history-link" href="#">welcome to my dashboard</a></td>
                                        <td>3 days ago</td>
                                        <td class="table-action">
                                            <a data-confirm-message="Do you want to edit this message?" data-confirm-title="Edit message" class="ui-confirm-edit-link" href="#"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                                                
                            </tbody>
                        </table>
                    </div>
                    <div class="text-center">
        
                <input type="button" value="Create" class="btn btn-primary mb10" name="createmessage">
                 
           
                            </div>
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
