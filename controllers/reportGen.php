<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$m=date('m');
	$reply=$con->query("SELECT * FROM sales WHERE MONTH(date)=$m");
	session_start();
	if(!isset($_SESSION['uname']))
		header("location:/views/login.php");
	else
	{
		$file_name="$_SERVER[DOCUMENT_ROOT]/reports/".date("FY").".csv";
		$handle=fopen($file_name,"w");
		$heads="
		BILL NO,DATE,NON-TAXABLE SALES,AMT-4%,AMT-12.5%,TAX-4%,TAX-12.5%,CESS-4%,CESS-12.5%,TOTAL WITHOUT TAX,CASH-CREDIT\n";
		fwrite($handle,$heads);
		$headNos="1,2,3,4,5,6,7,8,9,10(3+4+5),11\n\n";
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
			


	
