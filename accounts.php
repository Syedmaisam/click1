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
                      <i class="fa fa-desktop"></i> Account Settings
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
            <a class="minimize" href="">−</a>
        </div>
        <h4 class="panel-title">Account Details</h4>

    </div>


    <div class="panel-body">
        
            <div class="form-group" style="height:35px;">
                <label class="col-sm-4 control-label"><label for="profileemail">E-Mail</label></label>
                <div class="col-sm-8">
                    <input type="email" value="sksanjstyle@gmail.com" maxlength="100" required id="profileemail" class="form-control required" name="email">                </div>
                <p></p>            </div>


            <div class="form-group"  style="height:35px;">
                <label class="col-sm-4 control-label"><label for="profilepassword">Password</label></label>
                <div class="col-sm-8">
                    <input type="password" value="" maxlength="50" required id="profilepassword" class="form-control required" name="password">                </div>
                <p></p>            </div>     


            <div class="form-group"  style="height:35px;">
                <label class="col-sm-4 control-label"><label for="profilefirstName">First name</label></label>
                <div class="col-sm-8">
                    <input type="text" value="sanjeev" maxlength="50" required id="profilefirstName" class="form-control required" name="firstName">                </div>
                <p></p>            </div> 

            <div class="form-group"  style="height:35px;">
                <label class="col-sm-4 control-label"><label for="profilelastName">Last name</label></label>
                <div class="col-sm-8">
                    <input type="text" value="kumar" maxlength="50" required id="profilelastName" class="form-control required" name="lastName">                </div>
                <p></p>            </div>      



    </div>

    <div class="panel-footer">
        <div class="row text-center">
            <p><label></label><input type="submit" value="Update" id="profilesubmitbtn" class="formbutton btn btn-primary" name="submitbtn"></p>    
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
