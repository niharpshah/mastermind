<?php
include 'connection.php';
include 'encrypt.php';

if (isset($_REQUEST["sid"])) {
    $converter = new Encryption;
    $id = $converter->decode($_REQUEST["sid"]);
    $sql = mysqli_query
        ($cn, "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where product_id ='" . $id . "'");
    if (mysqli_num_rows($sql) <= 0) {
        echo "<script>window.location='login.php';</script>";
    }
}

if (isset($_REQUEST["subcid"])) {
    $converter = new Encryption;
    $subc = $converter->decode($_REQUEST["subcid"]);
    $sql = mysqli_query
        ($cn, "select *,(select subcat_name from tbl_subcategory where subcat_id = tbl_products.subcat_id) as sub, (select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as cat from tbl_products where subcat_id = '" . $subc . "'");
    if (mysqli_num_rows($sql) <= 0) {
        echo "<script>window.location='login.php';</script>";
    }
}
?>

<?php
if (isset($_REQUEST['btnrating'])) {
    $rating = $_REQUEST['txtrating'];
    $comment = $_REQUEST['txtcomment'];
    $qry = "insert into tbl_rating values(NULL,'" . $_SESSION['uid'] . "','" . $id . "','$comment','$rating',NOW(),'No')";
    $rs = mysqli_query($cn, $qry);
}
?>
<!doctype html>
<html lang="en-US">

<!-- Mirrored from sitesao.com/html/airslice/single-product-fullwidth.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:23:23 GMT -->
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>
<title>Product Detail</title>
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/preloader.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/skin-selector.css' type='text/css' media='all'/>

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
<body class="single-product" data-spy="scroll">
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

<?php include 'header.php';?>
<div class="heading-container ">
<div class="container heading-standar">
<div class="heading-wrap">

<div class="page-title">
<h1 align="center">Products</h1>
</div>
</div>
</div>
</div>
<?php

if (isset($_REQUEST['addCart'])) {

    $quty = $_REQUEST['txtqty'];
    $pid = $_REQUEST["pid"];
    if (isset($_SESSION['uid'])) {
        $userid = $_SESSION['uid'];
        $qry = "insert into tbl_cart values(NULL,'$userid','$pid','$quty')";
        $rs = mysqli_query($cn, $qry);
        if ($rs) {
            echo "<script>window.location='cart.php';</script>";
        } else {
            echo "Records Not inserted";
        }
    } else {
        echo "<script>alert('Please Login First');</script>";
        echo "<script>window.location='product.php?sid=$pid';</script>";
    }
}
?>

<div class="content-container">
<?php

$qry = "select *,(select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname,(select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as catname from tbl_products where product_id = '" . $id . "'";
$rs = mysqli_query($cn, $qry);
while ($row = mysqli_fetch_array($rs)) {
    ?>
<div class="container">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="shop">
<div class="product">
<div class="row">
<div class="col-md-6 col-sm-6">
<div class="single-product-images">
<div class="caroufredsel product-images-slider" data-height="variable" data-visible="1" data-responsive="1" data-infinite="1">
<a href="#" class="expand-button">
<i class="fa fa-expand"></i>
</a>
<div class="caroufredsel-wrap">
<ul class="caroufredsel-items">
<li class="caroufredsel-item">
<a href="<?php echo "admin/images/product/" . $row['prod_img1']; ?>" data-rel="magnific-popup" title="p11">
<img width="700" height="700" src="<?php echo "admin/images/product/" . $row['prod_img1']; ?>" alt="p11"/>
</a>
</li>
<li class="caroufredsel-item">
<a href="<?php echo "admin/images/product/" . $row['prod_img2']; ?>" data-rel="magnific-popup" title="p12">
<img width="700" height="700" src="<?php echo "admin/images/product/" . $row['prod_img2']; ?>" alt="p12"/>
</a>
</li>
<li class="caroufredsel-item">
<a href="<?php echo "admin/images/product/" . $row['prod_img3']; ?>" data-rel="magnific-popup" title="p13">
<img width="700" height="700" src="<?php echo "admin/images/product/" . $row['prod_img3']; ?>" alt="p13"/>
</a>
</li>
</ul>
<a href="#" class="caroufredsel-prev"></a>
<a href="#" class="caroufredsel-next"></a>
</div>
</div>
<div class="product-thumbnails-slider single-product-thumbnails" data-visible-max="4" data-visible-min="3" data-responsive="1" data-infinite="1">
<div class="caroufredsel-wrap">
<ul class="caroufredsel-items">
<li class="caroufredsel-item">
<div class="thumb">
<a href="#" data-rel="0" title="p11">
<img width="200" height="200" src="<?php echo "admin/images/product/" . $row['prod_img1']; ?>" alt="p11" title="p11"/>
</a>
</div>
</li>
<li class="caroufredsel-item">
<div class="thumb">
<a href="#" data-rel="1" title="p12">
<img width="200" height="200" src="<?php echo "admin/images/product/" . $row['prod_img2']; ?>" alt="p12"/>
</a>
</div>
</li>
<li class="caroufredsel-item">
<div class="thumb">
<a href="#" data-rel="2" title="p13">
<img width="200" height="200" src="<?php echo "admin/images/product/" . $row['prod_img3']; ?>" alt="p13"/>
</a>
</div>
</li>
</ul>
<a href="#" class="caroufredsel-prev"></a>
<a href="#" class="caroufredsel-next"></a>
</div>
</div>
</div>
</div>
<div class="col-md-6 col-sm-6">
<div class="summary entry-summary">
<h1 class="product_title entry-title"><?php echo $row['product_name'] ?></h1>
<div class="shop-product-rating">
<div>
<input name="txtrating" id="txtrating" class="ratingEvent rating5" readonly="" value="5"/>
</div>
<a href="#reviews" class="shop-review-link">
(<span class="count"><?php $qry = mysqli_query($cn, "select * from tbl_rating where product_id='" . $converter->decode($_REQUEST["sid"]) . "'");
    echo mysqli_num_rows($qry);?></span> customer reviews)
</a>
</div>
<p class="price"><span class="amount"><i class="fa fa-inr"></i> <?php echo $row['price'] ?></span></p>

<form class="cart" method="post">
<input type="hidden" id="pid" name="pid" value="<?php echo $row['product_id'] ?>">
<div class="quantity">
<input type="number" name="txtqty" id="txtqty" step="1" min="1" name="quantity" value="1" class="input-text qty text" size="4" />
</div>
<button type="submit" name="addCart" id="addCart" class="button">Add to cart</button>
</form>
<div class="add-to-wishlist-actions">
<a href="#" class="add_to_wishlist"></a>
</div>
<div class="clear"></div>
<div class="product_meta">
<span class="posted_in">
Categories: <a href="#"><?php echo $row['catname']; ?></a>,<a href="#"><?php echo $row['subname']; ?></a>.
</span>
</div>
<div class="share-links">
<div class="share-icons">
<span class="facebook-share">
<a href="#" title="Share on Facebook">
<i class="fa fa-facebook"></i>
</a>
</span>
<span class="twitter-share">
<a href="#" title="Share on Twitter">
<i class="fa fa-twitter"></i>
</a>
</span>
<span class="google-plus-share">
<a href="#" title="Share on Google +">
<i class="fa fa-google-plus"></i>
</a>
</span>
<span class="linkedin-share">
<a href="#" title="Share on Linked In">
<i class="fa fa-linkedin"></i>
</a>
</span>
</div>
</div>
</div>
</div>
</div>
<div class="tabbable tabs-primary tabs-top shop-tabs">
<ul class="nav nav-tabs" role="tablist">
<li class="active">
<a data-toggle="tab" role="tab" href="#tab-description">Description</a>
</li>
<li>
<a data-toggle="tab" role="tab" href="#tab-reviews">Reviews (<?php $qry = mysqli_query($cn, "select * from tbl_rating where product_id='" . $converter->decode($_REQUEST["sid"]) . "'");
    echo mysqli_num_rows($qry);?>)</a>
</li>
</ul>
<div class="tab-content">
<div class="tab-pane active" id="tab-description">
<p><?php echo $row['description']; ?></p>
</div>
<div class="tab-pane" id="tab-reviews">
<div id="reviews">
<div id="comments">
<?php
$sql = "select *,(select user_name from tbl_user where user_id=tbl_rating.user_id) as uname from tbl_rating where product_id='" . $converter->decode($_REQUEST["sid"]) . "'";
    $rs = mysqli_query($cn, $sql);
    while ($row = mysqli_fetch_array($rs)) {

        $date = $row['date_time'];
        $cdate = date("d-m-Y h:i a", strtotime($date));
        ?>

<ol class="commentlist">
<li class="comment">
<div class="comment_container">
<img alt="" src="images/avatar/user-1.jpg" class="avatar" height="60" width="60"/>
<div class="comment-text">
<div style="float:right;">
<input name="txtrating" id="txtrating" class="ratingEvent rating5" readonly="" value="<?php echo $row['ratings']; ?>"/>
</div>
<p class="meta">
<strong><?php echo ucwords($row['uname']); ?></strong> &ndash; <time><?php echo $cdate; ?></time> <strong>:</strong>
</p>
<div class="description">
<p><?php echo $row['messege']; ?></p>
</div>
</div>
</div>
</li>
<?php
}
    ?>
</ol>

<?php
if (isset($_SESSION['uid'])) {
        ?>
<div id="respond-wrap">
<div id="respond" class="comment-respond">
<h3 id="reply-title" class="comment-reply-title">
<span>Leave a reply</span>
</h3>
<form class="comment-form" name="myform" method="post" enctype="multipart/form-data">
<p class="comment-form-name">
<label>Rating</label>
<input name="txtrating" id="txtrating" class="ratingEvent rating5" value=""/>
</p>
<p class="comment-form-comment">
<label>Comment</label>
<textarea class="form-control" name="txtcomment" id="txtcomment" cols="45" rows="8" ></textarea>
</p>
<p>
<input name="btnrating" id="btnrating" class="btn btn-primary form-submit" value="Post Comment" type="submit"/>
</p>
</form>
</div>
</div>
<?php
}
    ?>
</div>
<div class="clear"></div>
</div>
</div>
</div>
</div>
<div class="related products">
<div class="related-title">
<h3><span>Related Products</span></h3>
</div>
<ul class="products columns-3" data-columns="3">
<?php
$qry = mysqli_query($cn, "select *,(select subcat_name from tbl_subcategory where subcat_id = tbl_products.subcat_id) as sub, (select cat_name from tbl_category where cat_id=(select cat_id from tbl_subcategory where subcat_id=tbl_products.subcat_id)) as cat from tbl_products where subcat_id = '" . $subc . "'");
    while ($row = mysqli_fetch_array($qry)) {
        ?>
<li class="product">
<div class="product-container">
<figure>
<div class="product-wrap">
<div class="product-images">
<span class="onsale">Sale!</span>
<div class="shop-loop-thumbnail shop-loop-front-thumbnail">
<img style="height:250px;" src="<?php echo "admin/images/product/" . $row['prod_img1']; ?>" alt=""/></div>
<div class="shop-loop-thumbnail shop-loop-back-thumbnail">
<img style="height:250px;"src="<?php echo "admin/images/product/" . $row['prod_img2']; ?>" alt=""/></div>
<div class="yith-wcwl-add-to-wishlist">
<a href="#" class="add_to_wishlist">Add to Wishlist</a></div>
<div class="clear"></div>
</div>
<div class="shop-loop-actions">
<a href="#" class="button add_to_cart_button product_type_simple">Add to cart</a>
<a class="shop-loop-quickview" href="product.php?id=<?php echo $row['product_id']; ?>"></a></div>
</div>
<figcaption>
<div class="shop-loop-product-info">
<div class="info-title">
<div class="product-category">
<a href="#" rel="tag"><?php echo $row['cat']; ?></a>, <a href="#" rel="tag"><?php echo $row['sub']; ?></a>
</div>
<h3 class="product_title">
<a href="product.php?sid=<?php echo $converter->encode($row['product_id']); ?>&subcid=<?php echo $converter->encode($row['subcat_id']); ?>"><?php echo $row['product_name']; ?></a>
</h3>
</div>
<div class="info-meta">
<div class="info-price">
<span class="price">
<ins>
<span class="amount"><i class="fa fa-inr"></i>&nbsp;<?php echo $row['price']; ?></span>
</ins>
</span>
</div>
<div class="info-rating">
<div class="star-rating">
<span style="width:80%"></span>
</div>
</div>
</div>
</div>
</figcaption>
</figure>
</div>
</li>
<?php }?>

</ul>
</div>
</div>
</div>
</div>
</div>
</div>
</div>
<?php
}
?>
</div>

<?php include 'footer.php';?></div>
<a href="#" class="go-to-top"><i class="fa fa-angle-up"></i></a>

<div class="sitesao-preview__loading">
<div class="sitesao-preview__loading__animation"><i></i><i></i><i></i><i></i></div>
</div>

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

<!-- Mirrored from sitesao.com/html/airslice/single-product-fullwidth.html by HTTrack Website Copier/3.x [XR&CO'2014], Wed, 02 Dec 2015 11:23:23 GMT -->
</html>