<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
$arrLinkData = $objJustLink->get_jusLink();
?>
<?php $j=0; foreach ($arrLinkData as $linkdata){ $j=$j+1; ?>
<tr>
	<td><?php echo $j; ?></td>
	<td><a data-questions-array="" data-generator-action-link="#"
		data-generator-action-text="Techp"
		data-generator-message-text="welcome to my dashboard"
		data-link-profile="769" data-msg-white-label="0"
		data-msg-action-type="0" data-msg-link-bg="#00aeef"
		data-msg-link-color="#ffffff" data-msg-style="0"
		data-msg-text="#36393D" data-msg-opacity="5"
		data-msg-background="#ff0000" data-msg-position="0"
		data-generator-design="0" class="history-link"
		href="<?php echo $linkdata['link_url']; ?>"><?php echo $linkdata['link_name']; ?></a></td>
	<td><?php echo $objJustLink->getTimes($linkdata['add_date']);  ?></td>
	<td class="table-action"><a data-confirm-title="Edit message" class="ui-confirm-edit-link"
		href="<?php echo SITE_ROOT_URL.'views/justLink/edit.php/'.$linkdata['id']; ?>"><i class="fa fa-pencil"></i></a></td>
</tr>
<?php } ?>