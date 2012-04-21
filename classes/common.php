<?php
	class page
	{
		public function __construct($title)
		{
/*			session_start();
			if($_SESSION['head_flag']=='admin')
				$home="/admin/views/adminHome.php";
			else
				$home="/controllers/homePage.php";*/
			$header="
				<html>
				<font face=ubuntu>
				<title>$title</title>
				<h1><center>$title</center></h1>
				<body background='/views/images/bg.jpg' vlink=blue>";
			echo $header;
		}
		
	};
?>



