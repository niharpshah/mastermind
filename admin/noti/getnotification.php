<?php
header('Content-type: application/json');
include '../connection.php';

$sql = "SELECT *, (select user_name from tbl_user where user_id=(select user_id from tbl_ticket where ticket_id=tbl_notifications.ticket_id)) as ticketnoti FROM  tbl_notifications ORDER BY notification_id";
$result = mysql_query($sql) or die ("Query error: " . mysql_error());

$records = array();

while($row = mysql_fetch_assoc($result)) {
	$records[] = $row;
}

echo $_GET['jsoncallback'] . '(' . json_encode($records) . ');';
?>