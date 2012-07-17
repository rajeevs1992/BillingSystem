<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	if(isset($_SESSION['uname']))
		header("location:/views/login.php");
	$con=new database;
	if(strlen($_POST['code']))
	{
		$con->query("DELETE FROM item WHERE code='$_POST[code]'");
	}
	header("location:/views/bill.php");
?>
