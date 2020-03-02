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
               
                <a data-toggle="modal-csv-export" href="/export?action=campaigns-csv&amp;id=769" data-original-title="Expor to CSV" data-placement="bottom" class="btn btn-white btn-xs tooltips"><i class="fa fa-table"></i></a>
                 <a href="" class="minimize">−</a>
            </div><!-- panel-btns -->
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
                            <th>Clicks</th>
                            <th></th>
                        </tr>
                    </thead>
                    <tbody>
                                                <tr>
                            <td><a href="/campaigns/view/125">my campaingn</a></td>
                            <td>test this campaign</td>
                            <td><span><i class="fa fa-pen"></i> 1</span></td>
                            <td><span><i class="fa fa-eye"></i> 6</span></td> 
                            <td><span><i class="fa fa-user"></i> 2</span></td>
                            <td>
                                <div class="btn-group pull-right  mr10">
                                   <a class="btn btn-primary" href="/campaigns/view/125 ">Messages</a>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/campaigns/view/125">Messages</a></li>                
                                        <li><a href="/campaigns/edit/125">Edit</a></li>
                                        <li><a href="/analytics/campaigns/125">Analytics</a></li>
                                        <li><a href="#">User access</a></li>
                                        <li class="divider"></li>
                                        <li><a href="/campaigns/delete/125">Delete</a></li>
                                    </ul>
                                </div><!-- btn-group -->
                            </td>
                        </tr>
                                                <tr>
                            <td><a href="/campaigns/view/133">my camp 2</a></td>
                            <td>my camp 2 desc</td>
                            <td><span><i class="fa fa-pen"></i> 1</span></td>
                            <td><span><i class="fa fa-eye"></i> 0</span></td> 
                            <td><span><i class="fa fa-user"></i> 0</span></td>
                            <td>
                                <div class="btn-group pull-right  mr10">
                                   <a class="btn btn-primary" href="/campaigns/view/133 ">Messages</a>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="/campaigns/view/133">Messages</a></li>                
                                        <li><a href="/campaigns/edit/133">Edit</a></li>
                                        <li><a href="/analytics/campaigns/133">Analytics</a></li>
                                        <li><a href="#">User access</a></li>
                                        <li class="divider"></li>
                                        <li><a href="/campaigns/delete/133">Delete</a></li>
                                    </ul>
                                </div><!-- btn-group -->
                            </td>
                        </tr>
                                             </tbody>
                </table>
            </div><!-- table-responsive -->
        </div>
    </div>
              
              
              
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>


<?php include_once "js/javascript.php"; ?>

</body>
</html>
