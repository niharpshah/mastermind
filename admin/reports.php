<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['logid'])) {
    echo "<script>window.location = 'index.php';";
}
include "FusionCharts.php";

?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:13:31 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Reports</title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
  <!-- Bootstrap CSS -->

  <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link rel='stylesheet' href='assets/css/animated-masonry-gallery.css'>
<link rel='stylesheet' href='assets/css/rotated-gallery.css'>
<link rel='stylesheet' href='assets/css/sweet-alerts/sweetalert.css'>
<link rel='stylesheet' href='assets/css/jtree.css'>
  <script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
  </script>
</head>
<body>
  <div class="piluku-preloader text-center">
  <!-- <div class="progress">
      <div class="indeterminate"></div>
  </div> -->
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">


<?php include 'leftbar.php';?>
<!-- left-bar -->

<div class="content" id="content">

	<div class="overlay"></div>

	<?php include 'header.php';?>
<!-- /top-bar -->

	<div class="main-content">
       <div class="row">
        <div class="col-md-12 nopad-right">
            <!-- panel -->



		<div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Sales Deatils</strong>
                  </h3>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
				 <?php
$strXML = "<chart  xAxisName='Order' yAxisName='Product' showValues='0' formatNumberScale='0' showBorder='1'>";

$sql = mysqli_query($cn, "select * from tbl_products");
while ($row = mysqli_fetch_array($sql)) {
    $res = mysqli_query($cn, "select * from tbl_order_detail where product_id='" . $row["product_id"] . "'");
    $strXML .= "<set label='" . $row["product_name"] . "' value='" . mysqli_num_rows($res) . "' />";
}
$strXML .= "</chart>";
//Create the chart - Column 3D Chart with data from strXML variable using dataXML method
echo renderChartHTML("FusionCharts/Column3D.swf", "", $strXML, "myNext", 1040, 400, false);
?>
                </div>
                <!-- /row -->
            </div>
        </div>



			<div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Employee wise Total Ticket</strong>
                  </h3>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
				 <?php
$strXML = "<chart  xAxisName='Epmloyee' yAxisName='Ticket' showValues='0' formatNumberScale='0' showBorder='1'>";

$sql = mysqli_query($cn, "select * from tbl_employee");
while ($row = mysqli_fetch_array($sql)) {
    $res = mysqli_query($cn, "select * from tbl_ticket where emp_id='" . $row["emp_id"] . "'");
    $strXML .= "<set label='" . $row["emp_name"] . "' value='" . mysqli_num_rows($res) . "' />";
}
$strXML .= "</chart>";
//Create the chart - Column 3D Chart with data from strXML variable using dataXML method
echo renderChartHTML("FusionCharts/Area2D.swf", "", $strXML, "myNext", 1040, 400, false);
?>
                </div>
                <!-- /row -->
            </div>
        </div>

            <div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Employee wise Completed Ticket</strong>
                  </h3>


				<form name="myform" method="post" enctype="multipart/form-data">
					<div class="col-md-3 col-sm-6 col-xs-12 nopad-right">
						<div class="picker">
							<div class="form-group">
								<div class="col-md-9" id="date-range">
									<div class="input-group input-daterange" id="datepicker">
										<input type="text" class="form-control" name="txtdate1">
										<span class="input-group-addon bg">
										To
										</span>
										<input type="text" class="form-control" name="txtdate2">
									</div>
								</div>
							</div>
						</div>
					</div>
					<button type="submit" name="btncheck" id="btcheck" btn class="btn btn-primary btn-xs">Check</button>
				</form>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
				<?php
if (isset($_REQUEST['btncheck'])) {
    $sdate = date('Y-m-d', strtotime($_REQUEST['txtdate1']));
    $edate = date('Y-m-d', strtotime($_REQUEST['txtdate2']));

    $strXML = "<chart  xAxisName='Epmloyee' yAxisName='Ticket' showValues='0' formatNumberScale='0' showBorder='1'>";

    $sql = mysqli_query($cn, "select * from tbl_employee");
    while ($row = mysqli_fetch_array($sql)) {
        $res = mysqli_query($cn, "select * from tbl_ticket where emp_id='" . $row["emp_id"] . "' and status='completed' and ticket_date BETWEEN '" . $sdate . "' AND '" . $edate . "'");
        $strXML .= "<set label='" . $row["emp_name"] . "' value='" . mysqli_num_rows($res) . "' />";
    }
    $strXML .= "</chart>";
    //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
    echo renderChartHTML("FusionCharts/Doughnut2D.swf", "", $strXML, "myNext", 1040, 400, false);
} else {
    ?>
				 <?php
$strXML = "<chart  xAxisName='Epmloyee' yAxisName='Ticket' showValues='0' formatNumberScale='0' showBorder='1'>";

    $sql = mysqli_query($cn, "select * from tbl_employee");
    while ($row = mysqli_fetch_array($sql)) {
        $res = mysqli_query($cn, "select * from tbl_ticket where emp_id='" . $row["emp_id"] . "' and status='completed'");
        $strXML .= "<set label='" . $row["emp_name"] . "' value='" . mysqli_num_rows($res) . "' />";
    }
    $strXML .= "</chart>";
    //Create the chart - Column 3D Chart with data from strXML variable using dataXML method
    echo renderChartHTML("FusionCharts/Doughnut2D.swf", "", $strXML, "myNext", 1040, 400, false);
}?>
                </div>
                <!-- /row -->
            </div>
        </div>

		<div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Employee wise Assign Ticket</strong>
                  </h3>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
				 <?php
$strXML = "<chart  xAxisName='Epmloyee' yAxisName='Ticket' showValues='0' formatNumberScale='0' showBorder='1'>";

$sql = mysqli_query($cn, "select * from tbl_employee");
while ($row = mysqli_fetch_array($sql)) {
    $res = mysqli_query($cn, "select * from tbl_ticket where emp_id='" . $row["emp_id"] . "' and status='assign'");
    $strXML .= "<set label='" . $row["emp_name"] . "' value='" . mysqli_num_rows($res) . "' />";
}
$strXML .= "</chart>";
//Create the chart - Column 3D Chart with data from strXML variable using dataXML method
echo renderChartHTML("FusionCharts/Column3D.swf", "", $strXML, "myNext", 1040, 400, false);
?>
                </div>
                <!-- /row -->
            </div>
        </div>
        <!-- /panel -->

		<div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        <strong>Employee wise Switch Ticket</strong>
                  </h3>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
				 <?php
$strXML = "<chart  xAxisName='Epmloyee' yAxisName='Ticket' showValues='0' formatNumberScale='0' showBorder='1'>";

$sql = mysqli_query($cn, "select * from tbl_employee");
while ($row = mysqli_fetch_array($sql)) {
    $res = mysqli_query($cn, "select * from tbl_ticket where emp_id='" . $row["emp_id"] . "' and status='switch'");
    $strXML .= "<set label='" . $row["emp_name"] . "' value='" . mysqli_num_rows($res) . "' />";
}
$strXML .= "</chart>";
//Create the chart - Column 3D Chart with data from strXML variable using dataXML method
echo renderChartHTML("FusionCharts/pie2D.swf", "", $strXML, "myNext", 1040, 400, false);
?>
                </div>
                <!-- /row -->
            </div>
        </div>

    </div>
    <!-- col-md-6 -->


</div>
<!-- row -->
</div>

</div>


	<!-- /Right-bar -->
</div>
<!-- wrapper -->

<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/chartist.min.js'></script>
<script src='assets/js/CustomChart.js'></script>
<script src='assets/js/build/d3.min.js'></script>
<script src='assets/js/nvd3/nv.d3.js'></script>
<script src='assets/js/sparkline.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/widgets.js'></script>
<script src='assets/js/core.js'></script>
<script>
$(document).ready(function(){
$('#row').css('textTransform', 'capitalize');
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkreport').addClass('current');
	});
</script>

<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/select2.js'></script>
<script src='assets/js/jquery.multi-select.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src='assets/js/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap-colorpicker.js'></script>
<script src='assets/js/jquery.maskedinput.js'></script>
<script src='assets/js/form-elements.js'></script>
<script src="assets/js/jquery.countTo.js"></script>
<script type="text/javascript">
$(document).ready(function(){

$('#datepicker').datepicker({format : "YYYY-mm-dd"});
});
</script>

</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:13:31 GMT -->
</html>