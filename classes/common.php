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
			$buttonLink="<th><a href='%s' ><input type=submit value='%s' style=height:25px;width:130px></a></th>";
			$header="
				<html>
				<font face=ubuntu>
				<title>$title</title>
				<h1><center>$title</center></h1>
				<br>
				<body style='background:url(/views/images/gr1.jpg)' vlink=blue>";
			echo "$header
				<table border=1>
				<tr>";
			echo sprintf($buttonLink,"/views/bill.php","New Bill");
			echo sprintf($buttonLink,"/views/showSavedBills","Saved Bills");
			echo sprintf($buttonLink,"/views/controlPanel.php","Control Panel");
			echo sprintf($buttonLink,"/controllers/logout.php","Logout");
			echo "</tr></table>";	
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
	class controlPanelPage
	{
		public function __construct($title,$level)
		{
			error_reporting(E_ALL);
			session_start();
			if((!isset($_SESSION['uname'])) || $_SESSION['acessLevel']<$level)
			{
				header("location:/views/login.php");
			}
			$buttonLink="<th><a href='%s' ><input type=submit value='%s' style=height:40px;width:150px></a></th>";
			$header="
				<html>
				<font face=ubuntu>
				<title>$title</title>
				<h1><center>$title</center></h1>
				<br>
				<body style='background:url(/views/images/gr1.jpg)' vlink=blue>";
			echo "$header
				<table border=1>
				<tr>";
			echo sprintf($buttonLink,"/views/bill.php","New Bill");
			echo sprintf($buttonLink,"/views/showSavedBills","Saved Bills");
			echo sprintf($buttonLink,"/views/addItem.php","Add new item");
			echo sprintf($buttonLink,"/","Delete item");
			echo sprintf($buttonLink,"/views/monthlyReport.php","Monthly Statement");
			echo sprintf($buttonLink,"/views/fullStockData.php","Full Stock");
			echo sprintf($buttonLink,"/views/purchase.php","Purchase");
			echo sprintf($buttonLink,"/controllers/logout.php","Logout");
			echo "</tr></table>";	
		}
	};
?>
