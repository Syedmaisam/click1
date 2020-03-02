<?php
include_once '../../config/config.php';
include_once SOURCE_ROOT.'getResponse/GetResponseAPI.class.php';
include_once SOURCE_ROOT_CONTROLLER."Apis/mailerlite.php";
include_once SOURCE_ROOT_CONTROLLER."Apis/mailchimp.php";
require_once(SOURCE_ROOT.'Awaber/aweber_api/aweber_api.php');
if($_POST['api_key']!=''){
	?>
<div class="box-body table-responsive no-padding">
	<?php
	if($_REQUEST['get_res_val']==1){
		$api = new GetResponse($_POST['api_key']);
		$campaigns 	 = (array)$api->getCampaigns();
		$campaignIDs = array_keys($campaigns);
	}   elseif($_REQUEST['get_res_val']==2)
	{
		try {

			$aweber = new AWeberAPI(AWABER_CONSUMER_KEY,AWABER_CONSUMER_SECRET);
			$aweber->adapter->debug = false;
			$arrDaata = $aweber->getDataFromAweberID($_POST['api_key']);
			$campaigns = $aweber->getAccount($arrDaata[2],$arrDaata[3]);
			echo "<input type='hidden' name='access_token' id='access_token' value='".$arrDaata[2]."'>";
			echo "<input type='hidden' name='access_secret' id='access_secret' value='".$arrDaata[3]."'>";
		} catch(Exception $e) {
			echo 'Message: Please get another auth code';
			exit;
		}
	} elseif($_REQUEST['get_res_val']==5)
	{
		$api = new Mailerlite_Controller($_POST['api_key']);
		$campaigns 	 = $api->getAll();
	}  elseif($_REQUEST['get_res_val']==3)
	{
		$api = new Mailchimp_Controller($_POST['api_key']);
		$campaigns 	 = $api->getList();
	}
	$j=0; ?>
<table class="table table-hover">
	<thead>
		<tr>
			<th>S.No.</th>
			<th>ID</th>
			<th>NAME</th>
			<th>Action</th>
		</tr>
	</thead>
<?php 
	if($_REQUEST['get_res_val']==1){
		for ($i=0;$i<count($campaigns);$i++)
		{
			?>
	<tr>
		<td><?php echo $j=$j+1; ?></td>
		<td><?php echo $campaignIDs[$i]; ?></td>
		<td><?php echo $campaigns[$campaignIDs[$i]]->name; ?></td>
		<td><i style="cursor: pointer;" class="fa fa-fw fa-plus" title="Add"
			onclick="add_getresponse_list('<?php echo $campaignIDs[$i]; ?>')"></i></td>
	</tr>
	<?php
		} } else if($_REQUEST['get_res_val']==5){
			foreach ($campaigns->Results as $cam){
				?>
	<tr>
		<td><?php echo $j=$j+1; ?></td>
		<td><?php echo $cam->id; ?></td>
		<td><?php echo $cam->name; ?></td>
		<td><i style="cursor: pointer;" class="fa fa-fw fa-plus" title="Add"
			onclick="add_getresponse_list('<?php echo $cam->id; ?>')"></i></td>
	</tr>
	<?php } }  else if($_REQUEST['get_res_val']==3){
		foreach ($campaigns->lists as $cam){
			?>
	<tr>
		<td><?php echo $j=$j+1; ?></td>
		<td><?php echo $cam['id']; ?></td>
		<td><?php echo $cam['default_from_name']; ?></td>
		<td><i style="cursor: pointer;" class="fa fa-fw fa-plus" title="Add"
			onclick="add_getresponse_list('<?php echo $cam['id']; ?>')"></i></td>
	</tr>
	<?php } }  else if($_REQUEST['get_res_val']==2){
		foreach ($campaigns->lists as $offset => $listawaber){
			?>
	<tr>
		<td><?php echo $j=$j+1; ?></td>
		<td><?php echo $listawaber->id; ?></td>
		<td><?php echo $listawaber->name; ?></td>
		<td><i style="cursor: pointer;" class="fa fa-fw fa-plus" title="Add"
			onclick="add_getresponse_list('<?php echo $list->id; ?>')"></i></td>
	</tr>
	<?php } } ?>

	<?php }
	?>
</table>
<input type="hidden" id="account_id" name="account_id"
	value="<?php echo ($campaigns->id!='')?$campaigns->id:''; ?>"></div>
