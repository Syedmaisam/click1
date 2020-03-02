<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
include_once SOURCE_ROOT_CONTROLLER.'image/getProfileValueController.php';
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
$objDomain = new Domain_Controller();
$arrDomianData = $objDomain->get_domain();
$objJustLink = new Justlink_Controller();

$obj  = new getProfileValueController();
$profileVal = $obj->getProfileValue();
$objBasic = new basicController();

for ($i=0;$i < count($profileVal); $i++)
{
	
	$arrData=$objBasic->getFormDetails($profileVal[$i]['id']);
	foreach ($arrData as $data)
	{
		?>
<tr>
	<td>
		<div class='col-xs-4'>
			<img class='img16' alt='favicon' src='<?php echo $objJustLink->getfavicon($data['contenturl']); ?>' style="height: 20px; width: 20px;">
		</div>
	</td>
	<td class='col-md-6' id><?php echo $data['title'];?> <a rel='prettyPhoto' id="sharetitle_<?php echo $data['id']?>" target="_blank" href='<?php echo $data['contenturl'];?>'><?php echo $data['contenturl'];?></a>



		<div class='input-group mt10 col-md-10'>
			<input type='text' value='<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$data['randomlink']:SITE_ROOT_URL.$data['randomlink']; ?>' class='form-control linkContentSelect' id="sharelink_<?php echo $data['id']?>"
				placeholder=''> <span class='input-group-btn'> <a data-href='#'
				data-original-title='Copy to clipboard' type='button'
				data-toggle='tooltip' data-placement='bottom'
				title='Copy link to clipboard' data_tip='<?php echo SITE_ROOT_URL.$data['randomlink']; ?>'
				class='link-copy-btn btn btn-primary mr10 button-right' id="copy-dynamic" ><i
					class='fa fa-copy'></i> <span>Copy</span> </a> <a
				class='btn btn-primary button-left' target='_blank' href='<?php echo ($arrDomianData[0]['domain_status']==1)?"http://".$arrDomianData[0]['domain_name']."/".$data['randomlink']:SITE_ROOT_URL.$data['randomlink']; ?>'><i
					class='fa fa-eye'></i> <span>View</span> </a> <a
								class='btn btn-primary button-right' id="sharedata_<?php echo $data['id']?>" href='#' onclick="showshare(<?php echo $data['id']?>);"><i class='fa fa-share'></i> <span>Share</span></a>
		
		</div>

		<blockquote class='mt10'>
			<i class='fa fa-quote-left'></i>
			<p>
				<span id="sharemessage_<?php echo $data['id']?>"><?php echo $data['message']; ?></span> <a title='Edit campaign message'
					href='/campaigns/view/125'></a>
			</p>
			<small id="shareprofile_<?php echo $data['id']?>"><?php echo $profileVal[$i]['profile_name']; ?></small>
		</blockquote>
	</td>
	<td><small><?php echo $objJustLink->getTimes($data['created']);  ?></small></td>
	<td><small><?php echo $objJustLink->getAnswerCount($data['id'], $data['profile'] )?></small></td>
	
	
	<td>
		<div class='btn-group pull-right  mr10' style="width: 79px;">
			<a class='btn btn-primary' href='EditFormsAndPoll.php/<?php echo $data['id']; ?>'>Edit</a>
			<button style="height: 34px;" data-toggle='dropdown'
				class='btn btn-primary dropdown-toggle' type='button'>
				<span class='caret'></span> <span class='sr-only'>Toggle Dropdown</span>
			</button>
			<ul role='menu' class='dropdown-menu'>
				<li><a href='EditFormsAndPoll.php/<?php echo $data['id']; ?>'>Edit</a></li>
								<li class='divider'></li>
				
				<li><a href="<?php echo SITE_ROOT_URL.'views/basic/analyticsFormPoll.php/'. $data['randomlink']; ?>">Analytics</a></li>
				<li class='divider'></li>
<li><a href="<?php echo SITE_ROOT_URL.'views/basic/viewresult.php/'. $data['randomlink']; ?>">View Results</a></li>
				<li class='divider'></li>
				<li style="cursor:pointer;"><a data-del-callback-func='deleteRowItem'
					data-href='/links/delete/9061'
					data-confirm-message='Are you sure want to delete this link?'
					data-confirm-title='Delete link?' class='ui-confirm-delete-link'
					onclick="delete_FormsPolldetail('<?php echo $data['id']; ?>')">Delete</a>
				</li>
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