<?php
header('Content-type: application/json');
include '../connection.php';

$sql = "SELECT count(*) as number FROM tbl_notifications ORDER BY notification_id";
$result = mysql_query($sql) or die ("Query error: " . mysql_error());

$records = array();

while($row = mysql_fetch_assoc($result)) {
	$records[] = $row;
}

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>