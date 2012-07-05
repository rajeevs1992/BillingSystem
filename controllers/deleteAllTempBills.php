<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$con->query("DELETE FROM temp");
	header("location:/views/showSavedBills");
?>
