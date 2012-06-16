<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	$con=new database;
	$i=1;
	while($i<10)
	{
		if(strlen($_POST["code$i"])!=0)
		{
			$SP=round(($_POST["unitPrice$i"]+($_POST["unitPrice$i"]*$_POST["rateOfTax$i"]*.01)),3);
			$profitPerUnit=$SP-$_POST["PurchasePrice$i"];
			$code=$_POST["code$i"];
			$name=$_POST["name$i"];
			$mrp=$_POST["mrp$i"];
			$up=$_POST["unitPrice$i"];
			$rot=$_POST["rateOfTax$i"];
			$pp=$_POST["PurchasePrice$i"];
			$qty=$_POST["qty$i"];
			$con->query("INSERT INTO item VALUES('$code','$name','$mrp','$up','$rot','$SP','$pp','$profitPerUnit','$qty','0')");
		}
		$i++;
	}
	header("location:/");
?>
