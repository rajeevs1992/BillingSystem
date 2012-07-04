<html>
<script type="text/javascript">
function request(url,arg1,arg2,mode)
{
if(mode==1)
{
			url=url+arg1;
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
		var reply=eval('(' + xmlhttp.responseText + ')');
		if(mode==1)
		{
			populate(reply,arg2);
		}
		else if(mode==2)
		{
			stockVerificationAction(reply,arg1);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function populate(json,count)
{
	if(json==false)
	{
		alert("Invalid Code!!!");
    	document.getElementById("code"+count).value='';
    	document.getElementById("code"+count).focus();
		return;
	}
	document.getElementById("mrp"+count).value=json.mrp;
    document.getElementById("PplusT"+count).value=roundNumber((parseFloat(json.unitPrice)+(json.unitPrice*json.rateOfTax/100)),3);
    document.getElementById("name"+count).value=json.name;
    document.getElementById("unitPrice"+count).value=roundNumber(parseFloat(json.unitPrice),3);
    document.getElementById("rateOfTax"+count).value=json.rateOfTax;
    document.getElementById("qty"+count).value='';
}

function calculate(count,qty)
{
	var total=document.getElementById("PplusT"+count).value * qty;
	document.getElementById("total"+count).value=roundNumber(total,3);
   	var unit=document.getElementById("unitPrice"+count).value;
	var rot=document.getElementById("rateOfTax"+count).value;
   	document.getElementById("taxAmt"+count).value=roundNumber(qty*unit*rot/100,3);
   	document.getElementById("cess"+count).value=roundNumber(unit*rot*.01/100,3);
	sum();
}
function roundNumber(rnum, rlength) 
{ 
	var newnumber = Math.round(rnum*Math.pow(10,rlength))/Math.pow(10,rlength);
   	return parseFloat(newnumber); 
}
function stockVerificationAction(reply,count)
{
	var stock=parseInt(reply.stock);
	if(stock<=0)
	{
		alert("Out of Stock!!!Only "+stock*-1+" units remaining.");
    	document.getElementById("qty"+count).value='';
    	document.getElementById("qty"+count).focus();
	}
	else
		calculate(count,reply.qty);
}

function sum()
{
	var i=0;
	var sum=0;
	var temp;
	for(i=0;i<51;i++)
	{
		temp=parseFloat(document.getElementById("total"+i).value);
		sum=sum+temp;
	}
	document.getElementById("total").value=roundNumber(sum,3);
}

function verifyStock(count,qty)
{
    var code=document.getElementById("code"+count).value;
	request("/controllers/verifyIfInStock.php?code="+code+"&qty="+qty,count,0,2);
}

function getBal(cash)
{
	var bal=((parseFloat(document.getElementById('total').value) - parseFloat(cash))*-1);
	if(bal<0)
	{
		alert("Bill amount greater than entered amount!!");
		document.getElementById('cash').value='';
		document.getElementById('cash').focus();
	}
	document.getElementById('bal').value=roundNumber(bal,3);
}
function redirect()
{	
	 if(document.value=="Print")
        {
                document.billForm.action="/controllers/bill.php";
        }
        else if(document.value=="Save")
        {
                document.billForm.action="/controllers/save.php";
        }
        return true;
}
</script>

<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/database.php");
	$query="SELECT * FROM temp WHERE tempBillNo='$_GET[billno]'";
	$con=new database();
	$reply=$con->query($query);
	$page=new page("Engineering College Co-Operative Society Ltd,R-51",1);
	$billNo=$page->getBillNo();
	$readonly="style=background:#f1ec9b";
	echo "<div style='left:10px;position:absolute;color:red'>";
	echo "Bill Number:<input type=text value=$billNo readonly $readonly>&nbsp;&nbsp;";
	echo "Billed By:<input type=text value=$_SESSION[uname] readonly $readonly></div><br><br><br>";
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
	height:200px;overflow:scroll;
	top:235px;position:absolute;
	border:3px black solid;'>
	<form method=\"post\" name=\"billForm\" onsubmit=\"return redirect();\">
	";
	echo "<input type=hidden value=$billNo name=billNo>";
	$i=1;
	$query="SELECT * FROM item WHERE code='%s'";
	$billTotal=0;
	if($reply!=0)
	{
	while($row=mysql_fetch_assoc($reply)){
		$itemQuery=sprintf($query,$row['code']);
		$itemReply=$con->query($itemQuery);
		if($itemReply!=0)
		{
		$attr=mysql_fetch_assoc($itemReply);
		echo "<input type=text tabindex=-1 id=n$i value=$i readonly $readonly size=2>\n";
		echo "<input type=text tabindex=-1 id='mrp$i' readonly $readonly size=4 value=".$attr['mrp']."\n>";
		$tax=($attr['rateOfTax']/100)*$attr['unitPrice'];
		$taxAmt=$tax*$row['qty'];
		$PplusT=$tax+$attr['unitPrice'];
		echo "<input type=text tabindex=-1 id='PplusT$i' name=PplusT$i readonly $readonly size=7 value=".$PplusT.">\n";
		echo "<input type=text tabindex=-1 id=name$i readonly $readonly size=25 value=".$attr['name'].">\n";
		echo "<input type=text name=code$i id=code$i size=6 value='".$row['code']."' onchange=request('/controllers/billComplete.php?code=',this.value,$i,1)>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6  value='".$row['qty']."' onchange='verifyStock($i,this.value)'>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i size=7 $readonly readonly value=".$attr['unitPrice'].">\n";
		echo "<input type=text tabindex=-1 id=rateOfTax$i size=7 readonly $readonly value=".$attr['rateOfTax'].">\n";
		echo "<input type=text tabindex=-1 id=taxAmt$i name=taxAmt$i size=7 readonly $readonly value=".$taxAmt.">\n";
		$cess=0;
		echo "<input type=text tabindex=-1 id=cess$i name=cess$i size=7 readonly $readonly value=".$cess.">\n";
		$total=$row['qty']*($PplusT+$cess);
		$billTotal+=$total;
		echo "<input type=text tabindex=-1 id=total$i name=total$i  readonly $readonly value=".$total."><br>\n";
	$i++;
	}
	}
	}
	$k=$i;
	for($i=$k;$i<51;$i++)
	{
		echo "<input type=text tabindex=-1 id=n$i value=$i readonly $readonly size=2>\n";
		echo "<input type=text tabindex=-1 id='mrp$i' readonly $readonly size=4>\n";
		echo "<input type=text tabindex=-1 id='PplusT$i' name=PplusT$i readonly $readonly size=7>\n";
		echo "<input type=text tabindex=-1 id=name$i readonly $readonly size=25>\n";
		echo "<input type=text name=code$i id=code$i size=6 onchange=request('/controllers/billComplete.php?code=',this.value,$i,1)>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6  onchange='verifyStock($i,this.value)'>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i size=7 $readonly readonly>\n";
		echo "<input type=text tabindex=-1 id=rateOfTax$i size=7 readonly $readonly>\n";
		echo "<input type=text tabindex=-1 id=taxAmt$i name=taxAmt$i size=7 readonly $readonly>\n";
		echo "<input type=text tabindex=-1 id=cess$i name=cess$i size=7 readonly $readonly>\n";
		echo "<input type=text tabindex=-1 id=total$i name=total$i value=0 readonly $readonly><br>\n";

	}
	echo "
	</div>
	<div style='top:450;left:600;position:absolute;'>
	BILL AMOUNT :<input type=text id=total name=total readonly $readonly value=".$billTotal.">
	</div>
	<div style='top:500;left:50;position:absolute;'>
	TOTAL CASH :<input type=text id=cash onchange=getBal(this.value)>
	Balance    :<input type=text id=bal readonly $readonly tabindex=-1>
	</div>
	<input type=submit  style='top:600px;left:150px;position:absolute;height:40px;width:80px' id=print	onclick='document.value=this.value' value='Print'>
	<input type=submit style='top:600px;left:250px;position:absolute;height:40px;width:80px' id=save	onclick='document.value=this.value' value='Save'>
	</form>
	</body>";
?>
