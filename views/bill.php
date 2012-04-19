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
	echo "<div style='left:330px;position:absolute'>Item Code</div>";
	echo "<div style='left:505px;position:absolute'>Qty</div>";
	echo "<div style='left:680px;position:absolute'>Unit Price</div>";
	echo "<div style='left:855px;position:absolute'>Total</div><br>";
	echo"
	<div style='
	width:55%;height:200px;overflow:scroll;
	top:35px;left:250;position:absolute;
	border:3px black solid;'>
	<form action=/controllers/test.php method=post>
	";

	for($i=1;$i<51;$i++)
	{
		echo "<input type=text name=num value=$i readonly size=2>";
		echo "<input type=text name=code$i id=code$i onchange=populate($i,this.value)>";
		echo "<input type=text name=qty$i id=qty$i onchange=calculate($i,this.value)>";
		echo "<input type=text id=unitPrice$i name=unitPrice$i readonly>";
		echo "<input type=text id=total$i name=total$i readonly><br>\n";

	}
	echo "
	</div>
	<input type=submit value='Print' style='top:250px;position:absolute'>
	</form>
	</body>";
?>
