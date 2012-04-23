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
    	document.getElementById("mrp"+count).value=json.mrp;
    	document.getElementById("PplusT"+count).value=parseInt(json.unitPrice)+(json.unitPrice*json.rateOfTax/100);
    	document.getElementById("name"+count).value=json.name;
    	document.getElementById("unitPrice"+count).value=json.unitPrice;
    	document.getElementById("rateOfTax"+count).value=json.rateOfTax;

	}
  }
xmlhttp.open("GET","../controllers/billComplete.php?code="+code,true);
xmlhttp.send();
}
function calculate(count,qty)
{

	var total=document.getElementById("PplusT"+count).value * qty;
	document.getElementById("total"+count).value=total;
   	var unit=document.getElementById("unitPrice"+count).value;
   	var rot=document.getElementById("rateOfTax"+count).value;
   	document.getElementById("taxAmt"+count).value=unit*rot/100;
   	document.getElementById("cess"+count).value=unit*rot*.01/100;
	var i=0;
	var sum=0;
	var temp;
	for(i=1;i<51;i++)
	{
		temp=parseFloat(document.getElementById("total"+i).value);
		sum=sum+temp;
	}
	document.getElementById("total").value=sum;
}
</script>

<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("ENGINEERING COLLEGE COOPERATIVE SOCIETY LTD,R-51");
	$spaces="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "
	<div align=center>
	KGST No 26120286$spaces CST No 25125286$spaces TIN 32080668625$spaces
	</div>
	";

	echo "<div style='left:10px;position:absolute'>No.</div>";
	echo "<div style='left:55px;position:absolute'>MRP</div>";
	echo "<div style='left:100px;position:absolute'>Price+Tax</div>";
	echo "<div style='left:290px;position:absolute'>ITEM</div>";
	echo "<div style='left:430px;position:absolute'>Code</div>";
	echo "<div style='left:500px;position:absolute'>Qty</div>";
	echo "<div style='left:592px;position:absolute'>Unit Price</div>";
	echo "<div style='left:737px;position:absolute'>RoT</div>";
	echo "<div style='left:792px;position:absolute'>Tax Amt</div>";
	echo "<div style='left:882px;position:absolute'>Cess</div>";
	echo "<div style='left:990px;position:absolute'>Total</div>";

	echo"
	<div style='
	width:100%;height:200px;overflow:scroll;
	top:135px;position:absolute;
	border:3px black solid;'>
	<form action=/controllers/test.php method=post>
	";
	for($i=1;$i<51;$i++)
	{
		echo "<input type=text tabindex=-1 id=n$i value=$i readonly size=2>\n";
		echo "<input type=text tabindex=-1 id='mrp$i' readonly size=4>\n";
		echo "<input type=text tabindex=-1 id='PplusT$i' readonly size=7>\n";
		echo "<input type=text tabindex=-1 id=name$i readonly size=30>\n";
		echo "<input type=text name=code$i id=code$i size=6 onchange=populate($i,this.value)>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6 onchange=calculate($i,this.value)>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i readonly>\n";
		echo "<input type=text tabindex=-1 id=rateOfTax$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=taxAmt$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=cess$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=total$i name=total$i value=0 readonly><br>\n";

	}
	echo "
	</div>
	<div style='top:350;left:830;position:absolute;'>
	BILL AMOUNT :<input type=text id=total name=total readonly>
	</div>
	<div style='top:400;left:50;position:absolute;'>
	TOTAL CASH :<input type=text id=cash onchange=\"document.getElementById('bal').value=(parseFloat(document.getElementById('total').value) - getElementById('cash').value)*-1;\">
	Balance    :<input type=text id=bal readonly>
	</div>
	<input type=submit value='Print' style='top:600px;left:150px;position:absolute;height:25px'>
	</form>
	</body>";
?>
