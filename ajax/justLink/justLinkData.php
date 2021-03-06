<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT.'controller/image/getProfileValueController.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$objProfile  = new getProfileValueController();
$arrLinkData = $objJustLink->get_jusLink();
$objDomain = new Domain_Controller();
$arrDomianData = $objDomain->get_domain();
foreach ($arrLinkData as $linkData){

	 ?>

		<tr class="tr_<?php echo $linkData['id']; ?>">
			<td>
			<div class="col-xs-4"><img class="img16" alt="favicon" src="<?php echo $objJustLink->getfavicon($linkData['destination_url']); ?>" style='height:20px;width:20px;'></div>
			</td>
			<td class="col-md-6">
			<small>
			<?php echo $linkData['link_name']; ?>: <a target="_blanck" rel="prettyPhoto" href="<?php echo $linkData['destination_url']; ?>" id="sharetitle_<?php echo $linkData['id']?>"><?php echo $linkData['destination_url']; ?></a>



			<div class="input-group mt10 col-md-10"><input type="text" value="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$linkData['randUrl']:SITE_ROOT_URL.$linkData['randUrl']; ?>"
				class="form-control linkContentSelect" placeholder="" id="sharelink_<?php echo $linkData['id']?>"> <span
				class="input-group-btn"> <a data-href="#"
				data-original-title="Copy to clipboard" type="button"
				data-toggle="tooltip" data-placement="bottom"
				title="Copy link to clipboard" data_tip='<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$linkData['randUrl']:SITE_ROOT_URL.$linkData['randUrl']; ?>'
				class="link-copy-btn btn btn-primary mr10 button-right" id="copy-dynamic"><i
				class="fa fa-copy"></i> <span>Copy</span></a><a
				class="btn btn-primary button-left" target="_blank" href="<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$linkData['randUrl']:SITE_ROOT_URL.$linkData['randUrl']; ?>"><i
				class="fa fa-eye"></i> <span>View</span></a> <a
								class="btn btn-primary button-right" target="_blank" href="#"  onclick="showsharepopup(<?php echo $linkData['id']?>);"><i
				class="fa fa-share"></i> <span>Share</span></a></div>
<blockquote class='mt10'>
			<i class='fa fa-quote-left'></i>
			<p>
				<span id="sharemessage_<?php echo $linkData['id']?>"><?php echo $linkData['message']; ?></span> <a title='Edit campaign message'
					href='/campaigns/view/125'></a>
			</p>
			<small id="shareprofile_<?php echo $linkData['id']?>"><?php $arrProfileData = $objProfile->getProfileValue($linkData['profile_id']); echo $arrProfileData[0]['profile_name'] ?></small>
		</blockquote>
			</td>
			<td><small><?php echo $objJustLink->getTimes($linkData['add_date']); ?></small></td>
			<td><span><i class="fa fa-eye"></i> <?php echo $linkData['view']; ?></span></td>
			<td><span><i class="fa fa-user"></i> <?php echo $linkData['uniqueview']; ?></span></td>
			<td>
			<div >
			<input id="switch-size" class="just_<?php echo $linkData['id']; ?>" type="checkbox" <?php echo ($linkData['status']==1)?"checked":''; ?> data-size="mini" data-on-text="Publish" onChange="change_just_link_status('<?php echo $linkData['id']; ?>')" data-label-width="20">
			</div>
			</td>

			<td>
			<div class="btn-group pull-right  mr10" style="width: 80px;"><a class="btn btn-primary"
				href="<?php echo SITE_ROOT_URL.'views/justLink/edit.php/'.$linkData['id']; ?>">Edit</a>
			<button data-toggle="dropdown"
				class="btn btn-primary dropdown-toggle" type="button"><span
				class="caret"></span> <span class="sr-only">Toggle Dropdown</span></button>
			<ul role="menu" class="dropdown-menu">
				<li><a href="<?php echo SITE_ROOT_URL.'views/justLink/edit.php/'.$linkData['id']; ?>">Edit</a></li>
				<li class="divider"></li>
				<li><a href="<?php echo SITE_ROOT_URL.'views/justLink/analytics.php/'.$linkData['randUrl'] ?>">Analytics</a></li>
				<li class="divider"></li>
				<li><a onclick="deleteJustLink('<?php echo $linkData['id']; ?>')" style="cursor: pointer;">Delete</a></li>
			</ul>
<input type="hidden" id="hid_<?php echo $linkData['id'];?>" value="<?php echo SITE_ROOT_URL.'/images/profile/'.$arrProfileData[0]['profile_image_path'];?>">
			</div>
			<!-- btn-group --></td>
		</tr>
		<?php } ?>
	<script src="<?php echo SITE_ROOT_URL; ?>js/highlight.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/bootstrap-switch.js"></script>
    <script src="<?php echo SITE_ROOT_URL; ?>js/main.js"></script>