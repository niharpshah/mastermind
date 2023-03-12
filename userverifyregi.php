<?php
include('connection.php');
include('encrypt.php');
if(isset($_REQUEST["lid"]))
{
	$converter = new Encryption;
	$ss = $converter->decode($_REQUEST["lid"]);
	$sql=mysql_query("select * from tbl_user where otp_code='".$ss."'");
	if(mysql_num_rows($sql)<=0)
	{
		echo "<script>window.location='error.php';<script>";
	}  
}
?>
<!doctype html>
<html lang="en-US">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Verify New User</title>
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
<?php include('header.php'); ?>
<div class="heading-container heading-resize">
<div class="heading-background heading-parallax bg-1">
<div class="container">
<div class="row heading-wrap">
<div class="col-md-12 page-title parallax-content">
<h1>MASTER MIND TECHNOLOGIES</h1>
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
<div class="row" >
<h2 align="center" style="color:#57bb8a;"><i class="elegant_icon_key_alt"></i> <strong>Confirm OTP</strong></h2>
<div class="column col-md-3 col-sm-12"></div>
<div class="column col-md-6 col-sm-12">
<form name="myform" method="post">
<?php
if(isset($_REQUEST['btnotp']))
{
	$sql=mysql_query("select * from tbl_user where otp_code='".$_REQUEST['txtotp']."'");
	if(mysql_num_rows($sql)>0)
	{
		while($row = mysql_fetch_array($sql))
		{
			$newotp = $row['otp_code'];
			$userid = $row['user_id'];
		}
		if($newotp == $_REQUEST['txtotp'])
		{
			$messagebody = file_get_contents("testregiemail.html");
			
								$email = 'npshah1194@gmail.com';
								$to       = 'ankitpatel00725.ap@gmail.com';
								$subject  = 'Welcome To Master Mind Technologies';
//								$messagebody = str_replace("{{NAME}}",$_SESSION['name'], $messagebody);
//								$messagebody = str_replace("{{ADDRESS}}",$_REQUEST['txtadd'], $messagebody);
//								$messagebody = str_replace("{{CONTACT}}",$_REQUEST['txtcon'], $messagebody);
//								$messagebody = str_replace("{{PINCODE}}",$_REQUEST['txtpin'], $messagebody);
								$message  = $messagebody;
								$headers  = 'MIME-Version: 1.0' . "\r\n";
								$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
								$headers .= 'From: '.$email."\r\n".
											'Reply-To: '. $email. "\r\n".
											'X-Mailer: PHP/'. phpversion();
											if(mail($to, $subject, $message, $headers))
									echo "<script>alert('Your inquiry has been send successfull...')</script>";
								else
									echo "Email sending failed";
									
			echo"<Script>alert('Congratulations...!!! You Are Verified');</script>";
			echo "<script>window.location='login.php';</script>";
		}
	}
	else
	{
	?>
		<center><div class="alert alert-danger column col-md-12 col-sm-12 " role="alert" style="text-align:center;">
		<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
		<strong>Sorry OTP Can Not Matched.</strong></div></center>
	<?php
	}
}
?>
<div class="row">
<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_lock"></i>&nbsp;<strong>Enter OTP :</strong>
<input type="text" name="txtotp" id="txtotp" class="form-control text" placeholder="Enter Your OTP Code" />
</div>
</div>

<div class="text-center">
<button type="submit" name="btnotp" id="btnotp" class="btn btn-primary btn-block btn-sm btn-style-square btn-effect-bg-right"><span>Check My Otp</span></button>
</div>

</div>
</form>

</div>
<div class="column col-md-3 col-sm-12"></div>
<div class="empty-space-30"></div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
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

<script type='text/javascript' src='js/jquery.appear.min.js'></script>
<script type='text/javascript' src='js/script.js'></script>
<script type='text/javascript' src='js/jquery.parallax.js'></script>
<script type='text/javascript' src='js/jquery.countTo.min.js'></script>
<script type='text/javascript' src='js/isotope.pkgd.min.js'></script>
<script type='text/javascript' src='js/jquery.magnific-popup.min.js'></script>
<script type='text/javascript' src='js/jquery.touchSwipe.min.js'></script>

<script type='text/javascript' src='js/jquery.carouFredSel.min.js'></script>
<script type='text/javascript' src='js/skin-selector.js'></script>
<script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>

<!-- Mirrored from sitesao.com/html/airslice/contact-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:22:55 GMT -->
</html>