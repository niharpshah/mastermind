<?php
header('Content-type:application/json');

include 'connection.php';

$res = mysqli_query($cn, "delete from tbl_category where cat_id='" . $_REQUEST["did"] . "'") or die(mysqli_error($cn));

if ($res) {
    echo '{"msg":"Success"}';
} else {
    echo '{"msg":"Error"}';
}
?>

<?php /*?>else if ($action == "remove") {
$id = $mydata[0]->id;
$img = mysqli_query($cn,"select cat_img from tbl_category where cat_id='" . $id . "'");
while ($r = mysql_fetch_array($img)) {
$sql = "DELETE FROM tbl_category where cat_id=" . $id;
$sql = mysqli_query($cn,$sql) or die(mysql_error());
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
<?php */?>