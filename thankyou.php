<?php 
include('connection.php');
if(!isset($_SESSION['uid']))
{
	echo "<script>window.location='index.php';</script>";
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

<div class="content-container">
<div class="container">
<div class="row">
<div class="col-md-12 main-wrap">
<div class="main-content">
<div class="row">
<div class="column col-md-12">
<div class="posts" data-paginate="page_num" data-layout="default">
<div class="posts-wrap posts-layout-medium">
<div class="henry-wrap">
			<div class="contact-img" align="center" style="font-size:38px;">
				<p sty><strong>THANK YOU</strong></p> 
			</div>
				
				<div class="col span_1_of_3">
					<div class="grid-bot">
								<div class="grid1-l-img" align="center" style="font-size:22px;">
									<p><?php echo  "<strong style='color:#57bb8a'>" . strtoupper($_SESSION['name']) . "</strong>&nbsp;FOR CHOOSING US" ;?></p>
								</div>
								<div class="grid1-l-desc" align="center" >
									<p><img src="images/yhnnnqq.png" alt="PARCEL" /></p>
								</div>
								<div class="grid1-l-desc" align="center" style="font-size:24px;">
									<p><strong>Your Product Will Be Delivered Soon</strong></p>
								</div>
								<div class="clear"></div>
								<div class="grid-desc">
									
								</div>
					</div>
				</div>
				<div class="clear"></div>
	</div>
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
</div>

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







<!--

-->