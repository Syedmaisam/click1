<?php
include_once "../../config/config.php";
if($_SESSION['logeid']=="")

{
	 
	header("location:".SITE_ROOT_URL."login.php");
}
include_once SOURCE_ROOT_CONTROLLER.'basic/basicController.php';
include_once SOURCE_ROOT.'controller/Domain_masking/domainmasking.php';
include_once SOURCE_ROOT_CLASSES . 'class_contactdetails.php';
$objcontact = new class_contactdetails();
$arrRandUrl = explode("/",$_SERVER['PATH_INFO']);
$objBasic = new basicController();
$arrGetData = $objBasic->getFormPollDetailsByRandomLink($arrRandUrl[1]);
$arrAnswers = explode(",", $arrGetData[0]['PollAnswer']);


if (isset ( $_POST ['submit'] )) {
$exportArry = array();	
$headerArray = array();
        $headerArray[] = "ID";
        $headerArray[] = "ANSWER";
	$headerArray[] = "VOTE";
	
	$exportArry[] = $headerArray;
//var_dump($getViewData );
//exit;
$v = 0;
foreach ($arrAnswers as $answers){
		
$localArray = array();
			 $v=$v+1;
                         $localArray[] = $v;
                       
                         $localArray[] = $answers;
                         $arrDataVote = $objBasic->getRandAnswerData($answers, $arrRandUrl[1]);
                         
                         $localArray[] = $arrDataVote[0]['count(id)'];
                         

                         $exportArry[] = $localArray;

                  }
                
                //$arrUrl = explode("/",$_SERVER["PATH_INFO"]);
//var_dump($arrUrl);
        $arrUrl = $_REQUEST['f'];
	
	//echo $arrUrl;
	$objcontact->convert_to_csv( $exportArry, $arrUrl, ',' );
	exit;

}
?>

<html>
<head>
<meta charset="UTF-8">
<title><?php echo SITE_TITLE; ?></title>
<meta
	content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no'
	name='viewport'>
<!-- bootstrap 3.0.2 -->
	<?php require_once SOURCE_ROOT.'css.php'; ?>
    <link href="<?php echo SITE_CSS_URL ?>highlight.css" rel="stylesheet">
    <link href="<?php echo SITE_CSS_URL ?>bootstrap-switch.css" rel="stylesheet">
    <style type="text/css">
    .line-h td
    {
   	 line-height: 30px!important;
    }
    </style>
</head>
<body class="skin-blue">

<?php //exit; ?>
	<?php include_once SOURCE_ROOT."header.php"; ?>
	<div class="wrapper row-offcanvas row-offcanvas-left">
		<!-- Left side column. contains the logo and sidebar -->
		<?php include_once SOURCE_ROOT."sidebar.php"; ?>


		<!-- Right side column. Contains the navbar and content of the page -->
		<aside class="right-side">
			<!-- Content Header (Page header) -->
			<section class="content-header">
				<h1>
					<i class="fa fa-fw fa-question-circle"></i> Poll Questions</small>
				</h1>
				<ol class="breadcrumb">
					<li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
					<li><a href="#">Basic</a></li>

				</ol>
			</section>

			<!-- Main content -->
			<section class="content">



				<div class="row">
            <div class="col-xs-8">
              <div class="box">
                <div class="box-header">
                  <!--<h3 class="box-title"><i class="fa fa-fw fa-question-circle"></i> Poll Questions</h3>-->

                  <div class="box-tools">
                    <input id="hidden_page" type="hidden" value= "<?php echo $arrRandUrl[1];?>"></input>
								<form id="export" name="export" method="post"
									action="" onSubmit="return exportdata()">
									<input class="btn btn-danger" type="submit" name="submit"
										value="export" style="float: right;"></input> <input
										type="text" id="id_filename" name="id_filename" value=""
										style="display: none;"></input>
								</form>
                  </div>
                </div><!-- /.box-header -->
                <div class="box-body table-responsive no-padding">
                  <table class="table table-hover">
                    <tr>
                      <th>ID</th>
                      <th>Answer</th>
                      <th> Vote</th>
                      </tr>
                 <?php $i=0; foreach ($arrAnswers as $answers){ $i=$i+1; ?>
                    <tr class="line-h">
                      <td><?php echo $i; ?></td>
                      <td><?php echo $answers; ?></td>
                      <td><i class="fa fa-fw fa-thumbs-o-up"></i> <?php $arrDataVote = $objBasic->getRandAnswerData($answers, $arrRandUrl[1]); 
echo $arrDataVote[0]['count(id)']; ?></td>
                    </tr>
                <?php } ?>
                    </table>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
            <div class="col-xs-4">
            	<div class="box box-danger">
                <div class="box-header with-border">
                  <h3 class="box-title"><i class="fa fa-fw fa-question-circle"></i> Top Answers</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->
            </div>
          </div>
	</div>
<?php include_once SOURCE_ROOT."js/javascript.php"; ?>
<script type="text/javascript">
$(document).ready(function(){
	$(".blackscreen").show();
	$(".loader_popup").show();
	$.ajax({
		type: "post",
		url: SITE_ROOT_URL+'ajax/basic/getFormsData.php',
		data: {
		id:1
	},			
	success: function(response) {
		
		if(response!=''){
		$("#basicDataGrid").html(response);
		 $("a#copy-dynamic").zclip({
			   path:"<?php echo SITE_ROOT_URL; ?>clipboard/ZeroClipboard.swf",
		       copy:function(){return $(this).attr('data_tip');}
		    });
		} else 
		{
			var trData = "<td colspan='6' style='text-align: center;'>No Record Found!</td>";
			$("#basicDataGrid").html(trData);
		}
		$(".blackscreen").hide();
		$(".loader_popup").hide();
	},
	error:function 
	(XMLHttpRequest, textStatus, errorThrown) {
	}
	}); 
});


</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="<?php echo SITE_ROOT_URL; ?>plugins/morris/morris.min.js" type="text/javascript"></script>
   <script type="text/javascript">
      $(function () {
        "use strict";
        //DONUT CHART
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [
<?php foreach ($arrAnswers as $answers){  ?>
            {label: "<?php echo $answers; ?>", value: <?php $arrDataVote = $objBasic->getRandAnswerData($answers, $arrRandUrl[1]); echo $arrDataVote[0]['count(id)']; ?>},
<?php } ?>
          ],
          hideHover: 'auto'
        });
        //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
            {y: '2006', a: 100, b: 90},
            {y: '2007', a: 75, b: 65},
            {y: '2008', a: 50, b: 40},
            {y: '2009', a: 75, b: 65},
            {y: '2010', a: 50, b: 40},
            {y: '2011', a: 75, b: 65},
            {y: '2012', a: 100, b: 90}
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a', 'b'],
          labels: ['CPU', 'DISK'],
          hideHover: 'auto'
        });
      });

			function exportdata()
			{
			
				var outputFile = window.prompt("What do you want to name your output file") || 'export';
if(outputFile  == "export")
{
 return false;
}
else
{
outputFile = outputFile.replace('.csv','') + '.csv';

                //alert(outputFile);
               
                var page = $('#hidden_page').val();

if(page != "" )
{
   //var href = <?php echo SITE_ROOT_URL;?>+"views/contact/index.php?f="+outputFile;
 var href ="<?php echo SITE_ROOT_URL;?>views/basic/viewresult.php/"+page+"?f="+outputFile;
}
else
{
 var href = SITE_ROOT_URL+"views/basic/viewresult.php?f="+outputFile;
}
               
				
            	$('#export').attr("action",href);
                //return false;
}
                
                
			}
    </script>
</body>
</html>