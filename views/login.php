<?php
	session_start();
	if(isset($_SESSION['uname']))
		header("location:/views/bill.php");
?>
<html>
<body background=/views/images/gr1.jpg>
<font face=ubuntu>
<title>Login</title>
<h1>The Govt Engineering College,Thrissur</h1>
<h2>The Engineering College Co-Operative Store Ltd</h2>
<a href=/test/test.php >Test</a>
<div style='right:90px;top:150px;border:3px black solid;position:absolute'>
<br>
<h3>&nbsp;Sign In</h3>
<form action=/controllers/login.php method=post name=login>
&nbsp;Username:<input type=text id=uname name=uname style='height:25px;left:5px;position:relative'>&nbsp;
<br><br>
&nbsp;Password:&nbsp;<input type=password id=passwd name=passwd style='height:25px;left:5px;position:relative'>&nbsp;
<br><br>
<input type=submit value='Sign In' style='height:25px;left:5px;position:relative'>
<br><br><br>
</form>
</div>
</font>
</body>
</html>
