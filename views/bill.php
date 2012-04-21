<html>




<script type="text/javascript">
function populate(count,code)
{
if (code=="")
  {
      document.getElementById("unitPrice"+count).value='0';
	  return;
	} 
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
		var json=eval('(' + xmlhttp.responseText + ')');

    	document.getElementById("unitPrice"+count).value=json.unitPrice;
	}
  }
xmlhttp.open("GET","../controllers/billComplete.php?code="+code,true);
xmlhttp.send();
}

function calculate(count,qty)
{
	var total=document.getElementById("unitPrice"+count).value * qty;
	document.getElementById("total"+count).value=total;
}
</script>




<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("New Bill");

	echo "<div style='left:330px;position:absolute'>Item Code</div>";
	echo "<div style='left:505px;position:absolute'>Qty</div>";
	echo "<div style='left:680px;position:absolute'>Unit Price</div>";
	echo "<div style='left:855px;position:absolute'>Total</div><br>";
	echo"
	<div style='
	width:49%;height:200px;overflow:scroll;
	top:135px;left:250;position:absolute;
	border:3px black solid;'>
	<form action=/controllers/test.php method=post>
	";
	for($i=1;$i<51;$i++)
	{
		echo "<input type=text tabindex=-1 name=num value=$i readonly size=2>\n";
		echo "<input type=text name=code$i id=code$i onchange=populate($i,this.value)>\n";
		echo "<input type=text name=qty$i  id=qty$i onchange=calculate($i,this.value)>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i readonly>\n";
		echo "<input type=text tabindex=-1 id=total$i name=total$i readonly><br>\n";

	}
	echo "
	</div>
	<input type=submit value='Print' style='top:400px;left:150px;position:absolute;height:25px'>
	</form>
	</body>";
?>
