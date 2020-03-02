<?php
include "../../../config/config.php";
$popupdata="<div id='popupform' style='position:relative;'>".$_REQUEST['popupform']."</div>";

$ss= htmlentities(mysql_real_escape_string($popupdata));
						//$sql="insert into popup(text_data) values('$ss')";
						$sql="UPDATE popup SET text_data ='$ss' WHERE id=1";
						mysql_query($sql);
						
						echo "updated";

?>