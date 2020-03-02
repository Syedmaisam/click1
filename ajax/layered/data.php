<?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'Layered/Layered.php';
$objLayered = new Layered_Controller();
$arrLayeredData = $objLayered->get_layered();
include_once SOURCE_ROOT_CONTROLLER.'justLink/Justlink.php';
$objJustLink = new Justlink_Controller();
?>
<?php $j=0; foreach ($arrLayeredData as $layeredData){ $j=$j+1; ?>
                                  	<tr>
                                        <td><?php echo $j; ?></td>
                                        <td><a data-questions-array="" data-generator-action-link="#" data-generator-action-text="Techp" data-generator-message-text="welcome to my dashboard" data-link-profile="769" data-msg-white-label="0" data-msg-action-type="0" data-msg-link-bg="#00aeef" data-msg-link-color="#ffffff" data-msg-style="0" data-msg-text="#36393D" data-msg-opacity="5" data-msg-background="#ff0000" data-msg-position="0" data-generator-design="0" class="history-link" href="<?php echo $linkdata['../basic - Copy/link_url']; ?>"><?php echo $layeredData['popup_title']; ?></a></td>
                                        <td><?php echo $layeredData['popup_title']; ?></a></td>
			<td><?php echo $objJustLink->getTimes($layeredData['popup_created_date']);  ?></td>
                                        <td class="table-action">
                                            <a data-confirm-message="Do you want to edit this message?" data-confirm-title="Edit message" class="ui-confirm-edit-link" href="<?php echo SITE_ROOT_URL.'views/layered/edit.php/'.$layeredData['poup_id']; ?>"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                               <?php } ?>    