<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['logid'])) {
    echo "<script>window.location = 'index.php';</script>";
}
include "FusionCharts.php";
?>



<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:13:31 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Dashboard</title>

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
       <div class="row" id="row">
        <div class="col-md-3 col-sm-6 col-xs-12 nopad-right">
            <div class="dashboard-stats">
                <div class="left">
                    <h3 class="flatBluec counter" data-to="<?php $user = mysqli_query($cn, "select * from tbl_user");
echo mysqli_num_rows($user);
?>" data-speed="4000">

					</h3>
                    <h4>Total Users</h4>
                </div>
                <div class="right flatBlue">
                    <i class="ion-ios-person-outline"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 nopad-right">
            <div class="dashboard-stats">
                <div class="left">
                    <h3 class="flatOrangec counter" data-to="<?php $user = mysqli_query($cn, "select * from tbl_ticket");
echo mysqli_num_rows($user);
?>" data-speed="4000"></h3>
                    <h4>Total Tickets</h4>
                </div>
                <div class="right flatOrange">
                    <i class="fa fa-ticket"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 nopad-right">
            <div class="dashboard-stats">
                <div class="left">
                    <h3 class="flatRedc counter" data-to="<?php $user = mysqli_query($cn, "select * from tbl_ticket where status !='completed'");
echo mysqli_num_rows($user);
?>" data-speed="4000"></h3>
                    <h4>Pending Tickets</h4>
                </div>
                <div class="right flatRed">
                    <i class="icon icon-close"></i>
                </div>
            </div>
        </div>
        <div class="col-md-3 col-sm-6 col-xs-12 nopad-right">
            <div class="dashboard-stats">
                <div class="left">
                    <h3 class="flatGreenc counter" data-to="<?php $user = mysqli_query($cn, "select * from tbl_ticket where status='completed'");
echo mysqli_num_rows($user);
?>" data-speed="8000"></h3>
                    <h4>Completed Tickets</h4>
                </div>
				<div class="right flatGreen">
                    <i class="icon icon-check"></i>
                </div>
            </div>
        </div>

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
                        Employee wise Completed Ticket

                  </h3>
              </div>
              <div class="panel-body">
                <div class="row main-chart-parent">
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
?>
                </div>
                <!-- /row -->
            </div>
        </div>

		<div class="panel panel-piluku">
                <div class="panel-heading">
                    <h3 class="panel-title">
                        Employee wise Assign Ticket
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
<script>
$(document).ready(function(){
$('#row').css('textTransform', 'capitalize');
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkdash').addClass('current');
	});
</script>

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

<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/index.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:13:31 GMT -->
</html>