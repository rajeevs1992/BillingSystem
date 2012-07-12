<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	session_start();
	$con=new database;
	if($_POST['write']=='0')
	{
		if(isset($_POST['no']) && isset($_POST['code']) && isset($_POST['qty']) && isset($_POST['from']))
		{
			$code=strtolower($_POST['code']);
			$reply=$con->query("SELECT totalStock,rateOfTax,purchasingPrice,name FROM item WHERE code='$code'");
			$row=mysql_fetch_assoc($reply);
			$cur=$row['totalStock'];
			$new=$cur+$_POST['qty'];
			$tax=getTax($row['rateOfTax'],$row['purchasingPrice']);
			$con->query("UPDATE item SET totalStock='$new' WHERE code='$code'");
			$con->query("INSERT INTO purchase SET
			inv_no='$_POST[no]',
			code='$code',
			name='$row[name]',
			qty='$_POST[qty]',
			rot='$row[rateOfTax]',
			pp='$row[purchasingPrice]',
			taxAmt='$tax',
			from='$_POST[from]',
			date='$_POST[date]'");
			$_SESSION['message']="Added $_POST[qty] units of $code to stock!!Ne stock is $new";
			header("location:/views/purchase.php");
		}
		else
			$_SESSION['message']="All fields marked * are mandatory!!!";
	}
	else
	{
		if(isset($_POST['no']) && isset($_POST['code']) && isset($_POST['name']) && isset($_POST['qty']) && isset($_POST['pp'])  && isset($_POST['profit']) && isset($_POST['from']))
		{
			$code=strtolower($_POST['code']);
			$pp=$_POST['pp'];
			if($_POST['profitmode']=='1')
				$unitPrice=round(($pp+$_POST['profit']),2);
			else
				$unitPrice=round(($pp+($pp*$_POST['profit']/100)),2);
			$con->query("INSERT INTO item SET 
			code='$code',
			name='$_POST[iname]',
			mrp='$_POST[mrp]',
			unitPrice='$unitPrice',
			rateOfTax='$_POST[rot]',
			purchasingPrice='$pp',
			profit='$_POST[profit]',
			profitMode='$_POST[profitmode]',
			totalStock='$_POST[qty]',
			openingStock='$_POST[qty]'");
			$tax=getTax($_POST['rot'],$pp);

			$con->query( "INSERT INTO purchase SET
			inv_no='$_POST[no]',
			code='$code',
			name='$_POST[iname]',
			qty='$_POST[qty]',
			rot='$_POST[rot]',
			pp='$pp',
			taxAmt='$tax',
			`from`='$_POST[from]',
			date='$_POST[date]'");
			$_SESSION['message']="Added $_POST[qty] units of $code to stock!!New stock is $_POST[qty]";
			header("location:/views/purchase.php");
		}
		else
			$_SESSION['message']="All fields marked * are mandatory!!!";
	header("location:/views/purchase.php");

	}

	function getTax($rot,$pp)
	{
		include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
		if($rot==1)
			$rot=$tax1;
		else if($rot==2)
			$rot=$tax2;
		$up=$pp*100/($rot+100);
		$tax=round(($up*$_POST['qty']*$rot/100),2);
		return $tax;
	}

?>
