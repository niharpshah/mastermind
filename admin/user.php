 <?php
	session_start();
	include('connection.php'); 
	if(!isset($_SESSION['logid']))
	{
		echo "<script>window.location='index.php';</script>";
	} 
 ?>
<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:18 GMT -->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge"> 
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Users</title>

  <!-- <link rel="shortcut icon" href="images/favicon.ico" type="image/x-icon">
  <link rel="icon" href="images/favicon.ico" type="image/x-icon"> -->
  <!-- Bootstrap CSS -->

<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>

<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
	  $('#mydatatable').DataTable();
    });
		
	$(document).ready(function () {
		fillData('all');
	});
	function fillData(val) { 

    var mydata = [];
    var ourObj = {};
    ourObj.action = "getdata";
    ourObj.mydata = mydata;
    var rowData = "";
    rowData += "<table id='example' class='table table-striped table-bordered'>";
    rowData += "<thead>";
    rowData += "<tr>";
    rowData += "<th>Sr No.</th>";
    rowData += "<th>Name</th>";
    rowData += "<th>Contact No.</th>";
    rowData += "<th>Email</th>";
    rowData += "<th>Joined Date</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'user_data.php',
        type: 'POST',
        async: false,
        data: {"ajaxdata": JSON.stringify(ourObj)},
        success: function(response) {
            if (response) {
                if (response.length > 0) {
                    rowData += "<tbody>";

                    for (var i = 0; i < response.length; i++)
                    {
                        var item = response[i];
                        rowData += "<tr>";
                        rowData += "<td style='text-align:center;'>" + (i + 1).toString() + "</td>";
						
                        var uname = "";
                        if (item.user_name === null || item.user_name === undefined) {
                            uname = "";
                        } else {
                            uname = item.user_name;
                        }
                        rowData += "<td>" + uname + "</td>";

                        var cont = "";
                        if (item.contact === null || item.contact === undefined) {
                            cont = "";
                        } else {
                            cont = item.contact;
                        }
                        rowData += "<td>" + cont + "</td>";
	
                        var uemail = "";
                        if (item.email === null || item.email === undefined) {
                            uemail = "";
                        } else {
                            uemail = item.email;
                        }
                        rowData += "<td>" + uemail + "</td>";



                        var date = setMyDate(item.reg_date);

                        rowData += "<td>" + date + "</td>";

                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "</td>";
                        rowData += "</tr>";
                    }
                    rowData += "</tbody>";
                }
            }
        },
        error: function(errorData) {

        }
    });

    rowData += "</table>";
    $("#myTableData").html(rowData);
    $('#divError').css("display", "none");

    //$('#mydatatable').DataTable().destroy();


}

function setMyDate(val) {
    var t_sdate = val;
    var sptdate = String(t_sdate).split("-");
    var months = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'August', 'September', 'October', 'November', 'December'];
    var myMonth = sptdate[1];
    var myDay = sptdate[2];
    var myYear = sptdate[0];
    return myDay + "-" + myMonth + "-" + myYear;
}
	
function confirmRemove(did) {
    var did = did;
	alert(did);
    if (did && did != "") {
        var mydata = [{"id": did}];
        var ourObj = {};
        ourObj.action = "remove";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'prod_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response) {
                    if (response.msg && response.msg === "Success") {
                        fillData("all");
                    } else {
                    }
                }
            }
        });
    }
}
function editData(eid) {
    if (eid && eid != "") {
        var mydata = [{"id": eid}];
        var ourObj = {};
        ourObj.action = "getitem";
        ourObj.mydata = mydata;
        $.ajax({
            url: 'prod_data.php',
            type: 'POST',
            data: {"ajaxdata": JSON.stringify(ourObj)},
            success: function(response) {
                if (response && response.length > 0) {
                    $('#txtprodid').val(response[0].product_id);
                    $('#txtsubcatname').val(response[0].subcat_id);
                    $('#txtprodname').val(response[0].product_name);
                    $('#txtproddes').val(response[0].description);
                    if (response[0].prod_img1 !== null && response[0].prod_img1 !== "") {
                        $("#imgGallery1").attr("src", "images/product/small/" + response[0].prod_img1);
                        $("#imgGallery1").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].prod_img1);
                    }
					
                    if (response[0].prod_img2 !== null && response[0].prod_img2 !== "") {
                        $("#imgGallery2").attr("src", "images/product/small/" + response[0].prod_img2);
                        $("#imgGallery2").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].prod_img2);
                    }

                    if (response[0].prod_img3 !== null && response[0].prod_img3 !== "") {
                        $("#imgGallery3").attr("src", "images/product/small/" + response[0].prod_img3);
                        $("#imgGallery3").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].prod_img3);
                    }

                    if (response[0].instruction !== null && response[0].instruction !== "") {
                        $("#imgGallery").attr("src", "images/product/small/" + response[0].instruction);
                        $("#imgGallery").css("display", "block");
                        $("#divImage").css("display", "block");
                        $("#oldimg").val(response[0].instruction);
                    }

                    $('#txtprodcode').val(response[0].product_code);
                    $('#txtprice').val(response[0].price);
                    $('#txtcatdesc').val(response[0].availibility);

//                    $('#myBox').unblock();
                    $('#divDataModal').modal('toggle');
                    $('#txtFirstname').focus();
                } else {
					alert('problem');
                }
            }
        });
    } else {
        return false;
    }
}

</script>
</head>
<body class="" >
  <div class="piluku-preloader text-center">
  <!-- <div class="progress">
      <div class="indeterminate"></div>
  </div> -->
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">

  

<?php include('leftbar.php'); ?>
<!-- left-bar -->

<div class="content" id="content">
	
	<div class="overlay"></div>			
	
	<?php include('header.php'); ?>
<!-- /top-bar -->
	


	<!-- main content -->
	<div class="main-content">

		<!-- *** Editable Tables *** -->
		
		<!-- /panel -->

		<!-- *** Editable Tables *** -->
		<div class="panel panel-piluku">
			<div class="panel-heading">
				<h3 class="panel-title">
					<i class="icon ti-user"></i> <strong>Users</strong>
					<!--<span class="panel-options">
						<a href="#" class="panel-refresh">
							<i class="icon ti-reload"></i>
						</a>
						<a href="#" class="panel-minimize">
							<i class="icon ti-angle-up"></i>
						</a>
						<a href="#" class="panel-close">
							<i class="icon ti-close"></i>
						</a>
					</span>-->

				</h3>
			</div>
			<div class="panel-body">
				<div class="table-responsive" id="myTableData">
	<!-- DELETE QUERY ENDED -->
				</div>
			</div>
		</div>
		
	</div>
	
	<div class="modal fade" id="largemodal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-lg">
			<div class="modal-content">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true" class="ti-close"></span></button>
					<h4 class="modal-title" id="myModalLabel1"></h4>
				</div>
				
			</div>
		</div>
	</div>
	
	
</div>
</div>

<!-- Page Scripts -->
    
    <!-- Edited for search input -->


<script src='assets/js/jquery-ui-1.10.3.custom.min.js'></script>
<script src='assets/js/bootstrap.min.js'></script>
<script src='assets/js/jquery.nicescroll.min.js'></script>
<script src='assets/js/wow.min.js'></script>
<script src='assets/js/jquery.loadmask.min.js'></script>
<script src='assets/js/jquery.accordion.js'></script>
<script src='assets/js/materialize.js'></script>
<script src='assets/js/bic_calendar.js'></script>
<script src='assets/js/core.js'></script>
<script src='assets/js/jquery.dataTables.min.js'></script>
<script src='assets/js/bootstrap-datatables.js'></script>
<script src='assets/js/dataTables-custom.js'></script>
<script src='assets/js/mindmup-editabletable.js'></script>
<script src='assets/js/numeric-input-example.js'></script>
<script src='assets/js/dynamic-tables.js'></script>
<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>


<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkuser').addClass('current');
	});
</script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>