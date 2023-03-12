<?php
session_start();
include "connection.php";
header('Content-type: application/json');

$output = array();

if (isset($_POST["hfAction"]) && $_POST["hfAction"] != "") {
    $finalname = "";
    if ($_POST["hfAction"] == "add") {
        $id = $_POST["txtempid"];
        if ($_FILES['txtempimg']['name'] != "") {
            $fname = $_FILES['txtempimg']['name'];
            $fileext = pathinfo($fname, PATHINFO_EXTENSION); // getting image extension
            $filename = "EmployeeImage_" . date('Ymdhis') . "." . $fileext;
        } else {
            $filename = $_REQUEST["oldimg"];
        }

        $sql = "";
        if ($id == "") {
            $sql = "insert into tbl_employee values(NULL,'" . $_REQUEST['txtempname'] . "','" . $_REQUEST['txtcontact'] . "','" . $_REQUEST['txtpassword'] . "','" . $filename . "','" . $_REQUEST['txtemail'] . "','" . mysqli_real_escape_string($cn, $_REQUEST['txtempadd']) . "','" . $_REQUEST['r_block'] . "',NULL)";
        } else {
            if ($_FILES['txtempimg']['name'] != "" && $_FILES['txtempimg']['name'] != null) {
                unlink("images/employee/" . $_REQUEST['oldimg']);
                unlink("images/employee/small/" . $_REQUEST['oldimg']);
            }
            $sql = "update tbl_employee set emp_name='" . mysqli_real_escape_string($cn, $_REQUEST['txtempname']) . "',emp_contact='" . mysqli_real_escape_string($cn, $_REQUEST['txtcontact']) . "',emp_img='" . $filename . "',emp_email='" . mysqli_real_escape_string($cn, $_REQUEST["txtemail"]) . "',emp_address='" . mysqli_real_escape_string($cn, $_REQUEST["txtempadd"]) . "',emp_block='" . mysqli_real_escape_string($cn, $_REQUEST["r_block"]) . "' where emp_id='" . $id . "'";
        }

        $res = mysqli_query($cn, $sql) or die(mysqli_error($cn));
        if ($res) {
            if ($_FILES['txtempimg']['name'] != "") {
                $fname = $_FILES['txtempimg']['name'];
                $purestring = str_replace(' ', '-', $fname); // Replaces all spaces with hyphens.
                $post_photo = preg_replace("/\W(?=.*\.[^.]*$)/", "", $purestring);
                $post_photo_tmp = $_FILES['txtempimg']['tmp_name'];
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
                    imagejpeg($tmp_min, "images/employee/" . $filename, 80); //copy image in folder//
                    $newwidth_min = 300; // set compressing image width
                    $newheight_min = ($height_min / $width_min) * $newwidth_min; // equation for compressed image height
                    $tmp_min = imagecreatetruecolor($newwidth_min, $newheight_min); // create frame  for compress image
                    imagecopyresampled($tmp_min, $src, 0, 0, 0, 0, $newwidth_min, $newheight_min, $width_min, $height_min); // compressing image
                    imagejpeg($tmp_min, "images/employee/small/" . $filename, 80); //copy image in folder//
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
        $query = "SELECT *,(select count(*) from tbl_ticket where emp_id=tbl_employee.emp_id and status='assign') as assign,(select count(*) from tbl_ticket where emp_id=tbl_employee.emp_id and status='completed') as complete from tbl_employee ";
        $result = mysqli_query($cn, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $output[] = $row;
        }
    } else if ($action == "getitem") {
        $id = $mydata[0]->id;
        $query = "SELECT * from tbl_employee where emp_id=" . $id;
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
        $img = mysqli_query($cn, "select emp_img from tbl_employee where emp_id='" . $id . "'");
        while ($r = mysqli_fetch_array($img)) {
            $sql = "DELETE FROM tbl_employee where emp_id=" . $id;
            $sql = mysqli_query($cn, $sql) or die(mysqli_error($cn));
            if ($sql) {
                $output["msg"] = "Success";
                if (file_exists("images/employee/" . $r['emp_img'])) {
                    unlink("images/employee/" . $r['emp_img']);
                }
                if (file_exists("images/employee/small/" . $r['emp_img'])) {
                    unlink("images/employee/small/" . $r['emp_img']);
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
