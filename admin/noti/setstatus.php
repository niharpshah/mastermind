<?php
header('Content-type:application/json');

include '../connection.php';

$res=mysql_query("update tbl_notifications set complete_status='YES'")or die (mysql_error());


if($res)
	{
 	echo $_GET['jsoncallback'] .'([{"msg":"Update Successfully"}])';
	}
	else
	{
	 echo $_GET['jsoncallback'] .'([{"msg":"Error Updateing Data"}])';
	}
?>
