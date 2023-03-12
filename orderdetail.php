<?php
 include('connection.php');
 include('encrypt.php');
 if(!isset($_SESSION['uid']))
 {
 	echo "<script>window.location='index.php';</script>";
 }
if(isset($_REQUEST["oid"]))
{
	$converter = new Encryption;
	$sc = $converter->decode($_REQUEST["oid"]);
	$sql=mysql_query
	("select *,(select product_name from tbl_products where product_id=tbl_order_detail.product_id) as pname,(select prod_img1 from tbl_products where product_id=tbl_order_detail.product_id) as pimg,(select price from tbl_products where product_id=tbl_order_detail.product_id) as pprice from tbl_order_detail where order_id='". $sc ."'");
	if(mysql_num_rows($sql)<=0)
	{
		echo "<script>window.location='login.php';</script>";
	}  
}
?>
 
<!doctype html>
<html lang="en-US">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Order Details</title>
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
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
<?php include('header.php'); ?>
<div class="heading-container ">
<div class="container heading-standar">
<div class="heading-wrap">

<div class="page-title">
<h1 align="center">Order Details</h1>
</div>
</div>
</div>
</div>
<div class="content-container">
<div class="container">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="shop">
<table class="table table-bordered shop_table cart">
<thead>
<tr>
<th class="product-name text-center" style="text-align:center;">Sr No.</th>
<th class="product-name text-center" style="text-align:center;">Product Image</th>
<th class="product-name text-center" style="text-align:center;">Product</th>
<th class="product-price text-center" style="text-align:center;">Price</th>
<th class="product-quantity text-center" style="text-align:center;">Quantity</th>
</tr>
</thead>
<tbody>

<tr class="cart_item">
<?php
$converter = new Encryption;
$count=1;
	$qry="select *,(select product_name from tbl_products where product_id=tbl_order_detail.product_id) as pname,(select prod_img1 from tbl_products where product_id=tbl_order_detail.product_id) as pimg,(select price from tbl_products where product_id=tbl_order_detail.product_id) as pprice from tbl_order_detail where order_id='". $sc ."'";
	$rs = mysql_query($qry);
	while($row = mysql_fetch_array($rs))
	{
?>
<td class="product-name text-center"><?php echo $count; ?></td>
<td class="product-thumbnail text-center"><img src="<?php echo "admin/images/product/small/" .$row['pimg']; ?>"  style="height:60px; width:60px;"></td>
<td class="product-name text-center"><?php echo $row['pname']; ?></td>
<td class="product-price text-center" id="txtprice"><i class="fa fa-inr"></i><?php echo $row['pprice']; ?></td>
<td class="product-quantity text-center"><?php echo $row['qty']; ?></td>

</tr>
<?php 
$count++;
}
?>
</tbody>
</table>

</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
</div>
<a href="#" class="go-to-top"><i class="fa fa-angle-up"></i></a>
	

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

<!-- Mirrored from sitesao.com/html/airslice/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:23:23 GMT -->
</html>