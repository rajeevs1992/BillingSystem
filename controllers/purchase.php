<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	$con=new database;
	$code=strtolower($_POST['code']);
	$reply=$con->query("SELECT totalStock FROM item WHERE code='$code'");
	$row=mysql_fetch_assoc($reply);
	$cur=$row['totalStock'];
	$new=$cur+$_POST['qty'];
	$con->query("UPDATE store.item SET totalStock='$new' WHERE code='$code'");
	$con->query("INSERT INTO purchase VALUES('$code','$_POST[qty]','$_POST[date]')");
	$_SESSION['message']="Added $_POST[qty] units of $code to stock!!New stock is $new";
	header("location:/views/purchase.php");
?>
