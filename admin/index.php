<?php
session_start();
include('connection.php');
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/signin2.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:44 GMT -->

<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Admin Login</title>
	<link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
	<link rel="icon" href="images/favicon.ico" type="image/x-icon">
	<!--Bootstrap CSS-->

	<link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="assets/css/material.css">
	<link rel="stylesheet" href="assets/css/material.css">
	<link rel="stylesheet" type="text/css" href="assets/css/style.css">
	<link rel="stylesheet" type="text/css" href="assets/css/signin2.css">

	<!-- custom scrollbar stylesheet -->
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0" />
	<!--320-->
</head>

<body>

	<div class="flip-container">
		<div class="flipper">
			<div class="front">
				<!-- front content -->
				<div class="holder">
					<form name="myform" method="post" enctype="multipart/form-data">
						<h1 class="heading">Master Mind Technologies</h1>
						<?php
						if (isset($_REQUEST['btnsubmit'])) {
							$qry = "select * from tbl_admin where username='" . $_REQUEST['txtuname'] . "' and password='" . $_REQUEST['txtpassword'] . "'";
							$rs = mysqli_query($cn, $qry);
							if (mysqli_num_rows($rs) > 0) {
								while ($row = mysqli_fetch_array($rs)) {
									$logid = $row['login_id'];
									$uname = $row['username'];
									$pass = $row['password'];
								} // while over	
								if ($uname == $_REQUEST['txtuname'] && $pass == $_REQUEST['txtpassword']) {
									$_SESSION['logid'] = $logid;
									$_SESSION['uname'] = $uname;
									$qry = "insert into tbl_log values(NULL,'" . $logid . "',NOW())";
									$rs = mysqli_query($cn, $qry);
									if ($rs) {
										echo "<script>window.location = 'dashboard.php';</script>";
									} //if ENDED
								} else {
						?>
									<div class="alert alert-danger">
										Error! Username & password Does Not Match...
									</div>
								<?php
								} //If $uname == $_REQUEST ENDED
							} // if mysql_num_rows ENDED
							else {
								?>
								<div class="alert alert-danger">
									Error! Username & password Invalid.
								</div>
						<?php
							}
						} // If isset ENDED
						?>


						<input class="form-control" type="text" placeholder="Username" name="txtuname" id="txtuname">
						<input type="password" class="form-control" placeholder="Password" name="txtpassword" id="txtpassword">
						<div class="bottom_info">
							<input type="checkbox" id="c10" />
							<label for="c10"><span></span><strong>Show Password</strong></label>
							<a href="#" class="pull-right" data-toggle="modal" data-target="#forgot">forgot password?</a>
						</div>
						<div class="clearfix"></div>

						<button type="submit" class="btn btn-primary btn-block" name="btnsubmit" id="btnsubmit">Sign in</button>
						<div class="bottom_info" align="center">
							<?php
							$qry = mysqli_query($cn, "select * from tbl_log ORDER BY log_id DESC Limit 1");
							while ($row = mysqli_fetch_array($qry)) {
								$date = $row['datetime'];
								$adate = date("d-m-Y", strtotime($date));
								$time = $row['datetime'];
								$atime = date("h:i:s", strtotime($time));
								echo "Last Login Was On " . "<strong>" . $adate . "</strong>" . "&nbsp;At" . "&nbsp;<strong>" . $atime . "</strong>";
							}
							?>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>

	<!-- Modal -->
	<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
					<h4 class="modal-title" id="myModalLabel"><i class="ion-android-settings"></i> Reset password</h4>
				</div>
				<div class="modal-body">
					<div class="col-sm-12">
						<input type="text" class="form-control" placeholder="Enter Contact Number here" id="txtforgot" name="txtforgot">
						<h6 class="note"><i class="ion-android-mail"></i> password will be sent to your Registered Contact Number</h6>
					</div>
				</div>

				<div class="modal-footer">
					<button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary">Send</button>
				</div>
			</div>
		</div>
	</div>

	<!-- modal -->
	<script src="assets/js/jquery.js"></script>
	<script src="assets/js/bootstrap.min.js"></script>
	<script src="assets/js/materialize.js"></script>
	<script type="text/javascript">
		$(document).ready(function() {
			///alert('hh');
			$("#c10").click(function() {
				// alert('f');
				if ($("#c10").is(':checked')) {
					$("#txtpassword").attr('type', 'text');
				} else {
					$("#txtpassword").attr('type', 'password');
				}

			}); // click function over
		}); // document.ready over
	</script>


</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/signin2.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:45 GMT -->

</html>