<?php
include('connection.php');
?>

<?php
	if(isset($_REQUEST['btnsubmit']))
	{
		$pname=$_REQUEST['txtpname'];
		$problem=$_REQUEST['txtproblem'];
		$pdate=$_REQUEST['txtpdate'];
		$ptime=$_REQUEST['txtptime'];
		$add=$_REQUEST['txtadd'];
		$land=$_REQUEST['txtland'];
		$pin=$_REQUEST['txtpin'];
		$con=$_REQUEST['txtcon'];

		
		$qry="insert into tbl_ticket values(NULL,'".$_SESSION['uid']."','$pname','$problem',NOW(),NULL,'$pdate','$ptime','pending',NULL,NULL,NULL,'$add','$land','$pin','$con')";
		$rs = mysql_query($qry);
		$res = mysql_insert_id();
		if($rs)
		{
			$sql=mysql_query("insert into tbl_notifications values(NULL,'$res',NULL,NOW())");
			echo"<script>alert('Problem Is In Consideration');</script>";
			echo"<script>window.location ='userticket.php';</script>";
		}
		else
		{
			echo mysql_error();
		}
	}
?>

<!doctype html>
<html lang="en-US">

<!-- Mirrored from sitesao.com/html/airslice/contact-3.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:22:55 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Problem Register</title>
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
<div class="row">
<h1 align="center" style="color:#57bb8a;"><i class="elegant_icon_clipboard"></i> <strong>Problem Register</strong></h1>
<div class="column col-md-6 col-sm-6">
<form name="myform" method="post">
<div class="row">
<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_check_alt2"></i>&nbsp;<strong>Product Name :</strong>
<select class="form-control" name="txtpname" id="txtpname"  >
	<option value="" >Select Your Product</option>
	<?php
		$res = mysql_query("select * from tbl_products");
		while($r = mysql_fetch_array($res))
		{
	?>
	<option value="<?php  echo $r['product_id']; ?>"  ><?php echo $r['product_name']; ?></option>
	<?php } ?>
</select>
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_clipboard"></i>&nbsp;<strong>problem :</strong>
<input type="text" name="txtproblem" id="txtproblem" class="form-control text"placeholder="Enter Your Problem With Product" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_calendar"></i>&nbsp;<strong>Prefer Date :</strong>
<input type="date" name="txtpdate" id="txtpdate" class="form-control text" placeholder="Enter Your Prefer Date" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_clock_alt"></i>&nbsp;<strong>Prefer Time :</strong>
<select class="form-control" name="txtptime" id="txtptime"  >
	<option value="" >Select Prefer Time</option>
	<option value="9:00" >9:00 AM</option>
	<option value="10:00" >10:00 AM </option>
	<option value="12:00" >12:00 AM</option>
	<option value="15:00" >3:00 PM</option>
	<option value="17:00" >5:00 PM</option>
	<option value="19:00" >7:00 PM</option>
</select>
</div>
</div>

</div>
<div class="empty-space-30"></div>
</div>

<div class="column col-md-6 col-sm-6">
<div class="row">
<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_house_alt"></i>&nbsp;<strong>Address :</strong>
<textarea name="txtadd" id="txtadd" class="form-control text" placeholder="Enter Your Address" ></textarea>
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_pin_alt"></i>&nbsp;<strong>Landmark :</strong>
<input type="text" name="txtland" id="txtland" class="form-control text"placeholder="Enter Nearest Landmark" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_pushpin_alt"></i>&nbsp;<strong>Pincode :</strong>
<input type="text" name="txtpin" id="txtpin" class="form-control text" placeholder="Enter Your Pincode"  maxlength="6" />
</div>
</div>

<div class="col-sm-12">
<div class="form-control-wrap">
<i class="elegant_icon_phone"></i>&nbsp;<strong>Contact :</strong>
<input type="text" name="txtcon" id="txtcon" class="form-control text" placeholder="Enter Your Contact Number"  maxlength="10"/>
</div>
</div>

</div>
</div>
<button type="submit" name="btnsubmit" id="btnsubmit" class="btn btn-danger btn-block btn-lg btn-style-3d btn-effect-bg-center"><span>Submit Request</span>
</button>
</form>
<div class="empty-space-30"></div>
</div>

<!--<div class="column col-md-4 col-sm-4">
<div class="text-block">
<h4>Main Office</h4>
<p><strong>Address:</strong></p>
<p>
Lorem ipsum dolor sit amet, has an nullam sadipscing ullamcorper, nisl graeci minimum usu no, ne est erat deseruisse vituperata.
</p>
<p><strong>Email: </strong></p>
<p><a href="http://sitesao.com/cdn-cgi/l/email-protection#294c44484045694d4648444047074a4644"><span class="__cf_email__" data-cfemail="157078747c7955717a78747c7b3b767a78">[email&#160;protected]</span><script data-cfhash='f9e31' type="text/javascript">
/* <![CDATA[ */!function(){try{var t="currentScript"in document?document.currentScript:function(){for(var t=document.getElementsByTagName("script"),e=t.length;e--;)if(t[e].getAttribute("data-cfhash"))return t[e]}();if(t&&t.previousSibling){var e,r,n,i,c=t.previousSibling,a=c.getAttribute("data-cfemail");if(a){for(e="",r=parseInt(a.substr(0,2),16),n=2;a.length-n;n+=2)i=parseInt(a.substr(n,2),16)^r,e+=String.fromCharCode(i);e=document.createTextNode(e),c.parentNode.replaceChild(e,c)}t.parentNode.removeChild(t);}}catch(u){}}()/* ]]> */</script></a></p>
<p><strong>Phone: </strong></p>
<p>(+00) 123 456 789</p>
</div>
</div>-->
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

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkmy').addClass('active');
	});
</script>

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