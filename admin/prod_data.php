<?php
session_start();
include "connection.php";
header('Content-type: application/json');

$output = array();

if (isset($_POST["hfAction"]) && $_POST["hfAction"] != "") {
    $finalname = "";
    if ($_POST["hfAction"] == "add") {
        $id = $_POST["txtprodid"];

        if ($_FILES['txtprodinfo']['name'] != "") {
            $filename = date('Ymdhis') . $_FILES['txtprodinfo']['name'];
            $src = $_FILES['txtprodinfo']['tmp_name'];
            $path = "images/product/pdf/" . $filename;
            move_uploaded_file($src, $path);
        } else {
            $filename = $_REQUEST["oldpdf"];
        }

        if ($_FILES['txtprodimg1']['name'] != "") {
            $fname1 = $_FILES['txtprodimg1']['name'];
            $fileext1 = pathinfo($fname1, PATHINFO_EXTENSION); // getting image extension
            $filename1 = "ProductImage01" . date('Ymdhis') . "." . $fileext1;
        } else {
            $filename1 = $_REQUEST["oldimg1"];

        }
        if ($_FILES['txtprodimg2']['name'] != "") {
            $fname2 = $_FILES['txtprodimg2']['name'];
            $fileext2 = pathinfo($fname2, PATHINFO_EXTENSION); // getting image extension
            $filename2 = "ProductImage02" . date('Ymdhis') . "." . $fileext2;
        } else {
            $filename2 = $_REQUEST["oldimg2"];
        }
        if ($_FILES['txtprodimg3']['name'] != "") {
            $fname3 = $_FILES['txtprodimg3']['name'];
            $fileext3 = pathinfo($fname3, PATHINFO_EXTENSION); // getting image extension
            $filename3 = "ProductImage03" . date('Ymdhis') . "." . $fileext3;
        } else {
            $filename3 = $_REQUEST["oldimg3"];
        }

        $sql = "";
        if ($id == "") {
            $sql = "insert into tbl_products values(NULL,'" . $_REQUEST['txtsubcatname'] . "','" . $_REQUEST['txtprodname'] . "','" . $_REQUEST['txtproddes'] . "','" . $filename1 . "','" . $filename2 . "','" . $filename3 . "','" . $filename . "','" . $_REQUEST['txtprodcode'] . "','" . $_REQUEST['txtprice'] . "','" . $_REQUEST['r_aval'] . "',1)";
        } else {
            if ($_FILES['txtprodimg1']['name'] != "" && $_FILES['txtprodimg1']['name'] != null) {
                unlink("images/product/" . $_REQUEST['oldimg1']);
                unlink("images/product/small/" . $_REQUEST['oldimg1']);
            }
            if ($_FILES['txtprodimg2']['name'] != "" && $_FILES['txtprodimg2']['name'] != null) {
                unlink("images/product/" . $_REQUEST['oldimg2']);
                unlink("images/product/small/" . $_REQUEST['oldimg2']);
            }
            if ($_FILES['txtprodimg3']['name'] != "" && $_FILES['txtprodimg3']['name'] != null) {
                unlink("images/product/" . $_REQUEST['oldimg3']);
                unlink("images/product/small/" . $_REQUEST['oldimg3']);
            }
            if ($_FILES['txtprodinfo']['name'] != "" && $_FILES['txtprodinfo']['name'] != null) {
                unlink("images/product/pdf/" . $_REQUEST['oldpdf']);
            }

            $sql = "update tbl_products set subcat_id='" . mysqli_real_escape_string($cn, $_REQUEST['txtsubcatname']) . "',product_name='" . mysqli_real_escape_string($cn, $_REQUEST["txtprodname"]) . "',description='" . mysqli_real_escape_string($cn, $_REQUEST["txtproddes"]) . "',prod_img1='" . $filename1 . "',prod_img2='" . $filename2 . "',prod_img3='" . $filename3 . "',instruction='" . $filename . "',product_code='" . mysqli_real_escape_string($cn, $_REQUEST["txtprodcode"]) . "',price='" . mysqli_real_escape_string($cn, $_REQUEST["txtprice"]) . "',availibility='" . mysqli_real_escape_string($cn, $_REQUEST["r_aval"]) . "' where product_id='" . $id . "'";
        }

        $res = mysqli_query($cn, $sql) or die(mysqli_error($cn));
        if ($res) {

            if ($_FILES['txtprodimg1']['name'] != "") {
                $fname1 = $_FILES['txtprodimg1']['name'];
                $purestring = str_replace(' ', '-', $fname1); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtprodimg1']['tmp_name'];
                $ext = pathinfo($post_photo, PATHINFO_EXTENSION); // getting image extension
                if ($ext == 'png' || $ext == 'PNG' ||
                    $ext == 'jpg' || $ext == 'jpeg' ||
                    $ext == 'JPG' || $ext == 'JPEG' ||
                    $ext == 'gif' || $ext == 'GIF') { // checking image extension
                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG') {
                        $src = imagecreatefromjpeg($post_photo_tmp);
                    }
                    if ($ext == 'png' || $ext == 'PNG') {
                        $src = imagecreatefrompng($post_photo_tmp);
                    }
                    if ($ext == 'gif' || $ext == 'GIF') {
                        $src = imagecreatefromgif($post_photo_tmp);
                    }

                    list($width_min, $height_min) = getimagesize($post_photo_tmp); // fetching original image width and height

                    $newwidth_min = 600; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/" . $filename1, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/small/" . $filename1, 80); //copy image in folder//
                }
            }

            if ($_FILES['txtprodimg2']['name'] != "") {
                $fname2 = $_FILES['txtprodimg2']['name'];
                $purestring = str_replace(' ', '-', $fname2); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtprodimg2']['tmp_name'];
                $ext = pathinfo($post_photo, PATHINFO_EXTENSION); // getting image extension
                if ($ext == 'png' || $ext == 'PNG' ||
                    $ext == 'jpg' || $ext == 'jpeg' ||
                    $ext == 'JPG' || $ext == 'JPEG' ||
                    $ext == 'gif' || $ext == 'GIF') { // checking image extension
                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG') {
                        $src = imagecreatefromjpeg($post_photo_tmp);
                    }
                    if ($ext == 'png' || $ext == 'PNG') {
                        $src = imagecreatefrompng($post_photo_tmp);
                    }
                    if ($ext == 'gif' || $ext == 'GIF') {
                        $src = imagecreatefromgif($post_photo_tmp);
                    }

                    list($width_min, $height_min) = getimagesize($post_photo_tmp); // fetching original image width and height

                    $newwidth_min = 600; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/" . $filename2, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/small/" . $filename2, 80); //copy image in folder//
                }
            }

            if ($_FILES['txtprodimg3']['name'] != "") {
                $fname3 = $_FILES['txtprodimg3']['name'];
                $purestring = str_replace(' ', '-', $fname3); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtprodimg3']['tmp_name'];
                $ext = pathinfo($post_photo, PATHINFO_EXTENSION); // getting image extension
                if ($ext == 'png' || $ext == 'PNG' ||
                    $ext == 'jpg' || $ext == 'jpeg' ||
                    $ext == 'JPG' || $ext == 'JPEG' ||
                    $ext == 'gif' || $ext == 'GIF') { // checking image extension
                    if ($ext == 'jpg' || $ext == 'jpeg' || $ext == 'JPG' || $ext == 'JPEG') {
                        $src = imagecreatefromjpeg($post_photo_tmp);
                    }
                    if ($ext == 'png' || $ext == 'PNG') {
                        $src = imagecreatefrompng($post_photo_tmp);
                    }
                    if ($ext == 'gif' || $ext == 'GIF') {
                        $src = imagecreatefromgif($post_photo_tmp);
                    }

                    list($width_min, $height_min) = getimagesize($post_photo_tmp); // fetching original image width and height

                    $newwidth_min = 600; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/" . $filename3, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/product/small/" . $filename3, 80); //copy image in folder//
                }
            }

            $output["msg"] = "Success";
        } else {
            // createLog(mysqli_error($cn), $sql);
            $output["msg"] = "error";
        }
    } else {
        $output["msg"] = "error";
    }
} else if (isset($_POST["ajaxdata"])) {
    $ajaxdata = json_decode($_POST["ajaxdata"]);
    $action = $ajaxdata->action;
    $mydata = array();
    $mydata = $ajaxdata->mydata;

    if ($action == "getdata") {
        $query = "SELECT *, (select subcat_name from tbl_subcategory where subcat_id=tbl_products.subcat_id) as subname from tbl_products ";
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else if ($action == "getitem") {
        $id = $mydata[0]->id;
        $query = "SELECT * from tbl_products where product_id=" . $id;
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else if ($action == "setactive") {
        $id = $mydata[0]->id;
        $activeval = $mydata[0]->activevflag;
        $sql = "UPDATE tbl_employee set IsActive='" . $activeval . "' where EmployeeId=" . $id;
        $sql = mysqli_query($cn, $sql) or die(mysqli_error($cn));
        if ($sql) {
            $output["msg"] = "Success";
        } else {
            $output["msg"] = "Fail";
        }
    } else if ($action == "remove") {
        $id = $mydata[0]->id;
        $img = mysqli_query($cn, "select prod_img1,prod_img2,prod_img3 from tbl_products where product_id='" . $id . "'");
        while ($r = mysqli_fetch_array($img)) {
            $sql = "DELETE FROM tbl_products where product_id=" . $id;
            $sql = mysqli_query($cn, $sql) or die(mysqli_error($cn));
            if ($sql) {
                $output["msg"] = "Success";
                if (file_exists("images/product/" . $r['prod_img1'])) {
                    unlink("images/product/" . $r['prod_img1']);
                }
                if (file_exists("images/product/small/" . $r['prod_img1'])) {
                    unlink("images/product/small/" . $r['prod_img1']);
                }
                if (file_exists("images/product/" . $r['prod_img2'])) {
                    unlink("images/product/" . $r['prod_img2']);
                }
                if (file_exists("images/product/small/" . $r['prod_img2'])) {
                    unlink("images/product/small/" . $r['prod_img2']);
                }
                if (file_exists("images/product/" . $r['prod_img3'])) {
                    unlink("images/product/" . $r['prod_img3']);
                }
                if (file_exists("images/product/small/" . $r['prod_img3'])) {
                    unlink("images/product/small/" . $r['prod_img3']);
                }
                if (file_exists("images/product/pdf/" . $r['instruction'])) {
                    unlink("images/product/pdf/" . $r['instruction']);
                }

            } else {
                $output["msg"] = "Fail";
            }
        }
    }
} else {
    $output["msg"] = "Fail";
}
echo json_encode($output);
