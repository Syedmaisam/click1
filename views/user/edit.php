<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT_CONTROLLER.'User/adduser.php';

$iduser=$_REQUEST['id'];

$objuserData = new user_Controller();
$arrData=$objuserData->get_User_Data($iduser);


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
                        <small>Edit Users</small>
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

                      <div class="box box-info">
               
                <div class="box-body">
                <div class="callout callout-success alert-success alrtsuccess" style="display:none;">
                    <h4>Message</h4>
                    <p>User updated successfully...</p>
                  </div>
                  <!-- Color Picker -->
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label>Full Name</label>
                       <input type="text" class="form-control" id="fullname" value="<?php echo $arrData[0]['name']; ?>">
                    </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label>Email Address</label>
                       <input type="text" class="form-control" id="fullname"  value="<?php echo $arrData[0]['mailaddress']?>" disabled="disabled">
                      
                    </div>
                  </div>
                  <div class="row">
                  <div class="form-group col-md-6">
                      <label>Password</label>
                       <input type="password" class="form-control" id="passw">
                        <i>Leave blank to not change password</i>
                    </div>
                  </div>
                  <div class="row">
                  <div class="col-md-6">
              <button type="submit" class="btn btn-primary btn-block btn-flat"  style="height:40px;" onClick="updateuser(<?php echo $iduser ?>)">Save</button>
            </div></div>
            
                  </div>
                </div><!-- /.box-body -->
                     
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


</body>
</html>
