<?php 
include 'connection.php';
include('encrypt.php'); 
if(!isset($_SESSION['eid']))
{
	echo "<script>window.location='index.php';</script>";
}
if(isset($_REQUEST["sid"]))
{
	$converter = new Encryption;		
	$sid = $converter->decode($_REQUEST["sid"]);
	$sql=mysql_query
	("select *,(select user_name from tbl_user where user_id=tbl_ticket.user_id) as uname,(select product_name from tbl_products where product_id=tbl_ticket.product_id) as pname,(select prod_img1 from tbl_products where product_id=tbl_ticket.product_id) as pimg from tbl_ticket where ticket_id='".$sid."'");
	if(mysql_num_rows($sql)<=0)
	{
		echo "<script>window.location='error.php';</script>";
	}  
}
?>
<?php
	if(isset($_REQUEST['btnsubmit']))
	{
	       if($_REQUEST['status']=='switch')
		   {
		   		$status="switch";
		   		$qry="update tbl_ticket set status='$status',remark='" . mysql_real_escape_string($_REQUEST["txtremark"]) . "' where ticket_id='".$sid."'";
				$rs=mysql_query($qry);
				if($rs)
				{
					echo "<script>window.location='tickets.php';</script>";
				}
		   } 
		   else 
		   {
				$status="completed";
				$qry="update tbl_ticket set status='$status',remark='" . mysql_real_escape_string($_REQUEST["txtremark"]) . "',complete_date=NOW() where ticket_id='".$sid."'";
				$rs=mysql_query($qry);
				if($rs)
				{
					echo "<script>window.location='tickets.php';</script>";
				}
		   } 
	}
?>

<?php
if(isset($_REQUEST['btnsubmit']))
{
	if($_REQUEST['status']=='switch')
	{
		$qry="insert into tbl_switch values (NULL,'" .$_SESSION["eid"] . "','" . $sid . "','" . $_REQUEST["txtremark"] . "','No',NOW())";
		$rs=mysql_query($qry);
	//	if($rs)
	//	{
	//		echo "<script>alert('Ok');<script>";
	//	}
	//	else
	//	{
	//		echo "<script>alert('Sorry');<script>";
	//	}
	}
}
?>
<!doctype html>
<html lang="en-US">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Status</title>
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
<div class="morphsearch" id="morphsearch">
<form>
<input type="search" name="s" placeholder="Search..." class="morphsearch-input">
<button type="submit" class="morphsearch-submit"></button>
</form>
<span class="morphsearch-close"></span>
</div>
<?php include'header.php'; ?>
<div class="heading-container">
<div class="container heading-standar">
<div class="heading-wrap">
<div class="page-breadcrumb clearfix">
<div class="pull-left">
<ul class="breadcrumb">
<li>
<a href="#" class="home"><span>Home</span></a>
</li>
<li><span>Status</span></li>
</ul>
</div>

</div>
<div class="page-title">
<h1>Status</h1>
</div>
</div>
</div>
</div>
<?php 
	$qry="select *,(select subcat_name from tbl_subcategory where subcat_id=(select subcat_id from tbl_products where product_id = tbl_ticket.product_id)) as sat,(select user_name from tbl_user where user_id=tbl_ticket.user_id) as uname,(select product_name from tbl_products where product_id=tbl_ticket.product_id) as pname,(select prod_img1 from tbl_products where product_id=tbl_ticket.product_id) as pimg from tbl_ticket where ticket_id='".$sid."'";
	$rs = mysql_query($qry);
	while($r = mysql_fetch_array($rs))
	{ 
?>
<div class="content-container">
<div class="container">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="row">
<div class="column col-md-12">
<div class="posts" data-paginate="page_num" data-layout="default">
<div class="posts-wrap posts-layout-medium">
<article class="hentry">
<div class="hentry-wrap">
<div class="entry-featured image-featured">
<a title="Product Image">
<img width="700" height="350" src="<?php echo "admin/images/Product/" . $r["pimg"]; ?>" alt=""/>
</a>
</div>
<div class="entry-info">
<div class="entry-header">
<div class="date-badge">
<a title="Ticket Date">
<span class="date" style="font-size:16px;color:#FFFFFF;background-color:#57bb8a"><?php echo $r["ticket_date"] ?></span>
</a>
<!--<span class="meta-date">
<time datetime="2014-10-28T03:56:37+00:00">
<i class="fa fa-clock-o"></i>October 28, 2014
</time>
</span>
-->
</div>
<h2 class="entry-title">
<a title="Product Name">
<?php echo $r["pname"]; ?>
</a>
</h2>
<div class="entry-meta">
<span class="meta-category">
<i class="fa fa-folder-open-o"></i>
<a><strong><?php echo $r['sat']; ?></strong></a>
</span>
</div>
</div>
<div class="entry-content">
<p class="col-md-3">
<strong>Status : </strong><?php echo $r["status"]; ?><br>
<br>
<strong>Problem : </strong><?php echo $r["problem"]; ?><br>
<br>
<strong>Assign Date : </strong><?php echo $r["assign_date"]; ?><br>
<br>
<strong>Prefer Date : </strong><?php echo $r["prefer_date"] ?><br>
<br>
<strong>Prefer Time : </strong><?php echo $r["prefer_time"] ?>
</p>
<p class="col-md-2">
<strong>User Name : </strong><?php echo $r['uname']; ?><br>
<br>
<strong>Address : </strong><?php echo $r["address"] ?><br>
<br>
<strong>LandMark : </strong><?php echo $r["landmark"] ?><br>
<br>
<strong>Pincode : </strong><?php echo $r["pincode"] ?><br>
<br>
<strong>Contact : </strong><?php echo $r["contact"] ?>
</p>
<form id="myform" name="myform" method="post">
<p class="col-md-3" style="padding-top:0px">
<select class="form-control" name="status">
<option value="">Select Status</option>
<option value="switch">Switch</option>
<option value="completed">Completed</option>
</select>
<br>
<textarea id="txtremark" name="txtremark" placeholder="Reason To Switch" class="form-control textarea"></textarea>
<br>
<button class="btn btn-primary btn-align-left" type="submit" name="btnsubmit" id="btnsubmit">
<span>Proceed To Request</span>
</button>
</p>
</form>
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

<!-- Mirrored from sitesao.com/html/airslice/blog-masonry.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:19:20 GMT -->
</html>