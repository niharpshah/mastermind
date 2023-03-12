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

<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link href="assets/css/sweet-alerts/sweetalert.css" rel="stylesheet" type="text/css">


<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
<script src="jquery-2.1.4.min.js"></script>
<script src="jquery.validate.js"></script>
<script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
// AJAX STARTED
  	$(document).ready(function () {

		$("#myform").validate({
			rules:{
				txtcatname:"required",
				txtcatimg: {
                required: function() {
                //    return $("#oldimg").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            }

			},
			messages:{
				txtcatname:"Please Enter Category Name",
				txtcatimg: {
                required: "Category image is required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            }
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
							$('#myform').each(function (){
								this.reset();
							});
							$('#spanSccessMsg').html("Your Record Insert Successfull...!!!");
                        $('#divSuccess').css("display", "block");
//                       	clearControls();
//                        	fillData("all");
//                        	$('#divDataModal').modal('hide');
//                        	$('#myModalBox').unblock();
                    	} // if (data.msg
						else {
                    	} // else
					}, // success: func
                	error: function() {
					$('#spanErrorMsg').html("Your Record Not Insert...!!!");
                      $('#divError').css("display", "block");
                	} //error: func
            	});
				};
	}));

});
// AJAX ENDED
</script>

<style>
.error
{
	color:#FF0000;
}
</style>
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
	<!--main content-->
	<div class="main-content">
		<!--theme panel-->
		<div class="alert alert-success" id="divSuccess" style="display:none">
							<span id="spanSccessMsg"></span>
						</div>

		<div class="alert alert-danger" id="divError" style="display:none">
							<span id="spanErrorMsg"></span>
						</div>

		<div class="panel" >

			<div class="panel-body" >

				<!--form-heading-->
				<div class="form-heading">
					<i class="fa fa-book"></i>&nbsp;<strong>Category Form</strong>
				</div>

				<!--form-heading-->
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">

					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="hfcatid" id="hfcatid" />
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
	<!--main content-->

</div>

</div>

  <script type="text/javascript" src="jquery.validate.js"></script>
 <script type="text/javascript" src="additional-methods.js"></script>

<!-- wrapper -->
<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/select2.js'></script>
<script src='assets/js/jquery.multi-select.js'></script>
<script src='assets/js/bootstrap-filestyle.js'></script>
<script src='assets/js/bootstrap-datepicker.js'></script>
<script src='assets/js/bootstrap-colorpicker.js'></script>
<script src='assets/js/jquery.maskedinput.js'></script>
<script src='assets/js/form-elements.js'></script>
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkcat').addClass('current');
	});
</script>


<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/form-elements.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:16:49 GMT -->
</html>