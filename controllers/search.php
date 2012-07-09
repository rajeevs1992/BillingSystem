<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$con=new database;
	$mode=$_GET['mode'];
	$val=$_GET['val'];
	$reply='';
	if($mode=='1')
	{
		$reply=$con->query("SELECT * FROM item WHERE name LIKE '%$val%' OR code LIKE '%$val%'");
	}
	else
	{
		if($val!='')
			$reply=$con->query("SELECT code,name,totalStock FROM item WHERE name LIKE '%$val%' OR code LIKE '%$val%'");
		else
		{
			echo json_encode('');
			exit(0);
		}

	}
	$a=array();
	if($reply!=0)
	{
		$i=0;
		while($row=mysql_fetch_assoc($reply))
		{
			if($row['rateOfTax']==1)
				$row['rateOfTax']=$tax1;
			else if($row['rateOfTax']==2)
				$row['rateOfTax']=$tax2;
			$a[$i++]=$row;
		}
	}
	echo json_encode($a);
?>
