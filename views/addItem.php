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
	$page=new page("Add New Item",1);

	echo "<br><div style='left:10px;position:absolute'>No.</div>";
	echo "<div style='left:55px;position:absolute'>Code</div>";
	echo "<div style='left:200px;position:absolute'>ITEM</div>";
	echo "<div style='left:320px;position:absolute'>MRP</div>";
	echo "<div style='left:380px;position:absolute'>Qty</div>";
	echo "<div style='left:430px;position:absolute'>Unit Price</div>";
	echo "<div style='left:525px;position:absolute'>RoT</div>";
	echo "<div style='left:575px;position:absolute'>Purchasing Price</div>";

	echo"
	<div style='top:200px;position:absolute;border:3px black solid;'>
	<form action=/controllers/addItem.php method=post >
	";
	for($i=1;$i<11;$i++)
	{
		echo "<input type=text tabindex=-1      value=$i readonly size=2>\n";
		echo "<input type=text name=code$i      id=code$i       size=6 onchange=request('/controllers/billComplete.php?code=',this.value,$i,1)>\n";
		echo "<input type=text name=name$i      id=name$i       size=25>\n";
		echo "<input type=text name=mrp$i       id='mrp$i'      size=4>\n";
		echo "<input type=text name=qty$i       id=qty$i        size=6>\n";
		echo "<input type=text name=unitPrice$i id=unitPrice$i  size=7>\n";
		echo "<input type=text name=rateOfTax$i id=rateOfTax$i  size=7 >\n";
		echo "<input type=text name=PurchasePrice$i id=PurchasePrice$i  size=9><br>\n";
	}
	echo "</div>";
	echo "<input type=submit value='Add Items' style=top:480px;position:absolute;>";
	echo "</form></body></html>";
?>
