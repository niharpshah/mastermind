<?php
include('connection.php');
include('encrypt.php');
if(isset($_REQUEST["bill_id"]))
{
	$converter = new Encryption;
	$bid = $converter->decode($_REQUEST["bill_id"]);
	$sql=mysql_query
	("select *,(select product_name from tbl_products where product_id = tbl_order_detail.product_id) as pname,(select price from tbl_products where product_id = tbl_order_detail.product_id) as price from tbl_order_detail where order_id='". $bid ."'");
	if(mysql_num_rows($sql)<=0)
	{
		echo "<script>window.location='login.php';</script>";
	}  
}
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8" />
<title>Billing</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<link rel="shortcut icon" href="images/favicon.png"/>
<link rel='stylesheet' href='css/settings.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/elegant-icon.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/font-awesome.min.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/style.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/shop.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/preloader.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/magnific-popup.css' type='text/css' media='all'/>
<link rel='stylesheet' href='css/skin-selector.css' type='text/css' media='all'/>



	<link rel="stylesheet" type="text/css" href="invoice/bootstrap/css/bootstrap.min.css" />
	<link rel="stylesheet" type="text/css" href="invoice/font-awesome/css/font-awesome.min.css" />

    <script type="text/javascript" src="invoice/js/jquery-1.10.2.min.js"></script>
    <script type="text/javascript" src="invoice/bootstrap/js/bootstrap.min.js"></script>
	<script>
		function myFunction() {
      window.print();
  }
	</script>
</head>
<body>

<div class="container">

<div class="page-header">

</div>

<!-- Simple Invoice - START -->
<div class="container">
    
	<div class="row">
        <div class="col-xs-12">
		<img src="images/logo.png">
		
            
<?php
	$qry=mysql_query("select * from tbl_order where order_id ='". $bid ."'");
	while($row = mysql_fetch_array($qry))
	{
		$date = $row['order_date'];
		$ndate = date("d-m-Y", strtotime($date));
?>
			<div class="text-center">
                <h2>Invoice # : <?php echo "MMTOD-" . "<strong>".$row['order_id']."</strong>"; ?></h2>
            </div>
            <div class="row">
			
                <div class="col-xs-4 col-md-4 col-lg-4 pull-left">
                    <div class="panel panel-default height">
                        <div class="panel-heading"><strong>Billing Details</strong></div>
                        <div class="panel-body">
                            <strong><i class="elegant_icon_profile"></i>:</strong>&nbsp;<?php echo ucwords($_SESSION['name']); ?><br>
                             <strong><i class="elegant_icon_house"></i>:</strong>&nbsp;<?php echo $row['address']; ?><br>
							<?php echo "(+91) - " . $row['contact']; ?><br>
                            <strong><?php echo $row['pincode']; ?></strong><br>
                        </div>
						
                    </div>
                </div>
                <div class="col-xs-4 col-md-4 col-lg-4">
                    <div class="panel panel-default height">
                        <div class="panel-heading"><strong>Payment Information</strong></div>
                        <div class="panel-body">
                            <strong>Card Name:</strong> Visa<br>
                            <strong>Card Number:</strong> ***** 332<br>
                            <strong>Exp Date:</strong> 09/2020<br>
                        	<strong>Print:&nbsp;</strong><i class="fa fa-print" onClick="myFunction()"></i>
						</div>
                    </div>
                </div>
                <div class="col-xs-4 col-md-4 col-lg-4">
                    <div class="panel panel-default height">
                        <div class="panel-heading"><strong>Order Preferences</strong></div>
                        <div class="panel-body">
                            <strong>Order Date:</strong> <?php echo $ndate; ?><br>
                            <strong>Delivered On:</strong> <?php echo ucwords($row['status']); ?><br>
                        </div>
                    </div>
                </div>
            </div>
			<?php } ?>
        </div>
    </div>

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-heading">
                    <h3 class="text-center"><strong>Order summary</strong></h3>
                </div>
                <div class="panel-body">
                    <div class="table-responsive">
                        <table class="table table-condensed">
                            <thead>
                                <tr>
                                    <td><strong>Item Name</strong></td>
                                    <td class="text-center"><strong>Item Price</strong></td>
                                    <td class="text-center"><strong>Item Quantity</strong></td>
                                    <td class="text-right"><strong>Total</strong></td>
                                </tr>
                            </thead>
                            <tbody>
<?php
	$subtotal = 0;
	$cgst = 0;
	$sgst = 0;
	$final = 0;
	$qry=mysql_query("select *,(select product_name from tbl_products where product_id = tbl_order_detail.product_id) as pname,(select price from tbl_products where product_id = tbl_order_detail.product_id) as price from tbl_order_detail where order_id='". $bid ."'");
	while($row = mysql_fetch_array($qry))
	{
?>

                                <tr>
                                    <td><?php echo $row['pname']; ?></td>
                                    <td class="text-center"><?php echo $row['price']; ?></td>
                                    <td class="text-center"><?php echo $row['qty']; ?></td>
                                    <td class="text-right"><?php 
										echo $total= $row['price'] * $row['qty'];
									?></td>
                                </tr>
<?php 
$subtotal += $total;
$cgst = $subtotal * 9 / 100;
$sgst = $subtotal * 9 / 100;
$final = $subtotal + $sgst + $cgst; 
} 
?>                              
								 
								<tr>
                                    <td class="highrow"></td>
                                    <td class="highrow"></td>
                                    <td class="highrow text-center"><strong>Subtotal</strong></td>
                                    <td class="highrow text-right"><i class="fa fa-inr"></i>&nbsp;<?php echo $subtotal; ?></td>
                                </tr>
                                
								<tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>CGST</strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i>&nbsp;<?php echo $sgst; ?></td>
                                </tr>
								<tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>SGST</strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i>&nbsp;<?php echo $cgst; ?></td>
                                </tr>
                                
								<tr>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Shipping</strong></td>
                                    <td class="emptyrow text-right">FREE</td>
                                </tr>
								
								<tr>
                                    <td class="emptyrow"><i class="fa fa-barcode iconbig"></i></td>
                                    <td class="emptyrow"></td>
                                    <td class="emptyrow text-center"><strong>Total</strong></td>
                                    <td class="emptyrow text-right"><i class="fa fa-inr"></i>&nbsp;<?php echo $final; ?></td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
.height {
    min-height: 200px;
}

.icon {
    font-size: 47px;
    color: #5CB85C;
}

.iconbig {
    font-size: 77px;
    color: #5CB85C;
}

.table > tbody > tr > .emptyrow {
    border-top: none;
}

.table > thead > tr > .emptyrow {
    border-bottom: none;
}

.table > tbody > tr > .highrow {
    border-top: 3px solid;
}
</style>

<!-- Simple Invoice - END -->

</div>

</body>
</html>