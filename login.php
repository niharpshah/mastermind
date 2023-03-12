<?php
include 'connection.php';
if (isset($_SESSION['uid'])) {
    echo "<script>window.location ='index.php';</script>";
}
if (isset($_SESSION['eid'])) {
    echo "<script>window.location ='index.php';</script>";
}
?>


<!--USER LOGN-->


<!--Employee Login-->
<!doctype html>
<html lang="en-US">

<!-- Mirrored from sitesao.com/html/airslice/contact-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:22:55 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>LOGIN | USER & EMPLOYEE</title>
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/page.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/preloader.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/skin-selector.css' type='text/css' media='all'/>
<script type="text/javascript" src="js/jquery.js"></script>


<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body data-spy="scroll">

<div id="preloader">
<img class="preloader__logo" src="images/logo.png" alt=""/>
<div class="preloader__progress">
<svg width="60px" height="60px" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
<path class="preloader__progress-circlebg" fill="none" stroke="#dddddd" stroke-width="4" stroke-linecap="round" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
<path id='preloader__progress-circle' fill="none" stroke="#57bb8a" stroke-width="4" stroke-linecap="round" stroke-dashoffset="192.61" stroke-dasharray="192.61 192.61" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
</svg>
</div>
</div>
<div id="wrapper" class="wide-wrap">
<div class="morphsearch" id="morphsearch">
<form>
<input type="search" name="s" placeholder="Search..." class="morphsearch-input">
<button type="submit" class="morphsearch-submit"></button>
</form>
<span class="morphsearch-close"></span>
</div>
<?php include 'header.php';?>
<div class="heading-container heading-resize">
<div class="heading-background heading-parallax bg-1">
<div class="container">
<div class="row heading-wrap">
<div class="col-md-12 page-title parallax-content">
<h1>MASTER MIND TECHNOLOGIES</h1>
<h5><span class="subtitle">SMART SOLUTIONS</span></h5>
</div>
</div>
</div>
</div>
</div>
<div class="content-container no-padding">
<div class="container-full">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="row row-custom-padding section-contact">
<div class="column col-md-12">
<div class="container">
<div class="row">
<div class="column col-md-6 col-sm-6" style="background-color:honeydew;">
<form name="myform" method="post">
<h1 align="center" style="color:#57bb8a;"><i class="elegant_icon_ribbon_alt"></i> <strong>User</strong></h1>
<div class="row">
<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_phone"></i>&nbsp;&nbsp;<strong>Contact :</strong>
<input type="text" name="txtcontact" id="txtcontact" class="form-control text" placeholder="Enter Your Contact Number" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_lock"></i>&nbsp;<strong>Password :</strong>
<input type="password" name="txtpassword" id="txtpassword" class="form-control text" placeholder="Enter Your Password" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<input type="checkbox" name="showpass" id="showpass" /> <strong>Show Password</strong>
<label style="float:right"><a href="" data-toggle="modal" data-target="#forgot">Forgot Password</a></label>
</div>
</div>

</div>

<?php
if (isset($_REQUEST['btnlogin'])) {
    $qry = "select * from tbl_user where contact='" . $_REQUEST['txtcontact'] . "' and password='" . $_REQUEST['txtpassword'] . "'";
    $rs = mysqli_query($cn, $qry);
    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_array($rs)) {
            $userid = $row['user_id'];
            $contact = $row['contact'];
            $pass = $row['password'];
            $name = $row['user_name'];

        } // while over
        if ($contact == $_REQUEST['txtcontact'] && $pass == $_REQUEST['txtpassword']) {
            $_SESSION['uid'] = $userid;
            $_SESSION['name'] = $name;
            echo "<script>window.location ='shop.php';</script>";
        } //if ENDED
        else {
            echo "Username And Password Does Not Match";
        }
    } //If $uname == $_REQUEST ENDED
    else {
        ?>
				<div class="alert alert-danger">
					Sorry...!!! Username Or Password are Invalid.
				</div>
			<?php
} // if mysql_num_rows ENDED
}
?>
<div class="text-center" style="padding-bottom:10px;">
<button type="submit" name="btnlogin" id="btnlogin" class="btn btn-primary btn-block btn-lg btn-style-outlined btn-effect-bg-right"><span>Enter</span></button>
<center>
<label style="padding-top:5px;"><a href="registration.php">Create New Account</a></label>
</center>
</div>
</form>
</div>


<div class="column col-md-6 col-sm-6 bg" style="background-color:#F9FFD1;">
<form name="myform" method="post">
<h1 align="center" style="color:#57bb8a;"><i class="elegant_icon_ribbon_alt"></i> <strong>Employee</strong></h1>
<div class="row">
<div class="col-sm-12" >
<div class="form-control-wrap">
<i class="elegant_icon_phone"></i>&nbsp;&nbsp;<strong>Contact :</strong>
<input type="text" name="txtcontact" id="txtcontact" class="form-control text" placeholder="Enter Your Contact Number" />
</div>
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_lock"></i>&nbsp;<strong>Password :</strong>
<input type="password" name="txtepassword" id="txtepassword" class="form-control text" placeholder="Enter Your Password" />
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<input type="checkbox" name="showpass2" id="showpass2" /> <strong>Show Password</strong>
<label style="float:right"><a href="" data-toggle="modal" data-target="#empforgot">Forgot Password</a></label>
</div>
</div>

</div>


<?php
if (isset($_REQUEST['btnloginemp'])) {
    $qry = "select * from tbl_employee where emp_contact='" . $_REQUEST['txtcontact'] . "' and emp_pass='" . $_REQUEST['txtepassword'] . "'";
    $rs = mysqli_query($cn, $qry);
    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_array($rs)) {
            $empid = $row['emp_id'];
            $contact = $row['emp_contact'];
            $pass = $row['emp_pass'];
            $name = $row['emp_name'];

        } // while over
        if ($contact == $_REQUEST['txtcontact'] && $pass == $_REQUEST['txtepassword']) {
            $_SESSION['eid'] = $empid;
            $_SESSION['name'] = $name;
            echo "<script>window.location ='tickets.php';</script>";
        } //if ENDED
        else {
            echo "Username And Password Does Not Match";
        }
    } //If $uname == $_REQUEST ENDED
    else {
        ?>
				<div class="alert alert-danger">
					Sorry...!!! Username Or Password are Invalid.
				</div>
			<?php
} // if mysql_num_rows ENDED
}
?>

<div class="text-center" style="padding-bottom:43px;">
<button type="submit" name="btnloginemp" id="btnloginemp" class="btn btn-primary btn-block btn-lg btn-style-outlined btn-effect-bg-right"><span>Log In</span></button>
</div>
</form>
</div>

<!--USER MODAL-->

<div class="column col-md-3 col-sm-6">
<div class="modal fade" id="forgot" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-center modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<h4 class="modal-title"><i class="elegant_icon_cog"></i> Forgot Password</h4>
</div>
<div class="modal-body">
<form method="post" enctype="multipart/form-data" >
<div class="col-sm-12">
<input type="text" name="txtforgotcontact" id="txtforgotcontact" class="form-control text" placeholder="Enter Your Contact Number" />
<h6 style="color:#FF0000; margin-top:30px; letter-spacing:0.02cm;">
<i class="elegant_icon_mail_alt"></i>&nbsp;Password Will Be Sent To Your Registered Contact Number
</h6>
</div></div>
<div class="modal-footer">
<button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary" name="btnforgot" id="btnforgot">Send OTP</button>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="empty-space-40"></div>
</div>

<?php
if (isset($_REQUEST['btnforgot'])) {
    $qry = "select * from tbl_user where contact='" . $_REQUEST['txtforgotcontact'] . "'";
    $rs = mysqli_query($cn, $qry);
    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_array($rs)) {
            $usercontact = $row['contact'];
            $userid = $row['user_id'];
        } // while over
        if ($usercontact == $_REQUEST['txtforgotcontact']) {
            $otp = rand(00000, 99999);
            $ch = curl_init();
            $user = "npshah1194@gmail.com:Mahhi1194";
            $receipientno = $_REQUEST['txtforgotcontact'];
            $senderID = "TEST SMS";
            $msgtxt = "Dear User, \nYour  OTP Is : " . $otp;
            curl_setopt($ch, CURLOPT_URL, "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
            $buffer = curl_exec($ch);

            curl_close($ch);

            mysqli_query($cn, "update tbl_user set otp_code='" . $otp . "' where user_id='" . $userid . "'");

            echo "<script>window.location='confirmotp.php?otp=$userid';</script>";
        }
    } // if mysql_num_rows ENDED
    else {
        echo "<script>alert('GET OUT');</script>";
    }
}
?>
<!--END USER MODAL-->

<!--EMP MODAL-->

<div class="column col-md-3 col-sm-6">
<div class="modal fade" id="empforgot" tabindex="-1" role="dialog" aria-hidden="true">
<div class="modal-dialog modal-dialog-center modal-lg">
<div class="modal-content">
<div class="modal-header">
<button type="button" class="close" data-dismiss="modal">
<span aria-hidden="true">&times;</span>
<span class="sr-only">Close</span>
</button>
<h4 class="modal-title"><i class="elegant_icon_cog"></i> Reset Password</h4>
</div>
<div class="modal-body">
<form method="post" enctype="multipart/form-data" >
<div class="col-sm-12">
<input type="text" name="txtfcontact" id="txtfcontact" class="form-control text" placeholder="Enter Your Contact Number" />
<h6 style="color:#FF0000; margin-top:30px; letter-spacing:0.02cm;">
<i class="elegant_icon_mail_alt"></i>&nbsp;Password Will Be Sent To Your Registered Contact Number
</h6>
</div></div>
<div class="modal-footer">
<button type="button" class="btn btn-red" data-dismiss="modal">Close</button>
<button type="submit" class="btn btn-primary" name="btnempforgot" id="btnempforgot">Send OTP</button>
</div>
</form>
</div>
</div>
</div>
</div>
<div class="empty-space-40"></div>
</div>

<?php
if (isset($_REQUEST['btnempforgot'])) {
    $qry = "select * from tbl_employee where emp_contact='" . $_REQUEST['txtfcontact'] . "'";
    $rs = mysqli_query($cn, $qry);
    if (mysqli_num_rows($rs) > 0) {
        while ($row = mysqli_fetch_array($rs)) {
            $empcontact = $row['emp_contact'];
            $empid = $row['emp_id'];
        } // while over
        if ($empcontact == $_REQUEST['txtfcontact']) {
            $otp = rand(0000, 9999);
/*                    $ch = curl_init();
$user="npshah1194@gmail.com:Mahhi1194";
$receipientno=$_REQUEST['txtforgotcontact'];
$senderID="TEST SMS";
$msgtxt="Dear Employee, Your  OTP Is : ".$otp;
curl_setopt($ch,CURLOPT_URL,  "http://api.mVaayoo.com/mvaayooapi/MessageCompose");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "user=$user&senderID=$senderID&receipientno=$receipientno&msgtxt=$msgtxt");
$buffer = curl_exec($ch);

curl_close($ch);
 */
            mysqli_query($cn, "update tbl_employee set otp_code='" . $otp . "' where emp_id='" . $empid . "'");

            echo "<script>window.location='empconfirmotp.php?empotp=$empid';</script>";
        }
    } // if mysql_num_rows ENDED
    else {
        echo "<script>alert('Denied');</script>";
    }
}
?>
<!--END EMP MODAL-->



</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include 'footer.php';?>
</div>
<a href="#" class="go-to-top"><i class="fa fa-angle-up"></i></a>
<div class="sitesao-preview">

</div>
<div class="sitesao-preview__loading">
<div class="sitesao-preview__loading__animation"><i></i><i></i><i></i><i></i></div>
</div>
<script type='text/javascript' src='js/jquery.js'></script>
<script type='text/javascript' src='js/jquery-migrate.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='js/preloader.min.js'></script>
<script type='text/javascript' src='js/easing.min.js'></script>
<script type='text/javascript' src='js/imagesloaded.pkgd.min.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>
<script type='text/javascript' src='js/superfish-1.7.4.min.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnklog').addClass('active');
	});
</script>

<script type='text/javascript' src='js/jquery.appear.min.js'></script>
<script type='text/javascript' src='js/script.js'></script>
<script type='text/javascript' src='js/jquery.parallax.js'></script>
<script type='text/javascript' src='js/jquery.countTo.min.js'></script>
<script type='text/javascript' src='js/isotope.pkgd.min.js'></script>
<script type='text/javascript' src='js/jquery.magnific-popup.min.js'></script>
<script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>
<script type='text/javascript' src='js/jquery.carouFredSel.min.js'></script>
<script type="text/javascript">
	jQuery(document).ready(function(){
			///alert('hh');
		 jQuery("#showpass2").click(function(){
		// alert('f');
		 if(jQuery("#showpass2").is(':checked'))
		 {
		    jQuery("#txtepassword").attr('type' , 'text');
		 }
		 else
		 {
		   jQuery("#txtepassword").attr('type', 'password');
		 }

		 }); // click function over


		 jQuery("#showpass").click(function(){
		// alert('f');
		 if(jQuery("#showpass").is(':checked'))
		 {
		    jQuery("#txtpassword").attr('type' , 'text');
		 }
		 else
		 {
		   jQuery("#txtpassword").attr('type', 'password');
		 }

		 }); // click function over
	}); // document.ready over
</script>

<script type='text/javascript' src='js/skin-selector.js'></script>
<script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>

<!-- Mirrored from sitesao.com/html/airslice/contact-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:22:55 GMT -->
</html>