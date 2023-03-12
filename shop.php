<?php
include 'connection.php';
include 'encrypt.php';
include 'function.php';
if (isset($_REQUEST["subcatid"])) {
    $converter = new Encryption;
    $ss = $converter->decode($_REQUEST["subcatid"]);
    $sql = mysqli_query
        ($cn, "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where subcat_id='" . $ss . "'");
    if (mysqli_num_rows($sql) <= 0) {
        echo "<script>window.location='login.php';</script>";
    }
}

if (isset($_REQUEST["scatid"])) {
    $converter = new Encryption;
    $suub = $converter->decode($_REQUEST["scatid"]);
    $sql = mysqli_query
        ($cn, "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where subcat_id='" . $suub . "'");
    if (mysqli_num_rows($sql) <= 0) {
        echo "<script>window.location='login.php';<script>";
    }
}

if (isset($_GET["page"])) {
    $page = (int) $_GET["page"];
} else {
    $page = 1;
}

$setLimit = 9;
$pageLimit = ($page * $setLimit) - $setLimit;
?>

<!doctype html>
<html lang="en-US">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>SHOP</title>
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/preloader.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/skin-selector.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/pagging.css' type='text/css' media='all'/>
     <script type='text/javascript' src='js/jquery.js'></script>
    <script type="text/javascript" src="rating_1_0/rating.js"></script>
    <link rel="stylesheet" type="text/css" href="rating_1_0/rating.css" />
    <script type="text/javascript">
	$ = jQuery.noConflict();
	$(document).ready(function(){
        $(function ()
        {
            $('.rating').rating();

            $('.ratingEvent').rating({ rateEnd: function (v) { $('#result').text(v); } });
        });
	});
    </script>



<!--[if lt IE 9]>
            <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
            <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
        <![endif]-->
</head>
<body data-spy="scroll">
<!-- <div id="preloader">
<img class="preloader__logo" src="images/logo.png" alt=""/>
<div class="preloader__progress">
<svg width="60px" height="60px" viewBox="0 0 80 80" xmlns="http://www.w3.org/2000/svg">
<path class="preloader__progress-circlebg" fill="none" stroke="#dddddd" stroke-width="4" stroke-linecap="round" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
<path id='preloader__progress-circle' fill="none" stroke="#57bb8a" stroke-width="4" stroke-linecap="round" stroke-dashoffset="192.61" stroke-dasharray="192.61 192.61" d="M40,10C57.351,10,71,23.649,71,40.5S57.351,71,40.5,71 S10,57.351,10,40.5S23.649,10,40.5,10z"/>
</svg>
</div>
</div> -->
<div id="wrapper" class="wide-wrap">

<!--Header START-->
<?php include 'header.php';?>
<!--HEADER ENDS-->
<div class="heading-container heading-resize">
<div class="heading-background heading-parallax bg-3">
<div class="container">
<div class="row heading-wrap">
<div class="col-md-12 page-title parallax-content">
<h1>Great daily deals</h1>
<span class="subtitle">Shop Now!</span>
</div>
</div>
</div>
</div>
</div>
<div class="content-container shop">
<div class="container">
<div class="row">
<div class="col-md-9 main-wrap">
<div class="main-content">
<div class="columns-3">
<div class="shop-toolbar">
<p class="shop-result-count">Showing <?php echo $page; ?>&ndash;<?php echo $pageLimit; ?> of <?php $qry = mysqli_query($cn, "select * from tbl_products");
echo mysqli_num_rows($qry);?> results</p>
<form class="shop-ordering" method="get">
<div class="shop-ordering-select">
<select name="orderby" class="orderby" onChange="jsFunction(this.value)">
<option value="" selected='selected'>Default Sorting</option>
<option value="AZ">Sort by A-Z</option>
<option value="ZA">Sort by Z-A</option>
<option value="ASC">Sort by Price: low to high</option>
<option value="DESC">Sort by Price: high to low</option>
</select>
<i></i>
</div>

</form>
<script>
function jsFunction(value)
{
 //   alert(value);
 if (value === "ASC" || value === "DESC")
 {
 window.location='shop.php?as='+value;
 }
 else
 {
 	window.location='shop.php?az='+value;
 }
}
</script>
</div>
<ul class="products">
<php
$converter = new Encryption;
if (isset($_REQUEST['subcatid'])) {
    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where subcat_id='" . $ss . "'";
} else if (isset($_REQUEST["scatid"])) {
    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where subcat_id='" . $suub . "'";
} else if (isset($_REQUEST['btnfilter'])) {
    $min = $_REQUEST['txtminprice'];
    $max = $_REQUEST['txtmaxprice'];
    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where price BETWEEN '" . $min . "' AND '" . $max . "'";
} else if (isset($_REQUEST['as'])) {
    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products ORDER BY price " . $_REQUEST['as'];
} else if (isset($_REQUEST['az'])) {
    if ($_REQUEST['az'] == 'AZ') {
        $order = "ASC";
    } else {
        $order = "DESC";
    }
    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products ORDER BY product_name " . $order;
} else {

    $qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where status = 1 LIMIT " . $pageLimit . " , " . $setLimit;
}
$rs = mysqli_query($cn, $qry);
while ($row = mysqli_fetch_array($rs)) {
    ?>
<li class="product">
<div class="product-container">
<figure>
<div class="product-wrap">
<div class="product-images">
<span class="onsale">Sale!</span>
<div class="shop-loop-thumbnail shop-loop-front-thumbnail" style="height:250px;">
<img style="height:250px;" src="<?php echo "admin/images/product/" . $row['prod_img1']; ?>" alt="11"/>
</div>
<div class="shop-loop-thumbnail shop-loop-back-thumbnail" style="height:250px;">
<img style="height:250px;" src="<?php echo "admin/images/product/" . $row['prod_img2']; ?>" alt="12"/>
</div>
<div class="yith-wcwl-add-to-wishlist">
<a href="#" class="add_to_wishlist">Add to Wishlist</a>
</div>
<div class="clear"></div>
</div>
<form method="post">
<input type="hidden" id="pid" name="pid" value="<?php echo $row['product_id'] ?>">
</form>
<div class="shop-loop-actions">
<a class="shop-loop-quickview" title="Quick shop" href="product.php?sid=<?php echo $converter->encode($row['product_id']); ?>&subcid=<?php echo $converter->encode($row['subcat_id']); ?>"></a>
</div>
</div>
<figcaption>
<div class="shop-loop-product-info">
<div class="info-title">
<div class="product-category">
<a href="#" rel="tag"><?php echo $row['catname']; ?></a>, <a href="#" rel="tag"><?php echo $row['subname']; ?></a>
</div>
<h3 class="product_title">
<a href="product.php?sid=<?php echo $converter->encode($row['product_id']); ?>&subcid=<?php echo $converter->encode($row['subcat_id']); ?>"><?php echo $row['product_name'] ?></a>
</h3>
</div>
<div class="info-meta">
<div class="info-price">
<span class="price">
<ins>
<span class="amount"><i class="fa fa-inr"></i> <?php echo $row['price'] ?></span>
</ins>
</span>
</div>
<div class="info-rating">
<div>
<input name="txtrating" id="txtrating" class="ratingEvent rating5" readonly="" value="<?php $a = mysqli_query($cn, "select max(ratings) as rat from tbl_rating where product_id = '" . $row["product_id"] . "'");while ($r = mysqli_fetch_array($a)) {echo $r['rat'];}?>"/>
</div>

</div>
</div>
</div>
</figcaption>
</figure>

</div>
</li>
<!-- <php
}
?> -->
</ul>
<?php
if (!isset($_REQUEST['btnfilter']) && !isset($_REQUEST['as']) && !isset($_REQUEST['az'])) {
    ?>
<span class="page-numbers current"><?php echo displayPaginationBelow($setLimit, $page); ?></span>
<?php }?>
</a>

</div>
</div>
</div>
<aside class="col-md-3 sidebar-wrap">
<div class="main-sidebar">
<div class="widget shop widget_price_filter">
<h4 class="widget-title"><span>Filter by price</span></h4>
<form method="post" enctype="multipart/form-data">
<div class="price_slider_wrapper">
<div class="price_slider"></div>
<div class="price_slider_amount">
<input type="text" id="min_price" name="txtminprice" value="" data-min="<?php $a = mysqli_query($cn, "select min(price) as abgprice from tbl_products");
while ($r = mysqli_fetch_array($a)) {
    echo $r['abgprice'];
}
?>" placeholder="Min price"/>
<input type="text" id="max_price" name="txtmaxprice" value="" data-max="<?php $a = mysqli_query($cn, "select max(price) as abgprice from tbl_products");while ($r = mysqli_fetch_array($a)) {echo $r['abgprice'];}?>" placeholder="Max price"/>
<button type="submit" name="btnfilter" id="btnfilter" class="button">Filter</button>
<div class="price_label">
Price: <span class="from"></span> &mdash; <span class="to"></span>
</div>
<div class="clear"></div>
</div>
</div>
</form>
</div>

<div class="widget shop widget_product_categories">
<h4 class="widget-title"><span>Categories</span></h4>
<?php
$qry = "select * from  tbl_subcategory";
$rs = mysqli_query($cn, $qry);
while ($row = mysqli_fetch_array($rs)) {
    $sub = $row['subcat_id'];
    ?>
<ul class="product-categories">
<li><a href="shop.php?subcatid=<?php echo $converter->encode($sub); ?>"><?php echo $row['subcat_name']; ?></a> <span class="count"><strong>(<?php $res = mysqli_query($cn, "select * from tbl_products where subcat_id = '" . $sub . "'");
    echo mysqli_num_rows($res);?>)</strong></span></li>
<!--<li><a href="#">Dresses</a> <span class="count">(4)</span></li>
<li><a href="#">Innerwear</a> <span class="count">(5)</span></li>
<li><a href="#">Shirts</a> <span class="count">(6)</span></li>
<li><a href="#">Tees &amp; Polos</a> <span class="count">(6)</span></li>
<li><a href="#">Tops &amp; Tunics</a> <span class="count">(12)</span></li>
<li><a href="#">Winter Wear</a> <span class="count">(2)</span></li>-->
</ul>
<?php }?>
</div>
<div class="widget shop widget_top_rated_products">
<h4 class="widget-title"><span>Top Rated</span></h4>
<ul class="product_list_widget">
<li>
<a href="#">
<img width="200" height="200" src="images/product/product1_front.jpg" alt=""/>
<span class="product-title">Black Solids Poly</span>
</a>
<div class="star-rating">
<span style="width:100%"></span>
</div>
<span class="amount">&#36;9.00</span>
</li>
<li>
<a href="#">
<img width="200" height="200" src="images/product/product2_front.jpg" alt=""/>
<span class="product-title">Avirate Blue Ditsy</span>
</a>
<div class="star-rating">
<span style="width:40%"></span>
</div>
<span class="amount">&#36;18.00</span>
</li>
<li>
<a href="#">
<img width="200" height="200" src="images/product/product3_front.jpg" alt=""/>
<span class="product-title">Mustard Brown</span>
</a>
<div class="star-rating">
<span style="width:60%"></span>
</div>
<span class="amount">&#36;20.00</span>
</li>
<li>
<a href="#">
<img width="200" height="200" src="images/product/product4_front.jpg" alt=""/>
<span class="product-title">Unique Fashion Pink</span>
</a>
<div class="star-rating">
<span style="width:80%"></span>
</div>
<span class="amount">&#36;35.00</span>
</li>
<li>
<a href="#">
<img width="200" height="200" src="images/product/product5_front.jpg" alt=""/>
<span class="product-title">Chemistry Pink</span>
</a>
<div class="star-rating">
<span style="width:80%"></span>
</div>
<ins>
<span class="amount">&#36;2.00</span>
</ins>
<del>
<span class="amount">&#36;3.00</span>
</del>
</li>
</ul>
</div>

</div>
</aside>
</div>
</div>
</div>
<?php
include 'footer.php';
?>
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
<script>
</script>
<script type='text/javascript' src='js/core.min.js'></script>
<script type='text/javascript' src='js/widget.min.js'></script>
<script type='text/javascript' src='js/mouse.min.js'></script>
<script type='text/javascript' src='js/slider.min.js'></script>

<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkShop').addClass('active');
	});
</script>


<script type='text/javascript' src='js/jquery-ui-touch-punch.min.js'></script>
<script type='text/javascript'>
            var price_slider_params = {"currency_symbol":"&#8377;","currency_pos":"left","min_price":"","max_price":""};
        </script>
<script type='text/javascript' src='js/price-slider.js'></script>
<script type="text/javascript">
/* <![CDATA[ */
(function(){try{var s,a,i,j,r,c,l=document.getElementsByTagName("a"),t=document.createElement("textarea");for(i=0;l.length-i;i++){try{a=l[i].getAttribute("href");if(a&&a.indexOf("/cdn-cgi/l/email-protection") > -1  && (a.length > 28)){s='';j=27+ 1 + a.indexOf("/cdn-cgi/l/email-protection");if (a.length > j) {r=parseInt(a.substr(j,2),16);for(j+=2;a.length>j&&a.substr(j,1)!='X';j+=2){c=parseInt(a.substr(j,2),16)^r;s+=String.fromCharCode(c);}j+=1;s+=a.substr(j,a.length-j);}t.innerHTML=s.replace(/</g,"&lt;").replace(/>/g,"&gt;");l[i].setAttribute("href","mailto:"+t.value);}}catch(e){}}}catch(e){}})();
/* ]]> */
</script>
</body>

</html>