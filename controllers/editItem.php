<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	if(isset($_SESSION['uname']))
		header("location:/views/login.php");
	$con=new database;
	if(strlen($_POST['code']) && strlen($_POST['iname']) && strlen($_POST['ts']) && strlen($_POST['pp'])  && strlen($_POST['profit']) && strlen($_POST['mrp']))
	{
		
		$code=strtolower($_POST['code']);
		$pp=$_POST['pp'];
		if($_POST['profitmode']=='1')
			$unitPrice=round(($pp+$_POST['profit']),2);
		else
			$unitPrice=round(($pp+($pp*$_POST['profit']/100)),2);
		$con->query( "UPDATE item SET 
			name='$_POST[iname]',
			mrp='$_POST[mrp]',
			unitPrice='$unitPrice',
			rateOfTax='$_POST[rot]',
			purchasingPrice='$pp',
			profit='$_POST[profit]',
			profitMode='$_POST[profitmode]',
			totalStock='$_POST[ts]' 
			WHERE code='$code'");
	}
	else
		$_SESSION['message']='All fields are mandatory!!!!';
	header("location:/views/editItem.php");
?>
