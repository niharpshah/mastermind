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

  <title>Products</title>


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
				txtsubcatname:"required",
				txtprodname:"required",
				txtprodimg1: {
                required: function() {
               // return $("#oldimg1").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            },
				txtprodimg2: {
                required: function() {
                // return $("#oldimg2").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            },
				txtprodimg3: {
                required: function() {
                // return $("#oldimg3").val() === "" ? true : false;
                },
                extension: "jpg,jpeg,png"
            },
				txtprodinfo: {
                required: function() {
               // return $("#oldpdf").val() === "" ? true : false;
                },
                extension: "pdf"
            },
				txtprodcode:"required",
				txtprice:"required",
				r_status:"required"

			},
			messages:{
				txtsubcatname:"Please Enter Sub-Ctegory Name",
				txtprodname:"Please Enter Product Name",
				txtprodimg1: {
                required: "Product image 01 Is Required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            },
				txtprodimg2: {
                required: "Product image 02 Is Required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            },
				txtprodimg3: {
                required: "Product image 03 Is Required",
                extension: "Upload only image of type .jpg or .jpeg or .png"
            },
				txtprodinfo: {
                required: "Product Instruction One Is Required",
                extension: "Upload only PDF file."
            },
				txtprodcode:"Please Enter Product Code",
				txtprice:"Please Enter The Price",
				r_status:"Please Select One Option"
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
                	url: 'prod_data.php',
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
					Product Form
				</div>
				<!--form-heading-->
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtprodid" id="txtprodid" />
					<!--Default Horizontal Form-->


					<div class="form-group">
						<label class="col-sm-2 control-label">Sub Category Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtsubcatname" id="txtsubcatname"  >
								<option value="" >Select Sub-Category</option>
								<?php
$res = mysqli_query($cn, "select * from tbl_subcategory");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['subcat_id']; ?>"  ><?php echo $r['subcat_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Name:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprodname" class="form-control" placeholder="Product Name" name="txtprodname"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Description:</label>
						<div class="col-sm-8">
							<textarea id="txtproddes" name="txtproddes" class="form-control" placeholder="Product Description"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 01:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg1" name="txtprodimg1"  class="filestyle" data-icon="false" alt="prodimg1">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 02:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg2" name="txtprodimg2"  class="filestyle" data-icon="false" alt="prodimg2">
						</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 03:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg3" name="txtprodimg3"  class="filestyle" data-icon="false" alt="prodimg3">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Info:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodinfo" name="txtprodinfo"  class="filestyle" data-icon="false" alt="productinfo">
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Code:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprodcode" class="form-control" placeholder="Product Code : e.g. 000" name="txtprodcode"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Price:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprice" class="form-control" placeholder="Price" name="txtprice"  />
						</div>
					</div>

					<div class="form-group check-radio">
						<label class="col-sm-2 control-label">Availibility:</label>
						<div class="col-sm-8">
							<ul class="list-inline checkboxes-radio">
								<li class="ms-hover">
									<input type="radio" name="r_aval" id="ry" value="Yes" checked="checked">
									<label for="ry"><span></span>Yes</label>
								</li>
								<li>
									<input type="radio" name="r_aval" id="rn" value="No">
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
		$('#lnkprod').addClass('current');
	});
</script>


<script src="assets/js/jquery.countTo.js"></script>
</body>

</html>