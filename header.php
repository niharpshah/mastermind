<header class="header-container header-type-default header-navbar-default">
<div class="topbar">
<div class="container">
<div class="row">
<div class="col-md-7 col-sm-6">
<div class="left-topbar">
<div class="topbar-info">
<!--<a><i class="elegant_icon_mobile"></i>&nbsp;+91-93282-78971</a>-->
<a><i class="elegant_icon_mail"></i>&nbsp;info@mastersmindtech.com</a>
<a href="www.facebook.com" title="Facebook" target="_blank"><i class="fa fa-facebook facebook-outlined"></i></a>
<a href="www.twitter.com" title="Twitter" target="_blank"><i class="fa fa-twitter twitter-outlined"></i></a>
<a href="www." title="Goole Plus" target="_blank"><i class="fa fa-google-plus google-plus-outlined"></i></a>
</div>
</div>
</div>

<div class="col-md-5 col-sm-6">
<div class="right-topbar">
<div class="topbar-icon-button">
<?php
if(isset($_SESSION['uid']))
{
?>
<div class="navbar-minicart">
<a class="minicart-link" href="#">
<span class="minicart-icon">
<i class="elegant_icon_bag"></i>
<span>
<?php
if(isset($_SESSION['uid']))
{
$res=mysql_query("select * from tbl_cart where user_id='".$_SESSION['uid']."'");
echo mysql_num_rows($res);
}
else
{
	echo 0;
}
?>
</span>
</span>
</a>
<div class="minicart">
<div class="minicart-header">
<?php
if(isset($_SESSION['uid']))
{
	$res=mysql_query("select * from tbl_cart where user_id='".$_SESSION['uid']."'");
	if(mysql_num_rows($res)> 0)
	{
		echo mysql_num_rows($res) . " items in the shopping cart.";
	}
	else
	{
		echo "0 items in the shopping cart.";
	}
}
?>
</div>
<?php
		$subtotal=0;
		$qry="select *,(select product_name from tbl_products where product_id=tbl_cart.product_id) as pname,(select price from tbl_products where product_id=tbl_cart.product_id) as pprice,(select prod_img1 from tbl_products where product_id=tbl_cart.product_id) as pimg from tbl_cart where user_id='".$_SESSION['uid']."'";
	$rs = mysql_query($qry);
		while($r=mysql_fetch_array($rs))
		{
?>
<div class="minicart-body">
<div class="cart-product clearfix">
<div class="cart-product-image">
<a class="cart-product-img" href="#">
<img width="200" height="200" src="<?php echo "../admin/images/product/small/" . $r["pimg"] ?>" alt="p1"/>
</a>
</div>
<div class="cart-product-details">
<div class="cart-product-title">
<a href="#"><?php echo $r['pname']; ?></a>
</div>
<div class="cart-product-quantity-price"><?php echo $r['qty']; ?> x 
<span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo $r['pprice'] ?></span>
</div>
</div>
<a href="#" class="remove">&times;</a>
</div>

</div>
<?php 
	$t = $r['pprice'] * $r['qty'];
	$subtotal+=$t;
	
?>

<?php
}
?>

<div class="minicart-footer">
<div class="minicart-total">
Cart Subtotal : <span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo $subtotal; ?></span>
</div>
<div class="minicart-actions clearfix">
<a class="button" href="cart.php"><span class="text">View Cart</span></a>
</div>
</div>
</div>
</div>
<?php } ?>
<!--UID-->
<?php
if(isset($_SESSION['eid']))
{
?>
<div class="navbar-minicart">
<a class="minicart-link" href="tickets.php">
<span class="minicart-icon">
<i class="fa fa-ticket"></i>
<span>
<?php
if(isset($_SESSION['eid']))
{
$res=mysql_query("select * from tbl_ticket where status != 'completed' and status != 'switch' and emp_id='".$_SESSION['eid']."'");
echo mysql_num_rows($res);
}
else
{
	echo 0;
}
?>
</span>
</span>
</a>
<?php /*?><div class="minicart">
<div class="minicart-header">
<?php
if(isset($_SESSION['uid']))
{
	$res=mysql_query("select * from tbl_cart where user_id='".$_SESSION['uid']."'");
	if(mysql_num_rows($res)> 0)
	{
		echo mysql_num_rows($res) . " items in the shopping cart.";
	}
	else
	{
		echo "0 items in the shopping cart.";
	}
}
?>
</div>
</div><?php */?>
</div>
<?php } ?>

</div>
</div>
</div>
</div>
</div>
</div>
<div class="navbar-container">
<div class="navbar navbar-default navbar-scroll-fixed">
<div class="navbar-default-wrap">
<div class="container">
<div class="navbar-wrap">
<div class="navbar-header">
<button data-target=".primary-navbar-collapse" data-toggle="collapse" type="button" class="navbar-toggle">
<span class="sr-only">Toggle navigation</span>
<span class="icon-bar bar-top"></span>
<span class="icon-bar bar-middle"></span>
<span class="icon-bar bar-bottom"></span>
</button>
<a class="navbar-brand" title="AirSlice" href="index.php">
<img class="logo" alt="AirSlice" src="images/logo.png"/>
<img class="logo-fixed" alt="AirSlice" src="images/logo.png"/>
<img class="logo-mobile" alt="AirSlice" src="images/logo.png"/>
</a>
</div>
<nav class="collapse navbar-collapse primary-navbar-collapse">
<ul class="nav navbar-nav primary-nav">
<li class="menu-item-has-children megamenu dropdown" id="lnkHome">
<a title="Home" href="index.php" class="dropdown-hover">
<i class="navicon elegant_icon_house_alt"></i>
<span class="underline">Home</span> 
</a>
</li>

<?php
if(!isset($_SESSION['eid']))
{
?>
<li class="menu-item-has-children dropdown" id="lnkShop">
<a title="Shop" href="shop.php" class="dropdown-hover">
<i class="navicon elegant_icon_cart_alt"></i>
<span class="underline">Shop</span>
</a>

<?php /*?><ul class="dropdown-menu">
<?php
//$converter = new Encryption;

$sql = mysql_query("select *,(select cat_id from tbl_category where cat_id=tbl_subcategory.cat_id) as cate,(select cat_name from tbl_category where cat_id=tbl_subcategory.cat_id) as cat from tbl_subcategory");
while($row = mysql_fetch_array($sql))
{
?>
<li class="menu-item-has-children dropdown-submenu">
<a href="#" class="sf-with-ul"><?php echo $row['cat']; ?> <span class="caret"></span>
</a>
<ul class="dropdown-menu" style="display: none;">
<li><a href="shop.php?scatid=<?php echo $converter->encode($row['subcat_id']); ?>"><?php echo $row['subcat_name']; ?></a></li>
</ul>
</li>
<?php } ?>
</ul><?php */?>

</li>
<?php } ?>

<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown" id="lnkAbout">
<a title="About Us" href="about.php" class="dropdown-hover">
<i class="navicon elegant_icon_info_alt"></i>
<span class="underline">About Us</span>
</a>
</li>



<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown" id="lnkcon">
<a title="Contact Us" href="contact.php" class="dropdown-hover">
<i class="navicon elegant_icon_mobile"></i>
<span class="underline">Contact US</span>
</a>
</li>


<?php
if(isset($_SESSION['eid']))
{
?>

<li class="menu-item-has-children dropdown" id="lnkemy">
<a title="My Account" href="" class="dropdown-hover">
<i class="navicon elegant_icon_profile"></i>
<span class="underline">My Account</span> <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="empprofile.php"><i class="elegant_icon_profile"></i> <?php echo ucwords($_SESSION['name']); ?></a></li>
<li><a href="tickets.php" class="dropdown-hover"><i class="navicon fa fa-ticket"></i>Tickets</a></li>
<li><a href="empchangepassword.php"><i class="elegant_icon_lock"></i> Change Password</a></li>
<li><a href="pending.php"><i class="elegant_icon_target"></i> Pending Tickets</a></li>
<li><a href="switch.php"><i class="elegant_arrow_up-down_alt"></i> Switch Tickets</a></li>
<li><a href="complete.php"><i class="elegant_icon_check_alt2"></i> 	Completed Tickets</a></li>
<li><a href="emplogout.php"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>

</li>
<?php
}
?>
<!--USER-->

<?php
if(isset($_SESSION['uid']))
{
?>

<li class="menu-item-has-children dropdown" id="lnkmy">
<a title="My Account" href="" class="dropdown-hover">
<i class="navicon elegant_icon_profile"></i>
<span class="underline">My Account</span> <span class="caret"></span>
</a>
<ul class="dropdown-menu">
<li><a href="profile.php"><i class="elegant_icon_profile"></i> <?php echo ucwords($_SESSION['name']); ?></a></li>
<li><a href="myorder.php"><i class="elegant_icon_book_alt"></i> My Orders</a></li>
<li><a href="changepassword.php"><i class="elegant_icon_lock"></i> Change Password</a></li>
<li><a href="userticket.php"><i class="elegant_icon_check_alt2"></i> Complains</a></li>
<li><a href="ticketentry.php"><i class="elegant_icon_clipboard"></i> Problem Register</a></li>
<li><a href="logout.php"><i class="fa fa-power-off"></i> Logout</a></li>
</ul>

</li>
<?php
}
?>



<?php
if(!isset($_SESSION['uid']))
{
?>
<?php
if(!isset($_SESSION['eid']))
{
?>

<li class="menu-item-has-children megamenu megamenu-fullwidth dropdown" id="lnklog">
<a title="Login" href="login.php" class="dropdown-hover">
<i class="navicon elegant_icon_lock_alt"></i>
<span class="underline">Login</span> <span class="caret"></span>
</a>
</li>
<?php
}
}
?>

</ul>
</nav>

</div>
</div>
</div>
</div>
</div>

</header>





<?php /*?><li>
<?php
if(isset($_SESSION['uid']))
{
?>
<div class="navbar-minicart">
<a class="minicart-link" href="cart.php">
<span class="minicart-icon">
<i class="elegant_icon_bag"></i>
<span><?php
if(isset($_SESSION['uid']))
{
$res=mysql_query("select * from tbl_cart where user_id='".$_SESSION['uid']."'");
echo mysql_num_rows($res);
}
else
{
	echo 0;
}
?></span>
</span>
</a>

<div class="minicart">
<div class="minicart-header">
<?php
if(isset($_SESSION['uid']))
{
	$res=mysql_query("select * from tbl_cart where user_id='".$_SESSION['uid']."'");
	if(mysql_num_rows($res)> 0)
	{
		echo mysql_num_rows($res) . " items in the shopping cart.";
	}
	else
	{
		echo "0 items in the shopping cart.";
	}
}
?>
</div>
<?php
		$subtotal=0;
		$qry="select *,(select product_name from tbl_products where product_id=tbl_cart.product_id) as pname,(select price from tbl_products where product_id=tbl_cart.product_id) as pprice,(select prod_img1 from tbl_products where product_id=tbl_cart.product_id) as pimg from tbl_cart where user_id='".$_SESSION['uid']."'";
	$rs = mysql_query($qry);
		while($r=mysql_fetch_array($rs))
		{
?>

<div class="minicart-body">
<div class="cart-product clearfix">
<div class="cart-product-image">
<a class="cart-product-img" href="#">
<img width="200" height="200" src="<?php echo "../admin/images/product/small/" . $r["pimg"] ?>" alt="p1"/>
</a>
</div>
<div class="cart-product-details">
<div class="cart-product-title">
<a href="#"><?php echo $r["pname"] ?></a>
</div>
<div class="cart-product-quantity-price"><?php echo $r['qty']; ?> x
<span class="amount"><i class="fa fa-inr"></i><?php echo $r['pprice']; ?></span>
</div>
</div>
<a href="#" class="remove">&times;</a>
</div>
</div>

<?php 
	$t = $r['pprice'] * $r['qty'];
	$subtotal+=$t;
?>
<?php } ?>

<div class="minicart-footer">
<div class="minicart-total">
Cart Subtotal <span class="amount"><i class="fa fa-inr"></i><?php echo $subtotal; ?></span>
</div>
<div class="minicart-actions clearfix">
<a class="button" href="cart.php"><span class="text">View Cart</span></a>
</div>
</div>

</div>
</div>
<?php
}
?>
</li><?php */?>

