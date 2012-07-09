<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$page=new page("Current Month Reports",3);
	$con=new database;
	$m=date('m');
	$reply=$con->query("SELECT * FROM sales WHERE MONTH(date)='$m'");
	if($reply!=0)
	{
		echo "<table border=4 >
		<tr>
			<th>Bill no</th>
			<th>Date</th>
			<th>Non Taxable<br>Sales</th>
			<th>Amount for<br> $tax1%</th>
			<th>Amount for<br> $tax2%</th>
			<th>Tax $tax1%</th>
			<th>Tax $tax2%</th>
			<th>Total without tax</th>
			<th>Cash/Credit</th>
		</tr>";
		while($row=mysql_fetch_array($reply,MYSQL_NUM))
		{	
			echo "<tr>";
			foreach($row as &$tmp)
			{
				echo "<td>$tmp</td>";
			}
			echo "</tr>";
		}
	echo "</table>";
	}
?>

