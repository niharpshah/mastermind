<?php
session_start();
include 'connection.php';
if (!isset($_SESSION['logid'])) {
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

<title>Sub Category</title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
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
				txtsubcatname:"required",
//				txtsubcatimg: {
//                required: function() {
//                return $("#oldimg").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            }

			},
			messages:{
				txtcatname:"Please Enter Category Name",
				txtsubcatname:"Please Enter Category Name",
//				txtsubcatimg: {
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
                	url: 'subcat_data.php',
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
    rowData += "<th>Sr No.</th>";
    rowData += "<th>Category Name</th>";
    rowData += "<th>Sub-Category Name</th>";
    rowData += "<th>Sub-Category Description</th>";
    rowData += "<th>Sub-Category Image</th>";
    rowData += "<th>Update</th>";
    rowData += "<th>Delete</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'subcat_data.php',
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
                        var cname = "";
                        if (item.catname === null || item.catname === undefined) {
                            cname = "";
                        } else {
                            cname = item.catname;
                        }
                        rowData += "<td>" + cname + "</td>";

                        var subcatname = "";
                        if (item.subcat_name === null || item.subcat_name === undefined) {
                            subcatname = "";
                        } else {
                            subcatname = item.subcat_name;
                        }
                        rowData += "<td>" + subcatname + "</td>";

                        var subcatdes = "";
                        if (item.subcat_desc === null || item.subcat_desc === undefined) {
                            subcatdes = "";
                        } else {
                            subcatdes = item.subcat_desc;
                        }
                        rowData += "<td>" + subcatdes + "</td>";


                        var subimg = "";
                        if (item.subcat_img === null || item.subcat_img === undefined) {
                            subimg = "";
                        } else {
                            subimg = item.subcat_img;
                        }

                        rowData += "<td>";
                        rowData += "<a href='images/subcategory/" + subimg + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/subcategory/small/" + subimg + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";



                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "<td>";
                        rowData += "<button onClick='editData(" + item.subcat_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";

						rowData += "<td>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.subcat_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
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
		text: "You will not be able to recover Your Sub-category Again!",
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
					swal("Deleted!","Your Sub-category Has Been Deleted.","success");
				}
		} else {
			swal("Cancelled", "Your Sub-category is safe :)", "error");
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
            xmlhttp.open("GET", "deletesubcategory.php?did=" +id, false);
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
            url: 'subcat_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#txtsubcatid').val(response[0].subcat_id);
                    $('#txtcatname').val(response[0].cat_id);
                    $('#txtsubcatname').val(response[0].subcat_name);
                    $('#txtsubcatdes').val(response[0].subcat_desc);
                    if (response[0].subcat_img !== null && response[0].subcat_img !== "") {
                        $("#imgGallery").attr("src", "images/subcategory/small/" + response[0].subcat_img);
                        $("#imgGallery").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#suboldimg").val(response[0].subcat_img);
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
				<h3 class="panel-title">
					<i class="fa fa-barcode"></i>&nbsp;<strong>Sub Category</strong>
					<span class="panel-options"><a href="subcatagory.php"><button type="submit" class="btn btn-info btn-lg">Add Record</button></a></span>

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
					<h4 class="modal-title" id="myModalLabel1"><i class="fa fa-barcode"></i>&nbsp;<strong>Sub Category</strong></h4>
				</div>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtsubcatid" id="txtsubcatid" />&nbsp;
					<!--Default Horizontal Form-->
					<div class="form-group">
						<label class="col-sm-2 control-label">Category Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtcatname" id="txtcatname"  >
								<option value="" >Select Sub-Category</option>
								<?php
$res = mysqli_query($cn, "select * from tbl_category");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['cat_id']; ?>"  ><?php echo $r['cat_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>


					<div class="form-group">
						<label class="col-sm-2 control-label">Sub-Category Name:</label>
						<div class="col-sm-8">
						<input type="text" id="txtsubcatname" class="form-control" placeholder="Sub-Category Name" name="txtsubcatname"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Sub-Category Description:</label>
						<div class="col-sm-8">
							<textarea id="txtsubcatdes" name="txtsubcatdes" class="form-control" placeholder="Sub-Category Description"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Sub-Category Image:</label>
						<div class="col-sm-8">
							<input type="file" id="txtsubcatimg" name="txtsubcatimg" class="filestyle" data-icon="false" alt="asdfgh">
						</div>
						<div id="divImage" style="display: none;" class="col-md-2">
							<input type="hidden" name="oldimg" id="oldimg" />
                            <img id="imgGallery" name="imgGallery" style="display: none;height:60px;width: 60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
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

<script src="jquery.validate.js"></script>
<script src="additional-methods.js"></script>
<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script>
$(document).ready(function(){

$('#myTableData').css('textTransform', 'capitalize');
});

</script>

<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="assets/js/sweet-alerts.js"></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnksubcatv').addClass('current');
	});
</script>

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
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>