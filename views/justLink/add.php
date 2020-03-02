<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objProfile = new Profile_Controller();
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink();
$arrData = $objProfile->get_profile();

$profile_id=$arrData[0]['id'];
$profile_email=$arrData[0]['userId'];

include_once SOURCE_ROOT.'dapvalidation.php';


if(isset($_POST['submit']) && $_POST['submit']!='')
{
	
	$objJustLink->add_link($_POST);
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
           <div id="message" style="color: red;height: 40px;text-align: center;"></div>
                                    
                                    <div class="col-sm-12 col-sm-12">
                                    <div style="width:60%; margin:auto;" >
                                    
                                    <div class="nav-tabs-custom" style="box-shadow:2px 1px 20px rgba(20, 9, 12, 0.19);">
                                <ul class="nav nav-tabs">
                                    <li class="active"><a href="#tab_1" data-toggle="tab"><i class="fa fa-pencil"></i> Customize</a></li>
                                    <li><a href="#tab_3" data-toggle="tab"><i class="fa fa-history"></i> History</a></li>
                                   
                                </ul>
                                <div class="tab-content">
                                    <div class="tab-pane active custurl" id="tab_1">
                                  
               <div  class="input-group col-sm-12">
                 <label for="generatorSource">Campaign Name <small style="color: red;">*</small> </label>
                 <small id="link_name_req" style="color: red;display: none;"> Required</small>
                 <input type="text" value="" placeholder="e.g. The campaign name" class="form-control required" id="link_name" name="link_name" aria-required="true">
                                                                   
               </div>
  <div class="input-group col-sm-12">
   <label for="generatorSource">Profile <small style="color: red;">*</small> </label>
   <small id="linkProfile_req" style="color: red;display: none;"> Required</small>
                        <select class="form-control input-sm valid" id="linkProfile" name="profile" aria-required="true" aria-invalid="false">
                        <option value="">Select Profile</option>
						<?php foreach ($arrData as $dataP){ ?>
                            <option value="<?php echo $dataP['id']; ?>"><?php echo $dataP['profile_name']; ?></option>
                            <?php } ?>
                            </select>
                                    </div>    
                                    
                                     <div  class="input-group col-sm-12">
                 <label for="generatorSource">Destination Url <small style="color: red;">*</small> </label>
                 <small id="d_url_req" style="color: red;display: none;"> Required</small>
                 <small id="invalidurl_req" style="color: red;display: none;">Invalid Url</small>
                 <input type="text" value="<?php echo $_REQUEST['share_url'];?>"  class="form-control" id="d_url" name="d_url" aria-required="true" placeholder="e.g. http://www.example.com" onBlur="linkBlurJustLink()">
                                                                   
               </div>                    
                <div  class="input-group col-sm-12">
                 <label for="generatorSource">Link URL <small style="color: red;">*</small> </label>
                 <small id="ururl_req" style="color: red;display: none;"> Required</small>
                 <small id="validurl_req" style="color: red;display: none;">Invalid Url</small>
                 <input type="text" value=""  class="form-control" id="ururl" name="source" aria-required="true" placeholder="e.g. http://www.awesomeproduct.com" onBlur="linkBlurJustLinkYourUrl()">
                                                                   
               </div>    
                 <div  class="input-group col-sm-12" style="padding-top:10px; padding-bottom:10px;"> 
                <input type="checkbox" name="mask" id="mask" style="opacity:1!important;" > Enable Mask
                </div>
               <div  class="input-group col-sm-12" style="padding-top:10px; padding-bottom:10px;"> 
                <input type="button" value="Create new link" onClick="add_link_validation()"  class="btn btn-primary mb10" name="createmessage" style="width:100%;">                                                   </div>             
                                   
                                    </div>
                                    
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
                            <tbody id="addLinkdata">
                            <?php $j=0; foreach ($arrLinkData as $linkdata){ $j=$j+1; ?>
                                  	<tr>
                                        <td><?php echo $j; ?></td>
                                        <td><a data-questions-array="" data-generator-action-link="#" data-generator-action-text="Techp" data-generator-message-text="welcome to my dashboard" data-link-profile="769" data-msg-white-label="0" data-msg-action-type="0" data-msg-link-bg="#00aeef" data-msg-link-color="#ffffff" data-msg-style="0" data-msg-text="#36393D" data-msg-opacity="5" data-msg-background="#ff0000" data-msg-position="0" data-generator-design="0" class="history-link" href="<?php echo $linkdata['link_url']; ?>"><?php echo $linkdata['link_name']; ?></a></td>
                                        <td><?php echo $objJustLink->getTimes($linkdata['add_date']);  ?></td>
                                        <td class="table-action">
                                            <a data-confirm-message="Do you want to edit this message?" data-confirm-title="Edit message" class="ui-confirm-edit-link" href="<?php echo SITE_ROOT_URL.'views/justLink/edit.php/'.$linkdata['id']; ?>"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                               <?php } ?>                       
                            </tbody>
                        </table>
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
<div id="linksPopUpAdd" style="z-index: 50000; position: fixed; width: 700px; margin: auto; top: 20%; left: 30%; display: none;"></div>

<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
</html>