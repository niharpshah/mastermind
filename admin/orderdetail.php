 <?php
	session_start();
	include('connection.php'); 
	if(!isset($_SESSION['logid']))
	{
		echo "<script>window.location='index.php';</script>";
	} 
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:18 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Order Details</title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
  <!-- Bootstrap CSS -->

<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>

<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
	$('.piluku-preloader').addClass('hidden');
     $('#mydatatable').DataTable();
    });
		
	$(document).ready(function () {
		fillData('all');
	});
	function fillData(val) { 
	
	var oid= $("#orderid").val();
    var mydata = [{oid:oid}];
    var ourObj = {};
    ourObj.action = "getdata";
    ourObj.mydata = mydata;
    var rowData = "";
    rowData += "<table id='example' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
    rowData += "<th style='text-align:center;'><strong>No.</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Product Image</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Product Name</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Sub-Category</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Quantity</strong></th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'orderdetail_data.php',
        type: 'POST',
        async: false,
        data: {"ajaxdata": JSON.stringify(ourObj)},
        success: function(response) {
            if (response) {
                if (response.length > 0) {
                    rowData += "<tbody>";

                    for (var i = 0; i < response.length; i++)
                    {
                        var item = response[i];
                        rowData += "<tr>";
                        rowData += "<td style='text-align:center;'>" + (i + 1).toString() + "</td>";


                        var img = "";
                        if (item.pimg === null || item.pimg === undefined) {
                            img = "";
                        } else {
                            img = item.pimg;
                        }
                        rowData += "<td style='text-align:center;'>";
                        rowData += "<a href='images/product/" + img + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/product/small/" + img + "'   style='height:100px;width:100px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";
						
                        var name = "";
                        if (item.pname === null || item.pname === undefined) {
                            name = "";
                        } else {
                            name = item.pname;
                        }
                        rowData += "<td style='text-align:center;'>" + name + "</td>";
						
						var desc = "";
                        if (item.des === null || item.des === undefined) {
                            desc = "";
                        } else {
                            desc = item.des;
                        }
                        rowData += "<td style='text-align:center;'>" + desc + "</td>";

                        var qq = "";
                        if (item.qty === null || item.qty === undefined) {
                            qq = "";
                        } else {
                            qq = item.qty;
                        }
                        rowData += "<td style='text-align:center;'><strong>" + qq + "</strong></td>";

                        rowData += "</td>";
                        rowData += "</tr>";
                    }
                    rowData += "</tbody>";
                }
            }
        },
        error: function(errorData) {

        }
    });

    rowData += "</table>";
    $("#myTableData").html(rowData);
    $('#divError').css("display", "none");

    //$('#mydatatable').DataTable().destroy();


}

function setMyDate(val) {
    var t_sdate = val;
    var sptdate = String(t_sdate).split("-");
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var myMonth = sptdate[1];
    var myDay = sptdate[2];
    var myYear = sptdate[0];
    return myDay + "-" + myMonth + "-" + myYear;
}


function editData(eid) {
    if (eid && eid != "") {
        var mydata = [{"id": eid}];
        var ourObj = {};
        ourObj.action = "getitem";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'cat_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#hfoid').val(response[0].order_id);
//                    $('#myBox').unblock();
                    $('#divDataModal').modal('toggle');
                    $('#txtFirstname').focus();
                } else {
					alert('problem');
                }
            }
        });
    } else {
        return false;
    }
}
</script>
</head>
<body class="" >
  <div class="piluku-preloader text-center">
  <!-- <div class="progress">
      <div class="indeterminate"></div>
  </div> -->
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">

  

<?php include('leftbar.php'); ?>
<!-- left-bar -->

<div class="content" id="content">
	
	<div class="overlay"></div>			
	
	<?php include('header.php'); ?>
<!-- /top-bar -->
	


	<!-- main content -->
	<div class="main-content">

		<!-- *** Editable Tables *** -->
		
		<!-- /panel -->

		<!-- *** Editable Tables *** -->
		<div class="panel panel-piluku">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="icon ti-receipt"></i> <strong>Order Details</strong>
					
					<form method="post">
					<input  type="hidden" name="orderid" value="<?php echo $_REQUEST['oid'] ?>" id="orderid" />&nbsp;
					</form>
				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive" id="myTableData">
	<!-- DELETE QUERY ENDED -->
				</div>
			</div>
		</div>
		
	</div>
	
	
	
	
</div>
</div>

<!-- Page Scripts -->
    
    <!-- Edited for search input -->


<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/jquery.dataTables.min.js'></script>
<script src='assets/js/bootstrap-datatables.js'></script>
<script src='assets/js/dataTables-custom.js'></script>
<script src='assets/js/mindmup-editabletable.js'></script>
<script src='assets/js/numeric-input-example.js'></script>
<script src='assets/js/dynamic-tables.js'></script>
<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>