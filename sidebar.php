<aside class="left-side sidebar-offcanvas"  style="background-color:<?php echo $colorData[0]['SideBarBgColor'] ?>">
                <!-- sidebar: style can be found in sidebar.less -->
                <section class="sidebar">
                    <!-- Sidebar user panel -->
                    <div class="user-panel">
                        <div class="pull-left image">
                        <?php 
                       if($_SESSION['userpicpath']!="")
                       {
                       	?>
                       
                            <img src="<?php echo SITE_ROOT_URL; ?>images/profile/<?php echo $_SESSION['userpicpath']; ?>" class="img-circle" alt="User Image" />
                            <?php } else {?>
                        
                            <img src="<?php echo SITE_ROOT_URL; ?>img/defaultuser.png" class="img-circle" alt="User Image" />
                            <?php } ?>
                        </div>
                        <div class="pull-left info">
                            <p>Hello, <?php echo $_SESSION["username"]; ?></p>

                            <a href="#" style="border-left:none;"><i class="fa fa-circle text-success"></i> Online</a>
                        </div>
                    </div>
                    <!-- search form -->
            
                    <!-- /.search form -->
                    <!-- sidebar menu: : style can be found in sidebar.less -->
                    <ul class="sidebar-menu">
                        <li class="active">
                            <a href="<?php echo SITE_ROOT_URL.'index.php'; ?>">
                                <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                            </a>
                        </li>

                        <li class="treeview">
                            <a href="<?php echo SITE_ROOT_URL.'link'; ?>">
                                <i class="fa fa-qrcode "></i> <span>Basic</span>
                             
                            </a>
							<ul class="treeview-menu">
                              <li><a href="<?php echo SITE_ROOT_URL; ?>views/basic" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View List</a></li>
                          <li><a href="<?php echo SITE_ROOT_URL; ?>views/basic/add.php" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Create New Link</a></li>
<li><a href="<?php echo SITE_ROOT_URL; ?>views/basic/ViewFormsandPolls.php" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> View Polls and Forms</a></li>
                              <li><a href="<?php echo SITE_ROOT_URL; ?>views/basic/Polls.php" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Create New Poll</a></li>
  <li><a href="<?php echo SITE_ROOT_URL; ?>views/basic/Forms.php" style="margin-left: 10px;"><i class="fa fa-angle-double-right"></i> Create New Form</a></li>
                            </ul>
                        </li>
                        
                  
                        <li class="treeview">
                            <a href="#">
                                <i class="fa fa-briefcase"></i> <span>Campaigns</span>
                                <!--<small class="badge pull-right bg-yellow" id="buketCount">0</small>-->
                            </a>
							<ul class="treeview-menu">
                                <li><a href="<?php echo SITE_ROOT_URL; ?>views/campaign/index.php" style="margin-left: 10px;cursor:pointer;"><i class="fa fa-angle-double-right"></i> View List</a></li>
                                <li><a href="<?php echo SITE_ROOT_URL; ?>views/campaign/add.php" style="margin-left: 10px;cursor:pointer;"><i class="fa fa-angle-double-right"></i> Add New Campaign</a></li>
                            
                            </ul>
                        </li>
					
                    
					<li class="treeview">
                            <a href="#">
                                <i class="fa fa-bar-chart-o"></i> <span>Analytics</span>
                                <!--<small class="badge pull-right bg-yellow" id="buketCount">0</small>-->
                            </a>
							<ul class="treeview-menu">
                                <li><a href="<?php echo isset ( $_SESSION ['trialuser'] )? $_SESSION ['trialuser']:SITE_ROOT_URL.'views/Analytics/profile_stats_views.php'; ?>"  style="margin-left: 10px;cursor:pointer;"><i class="fa fa-angle-double-right"></i> All Analytics</a></li>
                                <?php 
                        if($_SESSION['usertype']=="admin")
                        {
               ?>
                                <li><a href="<?php echo SITE_ROOT_URL.'views/settings/analytic_settings.php' ?>" style="margin-left: 10px;cursor:pointer;"><i class="fa fa-angle-double-right"></i> Analytic Settings</a></li>
				<?php } ?>				
                            
                            </ul>
                        </li>
                        <?php 
                                 	if($colorData[0]['SupportLink']!="")
                        	{
                        ?>
                       
				<li>
                            <a href="<?php echo $colorData[0]['SupportLink']; ?>" target="_blank">
                                <i class="fa fa-fw fa-question"></i> <span>Support</span>
                            </a>
                        </li>
                        <?php } ?>
                        <?php 
                        if($_SESSION['usertype']=="admin")
                        {
               ?>
                        <li>
                            <a href="<?php echo SITE_ROOT_URL; ?>views/settings/index.php">
                                <i class="fa fa-fw fa-gears"></i> <span>Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="<?php echo SITE_ROOT_URL; ?>views/user/index.php">
                                <i class="fa fa-fw fa-user"></i> <span>Manage Users</span>
                            </a>
                        </li>
                        <?php } ?>
                    </ul>
					
                </section>
                <!-- /.sidebar -->
               
                
            </aside>

 <!--<div style="position:fixed;bottom:50px;left:0;z-index:99999;">
            <div style="width:190px; height:50px;background:#dbdbdb;">
<p><a href="https://inspiredsoft.freshdesk.com" target="_blank"><img style="border:1px solid#dbdbdb;" src="<?php echo SITE_ROOT_URL.'images'; ?>/inspiredbox.png"/></a></p>
</div>

<div style="width:190px; height:50px;background:#dbdbdb; margin-top:15px;">
<p><a href="http://cliks.it/tutorial" target="_blank"><img style="border:1px solid#dbdbdb;" src="<?php echo SITE_ROOT_URL.'images'; ?>/quiksitbox.png"/></a></p>
</div>
</div>
-->
            <div class="row" id="upv" style="width:500px; height:300px; display:none; position:fixed; top:30%;left:40%; z-index:90000000;">
            <div class="col-md-10">
                            <!-- Primary box -->
                            <div class="box box-solid box-primary">
                                <div class="box-header">
                                    <h3 class="box-title">Information</h3>
                                    <div class="box-tools pull-right">
                                       
                                        <button  onclick="closeupv();" class="btn btn-primary btn-sm"><i class="fa fa-times"></i></button>
                                    </div>
                                </div>
                                <div class="box-body">
                                  
                                    <p>
                                        You are using free version. Please upgrade version to use full features...
                                    </p>
<p>  <a href="http://cliks.it/upgrade" target="_blank">Upgrade</a>  </p>
                                </div><!-- /.box-body -->
                            </div><!-- /.box -->
                        </div>
            
            </div>
            <style type="text/css">
            .mid_box{clear: both;margin: 40% auto auto; padding: 5px;text-align: center;}
            .mid_box input{border: 1px solid #ccc;
    margin-bottom: 8px;
    margin-top: 13px;
    padding: 10px;}
            .db_q{ cursor: pointer;font-size: 18px;}
            </style>
 <script type="text/javascript" src="<?php echo SITE_ROOT_URL; ?>js/jquery.min.js"></script>           
            <script>
function upversion()
{
$(".blackscreen").show();
$("#upv").show();
}
function closeupv()
{
	$("#upv").hide();
	$(".blackscreen").hide();
}
$(document).ready(function(){
	
setTimeout(function(){ 
var clr="<?php echo $colorData[0]['SideBarTxtColor'] ?>";
var tphbclr="<?php echo $colorData[0]['TopBarTxtColor'] ?>";
$(".skin-blue .sidebar a").css("color",clr);
$(".skin-blue .navbar .sidebar-toggle .icon-bar").css("background-color",tphbclr);
$(".user-menu .glyphicon-user").css("color",tphbclr);
$(".user-menu .caret").css("color",tphbclr);
	}, 500);
});

            </script>
            
   <style>
   
  .skin-blue .sidebar > .sidebar-menu > li.active > a
   {
   background-color:<?php echo $colorData[0]['SideBarTxtHoverColor']; ?>;
   }
   skin-blue .sidebar > .sidebar-menu > li > a:hover
   {
   background-color:<?php echo $colorData[0]['SideBarTxtHoverColor']; ?>!important;
   }
   .skin-blue .sidebar > .sidebar-menu > li > .treeview-menu
   {
   background-color:<?php echo $colorData[0]['TopBarTxtHoverColor']; ?>;
   }
   .logotx{color:<?php echo $colorData[0]['logoTxtColor']; ?>;}
   </style>         