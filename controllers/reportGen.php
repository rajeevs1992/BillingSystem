<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$con=new database;
	if(isset($_GET['mode']))
		$m=date('m');
	else
		$m=date('m')-1;
	$reply=$con->query("SELECT * FROM sales WHERE MONTH(date)=$m");
	session_start();
	if(!isset($_SESSION['uname']))
		header("location:/views/login.php");
	else
	{
		if(isset($_GET['mode']))
		{
			$var=date("FY", mktime(0, 0, 0, (date('m')))); 
			$file_name="$_SERVER[DOCUMENT_ROOT]/reports/sales/$var"."_temp.csv";
		}
		else
		{
			$var=date("FY", mktime(0, 0, 0, (date('m')-1))); 
			$file_name="$_SERVER[DOCUMENT_ROOT]/reports/sales/$var.csv";
		}
		$handle=fopen($file_name,"w");
		$heads="BILL NO,DATE,NON-TAXABLE SALES,AMT-$tax1%,AMT-$tax2%,TAX-$tax1%,TAX-$tax2%,TOTAL WITHOUT TAX,CASH-CREDIT\n";
		fwrite($handle,$heads);
		$headNos="1,2,3,4,5,6,7,8(3+4+5),9\n\n";
		fwrite($handle,$headNos);
		while($row=mysql_fetch_array($reply,MYSQL_NUM))
		{
			$str='';
			foreach($row as &$tmp)
			{
				$str=$str."$tmp,";
			}
			$str=$str."\n";
			fwrite($handle,$str);
		}
		fclose($handle);
		if(isset($_GET['mode']))
			$file_name="$_SERVER[DOCUMENT_ROOT]/reports/purchases/$var"."_temp.csv";
		else
		{
			$file_name="$_SERVER[DOCUMENT_ROOT]/reports/purchases/$var.csv";
			$con->query("UPDATE item SET openingStock=totalStock");
		}
		$handle=fopen($file_name,"w");
		$reply=$con->query("SELECT inv_no,date,name,qty,rot,pp,taxAmt,`from` FROM purchase WHERE MONTH(date)=$m");
		$heads="INVOICE NO,DATE,ITEM NAME,QUANTITY,RATE OF TAX,PURCHASE PRICE,TAX PAID,PURCHASED FROM\n";
		fwrite($handle,$heads);
		while($row=mysql_fetch_array($reply,MYSQL_NUM))
		{
			$str='';
			foreach($row as &$tmp)
			{
				$str=$str."$tmp,";
			}
			$str=$str."\n";
			fwrite($handle,$str);
		}
		fclose($handle);
	}
	header("location:/views/bill.php");
?>
			


	
