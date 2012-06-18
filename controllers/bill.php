<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");

	session_start();
	$con=new database;
	$i=1;
	$querySales="INSERT INTO sales SET
	billNo='%s',
	date=CURDATE(),
	salesNonTax='%s',
	sales4pcTax='%s',
	sales125pcTax='%s',
	tax4pc='%s',
	tax125pc='%s',
	cess4pc='%s',
	cess125pc='%s',
	totalWithoutTax='%s',
	cashOrCredit='%s',
	user='%s'";

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
	cess='%s',
	total='%s',
	billNo='%s'";

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
			$query=sprintf($queryInvoice,
			$i,$reply['mrp'],$_POST["PplusT$i"],
			$reply['name'],$reply['code'],$qty,
			$reply['unitPrice'],$reply['rateOfTax'],
			$_POST["taxAmt$i"],$_POST["cess$i"],
			$_POST["total$i"],$billNo);
			$con->query($query);
			$query='';
			
			$query="UPDATE item SET totalStock = (totalStock - $qty)  WHERE code='$code' ";
			echo $query;
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

	$query="SELECT SUM(total) AS total,SUM(taxAmt) AS tax,SUM(cess) as cess FROM invoices 
	WHERE billNo='$billNo' AND rateOfTax='4'";
	$reply=$con->query($query);
	if($reply!=0)
		$reply=mysql_fetch_assoc($reply);
	$S4=$reply['total'];
	$T4=$reply['tax'];
	$C4=$reply['cess'];
	$query='';
	$reply='';

	$query="SELECT SUM(total) AS total,SUM(taxAmt) AS tax,SUM(cess) AS cess FROM invoices 
	WHERE billNo='$billNo' AND rateOfTax='12.5'";
	$reply=$con->query($query);	
	if($reply!=0)
		$reply=mysql_fetch_assoc($reply);
	$S125=$reply['total'];
	$T125=$reply['tax'];
	$C125=$reply['cess'];
	$query='';
	$reply='';
	
	$totalWithoutTax=$SnonTax+$S4+$S125;
	$query=sprintf($querySales,$billNo,$SnonTax,$S4,$S125,
	$T4,$T125,$C4,$C125,$totalWithoutTax,'C',$_SESSION['uname']);
	$con->query($query);
	$query='';

	header("location:/");

?>
