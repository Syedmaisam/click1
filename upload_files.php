<?php
include_once "config/config.php";
global $objGenral;
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
$objDomain = new Domain_Controller();
$domain = $_POST['domain_name'];
$arrSplitDom = explode(".",$domain);
$target_dir = "../{$arrSplitDom[0]}/";
for($i=0;$i<count($_FILES["fileToUpload"]["name"]);$i++){
if($_FILES["fileToUpload"]["name"][$i]!=''){
$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"][$i]);
$uploadOk = 1;
$imageFileType = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
if(isset($_POST["submit"])) {
    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"][$i]);
    if($check !== false) {
$param = array('file_name'=>$_FILES["fileToUpload"]["name"][$i],'domain_name'=>$domain);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file);
$objDomain->uploadFiles($param);
$objGenral->standardRedirect(SITE_ROOT_URL.'views/Profile/domain_settings.php');
       // echo "File is an image - " . $check["mime"] . ".";
        $uploadOk = 1;
    } else {
  //      echo "File is not an image.";
$param = array('file_name'=>$_FILES["fileToUpload"]["name"][$i],'domain_name'=>$domain);
move_uploaded_file($_FILES["fileToUpload"]["tmp_name"][$i], $target_file);
$objDomain->uploadFiles($param);

        $uploadOk = 0;
    }
}
}
}
echo "<script type='text/javascript'>document.location.href = 'http://cliks.it/click/views/Profile/fileuploader.php'</script>";
//header("location: http://cliks.it/clik/views/Profile/domain_settings.php'");
//$objGenral->standardRedirect(SITE_ROOT_URL.'views/Profile/domain_settings.php');
?> 