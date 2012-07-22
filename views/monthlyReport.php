<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$page=new page("Current Month Reports",3);
	$con=new database;
	$m=date('m');
	echo "<style type=text/css>
				td
				{
					text-align:center;
				}
			</style>";
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
	$reply=$con->query("SELECT SUM(salesNonTax) AS s0 ,
	SUM(tax1sales) AS s1 ,
	SUM(tax2sales) AS s2 ,
	SUM(tax1) AS t1 ,
	SUM(tax2) AS t2 ,
	SUM(totalWithoutTax) as total 
	FROM sales WHERE MONTH(date)='$m'");
	$reply=mysql_fetch_assoc($reply);
	$reply['s0']=round($reply['s0'],2);
	$reply['s1']=round($reply['s1'],2);
	$reply['s2']=round($reply['s2'],2);
	$reply['t1']=round($reply['t1'],2);
	$reply['t2']=round($reply['t2'],2);
	$reply['total']=round($reply['total'],2);
	echo "<tr>
	<th></th>
	<th>TOTAL</th>
	<th>$reply[s0]</th>
	<th>$reply[s1]</th>
	<th>$reply[s2]</th>
	<th>$reply[t1]</th>
	<th>$reply[t2]</th>
	<th>$reply[total]</th>
	<th></th>";
	echo "</table>";
	}
?>
<a href=/controllers/reportGen.php?mode=t><input type=submit value='Generate Report'></a>
</html>
