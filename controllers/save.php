<html>
<head>
<?php
	require_once("../classes/database.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Engineering College Co-Operative Society Ltd,R-51",1);
	$con=new Database();
	$query=("SELECT MAX(tempBillNo)+1 AS no FROM temp");
	$reply=$con->query($query);
	if($reply){
		$reply=mysql_fetch_assoc($reply);
		$tempNo=$reply['no'];
		if($tempNo==NULL)
			$tempNo=0;
	}
	$query="INSERT INTO temp VALUES('$tempNo','%s','%s',CURRENT_TIMESTAMP())";
	$flag=0;
	for($i=1;$i<51;$i++){
			if($_POST["code".$i]!=NULL){
				$tempQuery=sprintf($query,$_POST["code".$i],$_POST["qty".$i]);
				$reply=$con->query($tempQuery);
				$flag=1;
			}
	}
	if($flag){
		echo "<script type='text/javascript'>
			alert('Temporary Bill Number : $tempNo');
			window.location='/views/bill.php';
		</script>";
	}
	else{
		echo "<script type='text/javascript'>
			alert('Nothing to save!');
			window.location='/views/bill.php';
		</script>";
	}
?>
</head>
</html>
