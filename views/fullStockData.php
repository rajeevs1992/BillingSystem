<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$page=new page("Stock",3);
	$con=new database;
	$reply=$con->query("SELECT SUM(unitPrice*totalStock) AS valueCS,SUM(unitPrice*openingStock) AS valueOS FROM item");
	$reply=mysql_fetch_assoc($reply);
	$valueCS=$reply['valueCS'];
	$valueOS=$reply['valueOS'];
	$sales=$valueOS-$valueCS;
	echo "<br>
	<table border=4 cellpadding=4 >
	<tr>
		<th>Value Closing Stock</th>
		<th>Value Opening Stock</th>
		<th>Sales</th>
	</tr>
	<tr style=color:green>
		<td>$valueOS</td>
		<td>$valueCS</td>
		<td>$sales</td>
	<tr>
	</table>
	<br>
		";
	$reply=$con->query("SELECT * FROM item");
	echo "
	<table border=5 cellpadding=4>
	<tr>
		<th>Code</th>
		<th>MRP</th>
		<th>Item</th>
		<th>RoT</th>
		<th>Unit Price</th>
		<th>Tax</th>
		<th>SP</th>
		<th>Purchasing Price</th>
		<th>Profit/Unit</th>
		<th>Total Stock</th>
		<th>Opening Stock</th>
	</tr>
	";
	while($row=mysql_fetch_assoc($reply))
	{
		$tax=$row['unitPrice']*$row['rateOfTax']/100;
		echo "
		<tr>
			<td>$row[code]</td>
			<td>$row[mrp]</td>
			<td>$row[name]</td>
			<td>$row[rateOfTax]</td>
			<td>$row[unitPrice]</td>
			<td>$tax</td>
			<td>$row[sellingPrice]</td>
			<td>$row[purchasingPrice]</td>
			<td>$row[profitPerUnit]</td>
			<td>$row[totalStock]</td>
			<td>$row[openingStock]</td>
		</tr>
		";
	}
?>
