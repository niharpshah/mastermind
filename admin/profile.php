<?php
session_start();
 include('connection.php'); 
 if(!isset($_SESSION['logid']))
 {
 	echo "<script>window.location='index.php';</script>";
 }
?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/profile.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:13:50 GMT -->
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Admin Profile</title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
  <!-- Bootstrap CSS -->

  <link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link rel='stylesheet' href='assets/css/animated-masonry-gallery.css'>
<link rel='stylesheet' href='assets/css/rotated-gallery.css'>
<link rel='stylesheet' href='assets/css/sweet-alerts/sweetalert.css'>
<link rel='stylesheet' href='assets/css/jtree.css'>
  <script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });
  </script>
</head>
<body>
  <div class="piluku-preloader text-center">
  <!-- <div class="progress">
      <div class="indeterminate"></div>
  </div> -->
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">

  

<?php include('leftbar.php'); ?>
<!-- left-bar -->

<div class="content" id="content">
	
	<div class="overlay"></div>			
	
	<?php include('header.php'); ?>
<!-- /top-bar -->
	
	<div class="main-content">
		<!--row-->
		<div class="row">
			<div class="col-md-12 nopad-right">
				<!--                        *** Profile ***-->
				<div class="panel panel-piluku">
					<div class="panel-body profile-body">
						<!--                        *** Profile cover ***-->
						<div class="profile-heading">
							<div class="profile-img">
								<img src="assets/images/avatar/ten.png" alt="three">
							</div>
							<div class="profile-name">
								<?php echo ucwords($_SESSION['uname']); ?>
							</div>
							<div class="profile-age-country">
								<strong>Admin</strong>	 <br>
								<i class="ion ion-ios-location"></i> <strong>Master Mind Technology</strong>
							</div>
							
						</div>
						<!--                        *** /Profile cover ***-->
						<div class="row">
							<div class="profile-right">
								<div class="col-md-12">

									<div class="profile-sidebar" style="margin:50px;">
										<div class="profile-sidebar-heading">
											Personal Info
											<a href="#"><i class="ion ion-edit"></i></a>
										</div>
										<ul class="list-inline list-unstyled profile-personal-info">
											<li>date of birth <span>23-May-1990</span></li>
											<li>member since <span>May-2011</span></li>
											<li>gender <span>female</span></li>
											<li>occupation <span>student</span></li>
											<li>mobile number <span>+91 9949834568</span></li>
											<li>email address <span>nina@gmail.com</span></li>
										</ul>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>

</div>  
	<!-- /Right-bar -->
</div>
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

<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/profile.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:14:11 GMT -->
</html>