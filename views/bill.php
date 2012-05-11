<html>
<script type="text/javascript">
function request(url,code,count,flag)
{
if(flag==1)
{
			url=url+code;
}
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
		var json=eval('(' + xmlhttp.responseText + ')');
		if(flag==1)
		{
			populate(json,count);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function populate(json,count)
{
	document.getElementById("mrp"+count).value=json.mrp;
    document.getElementById("PplusT"+count).value=parseInt(json.unitPrice)+(json.unitPrice*json.rateOfTax/100);
    document.getElementById("name"+count).value=json.name;
    document.getElementById("unitPrice"+count).value=json.unitPrice;
    document.getElementById("rateOfTax"+count).value=json.rateOfTax;
    document.getElementById("qty"+count).value=''
}
	
function calculate(count,qty)
{
	var total=document.getElementById("PplusT"+count).value * qty;
	document.getElementById("total"+count).value=total;
   	var unit=document.getElementById("unitPrice"+count).value;
   	var rot=document.getElementById("rateOfTax"+count).value;
   	document.getElementById("taxAmt"+count).value=unit*rot/100;
   	document.getElementById("cess"+count).value=unit*rot*.01/100;
	sum();
}

function sum()
{
	var i=0;
	var sum=0;
	var temp;
	for(i=1;i<51;i++)
	{
		temp=parseFloat(document.getElementById("total"+i).value);
		sum=sum+temp;
	}
	document.getElementById("total").value=sum;
//	document.write(sum);
}

function verifyItemCode(count)
{
	document.write(document.getElementById('name'+count).length());
/*	if(typeof getElementById('MRP'+count).value == 'undefined')
	{
		alert("The entered item code is invalid!!Please verify to continue");
		getElementById('code'+count).value='';
		getElementById('code'+count).click();
	}*/
}


</script>

<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Engineering College Co-Operative Society Ltd,R-51");
	echo "<br><br><br>";
	echo "<div style='left:10px;position:absolute'>No.</div>";
	echo "<div style='left:55px;position:absolute'>MRP</div>";
	echo "<div style='left:100px;position:absolute'>Price+Tax</div>";
	echo "<div style='left:250px;position:absolute'>ITEM</div>";
	echo "<div style='left:390px;position:absolute'>Code</div>";
	echo "<div style='left:460px;position:absolute'>Qty</div>";
	echo "<div style='left:512px;position:absolute'>Unit Price</div>";
	echo "<div style='left:607px;position:absolute'>RoT</div>";
	echo "<div style='left:660px;position:absolute'>Tax Amt</div>";
	echo "<div style='left:750px;position:absolute'>Cess</div>";
	echo "<div style='left:850px;position:absolute'>Total</div>";

	echo"
	<div style='
	width:980px;height:200px;overflow:scroll;
	top:235px;position:absolute;
	border:3px black solid;'>
	<form action=/controllers/test.php method=post>
	";
	for($i=1;$i<51;$i++)
	{
		echo "<input type=text tabindex=-1 id=n$i value=$i readonly size=2>\n";
		echo "<input type=text tabindex=-1 id='mrp$i' readonly size=4>\n";
		echo "<input type=text tabindex=-1 id='PplusT$i' readonly size=7>\n";
		echo "<input type=text tabindex=-1 id=name$i readonly size=25>\n";
		echo "<input type=text name=code$i id=code$i size=6 onchange=request('/controllers/billComplete.php?code=',this.value,$i,1)>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6 onfocus=verifyItemCode($i) onchange='calculate($i,this.value)'>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=rateOfTax$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=taxAmt$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=cess$i size=7 readonly>\n";
		echo "<input type=text tabindex=-1 id=total$i name=total$i value=0 readonly><br>\n";

	}
	echo "
	</div>
	<div style='top:450;left:700;position:absolute;'>
	BILL AMOUNT :<input type=text id=total name=total readonly>
	</div>
	<div style='top:500;left:50;position:absolute;'>
	TOTAL CASH :<input type=text id=cash onchange=\"document.getElementById('bal').value=(parseFloat(document.getElementById('total').value) - getElementById('cash').value)*-1;\">
	Balance    :<input type=text id=bal readonly>
	</div>
	<input type=submit value='Print' style='top:600px;left:150px;position:absolute;height:25px'>
	</form>
	</body>";
?>
