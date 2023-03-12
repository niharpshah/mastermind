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
	<!--Report START-->
	$("#myformdate").on('submit', (function(e) {
		e.preventDefault();
		//alert('ohk');
		var sdate= $("#sdate").val();   
		var edate= $("#edate").val();  
		
		//alert(sdate);
		//alert(edate); 
        var mydata = [{"sdate": sdate, "edate": edate}];
        var ourObj = {};
        ourObj.action = "getitemwithdate";
        ourObj.mydata = mydata;
		 var rowData = "";
    rowData += "<table id='mydatatable' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
	rowData += "<th style='text-align:center;'>Sr No.</th>";
    rowData += "<th style='text-align:center;'>User Name</th>";
    rowData += "<th style='text-align:center;'>Product Name</th>";
    rowData += "<th style='text-align:center;'>Problem</th>";
	rowData += "<th style='text-align:center;'>Ticket Date</th>";
    rowData += "<th style='text-align:center;'>Employee Name</th>";
    rowData += "<th style='text-align:center;'>Prefer Date</th>";
    rowData += "<th style='text-align:center;'>Prefer Time</th>";
	rowData += "<th style='text-align:center;'>Status</th>";
	rowData += "<th style='text-align:center;'>Assign</th>";
	rowData += "<th style='text-align:center;'>Completed</th>";
	rowData += "<th style='text-align:center;'>Remark</th>";
    rowData += "<th style='text-align:center;'>Address</th>";
    rowData += "<th style='text-align:center;'>Landmark</th>";	
    rowData += "<th style='text-align:center;'>Pincode</th>";	
    rowData += "<th style='text-align:center;'>Contact</th>";	
    rowData += "<th style='text-align:center;'>Update</th>";
    rowData += "<th style='text-align:center;'>Delete</th>";
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

                        var tdate = "";
                        if (item.ticket_date === null || item.ticket_date === undefined) {
                            tdate = "";
                        } else {
                            tdate = item.ticket_date;
                        }
                        rowData += "<td style='text-align:center;'>" + tdate + "</td>";

                        var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
                        rowData += "<td style='text-align:center;'>" + empname + "</td>";

                        var pdate = "";
                        if (item.prefer_date === null || item.prefer_date === undefined) {
                            pdate = "";
                        } else {
                            pdate = item.prefer_date;
                        }
                        rowData += "<td style='text-align:center;'>" + pdate + "</td>";

                        var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<td style='text-align:center;'>" + ptime + "</td>";

                        var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<td style='text-align:center;'>" + sat + "</td>";

                        var adate = "";
                        if (item.assign_date === null || item.assign_date === undefined) {
                            adate = "";
                        } else {
                            adate = item.assign_date;
                        }
                        rowData += "<td style='text-align:center;'>" + adate + "</td>";

                        var cdate = "";
                        if (item.complete_date === null || item.complete_date === undefined) {
                            cdate = "";
                        } else {
                            cdate = item.complete_date;
                        }
                        rowData += "<td style='text-align:center;'>" + cdate + "</td>";

                        var remark = "";
                        if (item.remark === null || item.remark === undefined) {
                            remark = "";
                        } else {
                            remark = item.remark;
                        }
                        rowData += "<td style='text-align:center;'>" + remark + "</td>";

                        var address = "";
                        if (item.address === null || item.address === undefined) {
                            address = "";
                        } else {
                            address = item.address;
                        }
                        rowData += "<td style='text-align:center;'>" + address + "</td>";

                        var land = "";
                        if (item.landmark === null || item.landmark === undefined) {
                            land = "";
                        } else {
                            land = item.landmark;
                        }
                        rowData += "<td style='text-align:center;'>" + land + "</td>";
						
                        var pin = "";
                        if (item.pincode === null || item.pincode === undefined) {
                            pin = "";
                        } else {
                            pin = item.pincode;
                        }
                        rowData += "<td style='text-align:center;'>" + pin + "</td>";
                        
						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<td style='text-align:center;'>" + con + "</td>";


                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "<td style='text-align:center;'>";
                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";
						
						rowData += "</td>";
						
						rowData += "<td style='text-align:center;'>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.ticket_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
                        rowData += "";
                        rowData += "</td>";
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
			<!--	<!--Report START-->
});
	function fillData(val) { 

    var mydata = [];
    var ourObj = {};
    ourObj.action = "getdata";
    ourObj.mydata = mydata;
    var rowData = "";
    rowData += "<table id='mydatatable' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
	rowData += "<th style='text-align:center;'>Sr No.</th>";
    rowData += "<th style='text-align:center;'>User Name</th>";
    rowData += "<th style='text-align:center;'>Product Name</th>";
    rowData += "<th style='text-align:center;'>Problem</th>";
	rowData += "<th style='text-align:center;'>Ticket Date</th>";
    rowData += "<th style='text-align:center;'>Employee Name</th>";
    rowData += "<th style='text-align:center;'>Prefer Date</th>";
    rowData += "<th style='text-align:center;'>Prefer Time</th>";
	rowData += "<th style='text-align:center;'>Status</th>";
	rowData += "<th style='text-align:center;'>Assign</th>";
	rowData += "<th style='text-align:center;'>Completed</th>";
	rowData += "<th style='text-align:center;'>Remark</th>";
    rowData += "<th style='text-align:center;'>Address</th>";
    rowData += "<th style='text-align:center;'>Landmark</th>";	
    rowData += "<th style='text-align:center;'>Pincode</th>";	
    rowData += "<th style='text-align:center;'>Contact</th>";	
    rowData += "<th style='text-align:center;'>Update</th>";
    rowData += "<th style='text-align:center;'>Delete</th>";
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

                        var tdate = "";
                        if (item.ticket_date === null || item.ticket_date === undefined) {
                            tdate = "";
                        } else {
                            tdate = item.ticket_date;
                        }
                        rowData += "<td style='text-align:center;'>" + tdate + "</td>";

                        var empname = "";
                        if (item.employeename === null || item.employeename === undefined) {
                            empname = "";
                        } else {
                            empname = item.employeename;
                        }
                        rowData += "<td style='text-align:center;'>" + empname + "</td>";

                        var pdate = "";
                        if (item.prefer_date === null || item.prefer_date === undefined) {
                            pdate = "";
                        } else {
                            pdate = item.prefer_date;
                        }
                        rowData += "<td style='text-align:center;'>" + pdate + "</td>";

                        var ptime = "";
                        if (item.prefer_time === null || item.prefer_time === undefined) {
                            ptime = "";
                        } else {
                            ptime = item.prefer_time;
                        }
                        rowData += "<td style='text-align:center;'>" + ptime + "</td>";

                        var sat = "";
                        if (item.status === null || item.status === undefined) {
                            sat = "";
                        } else {
                            sat = item.status;
                        }
                        rowData += "<td style='text-align:center;'>" + sat + "</td>";

                        var adate = "";
                        if (item.assign_date === null || item.assign_date === undefined) {
                            adate = "";
                        } else {
                            adate = item.assign_date;
                        }
                        rowData += "<td style='text-align:center;'>" + adate + "</td>";

                        var cdate = "";
                        if (item.complete_date === null || item.complete_date === undefined) {
                            cdate = "";
                        } else {
                            cdate = item.complete_date;
                        }
                        rowData += "<td style='text-align:center;'>" + cdate + "</td>";

                        var remark = "";
                        if (item.remark === null || item.remark === undefined) {
                            remark = "";
                        } else {
                            remark = item.remark;
                        }
                        rowData += "<td style='text-align:center;'>" + remark + "</td>";

                        var address = "";
                        if (item.address === null || item.address === undefined) {
                            address = "";
                        } else {
                            address = item.address;
                        }
                        rowData += "<td style='text-align:center;'>" + address + "</td>";

                        var land = "";
                        if (item.landmark === null || item.landmark === undefined) {
                            land = "";
                        } else {
                            land = item.landmark;
                        }
                        rowData += "<td style='text-align:center;'>" + land + "</td>";
						
                        var pin = "";
                        if (item.pincode === null || item.pincode === undefined) {
                            pin = "";
                        } else {
                            pin = item.pincode;
                        }
                        rowData += "<td style='text-align:center;'>" + pin + "</td>";
                        
						var con = "";
                        if (item.contact === null || item.contact === undefined) {
                            con = "";
                        } else {
                            con = item.contact;
                        }
                        rowData += "<td style='text-align:center;'>" + con + "</td>";


                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "<td style='text-align:center;'>";
                        rowData += "<button onClick='editData(" + item.ticket_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";
						
						rowData += "</td>";
						
						rowData += "<td style='text-align:center;'>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.ticket_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
                        rowData += "";
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
	
	// $('#myTableData').DataTable({
//        dom: 'Blfrtip',
//        "iDisplayLength": 10,
//        "lengthMenu": [[10, 25, 50, 100, -1], [10, 25, 50, 100, "All"]],
//       
//    });

    //$('#mydatatable').DataTable().destroy();


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
			swal("Deleted!", "Your Ticket Has Been Deleted!", "success");
			window.location='ticketview.php';
			var res = JSON.parse(removeTicket(did));
				if(res.msg == "Success"){
					swal("Deleted!", "Your Ticket Has Been Deleted.", "success");
					 window.location='ticketview.php';	
				}
		} else {
			swal("Cancelled", "Your imaginary file is safe :)", "error");
		}
	});
	
    //if (did && did != "") {
//        
//        var mydata = [{"id": did}];
//        var ourObj = {};
//        ourObj.action = "remove";
//        ourObj.mydata = mydata;
//        $.ajax({
//            url: 'ticket_data.php',
//            type: 'POST',
//            data: {"ajaxdata": JSON.stringify(ourObj)},
//            success: function(response) {
//                if (response) {
//                    if (response.msg && response.msg === "Success") {
//                        fillData("all");
//                        //$("#hfdelid").val("");
////                        $('#divError').css("display", "none");
//                    } else {
//                        //$('#myBox').unblock();
////                        $('#divError').css("display", "block");
//                    }
//                }
//            }
//        });
//    }
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
                    $('#hfcatid').val(response[0].cat_id);
                    $('#txtcatname').val(response[0].cat_name);
                    $('#txtcatdesc').val(response[0].cat_desc);
                    if (response[0].cat_img !== null && response[0].cat_img !== "") {
                        $("#imgGallery").attr("src", "images/category/small/" + response[0].cat_img);
                        $("#imgGallery").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].cat_img);
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
				<h3 class="panel-title"><i class="fa fa-ticket"></i> <strong>Tickets</strong>		
				<div style="float:right; margin-right:10px;">
				<strong>Status: </strong> 
					<select>
						<option value="">Select</option>
						<option value="pendng">Pending</option>
						<option value="assign">Asssign</option>
						<option value="switch">Switch</option>
						<option value="completed">Completed</option>
					</select>
				</div>
			
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
				</h3>
				
			</div>
			<div class="panel-body">
				<div class="table-responsive" id="myTableData" >
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
					<input  type="hidden" name="txtticket" id="txtticket" />
					<!--Default Horizontal Form-->				
					<div class="form-group">
						<label class="col-sm-2 control-label">User:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtuname" id="txtuname"  >
								<option value="" >Select User</option>
								<?php
									$res = mysql_query("select * from tbl_user");
									while($r = mysql_fetch_array($res))
									{
								?>
								<option value="<?php  echo $r['user_id']; ?>"  ><?php echo $r['user_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Product Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtprodname" id="txtprodname"  >
								<option value="" >Select Product</option>
								<?php
									$res = mysql_query("select * from tbl_products");
									while($r = mysql_fetch_array($res))
									{
								?>
								<option value="<?php  echo $r['product_id']; ?>"  ><?php echo $r['product_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Problem:</label>
						<div class="col-sm-8">
						<textarea id="txtproblem" class="form-control" placeholder="Problem" name="txtproblem"></textarea>
						</div>
					</div>						
									
					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtemp" id="txtemp"  >
								<option value="" >Select Employee</option>
								<?php
									$res = mysql_query("select * from tbl_employee");
									while($r = mysql_fetch_array($res))
									{
								?>
								<option value="<?php  echo $r['emp_id']; ?>"  ><?php echo $r['emp_name']; ?></option>
								<?php } ?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Prefer Date:</label>
						<div class="col-sm-8">
							<input type="date" id="txtdate" name="txtdate"  class="form-control">
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Prefer Time:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txttime" id="txttime"  >
								<option value="" >Select Time</option>
								<option value="9:00 AM" >9:00 AM</option>
								<option value="10:00 AM" >10:00 AM</option>
								<option value="12:00 PM" >12:00 PM</option>
								<option value="3:00 PM" >3:00 PM</option>
								<option value="5:00 PM" >5:00 PM</option>
								<option value="7:00 PM" >7:00 PM</option>
							</select>
						</div>
					</div>

					<div class="form-group check-radio">
						<label class="col-sm-2 control-label">Ticket Status:</label>
						<div class="col-sm-8">
							<ul class="list-inline checkboxes-radio">
								<li class="ms-hover">
									<input type="radio" name="r_status" id="pending" value="pending" checked="checked">
									<label for="pending"><span></span>Pending</label>
								</li>
								
								<li class="ms-hover">
									<input type="radio" name="r_status" id="assign" value="assign">
									<label for="assign"><span></span>Assign</label>
								</li>
								
								<li>
									<input type="radio" name="r_status" id="completed" value="completed">
									<label for="completed"><span></span>Completed</label>
								</li>
							</ul>
						</div>
					</div>
				
					<!--<div class="form-group">
						<label class="col-sm-2 control-label">Remarks:</label>
						<div class="col-sm-8">
						<textarea id="txtremark" class="form-control" placeholder="Remarks" name="txtremark"></textarea>
						</div>
					</div>-->
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Address:</label>
						<div class="col-sm-8">
						<textarea id="txtadd" class="form-control" placeholder="Address" name="txtadd"></textarea>
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Landmark:</label>
						<div class="col-sm-8">
						<input type="text" id="txtland" class="form-control" placeholder="Landmark" name="txtland"  />
						</div>
					</div>	
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Pincode:</label>
						<div class="col-sm-8">
						<input type="text" id="txtpincode"  name="txtpincode" class="form-control" placeholder="Pincode" maxlength="6" />
						</div>
					</div>
					
					<div class="form-group">
						<label class="col-sm-2 control-label">Contact:</label>
						<div class="col-sm-8">
						<input type="text" id="txtcontact"  name="txtcontact" class="form-control" placeholder="Contact" maxlength="10" />
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
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/select2.js'></script>
<script src='assets/js/jquery.multi-select.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src='assets/js/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap-colorpicker.js'></script>
<script src='assets/js/jquery.maskedinput.js'></script>
<script src='assets/js/form-elements.js'></script>
<script src="assets/js/jquery.countTo.js"></script>



</body>
</html>