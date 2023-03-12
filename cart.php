<?php
 include('connection.php'); 
 if(!isset($_SESSION['uid']))
 {
 	echo "<script>window.location='index.php';</script>";
 }
 
 ?>
 
<?php
 if(isset($_REQUEST['del']))
 {
	 $sql=mysql_query("delete from tbl_cart where cart_id='".$_REQUEST['del']."'");
			if($sql)
			{
				echo "<script>window.location='cart.php';</script>";
			}
	}		
?>

<?php
 if(isset($_REQUEST['upd']))
 {
 		
	 		$sql=mysql_query("update tbl_cart set qty='".$_REQUEST['txtqty']."' where cart_id='".$_REQUEST['cid']."'");
			if($sql)
			{
				echo "<script>window.location='cart.php';</script>";
			}
		
	}		
?>
<!doctype html>
<html lang="en-US">

<!-- Mirrored from sitesao.com/html/airslice/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:23:23 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Cart | Mega Mind Technologies</title>
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
<h1 align="center">Shopping Cart</h1>
</div>
</div>
</div>
</div>
<div class="content-container">
<div class="container" style="overflow-x:scroll;">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="shop">
<table class="table table-bordered shop_table cart">
<thead>
<tr>
<th class="product-remove" style="text-align:center;">Remove</th>
<th class="product-name" style="text-align:center;">Product Image</th>
<th class="product-name" style="text-align:center;">Product</th>
<th class="product-price text-center" style="text-align:center;">Price</th>
<th class="product-quantity text-center" style="text-align:center;">Quantity</th>
<th class="product-subtotal text-center" style="text-align:center;">Total</th>
</tr>
</thead>
<tbody>

<tr class="cart_item">
<?php
$total = 0;
$count = 1;
$cgst = 0;
$sgst = 0;
$final = 0;
$t = 0;

	$qry="select *,(select user_name from tbl_user where user_id=tbl_cart.user_id) as uname,(select product_name from tbl_products where product_id=tbl_cart.product_id) as pname,(select price from tbl_products where product_id=tbl_cart.product_id) as pprice,(select prod_img1 from tbl_products where product_id=tbl_cart.product_id) as pimg from tbl_cart where user_id='".$_SESSION['uid']."'";
	$rs = mysql_query($qry);
	if(mysql_num_rows($rs)==0)
	{
	?>	
		<td colspan="6" align="center">Your Cart Is Empty. &nbsp;<a href="shop.php"><button class="button">Continue Shopping</button></a></td>
	<?php
	}
	else
	{
	
	while($row = mysql_fetch_array($rs))
	{
	?>

<td class="product-remove"><a href="?del=<?php echo $row['cart_id']; ?>" class="remove">&times;</a></td>
<td class="product-thumbnail"><img src="<?php echo "admin/images/product/small/" .$row['pimg']; ?>"  style="height:60px; width:60px;"></td>
<td class="product-name"><?php echo $row['pname']; ?></td>
<td class="product-price text-center" id="txtprice"><i class="fa fa-inr"></i><?php echo $row['pprice']; ?></td>
<td class="product-quantity text-center">
<div class="quantity">
<form method="post"> 
<input type="hidden" name="cid" id="cid" value=<?php echo $row['cart_id']; ?>"" class="button"	>
<input type="number" value="<?php echo $row['qty']; ?>"  min="1" id="txtqty" name="txtqty" title="Qty" class="input-text qty text" size="4"/>&nbsp;

<input type="submit" name="upd" id="upd" value="Add" class="button">
</form>
</div>
</td>
<?php
	$t = $row['pprice'] * $row['qty'];
?>

<td class="product-subtotal text-center" id="ptotal">
<span class="amount"><i class="fa fa-inr"></i><?php echo $t; ?></span></td>
</tr>
<?php 
$count++;
$total = $total + $t;
$cgst = $total * 9 / 100;
$sgst = $total * 9 / 100;
$final = $total + $cgst +$sgst;
}
}
?>
<?php
if($t != 0)
{
?>
<tr>
<td colspan="6" class="actions">
<div class="coupon">
<label>Coupon:</label>
<input type="text" name="coupon_code" class="input-text" placeholder="Coupon code"/>
<input type="submit" class="button" name="apply_coupon" value="Apply Coupon"/>
</div>
</td>
</tr>
<?php } ?>
</tbody>
</table>
<?php
if($t != 0)
{
?>
<div class="cart-collaterals">
<div class="cart_totals ">
<form method="post" name="myform" enctype="multipart/form-data">
<h2>Cart Totals</h2>
<table>
<tr class="cart-subtotal">
<th>Subtotal</th>
<td>
<span class="amount"><i class="fa fa-inr"></i> <?php echo $total; ?> </span>
</td>
</tr>
<tr class="shipping">
<th>CGST 9%</th>
<td><strong><i class="fa fa-inr"></i> <?php echo $cgst; ?></strong> <br/></td>
</tr>
<tr class="shipping">
<th>SGST 9%</th>
<td><strong><i class="fa fa-inr"></i> <?php echo $sgst; ?></strong> <br/></td>
</tr>
<tr class="shipping">
<th>Shipping</th>
<td><strong>Free Shipping</strong> <br/></td>
</tr>
<tr class="order-total">
<th>Total</th>
<td><strong><span class="amount"><i class="fa fa-inr"></i> <?php echo $final; ?> </span></strong></td>
</tr>
</table>
<div class="checkout-actions">
<a href="order.php" class="checkout-button button wc-forward">Proceed To Order</a>
</div>
</form>
</div>
</div>
<?php 
$_SESSION['finaltotal']=$final;
} ?>
</div>
</div>
</div>
</div>
</div>
</div>

<?php include('footer.php'); ?>
</div>
<a href="#" class="go-to-top"><i class="fa fa-angle-up"></i></a>
	
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

<!-- Mirrored from sitesao.com/html/airslice/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:23:23 GMT -->
</html>