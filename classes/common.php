<?php
	class page
	{
		public function __construct($title)
		{
			$spaces="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
			&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
			$buttonLink="<a href='%s' ><input type=submit value='%s' 
			style=display:inline;height:25px;left:%s;top:100;position:absolute></a>$spaces";
			$header="
				<html>
				<font face=ubuntu>
				<title>$title</title>
				<h1><center>$title</center></h1>
				<div style=top:50;left:350;position:absolute;>
					KGST No 26120286$spaces CST No 25125286$spaces TIN 32080668625$spaces
				</div>
				<br><br><br><br>
				<body background='/views/images/gr1.jpg' vlink=blue>";
			echo $header;
			echo sprintf($buttonLink,"/views/bill.php","New Bill","5");
			echo sprintf($buttonLink,"/","Add new item","150");
			echo sprintf($buttonLink,"/","Delete item","350");
			echo sprintf($buttonLink,"/","View Monthly Statement","540");
			echo sprintf($buttonLink,"/","View Full Stock Data","800");
			echo sprintf($buttonLink,"/","Logout","1024");
		}
		
	};
?>



