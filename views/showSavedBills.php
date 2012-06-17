<?php
	require_once("../classes/database.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Engineering College Co-Operative Society Ltd,R-51",1);
	$con=new Database();
	$query="SELECT DISTINCT tempBillNo,Date FROM temp";
	$reply=$con->query($query);
	$link="<a href='tempBill.php?billno=%s'><font color='grey'><strong>Temporary Bill No.%s</strong></font><br></a>";
	echo "<form action=../controllers/deleteAllTempBills.php method=post><table border='1'>
	<tr><th>Bill</th><th>Date and Time</th>";
        while($row=mysql_fetch_assoc($reply)){
			$tempLink=sprintf($link,$row['tempBillNo'],$row['tempBillNo']);
			echo "<tr><td>".$tempLink."</td><td>".$row['Date']."</td></tr>";
	}
	echo "</table><br><input type=submit value='Delete all temporary Bills'>
	</form>";
?>
