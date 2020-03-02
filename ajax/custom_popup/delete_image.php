<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'custom_template_image/customImageController.php';
$customImageObj = new customImageController();


$img_id = $_REQUEST['img_id'];
$arrdata = $customImageObj->delete_and_getimage_again($img_id);
?>

	<ul style="position: relative; height: 119px;" class="img-bank masonry">
		<?php
		foreach($arrdata as $image_data_new)

               {                 ?>
		<li
			style="top: 0px; left: 120px; display: inline-block; width: 115px;"
			class="li_draggable masonry-brick" title="Click &amp; Drag"
			id="li_remove_<?php echo $image_data_new['id']; ?>">

			<div class="img_slide" style="height: 100px !important;">
				<div class="del_image_link">
					<a href="javascript:void(o);"
						class="remove-img-link image_bank_unlink" id="16957"><img
						onClick="delete_select_image(<?php echo $image_data_new['id']; ?>)"
						style="width: 20px !important; position: absolute; margin-left: -7px;"
						src="images/close.png" /> </a>
				</div>

				<div class="image_bank_div">

					<div class="image_bank_div">
						<img class="image_bank draggable1 ui-draggable"
							id="<?php echo $image_data_new['id']; ?>"
							src="<?php echo SITE_ROOT_URL.'images/customImage/'.$image_data_new['image_source'];?>"
							name="uploadImg/<?php echo $image_data_new['image_source']; ?>,70,70"
							style="width: auto; height: 100px;">
					</div>

				</div>
		
		</li>
		<?php 
               }
               ?>
	</ul>