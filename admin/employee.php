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


<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>

  <script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });


// AJAX STARTED
  	$(document).ready(function () {

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
				txtempimg: {
					required: function() {
					//    return $("#oldimg").val() === "" ? true : false;
                },
	                extension: "jpg,jpeg,png"
				},
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
				txtempimg: {
                required: "Employee image is required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            },
				txtempadd: "Address Is Required."
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
						$('#myform').each(function() {
							this.reset();
						});
						$('#spanSccessMsg').html("Your Record Insert Successfull...!!!");
                        $('#divSuccess').css("display", "block");

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
					<i class="icon icon-users"></i>&nbsp;<strong>Employee Registration Form</strong>
				</div>
				<!--form-heading-->
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtempid" id="txtempid" />
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
						<input type="text" id="txtcontact" class="form-control" placeholder="Contact" name="txtcontact" maxlength="10" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Password:</label>
						<div class="col-sm-8">
						<input type="password" id="txtpassword" class="form-control" placeholder="Password" name="txtpassword"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Confirm password:</label>
						<div class="col-sm-8">
						<input type="password" id="txtcpassword" class="form-control" placeholder="Confirm Password" name="txtcpassword"  />
						</div>
					</div>

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
									<input type="radio" name="r_block" id="rn" value="No" checked="checked">
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
	<!--main content-->

</div>

</div>

<script type="text/javascript" src="jquery.validate.js"></script>
<script type="text/javascript" src="additional-methods.js"></script>

<!-- wrapper -->

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkemp').addClass('current');
	});
</script>

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


<script src="assets/js/jquery.countTo.js"></script>
</body>

</html>