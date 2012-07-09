<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");

	session_start();
	$con=new database;
	$i=1;
	$querySales="INSERT INTO sales SET
	billNo='%s',
	date=CURDATE(),
	salesNonTax='%s',
	tax1sales='%s',
	tax2sales='%s',
	tax1='%s',
	tax2='%s',
	totalWithoutTax='%s',
	cashOrCredit='%s'";

	$queryInvoice="INSERT INTO invoices SET
	slNo='%s',
	mrp='%s',
	PplusT='%s',
	name='%s',
	code='%s',
	qty='%s',
	unitPrice='%s',
	rateOfTax='%s',
	taxAmt='%s',
	total='%s',
	billNo='%s',
	user='%s'";

	$reply=$con->query("SELECT MAX(billNo) AS billNo FROM invoices");
	if($reply!=0)
		$billNo=mysql_fetch_assoc($reply);
	$billNo=$billNo['billNo']+1;

	while($i<51)
	{
		if(strlen($_POST["code$i"])!=0)
		{
			$code=mysql_escape_string($_POST["code$i"]);	
			$qty=mysql_escape_string($_POST["qty$i"]);	
			$reply=$con->query("SELECT * FROM item WHERE code='$code'");
			if($reply!=0)
				$reply=mysql_fetch_assoc($reply);
			if($reply['rateOfTax']==1)
				$reply['rateOfTax']=$tax1;
			else if($reply['rateOfTax']==2)
				$reply['rateOfTax']=$tax2;
			$query=sprintf($queryInvoice,
			$i,$reply['mrp'],$_POST["PplusT$i"],
			$reply['name'],$reply['code'],$qty,
			$reply['unitPrice'],$reply['rateOfTax'],
			$_POST["taxAmt$i"],
			$_POST["total$i"],$billNo,$_SESSION['uname']);
			$con->query($query);
			$query='';
			
			$query="UPDATE item SET totalStock = (totalStock - $qty)  WHERE code='$code' ";
			$con->query($query);
		}
		$i++;
	}
	$query="SELECT SUM(total) AS total FROM invoices WHERE billNo='$billNo' AND rateOfTax='0'";
	$reply=$con->query($query);
	if($reply!=0)
		$reply=mysql_fetch_assoc($reply);
	$SnonTax=$reply['total'];
	$query='';
	$reply='';

	$query="SELECT SUM(total) AS total,SUM(taxAmt) AS tax FROM invoices 
	WHERE billNo='$billNo' AND rateOfTax='$tax1'";
	$reply=$con->query($query);
	if($reply!=0)
		$reply=mysql_fetch_assoc($reply);
	$S_t1=$reply['total'];
	$T_t1=$reply['tax'];
	$query='';
	$reply='';

	$query="SELECT SUM(total) AS total,SUM(taxAmt) AS tax FROM invoices 
	WHERE billNo='$billNo' AND rateOfTax='$tax2'";
	$reply=$con->query($query);	
	if($reply!=0)
		$reply=mysql_fetch_assoc($reply);
	$S_t2=$reply['total'];
	$T_t2=$reply['tax'];
	$query='';
	$reply='';
	
	$totalWithoutTax=$SnonTax+$S_t1+$S_t2;
	$query=sprintf($querySales,$billNo,$SnonTax,$S_t1,$S_t2,
	$T_t1,$T_t2,$totalWithoutTax,'CA');
	$con->query($query);
	$query='';


	header("location:/views/print.php?billNo=$billNo");
?>
