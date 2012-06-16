<?php
	class page
	{
		public function __construct($title,$level)
		{
			error_reporting(E_ALL);
			session_start();
			if((!isset($_SESSION['uname'])) || $_SESSION['acessLevel']<$level)
			{
				header("location:/views/login.php");
			}
			$spaces="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$buttonLink="<a href='%s' ><input type=submit value='%s' 
			style=display:inline;height:25px;left:%s;position:relative></a>$spaces";
			$header="
				<html>
				<font face=ubuntu>
				<title>$title</title>
				<h1><center>$title</center></h1>
				<div style=left:350;position:relative;>
					KGST No 26120286$spaces CST No 25125286$spaces TIN 32080668625$spaces
				</div>
				<br>
				<body style='background:url(/views/images/gr1.jpg);position:fixed;' vlink=blue>";
			echo $header;
			echo sprintf($buttonLink,"/views/bill.php","New Bill","50");
			echo sprintf($buttonLink,"/views/addItem.php","Add new item","50");
			echo sprintf($buttonLink,"/","Delete item","50");
			echo sprintf($buttonLink,"/","View Monthly Statement","50");
			echo sprintf($buttonLink,"/views/fullStockData.php","View Full Stock Data","50");
			echo sprintf($buttonLink,"/views/purchase.php","Purchase","50");
			echo sprintf($buttonLink,"/controllers/logout.php","Logout","50");
			echo "<br>";
		}
		public function getBillNo()
		{
			require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
			$con=new database;
			$reply=$con->query("select max(billNo) from invoices");
			$reply=mysql_fetch_assoc($reply);
			return ($reply['max(billNo)']+1);
		}

		
		
	};
?>



