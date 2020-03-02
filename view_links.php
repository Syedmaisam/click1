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
                 <div class="callout callout-info">
                                        <h4>Complete your profile </h4>
                                        <p>You need to have your profile completed if you want to get most of LINX - click here to complete your profile..</p>
                                    </div> 
                        <div class="panel panel-default">
    <div class="panel-heading">
        <div class="panel-btns" style="text-align:right;">
		 <a data-toggle="modal-csv-export" href="/export?action=links-csv&amp;page=1&amp;profileId=&amp;userId=" data-original-title="Expor to CSV" data-placement="bottom" class="btn btn-white btn-xs tooltips"><i class="fa fa-table"></i></a>
         <a class="minimize" href="">−</a>
         <a class="panel-close" href="">×</a>  

             
                                </div><!-- panel-btns -->
        <h3 class="panel-title">Last created links</h3>
        <p>Below you can see all links you've created previously</p>
    </div>
    <div class="panel-body">
        <div class="row text-center mb30">
            <a class="btn btn-primary" href="basic.php"><i class="fa fa-link"></i> Create new link</a>
        </div>
        <div class="table-responsive">
            <table class="table table-hidaction table-hover mb30">
                <thead>
                    <tr>
                        <th><div class="col-xs-4"><i class="fa fa-picture-o"></i></div></th>
                        <th>Message</th>
                        <th>Created</th>
                        <th class="min-wid-75">Views</th>
                        <th>Clicks</th>
                        <th>Published</th>
                        <th class="min-wid-115"></th>
                </tr>
                </thead>
                <tbody>
                                                <tr>
                                <td>
                                    <div class="col-xs-4">
                                        <img class="img16" alt="favicon" src="#">
                                    </div>
                                </td>
                                <td class="col-md-6">
                                                                                                                                                                    Image: <a rel="prettyPhoto" href="#">Chrysanthemum.jpg</a>
                                                                                    
                                            
                                            
                                     <div class="input-group mt10 col-md-10"><input type="text" value="#" class="form-control linkContentSelect" placeholder="">
                <span class="input-group-btn">
                	<a data-href="#" data-original-title="Copy to clipboard" type="button" data-toggle="tooltip" data-placement="bottom" title="Copy link to clipboard" class="link-copy-btn btn btn-primary mr10 button-right"><i class="fa fa-copy"></i> <span>Copy</span></a>
                    <a class="btn btn-primary button-left" target="_blank" href="#"><i class="fa fa-eye"></i> <span>View</span></a>
                    <a data-href="/links/link-share/9061" data-toggle="modal-link-share" class="btn btn-primary button-right" href="/links/link-share/9061"><i class="fa fa-share"></i> <span>Share</span></a>
                
       
                 </div>
   		
             <blockquote class="mt10">
            <i class="fa fa-quote-left"></i>
            <p>test this message (Campaign: <a title="Edit campaign message" href="/campaigns/view/125">my campaingn</a>)</p>
            <small>sanjeev kumar</small>
          </blockquote>       
                                    </td>
                                <td>19 minutes ago</td>
                                <td><span><i class="fa fa-eye"></i> 5</span></td>
                                <td><span><i class="fa fa-user"></i> 2 </span></td>
                                <td> 
                                    <div data-requestid="9061" data-published="1" style="height: 20px; width: 50px;" class="toggle_link_9061 publish-toggle-btn toggle toggle-primary toggle-off"><div class="toggle-slide active"><div class="toggle-inner" style="width: 80px; margin-left: 0px;"><div class="toggle-on active" style="height: 20px; width: 40px; text-align: center; text-indent: -10px; line-height: 20px;">ON</div><div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;"></div><div class="toggle-off" style="height: 20px; width: 40px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">OFF</div></div></div></div>
                                </td>       

                                <td>
                                    <div class="btn-group pull-right  mr10">
                                        <a class="btn btn-primary" href="/links/edit/9061">Edit</a>
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="/links/edit/9061">Edit</a></li>
                                            <li><a href="/analytics/links/9061">Analytics</a></li>
                                                                                                                                    <li class="divider"></li>
                                            <li><a data-del-callback-func="deleteRowItem" data-href="/links/delete/9061" data-confirm-message="Are you sure want to delete this link?" data-confirm-title="Delete link?" class="ui-confirm-delete-link" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div><!-- btn-group -->
                                </td>
                            </tr>
                                                        <tr>
                                <td>
                                    <div class="col-xs-4">
                                        <img class="img16" alt="favicon" src="#">
                                    </div>
                                </td>
                                <td class="col-md-6">
                                                                                <b>Techprocompsoft</b><br>
                                                                                                                                                                    <a target="_blank" href="http://www.techprocompsoft.com">http://www.techprocompsoft.com</a>
                                                                                    
                                            
                                            
                                     <div class="input-group mt10 col-md-10"><input type="text" value="#" class="form-control linkContentSelect" placeholder="">
                <span class="input-group-btn">
                	<a data-href="#" data-original-title="Copy to clipboard" type="button" data-toggle="tooltip" data-placement="bottom" title="Copy link to clipboard" class="link-copy-btn btn btn-primary mr10 button-right"><i class="fa fa-copy"></i> <span>Copy</span></a>
                    <a class="btn btn-primary button-left" target="_blank" href="#"><i class="fa fa-eye"></i> <span>View</span></a>
                    <a data-href="/links/link-share/8868" data-toggle="modal-link-share" class="btn btn-primary button-right" href="/links/link-share/8868"><i class="fa fa-share"></i> <span>Share</span></a>
               
       
                 </div>
   		
             <blockquote class="mt10">
            <i class="fa fa-quote-left"></i>
            <p>welcome to my dashboard</p>
            <small>sanjeev kumar</small>
          </blockquote>       
                                    </td>
                                <td>2 days ago</td>
                                <td><span><i class="fa fa-eye"></i> 4</span></td>
                                <td><span><i class="fa fa-user"></i> 0 </span></td>
                                <td> 
                                    <div data-requestid="8868" data-published="1" style="height: 20px; width: 50px;" class="toggle_link_8868 publish-toggle-btn toggle toggle-primary toggle-off"><div class="toggle-slide active"><div class="toggle-inner" style="width: 80px; margin-left: 0px;"><div class="toggle-on active" style="height: 20px; width: 40px; text-align: center; text-indent: -10px; line-height: 20px;">ON</div><div class="toggle-blob" style="height: 20px; width: 20px; margin-left: -10px;"></div><div class="toggle-off" style="height: 20px; width: 40px; margin-left: -10px; text-align: center; text-indent: 10px; line-height: 20px;">OFF</div></div></div></div>
                                </td>       

                                <td>
                                    <div class="btn-group pull-right  mr10">
                                        <a class="btn btn-primary" href="/links/edit/8868">Edit</a>
                                        <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle" type="button">
                                            <span class="caret"></span>
                                            <span class="sr-only">Toggle Dropdown</span>
                                        </button>
                                        <ul role="menu" class="dropdown-menu">
                                            <li><a href="/links/edit/8868">Edit</a></li>
                                            <li><a href="/analytics/links/8868">Analytics</a></li>
                                                                                                                                    <li class="divider"></li>
                                            <li><a data-del-callback-func="deleteRowItem" data-href="/links/delete/8868" data-confirm-message="Are you sure want to delete this link?" data-confirm-title="Delete link?" class="ui-confirm-delete-link" href="javascript:void(0);">Delete</a></li>
                                        </ul>
                                    </div><!-- btn-group -->
                                </td>
                            </tr>
                                            </tbody>
            </table>

        </div><!-- table-responsive -->

    <div class="box-tools pull-right">
                                        <ul class="pagination pagination-sm inline">
                                            <li><a href="#">«</a></li>
                                            <li><a href="#">1</a></li>
                                            <li><a href="#">2</a></li>
                                            <li><a href="#">»</a></li>
                                        </ul>
                                    </div>
    </div><!-- col-md-6 -->
</div><!-- panel -->

<div class="row text-center">
    <a class="btn btn-primary" href="basic.php"><i class="fa fa-link"></i> Create new link</a>
</div>

<script>
</script>                    </div>
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

</body>
</html>
