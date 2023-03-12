<?php 
include 'connection.php';
if(!isset($_SESSION['uid']))
{
	echo "<script>window.location = 'index.php';</script>";
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>User Profile</title>
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/preloader.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/skin-selector.css' type='text/css' media='all'/>
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

<?php include'header.php'; ?>
<div class="heading-container">
<div class="container heading-standar">
<div class="heading-wrap">

<div class="page-title">
<h1 align="center">User Profile</h1>
</div>
</div>
</div>
</div>
<?php 
	$qry="select * from tbl_user where user_id = '". $_SESSION['uid'] ."'";
	$rs = mysql_query($qry);
	while($r = mysql_fetch_array($rs))
	{ 
			$date = $r['reg_date'];
			$ndate = date("d-m-Y", strtotime($date));
?>
<div class="content-container">
<div class="container">
<div class="row">
<div class="col-md-7 main-wrap">
<div class="main-content">
<div class="row">
<div class="column col-md-12" id="tbldata">
<div class="posts" data-paginate="page_num" data-layout="default">
<div class="posts-wrap posts-layout-medium">
<article class="hentry">
<div class="hentry-wrap">
<div class="entry-featured image-featured">
<a title="Product Image">
<img  src="<?php echo "admin/images/user/two.png" ?>" alt=""/>
</a>
</div>
<div class="entry-info">
<div class="entry-header">
<div class="date-badge">
<a title="Ticket Date">
<span class="date" style="font-size:16px;color:#FFFFFF;background-color:#57bb8a"><?php echo $ndate; ?></span>
</a>

</div>
<h2 class="entry-title">
<a title="Product Name">
<?php echo $r["user_name"]; ?>
</a>
</h2>

</div>
<div class="entry-content">
<p class="col-md-3">
<strong><i class="elegant_icon_mobile"></i>&nbsp;Contact : </strong><?php echo $r["contact"]; ?><br>
<br>
<strong><i class="elegant_icon_mail_alt"></i>&nbsp;Email : </strong><?php echo $r["email"]; ?><br>
<br>
<button id="updatebtn" name="updatebtn" class="btn btn-primary btn-block btn-sm btn-style-square btn-effect-bg-center" type="submit"><span>Update..!!</span></button>
</p>

</div>
</div>
</div>
</article>
</div>

</div>
</div>

</div>
</div>
</div>

<div class="col-md-5 main-wrap" id="formm">
<div class="main-content">
<div class="row">
<div class="column col-md-12">
<div class="posts" data-paginate="page_num" data-layout="default">
<div class="posts-wrap posts-layout-medium">

<form method="post" name="myform" id="myform">
<div class="date-badge">
<a title="Ticket Date">
<span class="date" style="font-size:16px;color:#FFFFFF;background-color:#57bb8a">Update Profile</span>
</a></div>
<div class="empty-space-30"></div>
<table class="table table-striped">

<tr>
<td><i class="elegant_icon_profile"></i> <strong>Name :</strong> </td>
<td><input type="text" name="txtname" id="txtname" value="<?php echo $r['user_name']; ?>"></td>
</tr>

<tr>
<td><i class="elegant_icon_mail"></i> <strong>Email :</strong> </td>
<td><input type="text" name="txtemail" id="txtemail" value="<?php echo $r['email']; ?>"></td>
</tr>

<tr align="center">
<td><button class="btn btn-success btn-block btn-sm btn-style-square btn-effect-border-outline-outward" id="btnup" name="btnup" type="submit">Modify..!!</button></td>
</tr>

</table>
</form>
<?php 
if(isset($_REQUEST['btnup']))
		{
			$sql=mysql_query("update tbl_user set user_name='".$_REQUEST['txtname']."',email='".$_REQUEST['txtemail']."' where user_id='". $_SESSION['uid'] ."'");
			if($sql)
			{
				echo "<script>window.location = 'profile.php'; </script>";
			}
			else
			{
				echo"<Script>alert('login.php');</script>";
			}
		}
?>
</div>

</div>
</div>

</div>
</div>
</div>

</div>
</div>
</div>

<?php } ?>
<?php include'footer.php'; ?>
</div>
<div class="sitesao-preview__loading">
<div class="sitesao-preview__loading__animation"><i></i><i></i><i></i><i></i></div>
</div>
<script type='text/javascript' src='js/jquery.js'></script>

<script>
jQuery(document).ready(function() {
jQuery('#formm').hide();
	jQuery("#updatebtn").click(function(){
			jQuery('#formm').show();
	});
		jQuery("#btnup").click(function(){
			jQuery('#formm').hide();
	});

});
</script>

<script type='text/javascript' src='js/jquery-migrate.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.tools.min.js'></script>
<script type='text/javascript' src='js/jquery.themepunch.revolution.min.js'></script>
<script type='text/javascript' src='js/preloader.min.js'></script>
<script type='text/javascript' src='js/easing.min.js'></script>
<script type='text/javascript' src='js/imagesloaded.pkgd.min.js'></script>
<script type='text/javascript' src='js/bootstrap.min.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkmy').addClass('active');
	});
</script>


<script>
jQuery(document).ready(function(){
jQuery('#tbldata').css('textTransform', 'capitalize');
});
</script>

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

<!-- Mirrored from sitesao.com/html/airslice/blog-masonry.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:19:20 GMT -->
</html>