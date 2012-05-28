<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	$uname=mysql_escape_string($_POST['uname']);
	$passwd=sha1($_POST['passwd']);
	$reply=$con->query("SELECT uname,acessLevel FROM users WHERE uname='$uname' AND passwd='$passwd'");
	if($reply!=0)
	{
		$reply=mysql_fetch_assoc($reply);
		session_start();
		$_SESSION['uname']=$reply['uname'];
		$_SESSION['acessLevel']=$reply['acessLevel'];
		header("location:/views/bill.php");
	}
	else
	{
		echo "	<script type='text/javascript'>
				alert('Wrong Password or Username!!!');
				</script>";
		header("location:/views/login.php");
	}
?>
