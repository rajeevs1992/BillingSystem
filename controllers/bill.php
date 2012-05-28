<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$i=1;
	$queryTotals="INSERT INTO totals VALUES(
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
	cashOrCredit='%s')";
	while($i<51)
	{
		if(strlen($_POST["code$i"])!=0)
		{
		//post contains billNo,PplusT,code,qty,taxAmt,cess,total,total
			$code=mysql_escape_string($_POST["code$i"]);	
			$qty=mysql_escape_string($_POST["qty$i"]);	
			$reply=$con->query("SELECT * FROM item WHERE code='$code'");
			$reply=mysql_fetch_assoc($reply);
			$query=sprintf($queryTotals,$_POST['billNo'],
			$reply='';

		}
		$i++;
	}
	echo $j;
?>
