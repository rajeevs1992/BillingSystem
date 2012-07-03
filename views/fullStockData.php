
<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$page=new page("Stock",3);
	$con=new database;
	echo "<script language=javascript>
	function request(value,mode)
	{
		var url='/controllers/search?val='+value+'&mode='+mode;
		if (window.XMLHttpRequest)
		  {
			  xmlhttp=new XMLHttpRequest();
		  }
		else
		{
			xmlhttp=new ActiveXObject(\"Microsoft.XMLHTTP\");
		}
		xmlhttp.onreadystatechange=function()
		{
			if (xmlhttp.readyState==4 && xmlhttp.status==200)
		    {
				if(xmlhttp.responseText=='None')
					document.getElementById('tab').innerHTML='No data!!';
				else
				{
					var reply=eval('(' + xmlhttp.responseText + ')');
					populate(reply);
				}
		   	}
		}
		xmlhttp.open(\"GET\",url,true);
		xmlhttp.send();
	}
	function populate(reply)
	{
		var row='<tr>\
					<td>code</td>\
					<td>mrp</td>\
					<td>item</td>\
					<td>rot</td>\
					<td>up</td>\
					<td>sp</td>\
					<td>pp</td>\
					<td>profit</td>\
					<td>stock</td>\
					<td>os</td>\
				</tr>';
		var data='\
		<table border=5 cellpadding=4>\
		<tr>\
			<th>Code</th>\
			<th>MRP</th>\
			<th>Item</th>\
			<th>RoT</th>\
			<th>Unit Price</th>\
			<th>SP</th>\
			<th>Purchasing Price</th>\
			<th>Profit/Unit</th>\
			<th>Total Stock</th>\
			<th>Opening Stock</th>\
		</tr>';
		var temp='';
		var c=0;
		for(i=0;i<reply.length;i++)
		{

			temp=row;
			temp=temp.replace('code',reply[i].code);
			temp=temp.replace('mrp',reply[i].mrp);
			temp=temp.replace('item',reply[i].name);
			temp=temp.replace('rot',reply[i].rateOfTax);
			temp=temp.replace('up',reply[i].unitPrice);
			temp=temp.replace('sp',reply[i].sellingPrice);
			temp=temp.replace('pp',reply[i].purchasingPrice);
			temp=temp.replace('profit',reply[i].profitPerUnit);
			temp=temp.replace('stock',reply[i].totalStock);
			temp=temp.replace('os',reply[i].openingStock);
			data=data+temp;
			temp='';
			c=c+1;
		}
			document.getElementById('tab').innerHTML=data;
	}
</script>";
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
	Search:<br>
	Code: <input type=text onkeyup=request(this.value,1) />
	Item Name: <input type=text onkeyup=request(this.value,2)>
	<br>
	<br>
		";
	$reply=$con->query("SELECT * FROM item");
	echo "<div id=tab>
		<table border=5 cellpadding=4>
		<tr>
			<th>Code</th>
			<th>MRP</th>
			<th>Item</th>
			<th>RoT</th>
			<th>Unit Price</th>
			<th>SP</th>
			<th>Purchasing Price</th>
			<th>Profit/Unit</th>
			<th>Total Stock</th>
			<th>Opening Stock</th>
		</tr>
		";
	while($row=mysql_fetch_assoc($reply))
	{
		echo "
		<tr>
			<td>$row[code]</td>
			<td>$row[mrp]</td>
			<td>$row[name]</td>
			<td>$row[rateOfTax]</td>
			<td>$row[unitPrice]</td>
			<td>$row[sellingPrice]</td>
			<td>$row[purchasingPrice]</td>
			<td>$row[profitPerUnit]</td>
			<td>$row[totalStock]</td>
			<td>$row[openingStock]</td>
		</tr>
		";
	}
	echo "</div>";
?>
