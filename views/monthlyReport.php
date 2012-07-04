<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
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
			<th>Non Taxable sales</th>
			<th>Amt 4%</th>
			<th>Amt 12.5%</th>
			<th>Tax 4%</th>
			<th>Tax 12.5%</th>
			<th>Cess 4%</th>
			<th>Cess 12.5%</th>
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

