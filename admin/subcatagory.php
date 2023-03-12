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
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>

  <title>Sub Category</title>


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
				txtcatname:"required",
				txtsubcatname:"required",
				txtsubcatimg: {
                required: function() {
                //    return $("#oldimg").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            }

			},
			messages:{
				txtcatname:"Please Select Category",
				txtsubcatname:"Please Enter Category Name",
				txtsubcatimg: {
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
                	url: 'subcat_data.php',
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


		<div class="alert alert-success" id="divSuccess" style="display:none">
							<span id="spanSccessMsg"></span>
						</div>

		<div class="alert alert-danger" id="divError" style="display:none">
							<span id="spanErrorMsg"></span>
						</div>

		<!--theme panel-->
		<div class="panel" >
			<div class="panel-body" >
				<!--form-heading-->
				<div class="form-heading">
					<i class="fa fa-barcode"></i>&nbsp;<strong>Sub Category</strong>
				</div>
				<!--form-heading-->
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtsubcatid" id="txtsubcatid" />
					<!--Default Horizontal Form-->
					<div class="form-group">
						<label class="col-sm-2 control-label">Category Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtcatname" id="txtcatname"  >
								<option value="" >Select Category</option>
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
		$('#lnksubcat').addClass('current');
	});
</script>

<script src="assets/js/jquery.countTo.js"></script>
</body>

</html>