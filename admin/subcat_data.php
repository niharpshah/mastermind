<?php
session_start();
include "connection.php";
header('Content-type: application/json');

$output = array();

if (isset($_POST["hfAction"]) && $_POST["hfAction"] != "") {
    $finalname = "";
    if ($_POST["hfAction"] == "add") {
        $id = $_POST["txtsubcatid"];
        if ($_FILES['txtsubcatimg']['name'] != "") {
            $fname = $_FILES['txtsubcatimg']['name'];
            $fileext = pathinfo($fname, PATHINFO_EXTENSION); // getting image extension
            $filename = "Sub-CategoryImage" . date('Ymdhis') . "." . $fileext;

        } else {
            $filename = $_REQUEST["oldimg"];
        }

        $sql = "";
        if ($id == "") {
            $sql = "insert into tbl_subcategory values(NULL,'" . $_REQUEST['txtcatname'] . "','" . $_REQUEST['txtsubcatname'] . "','" . mysqli_real_escape_string($cn, $_REQUEST['txtsubcatdes']) . "','" . $filename . "')";
        } else {
            if ($_FILES['txtsubcatimg']['name'] != "") {
                unlink("images/subcategory/" . $_REQUEST['oldimg']);
                unlink("images/subcategory/small/" . $_REQUEST['oldimg']);
            }
            $sql = "update tbl_subcategory set cat_id='" . mysqli_real_escape_string($cn, $_REQUEST['txtcatname']) . "',subcat_name='" . mysqli_real_escape_string($cn, $_REQUEST['txtsubcatname']) . "',subcat_desc='" . mysqli_real_escape_string($cn, $_REQUEST["txtsubcatdes"]) . "',subcat_img='" . $filename . "' where subcat_id='" . $id . "'";
        }

        $res = mysqli_query($cn, $sql) or die(mysqli_error($cn));
        if ($res) {
            if ($_FILES['txtsubcatimg']['name'] != "") {
                $fname = $_FILES['txtsubcatimg']['name'];
                $purestring = str_replace(' ', '-', $fname); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtsubcatimg']['tmp_name'];
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
                    imagejpeg($tmp_min, "images/subcategory/" . $filename, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/subcategory/small/" . $filename, 80); //copy image in folder//
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
        $query = "SELECT *, (select cat_name from tbl_category where cat_id=tbl_subcategory.cat_id) as catname from tbl_subcategory ";
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else if ($action == "getitem") {
        $id = $mydata[0]->id;
        $query = "SELECT * from tbl_subcategory where subcat_id=" . $id;
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
        $img = mysqli_query($cn, "select subcat_img from tbl_subcategory where subcat_id='" . $id . "'");
        while ($r = mysqli_fetch_array($img)) {
            $sql = "DELETE FROM tbl_subcategory where subcat_id=" . $id;
            $sql = mysqli_query($cn, $sql) or die(mysqli_error($cn));
            if ($sql) {
                $output["msg"] = "Success";
                if (file_exists("images/subcategory/" . $r['subcat_img'])) {
                    unlink("images/subcategory/" . $r['subcat_img']);
                }
                if (file_exists("images/subcategory/small/" . $r['subcat_img'])) {
                    unlink("images/subcategory/small/" . $r['subcat_img']);
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
