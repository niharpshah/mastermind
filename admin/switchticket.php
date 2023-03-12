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

  <title>Switched Tickets</title>


<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>

<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });

	$(document).ready(function () {
			fillData('all');
		$("#myform").on('submit', (function(e) {
		e.preventDefault();

//        if ($('#myForm').valid()) {
//            $('#myModalBox').block({
//                message: '<img src="images/hourglass.gif" />',
//                css: {backgroundColor: 'transparent', border: 'none'}
//            });
            	$.ajax({
                	type: 'POST',
                	url: 'switch_data.php',
                	data: new FormData(this),
                	contentType: false,
                	cache: false,
                	processData: false,
                	success: function(data) {
                    //var d = JSON.parse(data);
                    	if (data.msg && data.msg == "Success") {
								fillData('all');
								$('#largemodal').modal('hide');
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
			}));

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
    rowData += "<th style='text-align:center;'>Employee Name</th>";
	rowData += "<th style='text-align:center;'>Reason</th>";
	rowData += "<th style='text-align:center;'>Approve</th>";
    rowData += "<th style='text-align:center;'>Assign</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'switch_data.php',
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
                        var user = "";
                        if (item.uname === null || item.uname === undefined) {
                            user = "";
                        } else {
                            user = item.uname;
                        }
                        rowData += "<td style='text-align:center;'>" + user + "</td>";

                        var prod = "";
                        if (item.pname === null || item.pname === undefined) {
                            prod	 = "";
                        } else {
                            prod = item.pname;
                        }
                        rowData += "<td style='text-align:center;'>" + prod + "</td>";

						var empname = "";
                        if (item.ename === null || item.ename === undefined) {
                            empname = "";
                        } else {
                            empname = item.ename;
                        }
                        rowData += "<td style='text-align:center;'>" + empname + "</td>";

                        var ereason = "";
                        if (item.reason === null || item.reason === undefined) {
                            ereason = "";
                        } else {
                            ereason = item.reason;
                        }
                        rowData += "<td style='text-align:center;'>" + ereason + "</td>";

                        var approval = "";
                        if (item.approve === null || item.approve === undefined) {
                            approval = "";
                        } else {
                            approval = item.approve;
                        }
                        rowData += "<td style='text-align:center;'>" + approval + "</td>";

						if(approval == "No")
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
	alert(did);
    if (did && did != "") {
        var mydata = [{"id": did}];
        var ourObj = {};
        ourObj.action = "remove";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'switch_data.php',
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
            url: 'switch_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#txtticket').val(response[0].ticket_id);
                    $('#txtempname').val(response[0].emp_id);
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
				<h3 class="panel-title"><i class="ion-arrow-swap"></i> <strong>Switched Tickets</strong>
					<span class="panel-options">
						<a href="#" class="panel-refresh">
							<i class="icon ti-reload"></i>
						</a>
						<a href="#" class="panel-minimize">
							<i class="icon ti-angle-up"></i>
						</a>
						<a href="#" class="panel-close">
							<i class="icon ti-close"></i>
						</a>
					</span>

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
					<h4 class="modal-title" id="myModalLabel1">Switched Tickets</h4>
				</div><br>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtticket" id="txtticket" />
					<!--Default Horizontal Form-->
					<div class="form-group">
						<label class="col-sm-2 control-label"><strong>Employee Name:</strong></label>
						<div class="col-sm-8">
							<select class="form-control" name="txtempname" id="txtempname"  >
								<option value="" >Assign An Employee</option>
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
							<button name="btnsave" id="btnsave" class="btn btn-primary btn-icon-primary btn-icon-block btn-icon-blockleft">
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

<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkswticket').addClass('current');
	});
</script>



<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/jquery.dataTables.min.js'></script>
<script src='assets/js/bootstrap-datatables.js'></script>
<script src='assets/js/dataTables-custom.js'></script>
<script src='assets/js/mindmup-editabletable.js'></script>
<script src='assets/js/numeric-input-example.js'></script>
<script src='assets/js/dynamic-tables.js'></script>

<script src="assets/js/jquery.countTo.js"></script>
</body>
</html>