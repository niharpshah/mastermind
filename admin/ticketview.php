<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['logid'])) {
    echo "<script>window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Tickets</title>


<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link href="assets/css/sweet-alerts/sweetalert.css" rel="stylesheet" type="text/css">
<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>


<script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });

	$(document).ready(function () {

			fillData('all');

			$('#btnclear').click(function(){
				$('#sdate').val("");
				$('#edate').val("");
				fillData('all');
			});

// =============================================================================================================
	$("#myformdate").on('submit', (function(e) {
		e.preventDefault();
//		alert('ohk');
		var sdate= $("#sdate").val();
		var edate= $("#edate").val();

//		alert(sdate);
//		alert(edate);
        var mydata = [{"sdate": sdate, "edate": edate}];
        var ourObj = {};
        ourObj.action = "getitemwithdate";
        ourObj.mydata = mydata;
		 var rowData = "";
    rowData += "<table id='mydatatable' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
	rowData += "<th style='text-align:center;'><strong>Sr_No</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Client</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Product</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Problem</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Prefer_Date</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Prefer_Time</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Employee</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Status</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Contact</strong></th>";
    rowData += "<th style='text-align:center;'><strong>View</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Update</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Delete</strong></th>";
    rowData += "</tr>";
    rowData += "</thead>";

        $.ajax({
            url: 'ticket_data.php',
            type: 'POST',
			 async: false,
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
				if (response.length > 0) {
					rowData += "<tbody>";
		   			for (var i = 0; i < response.length; i++)
                    {
                        var item = response[i];
                        rowData += "<tr>";
						rowData += "<td style='text-align:center;'>" + (i + 1).toString() + "</td>";
                        var uname = "";
                        if (item.username === null || item.username === undefined) {
                            uname = "";
                        } else {
                            uname = item.username;
                        }
                        rowData += "<td style='text-align:center;'>" + uname + "</td>";

                        var pname = "";
                        if (item.productname === null || item.productname === undefined) {
                            pname = "";
                        } else {
                            pname = item.productname;
                        }
                        rowData += "<td style='text-align:center;'>" + pname + "</td>";

						var prob = "";
                        if (item.problem === null || item.problem === undefined) {
                            prob = "";
                        } else {
                            prob = item.problem;
                        }
						rowData += "<td style='text-align:center;'>" + prob + "</td>";


						var pdate = setMyDate(item.prefer_date);

                        rowData += "<td style='text-align:center;'>" + pdate + "</td>";

                        var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<td style='text-align:center;'>" + ptime + "</td>";

						var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
                        rowData += "<td style='text-align:center;'>" + empname + "</td>";

                        var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<td style='text-align:center;'>" + sat + "</td>";

						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<td style='text-align:center;'>" + con + "</td>";

						rowData += "<td style='text-align:center;'>";

                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-primary' data-original-title='Edit Data' data-toggle='modal' data-target='#Only_View1" + (i + 1) + "' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-eye' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";
                        rowData += "</td>";

						if(sat == 'pending')
						{
						rowData += "<td style='text-align:center;'>";
                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";
						}
						else
						{
							rowData += "<td style='text-align:center;'>";
							rowData += "<i class='fa fa-check' style='color:#76DE4F'></i>";

							rowData += "</td>";
						}
						rowData += "<td style='text-align:center;'>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.ticket_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
                        rowData += "";
                        rowData += "</td>";
		// dsn
						rowData += "<div class='modal fade modal-full-pad' id='Only_View1" + (i + 1) + "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden=;true'>";
                        rowData += "<div class='modal-dialog modal-full'>";
                        rowData += "<div class='modal-content'>";
                        rowData += "<div class='modal-header'>";
                        rowData += "<button type='button' class='close' data-dismiss='modal'>x</button>";
                        rowData += "<h4 class='modal-title' id='myModalLabel'><i class='fa fa-ticket'></i>&nbsp;<strong>Ticket Details</strong></h4>";
                        rowData += "</div>";
                        rowData += "<div class='modal-body'>";
                        rowData += "<div class='row'>";
                        rowData += "<div class='col-sm-12 col-xs-12'>";
                        rowData += "<div class='row'>";
						var uname = "";
                        if (item.username === null || item.username === undefined) {
                            uname = "";
                        } else {
                            uname = item.username;
                        }
                        rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Client Name</strong>";
                        rowData += "<p class='text-muted'>" + uname + "</p>";
                        rowData += "</div>";

                        var pname = "";
                        if (item.productname === null || item.productname === undefined) {
                            pname = "";
                        } else {
                            pname = item.productname;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Product</strong>";
                        rowData += "<p class='text-muted'>" + pname + "</p>";
                        rowData += "</div>";

                        var prob = "";
                        if (item.problem === null || item.problem === undefined) {
                            prob = "";
                        } else {
                            prob = item.problem;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Problem</strong>";
                        rowData += "<p class='text-muted'>" + prob + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

					    var tdate = setMyDate(item.ticket_date);
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Ticket On</strong>";
                        rowData += "<p class='text-muted'>" + tdate + "</p>";
                        rowData += "</div>";

						var pdate = setMyDate(item.prefer_date);
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Prefer Date</strong>";
                        rowData += "<p class='text-muted'>" + pdate + "</p>";
                        rowData += "</div>";

						var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";

                        rowData += "<strong>Prefer Time</strong>";
                        rowData += "<p class='text-muted'>" + ptime + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						if(item.complete_time === null || item.complete_time === undefined)
						{
							rowData += "<div class='col-md-4 col-xs-12 b-r'>";
							rowData += "<strong>Assigned On</strong>";
							rowData += "<p class='text-muted'> <strong>Not Assigned Yet</strong> </p>";
							rowData += "</div>";

						}
						else
						{
							var adate = setMyDate(item.assign_date);
							rowData += "<div class='col-md-4 col-xs-12 b-r'>";
							rowData += "<strong>Assigned On</strong>";
							rowData += "<p class='text-muted'>" + adate + "</p>";
							rowData += "</div>";
						}
						if(item.complete_time === null || item.complete_time === undefined)
						{
							rowData += "<div class='col-md-4 col-xs-6 b-r'>";
							rowData += "<strong>Completed On</strong>";
							rowData += "<p class='text-muted'> <strong>Not Completed Yet</strong> </p>";
							rowData += "</div>";
						}
						else
						{
							var cdate = setMyDate(item.complete_date);
							rowData += "<div class='col-md-4 col-xs-6 b-r'>";
							rowData += "<strong>Completed On</strong>";
							rowData += "<p class='text-muted'>" + cdate + "</p>";
							rowData += "</div>";
						}

						var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Status</strong>";
                        rowData += "<p class='text-muted'>" + sat + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Employee</strong>";
                        rowData += "<p class='text-muted'>" + empname + "</p>";
                        rowData += "</div>";

						var remark = "";
                        if (item.remark === null || item.remark === undefined) {
                            remark = "";
                        } else {
                            remark = item.remark;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Remark</strong>";
                        rowData += "<p class='text-muted'>" + remark + "</p>";
                        rowData += "</div>";

						var ad = "";
                        if (item.address === null || item.address === undefined) {
                            ad = "";
                        } else {
                            ad = item.address;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Address</strong>";
                        rowData += "<p class='text-muted'>" + ad + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						var land = "";
                        if (item.landmark === null || item.landmark === undefined) {
                            land = "";
                        } else {
                            land = item.landmark;
                        }
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Landmark</strong>";
                        rowData += "<p class='text-muted'>" + land + "</p>";
                        rowData += "</div>";

						var pin = "";
                        if (item.pincode === null || item.pincode === undefined) {
                            pin = "";
                        } else {
                            pin = item.pincode;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Pincode</strong>";
                        rowData += "<p class='text-muted'>" + pin + "</p>";
                        rowData += "</div>";

						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Contact</strong>";
                        rowData += "<p class='text-muted'>" + con + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";


                        rowData += "</div>";
                        rowData += "</div>";


                        rowData += "</tr>";
                    }
							rowData += "</tbody>";
				     	}
			        },// success: func
                	error: function() {


                	} //error: func
            	});
				 $("#myTableDatadate").html(rowData);
				  $("#myTableDatadate").css({'display':'block'});
				  $("#myTableData").css({'display':'none'});
			}));
			// Report START

// =============================================================================================================

		$("#myform").on('submit', (function(e) {
		e.preventDefault();
		//alert('ok');
//        if ($('#myform').valid()) {
//            $('#myModalBox').block({
//                message: '<img src="images/hourglass.gif" />',
//                css: {backgroundColor: 'transparent', border: 'none'}
//            });
            	$.ajax({
                	type: 'POST',
                	url: 'ticket_data.php',
                	data: new FormData(this),
                	contentType: false,
                	cache: false,
                	processData: false,
                	success: function(data) {
                    //var d = JSON.parse(data);
                    	if (data.msg && data.msg == "Success") {
								fillData('all');
							$('#myform').each(function (){
								this.reset();
							});
//                       	clearControls();
//                        	fillData("all");
//                        	$('#divDataModal').modal('hide');
//                        	$('#myModalBox').unblock();
                    	} // if (data.msg
						else {
                        	$('#spanErrorMsg').html("There is an error in submitting details.Please try again!!!");
                    	} // else
					}, // success: func
                	error: function() {
						alert('Error');
                	} //error: func
            	});
//				};
			}));

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
	rowData += "<th style='text-align:center;'><strong>Sr_No</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Client</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Product</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Problem</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Prefer_Date</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Prefer_Time</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Employee</strong></th>";
	rowData += "<th style='text-align:center;'><strong>Status</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Contact</strong></th>";
    rowData += "<th style='text-align:center;'><strong>View</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Update</strong></th>";
    rowData += "<th style='text-align:center;'><strong>Delete</strong></th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'ticket_data.php',
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
                        var uname = "";
                        if (item.username === null || item.username === undefined) {
                            uname = "";
                        } else {
                            uname = item.username;
                        }
                        rowData += "<td style='text-align:center;'>" + uname + "</td>";

                        var pname = "";
                        if (item.productname === null || item.productname === undefined) {
                            pname = "";
                        } else {
                            pname = item.productname;
                        }
                        rowData += "<td style='text-align:center;'>" + pname + "</td>";

						var prob = "";
                        if (item.problem === null || item.problem === undefined) {
                            prob = "";
                        } else {
                            prob = item.problem;
                        }
						rowData += "<td style='text-align:center;'>" + prob + "</td>";


						var pdate = setMyDate(item.prefer_date);

                        rowData += "<td style='text-align:center;'>" + pdate + "</td>";

                        var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<td style='text-align:center;'>" + ptime + "</td>";

						var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
                        rowData += "<td style='text-align:center;'>" + empname + "</td>";

                        var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<td style='text-align:center;'>" + sat + "</td>";

						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<td style='text-align:center;'>" + con + "</td>";

						rowData += "<td style='text-align:center;'>";

                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-primary' data-original-title='Edit Data' data-toggle='modal' data-target='#Only_View" + (i + 1) + "' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-eye' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";
                        rowData += "</td>";

						if(sat == 'pending')
						{
						rowData += "<td style='text-align:center;'>";
                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";
						}
						else
						{
							rowData += "<td style='text-align:center;'>";
							rowData += "<i class='fa fa-check' style='color:#76DE4F'></i>";

							rowData += "</td>";
						}
						rowData += "<td style='text-align:center;'>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.ticket_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
                        rowData += "";
                        rowData += "</td>";
		// dsn
						rowData += "<div class='modal fade modal-full-pad' id='Only_View" + (i + 1) + "' tabindex='-1' role='dialog' aria-labelledby='myModalLabel' aria-hidden=;true'>";
                        rowData += "<div class='modal-dialog modal-full'>";
                        rowData += "<div class='modal-content'>";
                        rowData += "<div class='modal-header'>";
                        rowData += "<button type='button' class='close' data-dismiss='modal'>x</button>";
                        rowData += "<h4 class='modal-title' id='myModalLabel'><i class='fa fa-ticket'></i>&nbsp;<strong>Ticket Details</strong></h4>";
                        rowData += "</div>";
                        rowData += "<div class='modal-body'>";
                        rowData += "<div class='row'>";
                        rowData += "<div class='col-sm-12 col-xs-12'>";
                        rowData += "<div class='row'>";
						var uname = "";
                        if (item.username === null || item.username === undefined) {
                            uname = "";
                        } else {
                            uname = item.username;
                        }
                        rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Client Name</strong>";
                        rowData += "<p class='text-muted'>" + uname + "</p>";
                        rowData += "</div>";

                        var pname = "";
                        if (item.productname === null || item.productname === undefined) {
                            pname = "";
                        } else {
                            pname = item.productname;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Product</strong>";
                        rowData += "<p class='text-muted'>" + pname + "</p>";
                        rowData += "</div>";

                        var prob = "";
                        if (item.problem === null || item.problem === undefined) {
                            prob = "";
                        } else {
                            prob = item.problem;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Problem</strong>";
                        rowData += "<p class='text-muted'>" + prob + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

					    var tdate = setMyDate(item.ticket_date);
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Ticket On</strong>";
                        rowData += "<p class='text-muted'>" + tdate + "</p>";
                        rowData += "</div>";

						var pdate = setMyDate(item.prefer_date);
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Prefer Date</strong>";
                        rowData += "<p class='text-muted'>" + pdate + "</p>";
                        rowData += "</div>";

						var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Prefer Time</strong>";
                        rowData += "<p class='text-muted'>" + ptime + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						if(item.complete_time === null || item.complete_time === undefined)
						{
							rowData += "<div class='col-md-4 col-xs-12 b-r'>";
							rowData += "<strong>Assigned On</strong>";
							rowData += "<p class='text-muted'> <strong>Not Assigned Yet</strong> </p>";
							rowData += "</div>";

						}
						else
						{
							var adate = setMyDate(item.assign_date);
							rowData += "<div class='col-md-4 col-xs-12 b-r'>";
							rowData += "<strong>Assigned On</strong>";
							rowData += "<p class='text-muted'>" + adate + "</p>";
							rowData += "</div>";
						}
						if(item.complete_time === null || item.complete_time === undefined)
						{
							rowData += "<div class='col-md-4 col-xs-6 b-r'>";
							rowData += "<strong>Completed On</strong>";
							rowData += "<p class='text-muted'> <strong>Not Completed Yet</strong> </p>";
							rowData += "</div>";
						}
						else
						{
							var cdate = setMyDate(item.complete_date);
							rowData += "<div class='col-md-4 col-xs-6 b-r'>";
							rowData += "<strong>Completed On</strong>";
							rowData += "<p class='text-muted'>" + cdate + "</p>";
							rowData += "</div>";
						}

						var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Status</strong>";
                        rowData += "<p class='text-muted'>" + sat + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Employee</strong>";
                        rowData += "<p class='text-muted'>" + empname + "</p>";
                        rowData += "</div>";

						var remark = "";
                        if (item.remark === null || item.remark === undefined) {
                            remark = "";
                        } else {
                            remark = item.remark;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Remark</strong>";
                        rowData += "<p class='text-muted'>" + remark + "</p>";
                        rowData += "</div>";

						var ad = "";
                        if (item.address === null || item.address === undefined) {
                            ad = "";
                        } else {
                            ad = item.address;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Address</strong>";
                        rowData += "<p class='text-muted'>" + ad + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";

						rowData += "<div class='row'>";

						var land = "";
                        if (item.landmark === null || item.landmark === undefined) {
                            land = "";
                        } else {
                            land = item.landmark;
                        }
					   	rowData += "<div class='col-md-4 col-xs-12 b-r'>";
                        rowData += "<strong>Landmark</strong>";
                        rowData += "<p class='text-muted'>" + land + "</p>";
                        rowData += "</div>";

						var pin = "";
                        if (item.pincode === null || item.pincode === undefined) {
                            pin = "";
                        } else {
                            pin = item.pincode;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Pincode</strong>";
                        rowData += "<p class='text-muted'>" + pin + "</p>";
                        rowData += "</div>";

						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<div class='col-md-4 col-xs-6 b-r'>";
                        rowData += "<strong>Contact</strong>";
                        rowData += "<p class='text-muted'>" + con + "</p>";
                        rowData += "</div>";

                        rowData += "</div>";
                        rowData += "<br>";


                        rowData += "</div>";
                        rowData += "</div>";


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

}

function confirmRemove(did) {
	var did = did;
//	alert(did);

	swal({
		title: "Are you sure?",
		text: "You will not be able to recover Your Ticket Again!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#6fd64b',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: "No, cancel it!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm){
			var res = JSON.parse(removeTicket(did));
				if(res.msg == "Success"){
					fillData('all');
					swal("Deleted!","Your Ticket Has Been Deleted.","success");
                        window.location='ticketview.php';
				}
		} else {
			swal("Cancelled", "Your Tickets is safe :)", "error");
		}
	});
}

function removeTicket(id){
		var returnData = new Object();
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  returnData= xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "deleteticket.php?did=" +id, false);
			xmlhttp.send();
			return returnData;
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
            url: 'ticket_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#txtticket').val(response[0].ticket_id);
					$('#txtticket').val(response[0].user_id);
					$('#txtticket').val(response[0].product_id);
					$('#txtticket').val(response[0].problem);
					$('#txtticket').val(response[0].ticket_date);
					$('#txtemp').val(response[0].emp_id);
					$('#txtticket').val(response[0].assign_date);
					$('#txtticket').val(response[0].complete_date);
					$('#txtticket').val(response[0].status);
					$('#txtticket').val(response[0].remark);
					$('#txtticket').val(response[0].address);
					$('#txtticket').val(response[0].landmark);
					$('#txtticket').val(response[0].pincode);
					$('#txtticket').val(response[0].contact);
                    if(response[0].status==='pending')
					{
						$('input[id=rp][value=pending]').prop("checked",true);
						$('input[id=ra][value=assign]').prop("checked",false);
					}
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



<?php include 'leftbar.php';?>
<!-- left-bar -->

<div class="content" id="content">

	<div class="overlay"></div>

	<?php include 'header.php';?>
<!-- /top-bar -->



	<!-- main content -->
	<div class="main-content">

		<!-- *** Editable Tables *** -->

		<!-- /panel -->

		<!-- *** Editable Tables *** -->
		<div class="panel panel-piluku">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-ticket"></i> <strong>Employee Tickets</strong>
					<span class="panel-options"><a href="ticket.php"><button type="submit" class="btn btn-info btn-lg">Add Record</button></a></span>
				</h3>

			</div>
			<div class="panel-body">

			<form name="myformdate" id="myformdate" method="post" enctype="multipart/form-data">
					<div class="form-group" >
							<div class="col-md-4" id="date-range">
								<div class="input-group input-daterange" id="datepicker">
									<input type="text" id="sdate" class="form-control" name="txtdate1">
									<span class="input-group-addon bg">
									To
									</span>
									<input type="text" id="edate" class="form-control" name="txtdate2">
								</div>
							</div>
							<button type="submit" name="btncheck"  class="btn btn-primary btn-lg">Check</button>
							<button type="submit" name="btnclear" id="btnclear"  class="btn btn-primary btn-lg">Clear</button>

						</div>
				</form>
				<div class="table-responsive" id="myTableData">
	<!-- DELETE QUERY ENDED -->
				</div>

				<div class="table-responsive" id="myTableDatadate" style="display:none">
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
					<h4 class="modal-title" id="myModalLabel1"><i class="fa fa-ticket"></i> Tickets</h4>
				</div>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtticket" id="txtticket" />&nbsp;
					<!--Default Horizontal Form-->
					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtemp" id="txtemp"  >
								<option value="" >Select Employee</option>
								<?php
$res = mysqli_query($cn, "select * from tbl_employee");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['emp_id']; ?>"  ><?php echo $r['emp_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
					 	<div align="center">
							<button name="btnsubcat" id="myform" class="btn btn-primary btn-icon-primary btn-icon-block btn-icon-blockleft">
							<i class="fa fa-save"></i>
							<span>Save Canges</span>
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

<script>
$(document).ready(function(){

$('#myTableData').css('textTransform', 'capitalize');
$('#myTableDatadate').css('textTransform', 'capitalize');
});
</script>

<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="assets/js/sweet-alerts.js"></script>

<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/build/d3.min.js'></script>
<script src='assets/js/nvd3/nv.d3.js'></script>
<script src='assets/js/sparkline.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/widgets.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/jquery.dataTables.min.js'></script>
<script src='assets/js/bootstrap-datatables.js'></script>
<script src='assets/js/dataTables-custom.js'></script>
<script src='assets/js/mindmup-editabletable.js'></script>
<script src='assets/js/numeric-input-example.js'></script>
<script src='assets/js/dynamic-tables.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/select2.js'></script>
<script src='assets/js/jquery.multi-select.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src='assets/js/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap-colorpicker.js'></script>
<script src='assets/js/jquery.maskedinput.js'></script>
<script src='assets/js/form-elements.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkticketv').addClass('current');
	});
</script>

<script src="assets/js/jquery.countTo.js"></script>
</body>
</html>