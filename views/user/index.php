<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
//include_once SOURCE_ROOT.'session_redirect.php';
include_once SOURCE_ROOT_CONTROLLER.'User/Profile.php';
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';
$objProfile = new Profile_Controller();

$objuserData = new user_Controller();
$arrData=$objuserData->get_All_User();


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
                      <i class="fa fa-desktop"></i> Manage Users
                        <small>Manage your Users</small>
                    </h1>
                    <ol class="breadcrumb">
                        <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
                        <li><a href="#">users</a></li>

                    </ol>
                </section>

                <!-- Main content -->
                <section class="content">
                 


<div class="contentpanel">
        
                     <div class="content-js-nocss">

                      <div class="box">
                
                <div class="box-body">
                  <table id="example1" class="table table-bordered table-striped">
                    <thead>
                      <tr>
                        <th>Name</th>
                        <th>Email</th>
                        
                        <th style="width:20%;">Manage</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php 
                    foreach ($arrData as $data){
                    
                    ?>
                      <tr>
                        <td><?php echo $data['name']; ?></td>
                        <td><?php echo $data['mailaddress']; ?></td>
                       
                        <td>
                        
                        
                        <a class="btn btn-primary" href="<?php echo SITE_ROOT_URL.'views/user/edit.php?id='.$data['id']; ?>">Edit</a> <?php if($data['userType']!='admin') {?><button class="btn btn-success" onClick="login_subuser(<?php echo $data['id'] ?>)">Login</button> <button class="btn btn-warning" onClick="delrec(<?php echo $data['id'] ?>)">Delete</button>
                     <?php }?>
                        </td>
                      
                      </tr>
                      <?php 
                    }
                      ?>
                     
                    </tbody>
                    <tfoot>
                      <tr>
                       <th>Name</th>
                        <th>Email</th>
                       
                        <th style="width:20%;">Manage</th>
                      </tr>
                    </tfoot>
                  </table>
                </div><!-- /.box-body -->
              </div>
                     
                  </div>
                </div><!-- /.box-body -->
              </div>
       
   
        <!-- panel -->


                    </div>
                </div>


                </section><!-- /.content -->
            </aside><!-- /.right-side -->

			
</div>

<?php include_once SOURCE_ROOT."js/javascript.php"; ?>

<script type="text/javascript">
      $(function () {
        $("#example1").dataTable();
        $('#example2').dataTable({
          "bPaginate": true,
          "bLengthChange": false,
          "bFilter": false,
          "bSort": true,
          "bInfo": true,
          "bAutoWidth": false
        });
      });
    </script>
</body>
</html>
