<?php
session_start();
unset($_SESSION['logid']);
unset($_SESSION['uname']);
header("location:index.php");
?>