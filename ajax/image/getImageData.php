<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT.'controller/image/getProfileValueController.php';
include_once SOURCE_ROOT.'controller/image/getHistoryController.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
$objJustLink = new Justlink_Controller();
$objHistoryController = new getHistoryController();
$obj  = new getProfileValueController();
$profileVal = $obj->getProfileValue();
$objDomain = new Domain_Controller();
$arrDomianData = $objDomain->get_domain();
for ($i=0;$i < count($profileVal); $i++)
{
	$arrData = $objHistoryController->getImagedata($profileVal[$i]['id']);
	foreach ($arrData as $data)
	{
		?>
<tr id="image_<?php echo $data['id']; ?>">
	<td>
		<div class="col-xs-4">
			<img style="width: 65px;" class="img16" alt="favicon"
				src="<?php
				if($data['imageLocation'] != '' && $data['imageLocation'] != null)
				{ 
					echo SITE_ROOT_URL.'images/basic/'.$data['imageLocation'];
				} else {
				echo $data['imageUrl'];
				}?>">
		</div>
	</td>
	<td class="col-md-6"><a rel="prettyPhoto" target="_blank"
		href="<?php echo SITE_ROOT_URL.'images/basic/'.$data['imageLocation']; ?>" id="sharetitle_<?php echo $data['id']; ?>"><?php echo $data['title']; ?>
	</a>
		<div class="input-group mt10 col-md-10">
			<input type="text" id="sharelink_<?php echo $data['id']; ?>"
				value="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$data['randomLink']:SITE_ROOT_URL.$data['randomLink']; ?>"
				class="form-control linkContentSelect" placeholder=""> <span
				class="input-group-btn"> <a data-href="#"
				data-original-title="Copy to clipboard" type="button"
				data-toggle="tooltip" data-placement="bottom"
				title="Copy link to clipboard" data_tip='<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$data['randomLink']:SITE_ROOT_URL.$data['randomLink']; ?>'
				class="link-copy-btn btn btn-primary mr10 button-right" id="copy-dynamic"><i
					class="fa fa-copy"></i> <span>Copy</span> </a> <a
				class="btn btn-primary button-left" target="_blank"
				href="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$data['randomLink']:SITE_ROOT_URL.$data['randomLink']; ?>"><i
					class="fa fa-eye"></i> <span>View</span> </a> <a
								class='btn btn-primary button-right' id="sharedata_<?php echo $data['id']?>" href='#' onclick="showsharepopup(<?php echo $data['id']?>);"><i
					class='fa fa-share'></i> <span>Share</span> </a>
		
		</div>

		<blockquote class="mt10">
			<small id="shareprofile_<?php echo $data['id']; ?>"><?php echo $profileVal[$i]['profile_name']; ?> </small>
		</blockquote>
	</td>
	<td><?php echo $objJustLink->getTimes($data['created']); ?></td>
	<td><span><i class="fa fa-eye"></i> <?php echo $data['view'];?></span></td>
	<td><span><i class="fa fa-user"></i> <?php echo $data['uniqueview'];?> </span></td>
	<td>
		<div>
			<input id="switch-size" class="basic_<?php echo $data['id']; ?>" type="checkbox" <?php echo ($data['status']==1)?"checked":''; ?> data-size="mini" data-on-text="Publish" onChange="change_image_link_status('<?php echo $data['id']; ?>')" data-label-width="20">
		</div>
	</td>
	<td>
		<div class="btn-group pull-right  mr10">
			<a class="btn btn-primary"
				href="<?php echo SITE_ROOT_URL.'views/image/edit.php/'.$data['id']; ?>">Edit</a>
			<button data-toggle="dropdown"
				class="btn btn-primary dropdown-toggle" type="button">
				<span class="caret"></span> <span class="sr-only">Toggle Dropdown</span>
			</button>
			<ul role="menu" class="dropdown-menu">
				<li><a
					href="<?php echo SITE_ROOT_URL.'views/image/edit.php/'.$data['id']; ?>">Edit</a>
				</li>
				<li class="divider"></li>
				<li><a href="<?php echo SITE_ROOT_URL.'views/image/analytics.php/'.$data['randomLink']; ?>">Analytics</a></li>
				<li class="divider"></li>
				<li style="cursor:pointer;"><a data-del-callback-func="deleteRowItem"
					data-href="/links/delete/9061"
					data-confirm-message="Are you sure want to delete this link?"
					data-confirm-title="Delete link?" class="ui-confirm-delete-link"
					onclick="delete_image('<?php echo $data['id']; ?>')">Delete</a></li>
			</ul>
<input type="hidden" id="hid_<?php echo $data['id'];?>" value="<?php echo SITE_ROOT_URL.'/images/profile/'.$profileVal[$i]['profile_image_path'];?>">
		</div> <!-- btn-group -->
	</td>
</tr>
<?php  } 
} ?>

	<script src="<?php echo SITE_ROOT_URL; ?>js/highlight.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/bootstrap-switch.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/main.js"></script>
