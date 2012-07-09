<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$con=new database;
	$m=date('m')-1;
	$reply=$con->query("SELECT * FROM sales WHERE MONTH(date)=$m");
	session_start();
	if(!isset($_SESSION['uname']))
		header("location:/views/login.php");
	else
	{
		$var=date("FY", mktime(0, 0, 0, (date('m')-1))); 
		$file_name="$_SERVER[DOCUMENT_ROOT]/reports/$var.csv";
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
	}
	header("location:/views/bill.php");
?>
			


	
