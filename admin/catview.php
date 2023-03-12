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

  <title>Category</title>

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

	$(document).ready(function () {
			fillData('all');
		$("#myform").validate({
			rules:{
				txtcatname:"required",
//				txtcatimg: {
//                required: function() {
//                return $("#oldimg").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            }

			},
			messages:{
				txtcatname:"Please Enter Category Name",
//				txtcatimg: {
//                required: "Category image is required",
//                extension: "Upload only image of type .jpg or .jpeg or .png"
//            }
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
                	url: 'cat_data.php',
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
    rowData += "<th style='text-align:center;'>Category Name</th>";
    rowData += "<th style='text-align:center;'>Categor Description</th>";
    rowData += "<th style='text-align:center;'>Category Image</th>";
    rowData += "<th style='text-align:center;'>Update</th>";
    rowData += "<th style='text-align:center;'>Delete</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'cat_data.php',
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
                        var catname = "";
                        if (item.cat_name === null || item.cat_name === undefined) {
                            catname = "";
                        } else {
                            catname = item.cat_name;
                        }
                        rowData += "<td>" + catname + "</td>";

                        var catdes = "";
                        if (item.cat_desc === null || item.cat_desc === undefined) {
                            catdes = "";
                        } else {
                            catdes = item.cat_desc;
                        }
                        rowData += "<td>" + catdes + "</td>";


                        var img = "";
                        if (item.cat_img === null || item.cat_img === undefined) {
                            img = "";
                        } else {
                            img = item.cat_img;
                        }

                        rowData += "<td>";
                        rowData += "<a href='images/category/" + img + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/category/small/" + img + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";



                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "<td>";
                        rowData += "<button onClick='editData(" + item.cat_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";

						rowData += "<td>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.cat_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
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
					swal("Deleted!","Your Category Has Been Deleted.","success");
				}
		} else {
			swal("Cancelled", "Your Category is safe :)", "error");
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
            xmlhttp.open("GET", "deletecategory.php?did=" +id, false);
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
            url: 'cat_data.php',
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
				<h3 class="panel-title"><i class="fa fa-book"></i> <strong>Category</strong>
					<span class="panel-options"><a href="catagory.php"><button type="submit" class="btn btn-info btn-lg">Add Record</button></a></span>
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
					<h4 class="modal-title" id="myModalLabel1"><i class="fa fa-book"></i> Category</h4>
				</div>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">

					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="hfcatid" id="hfcatid" />&nbsp;
					<!--Default Horizontal Form-->
					<div class="form-group">
						<label class="col-sm-2 control-label">Category Name:</label>
						<div class="col-sm-8">
						<input type="text" id="txtcatname" class="form-control" placeholder="Category Name" name="txtcatname"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Category Description:</label>
						<div class="col-sm-8">
							<textarea id="txtcatdesc" name="txtcatdesc" class="form-control" placeholder="Category Description"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Category Image:</label>
						<div class="col-sm-8">
							<input type="file" id="txtcatimg" name="txtcatimg" class="filestyle" data-icon="false" alt="Category Image">
						</div>
						<div id="divImage" style="display: none;" class="col-md-2">
                            <input type="hidden" name="oldimg" id="oldimg" />
                            <img id="Y	zXSDXCVFGNMBHIN-OJ9I;W33SSE34E/.?>" name="imgGallery" style="display: none;height:60px;width: 60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
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
<script src="jquery.validate.js"></script>
<script src="additional-methods.js"></script>
<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkcatv').addClass('current');
	});
</script>
<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>
<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="assets/js/sweet-alerts.js"></script>

<script src='assets/js/jquery.dataTables.min.js'></script>
<script src='assets/js/bootstrap-datatables.js'></script>
<script src='assets/js/dataTables-custom.js'></script>
<script src='assets/js/mindmup-editabletable.js'></script>
<script src='assets/js/numeric-input-example.js'></script>
<script src='assets/js/dynamic-tables.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

</html>