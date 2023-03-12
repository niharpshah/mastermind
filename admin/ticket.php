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
				txtuname:"required",
				txtprodname:"required",
				txtproblem:"required",
			//	txtemp:"required",
				txtdate:"required",
				txttime:"required",
				txtadd:"required",
				txtland:"required",
				txtpincode:"required",
				txtcontact:{
					required:true,
					maxlength:10
				}
			},
			messages:{
				txtuname:"Please Enter User Name",
				txtprodname:"Please Enter Product Name",
				txtproblem:"Please Enter Problem Please",
				//txtemp:"Please Enter Employee Name",
				txtdate:"Please Enter Prefer Date",
				txttime:"Please Enter Prefer Time",
				txtadd:"Please Enter Address",
				txtland:"Please Enter Nearest Landmark",
				txtpincode:"Please Enter Pincode",
				txtcontact:{
					required:"Please Enter Mobile Number",
					maxlength:"Maximum 10 Digits Allowed"
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
                	url: 'ticket_data.php',
                	data: new FormData(this),
                	contentType: false,
                	cache: false,
                	processData: false,
                	success: function(data) {
                    //var d = JSON.parse(data);
                    	if (data.msg && data.msg == "Success") {
							alert('Success');
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
		<div class="panel" >
			<div class="panel-body" >
				<!--form-heading-->
				<div class="form-heading">
					<i class="fa fa-ticket"></i>&nbsp;<strong>Ticket Entry Form</strong>
				</div>
				<!--form-heading-->
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
$res = mysqli_query($cn, "select * from tbl_user");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['user_id']; ?>"  ><?php echo $r['user_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtprodname" id="txtprodname"  >
								<option value="" >Select Product</option>
								<?php
$res = mysqli_query($cn, "select * from tbl_products");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['product_id']; ?>"  ><?php echo $r['product_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Problem:</label>
						<div class="col-sm-8">
						<textarea id="txtproblem" class="form-control" placeholder="Problem" name="txtproblem"></textarea>
						</div>
					</div>

					<?php /*?><div class="form-group">
<label class="col-sm-2 control-label">Employee Name:</label>
<div class="col-sm-8">
<select class="form-control" name="txtemp" id="txtemp" >
<option value="" >Select Employee</option>
<?php
$res = mysqli_query($cn,"select * from tbl_employee");
while($r = mysqli_fetch_array($res))
{
?>
<option value="<?php  echo $r['emp_id']; ?>"  ><?php echo $r['emp_name']; ?></option>
<?php } ?>
</select>
</div>
</div><?php */?>

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

					<!--<div class="form-group check-radio">
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
							</ul>
						</div>
					</div>-->

					<!--<div class="form-group">
						<label class="col-sm-2 control-label">Assign Date:</label>
						<div class="col-sm-8">
							<input type="text" id="txtadate" name="txtadte"  class="form-control" data-provide="datepicker">
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
		$('#lnkticket').addClass('current');
	});
</script>

<script src="assets/js/jquery.countTo.js"></script>
</body>

</html>