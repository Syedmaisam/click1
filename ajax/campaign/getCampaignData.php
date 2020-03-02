 <?php
include_once "../../config/config.php";
include_once SOURCE_ROOT_CONTROLLER.'campaign/addCampaign.php';
$objCampaign = new campaign_Controller();
$arrCampaignData = $objCampaign->get_user_all_campaign();
$ProfileId=$_POST['Profile'];
$CmpId=$_POST['CampID'];


/* echo "<pre>";
var_dump($arrCampaignData); exit; */
foreach ($arrCampaignData as $campData)
{ 

	$arrMessageCount=$objCampaign->getMessageCount($campData['profile_id'],$campData['id']);
	//var_dump($arrMessageCount[0]['mcount']);

	?>

               
                         <tr class="tr_<?php echo $campData['id']; ?>">
                           <td><?php echo $campData['ProfileName'] ?></td>
                            <td><a href="<?php echo SITE_ROOT_URL.'views/campaign/messages.php/'.$campData['id'].'/'.$campData['profile_id']; ?>"><?php echo $campData['campaign_name']; ?></a></td>
                            <td><?php echo $campData['campaign_desc']; ?></td>
                            <td><span><i class="fa fa-pen"></i> <?php echo $arrMessageCount[0]['mcount'] ?></span></td>
                            <td><span><i class="fa fa-eye"></i> <?php echo $campData['ViewCount'];?></span></td> 
                            <td><span><i class="fa fa-user"></i> <?php echo $campData['UniqueViewCount'];?></span></td>
                            <td>
                                <div class="btn-group pull-right  mr10">
                                   <a class="btn btn-primary" href="<?php echo SITE_ROOT_URL.'views/campaign/messages.php/'.$campData['id'].'/'.$campData['profile_id'];; ?> ">Messages</a>
                                    <button type="button" class="btn btn-primary dropdown-toggle" data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="<?php echo SITE_ROOT_URL.'views/campaign/messages.php/'.$campData['id'].'/'.$campData['profile_id']; ?>">Messages</a></li>                
                                        <li><a href="<?php echo SITE_ROOT_URL.'views/campaign/editCampaign.php/'.$campData['id'];?>">Edit</a></li>
                                        <li class="divider"></li>
										<li style='display:none;'><a href="<?php echo SITE_ROOT_URL.'views/Analytics/campaign_stats_views.php?id='. $campData['id']; ?>" ><i class="fa fa-bar-chart-o"></i>Analytics</a></li>
                                        <li><a href="<?php echo SITE_ROOT_URL.'views/campaign/DeleteCampaign.php/'.$campData['id']; ?>">Delete</a></li>
                                    </ul>
                                </div><!-- btn-group -->
                            </td>
                        </tr>
                       
                        
                        <?php } ?>