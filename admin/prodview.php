 <?php
session_start();
include 'connection.php';
if (!isset($_SESSION['logid'])) {
    echo "<script>window.location='index.php';</script>";
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/> <!--320-->

  <title>Products</title>

  <!-- Bootstrap CSS -->

<link rel='stylesheet' href='assets/css/bootstrap.min.css'>
<link rel='stylesheet' href='assets/css/material.css'>
<link rel='stylesheet' href='assets/css/style.css'>
<link rel='stylesheet' href='assets/css/sweet-alerts/sweetalert.css'>

<script src='assets/js/jquery.js'></script>
<script src='assets/js/app.js'></script>
  <script>
    jQuery(window).load(function () {
      $('.piluku-preloader').addClass('hidden');
    });

	$(document).ready(function () {
		fillData('all');

	$("#myform").validate({
			rules:{
				txtsubcatname:"required",
				txtprodname:"required",
//				txtprodimg1: {
//                required: function() {
//                return $("#oldimg1").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            },
//				txtprodimg2: {
//                required: function() {
//                return $("#oldimg2").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            },
//				txtprodimg3: {
//                required: function() {
//                return $("#oldimg3").val() === "" ? true : false;
//                },
//                extension: "jpg,jpeg,png"
//            },
//				txtprodinfo: {
//                required: function() {
//                return $("#oldpdf").val() === "" ? true : false;
//                },
//                extension: "pdf"
//            },
				txtprodcode:"required",
				txtprice:"required",
				r_status:"required"

			},
			messages:{
				txtsubcatname:"Please Enter Sub-Ctegory Name",
				txtprodname:"Please Enter Product Name",
//				txtprodimg1: {
//                required: "Product image 01 Is Required",
//                extension: "Upload only image of type .jpg or .jpeg or .png"
//            },
//				txtprodimg2: {
//                required: "Product image 02 Is Required",
//                extension: "Upload only image of type .jpg or .jpeg or .png"
//            },
//				txtprodimg3: {
//                required: "Product image 03 Is Required",
//                extension: "Upload only image of type .jpg or .jpeg or .png"
//            },
//				txtprodinfo: {
//                required: "Product Instruction One Is Required",
//                extension: "Upload only PDF file."
//            },
				txtprodcode:"Please Enter Product Code",
				txtprice:"Please Enter The Price",
				r_status:"Please Select One Option"
			}

		});

	$("#myform").on('submit', (function(e) {
		e.preventDefault();


        if ($('#myform').valid()) {
//            $('#myModalBox').block({
//                message: '<img src="images/hourglass.gif" />',
//                css: {backgroundColor: 'transparent', border: 'none'}
//            });
            	$.ajax({
                	type: 'POST',
                	url: 'prod_data.php',
                	data: new FormData(this),
                	contentType: false,
                	cache: false,
                	processData: false,
                	success: function(data) {
                    //var d = JSON.parse(data);
                    	if (data.msg && data.msg == "Success") {
							fillData('all');
						$('#myform').each(function() {
							this.reset();

						});
						$('#largemodal').modal('hide');
                    	} // if (data.msg
						else {
                        	$('#spanErrorMsg').html("There is an error in submitting details.Please try again!!!");
                    	} // else
					}, // success: func
                	error: function() {
						alert('Error');
                	} //error: func
            	});
			};
		}));
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
    rowData += "<th>Sub-Category Name</th>";
    rowData += "<th>Product Name</th>";
    rowData += "<th>Product Description</th>";
    rowData += "<th>Product Image 01</th>";
    rowData += "<th>Product Image 02</th>";
    rowData += "<th>Product Image 03</th>";
    rowData += "<th>Product Instructions</th>";
    rowData += "<th>Product Code</th>";
    rowData += "<th>Price</th>";
    rowData += "<th>Availibility</th>";
    rowData += "<th>Update</th>";
    rowData += "<th>Delete</th>";
    rowData += "</tr>";
    rowData += "</thead>";

    $.ajax({
        url: 'prod_data.php',
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

                        var subcname = "";
                        if (item.subname === null || item.subname === undefined) {
                            subcname = "";
                        } else {
                            subcname = item.subname;
                        }
                        rowData += "<td>" + subcname + "</td>";

                        var prodname = "";
                        if (item.product_name === null || item.product_name === undefined) {
                            prodname = "";
                        } else {
                            prodname = item.product_name;
                        }
                        rowData += "<td>" + prodname + "</td>";

                        var des = "";
                        if (item.description === null || item.description === undefined) {
                            des = "";
                        } else {
                            des = item.description;
                        }
                        rowData += "<td>" + des + "</td>";

                        var prodimg1 = "";
                        if (item.prod_img1 === null || item.prod_img1 === undefined) {
                            prodimg1 = "";
                        } else {
                            prodimg1 = item.prod_img1;
                        }
						rowData += "<td>";
                        rowData += "<a href='images/product/" + prodimg1 + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/product/small/" + prodimg1 + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";


                        var prodimg2 = "";
                        if (item.prod_img2 === null || item.prod_img2 === undefined) {
                            prodimg2 = "";
                        } else {
                            prodimg2 = item.prod_img2;
                        }
						rowData += "<td>";
                        rowData += "<a href='images/product/" + prodimg2 + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/product/small/" + prodimg2 + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";


                        var prodimg3 = "";
                        if (item.prod_img3 === null || item.prod_img3 === undefined) {
                            prodimg3 = "";
                        } else {
                            prodimg3 = item.prod_img3;
                        }
						rowData += "<td>";
                        rowData += "<a href='images/product/" + prodimg3 + "' class='image-popup-vertical-fit'>";
                        rowData += "<img class='img-responsive' src='images/product/small/" + prodimg3 + "'   style='height:45px;width:60px;'/>";
                        rowData += "</a>";
                        rowData += "</td>";

                        var ins = "";
                        if (item.instruction === null || item.instruction === undefined) {
                            ins = "";
                        } else {
                            ins = item.instruction;
                        }
                        rowData += "<td><a href='images/product/pdf/" + ins + "' target='_blank' ><img class='img-responsive' src='images/pdf.png' height='45px' width='60px' /></a></td>";

                        var code = "";
                        if (item.product_code === null || item.product_code === undefined) {
                            code = "";
                        } else {
                            code = item.product_code;
                        }
                        rowData += "<td>" + code + "</td>";


                        var price = "";
                        if (item.price === null || item.price === undefined) {
                            price = "";
                        } else {
                            price = item.price;
                        }
                        rowData += "<td>" + price + "</td>";

                        var aval = "";
                        if (item.availibility === null || item.availibility === undefined) {
                            aval = "";
                        } else {
                            aval = item.availibility;
                        }
                        rowData += "<td>" + aval + "</td>";




                        var activeval = "";
                        if (item.IsActive === null || item.IsActive === undefined) {
                            activeval = "";
                        } else {
                            activeval = item.IsActive;
                        }

                        rowData += "<td>";
                        rowData += "<button onClick='editData(" + item.product_id + ");' class='btn btn-info' data-original-title='Edit Data' data-toggle='modal' data-target='#largemodal' data-toggle='tooltip' style='padding:5px 10px;margin-bottom: 3px;'><i class='fa fa-pencil' style='font-size: 16px;'></i></button>&nbsp;&nbsp;";

						rowData += "</td>";

						rowData += "<td>";

                        rowData += "<button id='btnDelete' onClick='confirmRemove(" + item.product_id + ");' class='btn btn-danger' data-original-title='Delete Data' data-toggle='tooltip' style='padding:5px 10px;'><i class='fa fa-trash-o' style='font-size: 16px;'></i></button>";
                        rowData += "";
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

function confirmRemove(did) {
	var did = did;
//	alert(did);

	swal({
		title: "Are you sure?",
		text: "You will not be able to recover Your Product Again!",
		type: "warning",
		showCancelButton: true,
		confirmButtonColor: '#6fd64b',
		confirmButtonText: 'Yes, delete it!',
		cancelButtonText: "No, cancel it!",
		closeOnConfirm: false,
		closeOnCancel: false
	},
	function(isConfirm){
		if (isConfirm){
			var res = JSON.parse(removeTicket(did));
				if(res.msg == "Success"){
					fillData('all');
					swal("Deleted!","Your Product Has Been Deleted.","success");
				}
		} else {
			swal("Cancelled", "Your Product is safe :)", "error");
		}
	});
}

function removeTicket(id){
		var returnData = new Object();
            if (window.XMLHttpRequest) {
                // code for IE7+, Firefox, Chrome, Opera, Safari
                xmlhttp = new XMLHttpRequest();
            }
            else {// code for IE6, IE5
                xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
            }
            xmlhttp.onreadystatechange = function(){
                if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                  returnData= xmlhttp.responseText;
                }
            }
            xmlhttp.open("GET", "deleteproduct.php?did=" +id, false);
			xmlhttp.send();
			return returnData;
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
                        $("#divImage1").css("display", "block");
                        $("#oldimg1").val(response[0].prod_img1);
                    }

                    if (response[0].prod_img2 !== null && response[0].prod_img2 !== "") {
                        $("#imgGallery2").attr("src", "images/product/small/" + response[0].prod_img2);
                        $("#imgGallery2").css("display", "block");
                        $("#divImage2").css("display", "block");
                        $("#oldimg2").val(response[0].prod_img2);
                    }

                    if (response[0].prod_img3 !== null && response[0].prod_img3 !== "") {
                        $("#imgGallery3").attr("src", "images/product/small/" + response[0].prod_img3);
                        $("#imgGallery3").css("display", "block");
                        $("#divImage3").css("display", "block");
                        $("#oldimg3").val(response[0].prod_img3);
                    }

                    if (response[0].instruction !== null && response[0].instruction !== "") {
                        $("#imgGallery4").attr("src", "images/product/pdf/" + response[0].instruction);
                        $("#imgGallery4").css("display", "block");
                        $("#divImage4").css("display", "block");
                        $("#oldpdf").val(response[0].instruction);
                    }

                    $('#txtprodcode').val(response[0].product_code);
                    $('#txtprice').val(response[0].price);
					if(response[0].availibility == "YES")
					{
						$('input[id=ry][value=YES]').prop("checked",true);
						$('input[id=ry][value=YES]').prop("checked",false);
					}
					else
					{
						$('input[id=ry][value=YES]').prop("checked",false);
						$('input[id=ry][value=YES]').prop("checked",true);
					}
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
<style>
.error
{
	color:#FF0000;
	letter-spacing:0.02cm;
}
</style>

</head>
<body class="" >
  <div class="piluku-preloader text-center">
  <!-- <div class="progress">
      <div class="indeterminate"></div>
  </div> -->
  <div class="loader">Loading...</div>
</div>
<div class="wrapper ">



<?php include 'leftbar.php';?>
<!-- left-bar -->

<div class="content" id="content">

	<div class="overlay"></div>

	<?php include 'header.php';?>
<!-- /top-bar -->



	<!-- main content -->
	<div class="main-content">

		<!-- *** Editable Tables *** -->

		<!-- /panel -->

		<!-- *** Editable Tables *** -->
		<div class="panel panel-piluku">
			<div class="panel-heading">
				<h3 class="panel-title"><i class="fa fa-qrcode"></i> Products
					<span class="panel-options"><a href="products.php"><button type="submit" class="btn btn-info btn-lg">Add Record</button></a></span>

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
					<h4 class="modal-title" id="myModalLabel1"><i class="fa fa-qrcode"></i>&nbsp;Products</h4>
				</div>
				<form id="myform" class="form form-horizontal" method="post" enctype="multipart/form-data">
					<input  type="hidden" name="hfAction" value="add" />
					<input  type="hidden" name="txtprodid" id="txtprodid" />&nbsp;
					<!--Default Horizontal Form-->


					<div class="form-group">
						<label class="col-sm-2 control-label">Sub Category Name:</label>
						<div class="col-sm-8">
							<select class="form-control" name="txtsubcatname" id="txtsubcatname"  >
								<option value="" >Select Sub-Category</option>
								<?php
$res = mysqli_query($cn, "select * from tbl_subcategory");
while ($r = mysqli_fetch_array($res)) {
    ?>
								<option value="<?php echo $r['subcat_id']; ?>"  ><?php echo $r['subcat_name']; ?></option>
								<?php }?>
							</select>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Name:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprodname" class="form-control" placeholder="Product Name" name="txtprodname"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Description:</label>
						<div class="col-sm-8">
							<textarea id="txtproddes" name="txtproddes" class="form-control" placeholder="Product Description"></textarea>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 01:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg1" name="txtprodimg1"  class="filestyle" data-icon="false" alt="prodimg1">
						</div>
						<div id="divImage1" style="display: none;" class="col-md-2">
                            <input type="hidden" name="oldimg1" id="oldimg1" />
                            <img id="imgGallery1" name="imgGallery1" style="display: none;height:45px;width:60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 02:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg2" name="txtprodimg2"  class="filestyle" data-icon="false" alt="prodimg2">
						</div>
						<div id="divImage2" style="display: none;" class="col-md-2">
                            <input type="hidden" name="oldimg2" id="oldimg2" />
                            <img id="imgGallery2" name="imgGallery2" style="display: none;height:45px;width:60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
					</div>
					</div>
					<div class="form-group">
						<label class="col-sm-2 control-label">Product Image 03:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodimg3" name="txtprodimg3"  class="filestyle" data-icon="false" alt="prodimg3">
						</div>
						<div id="divImage3" style="display: none;" class="col-md-2">
                            <input type="hidden" name="oldimg3" id="oldimg3" />
                            <img id="imgGallery3" name="imgGallery3" style="display: none;height:45px;width:60px;margin:4px 0px;padding: 5px;border: 1px solid #ccd1d9;" />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Info:</label>
						<div class="col-sm-8">
							<input type="file" id="txtprodinfo" name="txtprodinfo"  class="filestyle" data-icon="false" alt="productinfo">
						</div>
						<div id="divImage4" style="display: none;" class="col-md-2">
                            <input type="hidden" name="oldpdf" id="oldpdf" />
                           <a id="imgGallery4" ><img id="imgGallery4" name="imgGallery4" height="50px" width="60px" src="images/pdf.png" alt="PDF" /></a>
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Product Code:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprodcode" class="form-control" placeholder="Product Code" name="txtprodcode"  />
						</div>
					</div>

					<div class="form-group">
						<label class="col-sm-2 control-label">Price:</label>
						<div class="col-sm-8">
						<input type="text" id="txtprice" class="form-control" placeholder="Price" name="txtprice"  />
						</div>
					</div>

					<div class="form-group check-radio">
						<label class="col-sm-2 control-label">Availibility:</label>
						<div class="col-sm-8">
							<ul class="list-inline checkboxes-radio">
								<li class="ms-hover">
									<input type="radio" name="r_aval" id="ry" value="Yes" checked="checked">
									<label for="ry"><span></span>Yes</label>
								</li>
								<li>
									<input type="radio" name="r_aval" id="rn" value="No">
									<label for="rn"><span></span>No</label>
								</li>
							</ul>
						</div>
					</div>


					 <div class="form-group">
					 	<div align="center">
							<button name="btnsubcat" id="myform" class="btn btn-primary btn-icon-primary btn-icon-block btn-icon-blockleft">
							<i class="fa fa-save"></i>
							<span>Save</span>
						</button>
						</div>
					 </div>
				</form>
			</div>
		</div>
	</div>


</div>
</div>

<!-- Page Scripts -->

    <!-- Edited for search input -->

<script src="jquery.validate.js"></script>
<script src="additional-methods.js"></script>
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
<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#lnkprodv').addClass('current');
	});
</script>

<script src="assets/js/sweet-alert/sweetalert.min.js"></script>
<script src="assets/js/sweet-alerts.js"></script>

<script>
$(document).ready(function(){
$('#myTableData').css('textTransform', 'capitalize');
});
</script>

<script src='assets/js/bootstrap-filestyle.js'></script>
<script src="assets/js/jquery.countTo.js"></script>
</body>

<!-- Mirrored from 104.219.251.196/~vijaytupakula/preview/piluku/dynamic-tables.html by HTTrack Website Copier/3.x [XR&CO'2013], Fri, 14 Aug 2015 08:17:34 GMT -->
</html>