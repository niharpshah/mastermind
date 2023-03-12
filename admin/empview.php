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

  <title>Employee</title>

   <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon">
  <!-- Bootstrap CSS -->
<style>
.error{
	color:#FF0000;
}
</style>
<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link rel='stylesheet' href='assets/css/sweet-alerts/sweetalert.css'>

<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });


// AJAX STARTED
  	$(document).ready(function () {
		fillData('all');

			$("#myform").validate({
			rules:{
				txtempname:"required",
				txtcontact:{
					required:true,
					maxlength:10
				},
				txtpassword:"required",
				txtcpassword: {
					required: true,
					equalTo: "#txtpassword"
            	},
				txtemail:{
					required:true,
					email:true
				},
//				txtempimg: {
//					required: function() {
//                return $("#oldimg").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            },
				txtempadd: "required",
			},
			messages:{
				txtempname:"Please Enter Employee Name",
				txtcontact:{
				required:"Please Enter Contact Number",
				maxlength:"Maximum 10 Digits Allowed"
				},
				txtpassword:"Please Enter Password",
				txtcpassword: {
                required: "Please Enter Password",
                equalTo: "Password Does Not Match."
            	},
				txtemail: {
                required: "Please Enter Email Id",
                email: "Please Enter valid Email Id e.g.john@example.com."
            	},
//				txtempimg: {
//                required: "Employee image is required",
//                extension: "Upload only image of type .jpg or .jpeg or .png"
//            },
				txtempadd: "Address Is Required.",
			}
		});


		$("#myform").on('submit', (function(e) {
		e.preventDefault();
        if ($('#myform').valid()) {
//            $('#myModalBox').block({
//                message: '<img src="images/hourglass.gif" />',
//                css: {backgroundColor: 'transparent', border: 'none'}
//            });
            	$.ajax({
                	type: 'POST',
                	url: 'emp_data.php',
                	data: new FormData(this),
                	contentType: false,
                	cache: false,
                	processData: false,
                	success: function(data) {
                    //var d = JSON.parse(data);
                    	if (data.msg && data.msg == "Success") {
							fillData('all');
							$('#largemodal').modal('hide');
						$('#myform').each(function() {
							this.reset();
						});

                    	} // if (data.msg
						else {
                        	$('#spanErrorMsg').html("There is an error in submitting details.Please try again!!!");
                    	} // else
					}, // success: func
                	error: function() {
						alert('Error');
                	} //error: func
            	});
				};
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
    rowData += "<th style='text-align:center;'>Sr No.</th>";
    rowData += "<th style='text-align:center;'>Name</th>";
    rowData += "<th style='text-align:center;'>Contact</th>";
    rowData += "<th style='text-align:center;'>Image</th>";
    rowData += "<th style='text-align:center;'>Email</th>";
    rowData += "<th style='text-align:center;'>Address</th>";
    rowData += "<th style='text-align:center;'>Assign</th>";
	rowData += "<th style='text-align:center;'>Complete</th>";
    rowData += "<th style='text-align:center;'>Block</th>";
    rowData += "<th style='text-align:center;'>Update</th>";
    rowData += "<th style='text-align:center;'>Delete</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'emp_data.php',
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

                        var empname = "";
                        if (item.emp_name === null || item.emp_name === undefined) {
                            empname = "";
                        } else {
                            empname = item.emp_name;
                        }
                        rowData += "<td>" + empname + "</td>";

                        var empcon = "";
                        if (item.emp_contact === null || item.emp_contact === undefined) {
                            empcon = "";
                        } else {
                            empcon = item.emp_contact;
                        }
                        rowData += "<td>" + empcon + "</td>";

                        var empimg = "";
                        if (item.emp_img === null || item.emp_img === undefined) {
                            empimg = "";
                        } else {
                            empimg = item.emp_img;
                        }

                        rowData += "<td>";
                        rowData += "<a href='images/employee/" + empimg + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/employee/small/" + empimg + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";

                        var empemail = "";
                        if (item.emp_email === null || item.emp_email === undefined) {
                            empemail = "";
                        } else {
                            empemail = item.emp_email;
                        }
                        rowData += "<td>" + empemail + "</td>";

                        var empadd = "";
                        if (item.emp_address === null || item.emp_address === undefined) {
                            empadd = "";
                        } else {
                            empadd = item.emp_address;
                        }
                        rowData += "<td>" + empadd + "</td>";

                        var empticket = "";
                        if (item.assign === null || item.assign === undefined) {
                            empticket = "";
                        } else {
                            empticket = item.assign;
                        }
                        rowData += "<td>" + empticket + "</td>";

						var empcmp = "";
                        if (item.complete === null || item.complete === undefined) {
                            empcmp = "";
                        } else {
                            empcmp = item.complete;
                        }
                        rowData += "<td>" + empcmp + "</td>";


                        var block = "";
                        if (item.emp_block === null || item.emp_block === undefined) {
                            block = "";
                        } else {
                            block = item.emp_block;
                        }
						if(item.emp_block === "Yes")
						{
						rowData += "<td> <span class='badge bg-danger'>" + block + "</span></td>";
						}
						else
						{
                        rowData += "<td> <span class='badge bg-success'>" + block + "</span></td>";
						}

                        rowData += "<td>";
                        rowData += "<button onClick='editData(" + item.emp_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";

						rowData += "<td>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.emp_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
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

    //$('#mydatatable').DataTable().destroy();


}


function confirmRemove(did) {
	var did = did;
//	alert(did);

	swal({
		title: "Are you sure?",
		text: "You will not be able to recover Your Category Again!",
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
					swal("Deleted!","Your Employee Has Been Deleted.","success");
				}
		} else {
			swal("Cancelled", "Your Employee is safe :)", "error");
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
            xmlhttp.open("GET", "deleteemployee.php?did=" +id, false);
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
            url: 'emp_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#txtempid').val(response[0].emp_id);
                    $('#txtempname').val(response[0].emp_name);
                    $('#txtcontact').val(response[0].emp_contact);
                    if (response[0].emp_img !== null && response[0].emp_img !== "") {
                        $("#imgGallery").attr("src", "images/employee/small/" + response[0].emp_img);
                        $("#imgGallery").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].emp_img);
                    }
					$('#txtemail').val(response[0].emp_email);
					$('#txtempadd').val(response[0].emp_address);
					if(response[0].emp_block == "YES")
					{
						$('input[id=ry][value=YES]').prop("checked",true);
						$('input[id=rn][value=NO]').prop("checked",false);
					}
					else
					{
						$('input[id=ry][value=YES]').prop("checked",false);
						$('input[id=rn][value=NO]').prop("checked",true);
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


// AJAX ENDED
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
				<h3 class="panel-title">
					<i class="icon icon-users"></i>&nbsp;<strong>Employee</strong>
					<span class="panel-options"><a href="employee.php"><button type="submit" class="btn btn-info btn-lg">Add Record</button></a></span>

				</h3>
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
					<h4 class="modal-title" id="myModalLabel1"><i class="icon icon-users"></i>&nbsp;Employee Update</h4>
				</div>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtempid" id="txtempid" />&nbsp;
					<!--Default Horizontal Form-->



					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Name:</label>
						<div class="col-sm-8">
						<input type="text" id="txtempname" class="form-control" placeholder="Employee Name" name="txtempname"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Contact:</label>
						<div class="col-sm-8">
						<input type="text" id="txtcontact" class="form-control" placeholder="Contact" name="txtcontact"  />
						</div>
					</div>

					<!--<div class="form-group">
						<label class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-8">
						<input type="password" id="txtpassword" class="form-control" placeholder="Password" name="txtpassword"  />
						</div>
					</div>-->

					<!--<div class="form-group">
						<label class="col-sm-2 control-label">Confirm password:</label>
						<div class="col-sm-8">
						<input type="password" id="txtcpassword" class="form-control" placeholder="Confirm Password" name="txtcpassword"  />
						</div>
					</div>-->

					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Image:</label>
						<div class="col-sm-8">
							<input type="file" id="txtempimg" name="txtempimg"  class="filestyle" data-icon="false" alt="EmpImg">
						</div>
						<div id="divImage" style="display: none;" class="col-md-2">
							<input type="hidden" name="oldimg" id="oldimg" />
                            <img id="imgGallery" name="imgGallery" style="display: none;height:60px;width: 60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Email:</label>
						<div class="col-sm-8">
						<input type="text" id="txtemail" class="form-control" placeholder="Email" name="txtemail"  />
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Employee Address:</label>
						<div class="col-sm-8">
							<textarea id="txtempadd" name="txtempadd" class="form-control" placeholder="Employee Address"></textarea>
						</div>
					</div>

					<div class="form-group check-radio">
						<label class="col-sm-2 control-label">Block:</label>
						<div class="col-sm-8">
							<ul class="list-inline checkboxes-radio">
								<li class="ms-hover">
									<input type="radio" name="r_block" id="ry" value="Yes">
									<label for="ry"><span></span>YES</label>
								</li>
								<li>
									<input type="radio" name="r_block" id="rn" value="No">
									<label for="rn"><span></span>No</label>
								</li>
							</ul>
						</div>
					</div>


					 <div class="form-group">
					 	<div align="center">
							<button name="btnsubcat" id="myform" class="btn btn-primary btn-icon-primary btn-icon-block btn-icon-blockleft">
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
<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript" src="additional-methods.js"></script>
<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>
<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>.

<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="assets/js/sweet-alerts.js"></script>

<script src='assets/js/jquery.loadmask.min.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkempv').addClass('current');
	});
</script>

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
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>