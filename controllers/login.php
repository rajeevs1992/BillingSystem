<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$uname=mysql_escape_string($_POST['uname']);
	$passwd=sha1($_POST['passwd']);
	$reply=$con->query("SELECT uname,acessLevel FROM users WHERE uname='$uname' AND passwd='$passwd'");
	if($reply!=0)
	{
		session_start();
		$reply=mysql_fetch_assoc($reply);
		$_SESSION['uname']=$reply['uname'];
		$_SESSION['acessLevel']=$reply['acessLevel'];
		$var=date("FY", mktime(0, 0, 0, (date('m')-1))); 
		if(file_exists($_SERVER['DOCUMENT_ROOT']."/reports/$var.csv"))
		{
			header("location:/views/bill.php");
		}
		else
		{
			header("location:/controllers/reportGen.php");
		}
	}
	else
	{
		echo "	<script type='text/javascript'>
				alert('Wrong Password or Username!!!');
				</script>";
		header("location:/views/login.php");
	}
?>
