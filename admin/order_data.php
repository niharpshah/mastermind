<?php
session_start();
include "connection.php";
header('Content-type: application/json');

$output = array();

if (isset($_POST["hfAction"]) && $_POST["hfAction"] != "") {
    $finalname = "";
    if ($_POST["hfAction"] == "add") {
        $id = $_POST["txtoid"];
        if ($_FILES['txtcatimg']['name'] != "") {
            $fname = $_FILES['txtcatimg']['name'];
            $fileext = pathinfo($fname, PATHINFO_EXTENSION); // getting image extension
            $filename = "CategoryImage" . date('Ymdhis') . "." . $fileext;
            unlink("images/category/" . $_REQUEST['oldimg']);
            unlink("images/category/small/" . $_REQUEST['oldimg']);
        } else {
            $filename = $_REQUEST["oldimg"];
        }

        $sql = "";
        if ($id == "") {
            $sql = "insert into tbl_order values(NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL)";
        } else {
            $sql = "update tbl_order set status='" . $_REQUEST['txtsat'] . "' where order_id='" . $id . "'";
        }

        $res = mysqli_query($cn, $sql) or die(mysqli_error($cn));
        if ($res) {
            if ($_FILES['txtcatimg']['name'] != "") {
                $fname = $_FILES['txtcatimg']['name'];
                $purestring = str_replace(' ', '-', $fname); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtcatimg']['tmp_name'];
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
                    imagejpeg($tmp_min, "images/category/" . $filename, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/category/small/" . $filename, 80); //copy image in folder//
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
        $query = "SELECT *,(select user_name from tbl_user where user_id=tbl_order.user_id) as uname from tbl_order";
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }

    } else if ($action == "getdataorder") {
        $query = "SELECT *,(SELECT product_name from tbl_products where product_id=tbl_order_detail.product_id) as pname,(SELECT prod_img1 from tbl_products where product_id=tbl_order_detail.product_id) as pimg,(SELECT subcat_name from tbl_subcategory where subcat_id=(SELECT subcat_id from tbl_products where product_id=tbl_order_detail.product_id)) as des from tbl_order_detail where order_id=" . $id;
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else if ($action == "getitem") {
        $id = $mydata[0]->id;
        $query = "SELECT * from tbl_order_detail where order_id=" . $id;
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
        $img = mysqli_query($cn, "select cat_img from tbl_category where cat_id='" . $id . "'");
        while ($r = mysqli_fetch_array($img)) {
            $sql = "DELETE FROM tbl_category where cat_id=" . $id;
            $sql = mysqli_query($cn, $sql) or die(mysqli_error($cn));
            if ($sql) {
                $output["msg"] = "Success";
                if (file_exists("images/category/" . $r['cat_img'])) {
                    unlink("images/category/" . $r['cat_img']);
                }
                if (file_exists("images/category/small/" . $r['cat_img'])) {
                    unlink("images/category/small/" . $r['cat_img']);
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
