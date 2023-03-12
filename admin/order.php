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

  <title>Orders</title>

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

    var mydata = [];
    var ourObj = {};
    ourObj.action = "getdata";
    ourObj.mydata = mydata;
    var rowData = "";
    rowData += "<table id='example' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
    rowData += "<th style='text-align:center;'><strong>Sr.</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Client</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Order On</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Address</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Pincode</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Contact</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Status</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Payment</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Paid</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Details</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Update</strong></th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'order_data.php',
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
                        rowData += "<tr style='text-align:center;'>";
                        rowData += "<td style='text-align:center;'>" + (i + 1).toString() + "</td>";
						
                        var name = "";
                        if (item.uname === null || item.uname === undefined) {
                            name = "";
                        } else {
                            name = item.uname;
                        }
                        rowData += "<td>" + name + "</td>";
			
						var order = setMyDate(item.order_date);
                        rowData += "<td>" + order + "</td>";						
						
						var ad = "";
                        if (item.address === null || item.address === undefined) {
                            ad = "";
                        } else {
                            ad = item.address;
                        }
                        rowData += "<td>" + ad + "</td>";
						
						var pin = "";
                        if (item.pincode === null || item.pincode === undefined) {
                            pin = "";
                        } else {
                            pin = item.pincode;
                        }
                        rowData += "<td>" + pin + "</td>";
						
						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<td>" + con + "</td>";
						
						var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<td>" + sat + "</td>";
						
						var pay = "";
                        if (item.payment_type === null || item.payment_type === undefined) {
                            pay = "";
                        } else {
                            pay = item.payment_type;
                        }
                        if(item.payment_type === "payumoney")
						{
						
						rowData += "<td> <span class='label bg-info'>" + pay + "</span></td>";
						}
						else
						{
                        rowData += "<td> <span class='label bg-warning'>" + pay + "</span></td>";
						}
						
						var paid = "";
                        if (item.is_pay === null || item.is_pay === undefined) {
                            paid = "";
                        } else {
                            paid = item.is_pay;
                        }
                        if(item.is_pay === "yes")
						{
						
						rowData += "<td> <span class='badge bg-success'>" + paid + "</span></td>";
						}
						else
						{
                        rowData += "<td> <span class='badge bg-danger'>" + paid + "</span></td>";
						}
						
						rowData += "<td style='text-align:center;'>";
                        rowData += "<button onClick='editData(" + item.order_id + ");' class='btn btn-default' data-original-title='Edit Data' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><a href='orderdetail.php?oid=" + item.order_id + "'><i class='fa fa-eye' style='font-size: 16px;'></i></a></button>&nbsp;&nbsp;";
						
						rowData += "</td>";

                        rowData += "<td>";
                        rowData += "<button onClick='editData(" + item.order_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";
                        
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
	
function confirmRemove(did) {
    var did = did;
	alert(did);
    if (did && did != "") {
        var mydata = [{"id": did}];
        var ourObj = {};
        ourObj.action = "remove";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'prod_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response) {
                    if (response.msg && response.msg === "Success") {
                        fillData("all");
                    } else {
                    }
                }
            }
        });
    }
}
function editData(eid) {
    if (eid && eid != "") {
        var mydata = [{"id": eid}];
        var ourObj = {};
        ourObj.action = "getitem";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'order_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#hfoid').val(response[0].order_id);
                    $('#txtprodname').val(response[0].product_name);
                    $('#prodqty').val(response[0].qty);
                    if (response[0].prod_img1 !== null && response[0].prod_img1 !== "") {
                        $("#imgGallery1").attr("src", "images/product/small/" + response[0].prod_img1);
                        $("#imgGallery1").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].prod_img1);
                    }
					

//                    $('#myBox').unblock();
                    $('#divDataModal').modal('toggle');
                    $('#txtFirstname').focus();
                } else {
					
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
					<i class="icon ti-truck"></i> <strong>Orders</strong>
				</h3>
				
				<form method="post">
					<input  type="hidden" name="hfoid" id="hfoid" />&nbsp;
					</form>
				
			</div>
			<div class="panel-body">
				<div class="table-responsive" id="myTableData">
	<!-- DELETE QUERY ENDED -->
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="modal fade" id="largemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
                    <h4 class="modal-title" id="myModalLabel1"><i class="fa fa-book"></i> Category</h4>
                </div>
                <form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
                    
                    <input  type="hidden" name="hfAction" value="add" />
                    <input  type="hidden" name="hfcatid" id="hfcatid" />&nbsp;
                    <!--Default Horizontal Form-->      
                    <div class="form-group">
                        <label class="col-sm-2 control-label">Status:</label>
                        <div class="col-sm-8">
                        <select name="txtsat" id="txtsat" class="form-control">
                            <option value="">Select Status</option>
                            <option value="pending">Pending</option>
                            <option value="delivered">Delivered</option>
                        </select>
                        </div>
                    </div>
                    
                     <div class="form-group">
                        <div align="center">
                            <button name="btnsubmit" id="myform" class="btn btn-primary btn-icon-primary btn-icon-block btn-icon-blockleft">
                            <i class="fa fa-save"></i>
                            <span>Save</span>
                        </button>   
                        </div>
                     </div>
                </form>
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

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkorder').addClass('current');
	});
</script>

<script src="assets/js/jquery.countTo.js"></script>

</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>