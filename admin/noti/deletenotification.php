<?php
header('Content-type:application/json');

include '../connection.php';

$res=mysql_query("delete from tbl_notifications where notification_id='".$_REQUEST["id"]."'")or die (mysql_error());


if($res)
	{
 	echo $_GET['jsoncallback'] .'([{"msg":"Delete Successfully"}])';
	}
	else
	{
	 echo $_GET['jsoncallback'] .'([{"msg":"Error Updateing Data"}])';
	}
?>
