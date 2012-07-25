<html>
<script language=javascript>
function request(url,arg1,arg2)
{
url=url+arg1;
if (window.XMLHttpRequest)
  {
  xmlhttp=new XMLHttpRequest();
  }
else
  {
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var reply=eval('(' + xmlhttp.responseText + ')');
		notify(reply,arg2);
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function notify(json,count)
{
	if(json!=false)
	{
		alert("The code exists!!!Use 'Purchase' tab to add stock.");
    	document.getElementById("code"+count).value='';
    	document.getElementById("code"+count).focus();
		return;
	}
}

</script>


<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/config/config.php");
	$page=new page("Add New Item",1);
	echo"
	<form action=/controllers/addItem.php method=post >
	<table border=3>
	<tr>
		<th>No</th>
		<th>Code</th>
		<th>Item</th>
		<th>MRP</th>
		<th>Qty</th>
		<th>Purchase<br>Price</th>
		<th>Profit</th>
		<th>Rate<br>Of Tax</th>
	</tr>
	";
	for($i=1;$i<11;$i++)
	{
		echo "<tr>\n<td><input type=text tabindex=-1      value=$i readonly size=2></td>\n";
		echo "<td><input type=text name=code$i      id=code$i       size=6 onchange=request('/controllers/billComplete.php?code=',this.value,$i,1)></td>\n";
		echo "<td><input type=text name=name$i      id=name$i       size=25></td>\n";
		echo "<td><input type=text name=mrp$i       id='mrp$i'      size=4></td>\n";
		echo "<td><input type=text name=qty$i       id=qty$i        size=6></td>\n";
		echo "<td><input type=text name=PurchasePrice$i id=PurchasePrice$i  size=9><br></td>\n";
		echo "<td><input type=text name=profit$i size=6>
				<select name=mode$i>
					<option value=1>%</option>
					<option value=2>Rs.</option>
				</select></td>\n";
		echo "<td>
				<select name=rateOfTax$i>
					<option value=0>0%</option>
					<option value=1>$tax1%</option>
					<option value=2>$tax2%</option>
				</select></td></tr>\n";
	}
	echo "</table>";
	echo "<input type=submit value='Add Items' style=top:480px;position:absolute;>";
	echo "</form></body></html>";
?>
