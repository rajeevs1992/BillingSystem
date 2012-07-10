<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	$con=new database;
	$code=strtolower($_POST['code']);
	if($_POST['write']=='0')
	{
		$reply=$con->query("SELECT totalStock FROM item WHERE code='$code'");
		$row=mysql_fetch_assoc($reply);
		$cur=$row['totalStock'];
		$new=$cur+$_POST['qty'];
		$con->query("UPDATE store.item SET totalStock='$new' WHERE code='$code'");
		$con->query("INSERT INTO purchase VALUES('$code','$_POST[qty]','$_POST[date]')");
		$_SESSION['message']="Added $_POST[qty] units of $code to stock!!New stock is $new";
		header("location:/views/purchase.php");
	}
	else
	{
		if($_POST['profitmode']=='1')
			$unitPrice=round(($_POST['pp']+$_POST['profit']),2);
		else
			$unitPrice=round(($_POST['pp']+($_POST['pp']*$_POST['profit']/100)),2);
		$con->query("INSERT INTO purchase VALUES('$code','$_POST[qty]','$_POST[date]')");
?>
