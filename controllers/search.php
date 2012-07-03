<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$con=new database;
	if($_GET['mode']=='1')
	{
		$reply=$con->query("SELECT * FROM item WHERE code LIKE '%$_GET[val]%'");
	}
	else
	{
		$reply=$con->query("SELECT * FROM item WHERE name LIKE '%$_GET[val]%'");
	}
	if($reply!=0)
	{
		$a=array();
		$i=0;
		while($row=mysql_fetch_assoc($reply))
		{
			$a[$i++]=$row;
		}
		echo json_encode($a);
	}
?>
