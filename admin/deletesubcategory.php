<?php
header('Content-type:application/json');

include 'connection.php';

$res = mysqli_query($cn, "delete from tbl_subcategory where subcat_id='" . $_REQUEST["did"] . "'") or die(mysqli_error($cn));

if ($res) {
    echo '{"msg":"Success"}';
} else {
    echo '{"msg":"Error"}';
}
