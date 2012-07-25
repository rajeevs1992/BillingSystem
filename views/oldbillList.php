<html>
<head>
	<link rel="stylesheet" type="text/css" media="all" href="date.css" />
	<script type="text/javascript" src="date.js"></script>
</head>
<style type=text/css>
	td
	{
		width:50px;
	}
</style>



<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$page=new page("Print Old bill",1);
	$con=new database;
	if(isset($_SESSION['message']))
	{
	echo "
		<script type=text/javascript>
			alert('$_SESSION[message]');
			return;
		</script>";
		unset($_SESSION['message']);
	}
	$reply=$con->query("SELECT billNo FROM sales WHERE date='$_POST[date]'");
	if($reply!=0)
	{
		echo "Select bill number <br>
		<form method=get action=/views/print.php>
		<select name=billNo>";
		while($row=mysql_fetch_assoc($reply))
		{
			echo "<option value=$row[billNo]>$row[billNo]</option>";
		}
		echo "</select><input type=submit value=Print>";
	}
?>
