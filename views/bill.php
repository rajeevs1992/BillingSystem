<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Engineering College Co-Operative Society Ltd,R-51",1);
?>
<script type="text/javascript">
function request(url,arg1,arg2,mode)
{
if(mode==1||mode==3)
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
		else if(mode==3)
		{
			search(reply);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}
function search(reply)
{
	if(reply==false)
	{
		document.getElementById('search').innerHTML='No results!!';
	}
	else
	{
		var data='';
		for(i=0;i<reply.length;i++)
		{
			data=data+reply[i].code+'---'+reply[i].name+'('+reply[i].totalStock+')<br>';
		}
		document.getElementById('search').innerHTML=data;
	}
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
	for(i=1;i<51;i++)
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
	$spaces="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
	echo "<div style=left:350;position:absolute;>
		KGST No 26120286$spaces\n CST No 25125286$spaces\n TIN 32080668625$spaces\n
		</div><br><br>";
	$billNo=$page->getBillNo();
	$readonly="style=background:#f1ec9b";
	echo "<div style='left:10px;color:red'>";
	echo "Bill Number:<input type=text value=$billNo readonly $readonly>&nbsp;&nbsp;";
	echo "Billed By:<input type=text value=$_SESSION[uname] readonly $readonly></div><br>";
	echo "<table cellpadding=0><tr><th>No.</th>";
	echo "<th>MRP</th>";
	echo "<th>Price+Tax</th>";
	echo "<th>ITEM</th>";
	echo "<th>Code</th>";
	echo "<th>Qty</th>";
	echo "<th>Unit Price</th>";
	echo "<th>RoT</th>";
	echo "<th>Tax Amt</th>";
	echo "<th>Cess</th>";
	echo "<th>Total</th><tr>";
	echo "<td><input type=text tabindex=-1 id=n1 value=1 readonly $readonly size=2></td>\n";
	echo "<td><input type=text tabindex=-1 id='mrp1' readonly $readonly size=4></td>\n";
	echo "<td><input type=text tabindex=-1 id='PplusT1' name=PplusT1 readonly $readonly size=7></td>\n";
	echo "<td><input type=text tabindex=-1 id=name1 readonly $readonly size=25></td>\n";
	echo "<td><input type=text name=code1 id=code1 size=6 onchange=request('/controllers/billComplete.php?code=',this.value,1,1)></td>\n";
	echo "<td><input type=text name=qty1  id=qty1  size=6  onchange='verifyStock(1,this.value)'></td>\n";
	echo "<td><input type=text tabindex=-1 id=unitPrice1 name=unitPrice1 size=7 $readonly readonly></td>\n";
	echo "<td><input type=text tabindex=-1 id=rateOfTax1 size=7 readonly $readonly></td>\n";
	echo "<td><input type=text tabindex=-1 id=taxAmt1 name=taxAmt1 size=7 readonly $readonly></td>\n";
	echo "<td><input type=text tabindex=-1 id=cess1 name=cess1 size=7 readonly $readonly></td>\n";
	echo "<td><input type=text tabindex=-1 id=total1 name=total1 value=0 readonly $readonly></td></tr></table>\n";


	echo"
	<div style='
	height:200px;overflow:scroll;
	top:260px;left:9px;position:absolute;'
	>
	<form method=\"post\" name=\"billForm\" onsubmit=\"return redirect();\">";
	echo "<input type=hidden value=$billNo name=billNo>";
	for($i=2;$i<51;$i++)
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
	BILL AMOUNT :<input type=text id=total name=total readonly $readonly>
	</div>
	<div style='top:500;left:50;position:absolute;'>
	TOTAL CASH :<input type=text id=cash onchange=getBal(this.value)>
	Balance    :<input type=text id=bal readonly $readonly tabindex=-1>
	</div>
	<input type=submit  style='top:600px;left:150px;position:absolute;height:40px;width:80px' id=print	onclick='document.value=this.value' value='Print' name='Print'>
	<input type=submit style='top:600px;left:250px;position:absolute;height:40px;width:80px' id=save	onclick='document.value=this.value' value='Save' name='Save'>
	</form>
	<div style='right:5px;top:230px;position:absolute;border:3px black solid;height:200px;width:300px;overflow:scroll;'>
	<h4 style=display:inline>Search code:</h4><br>
	<div style=color:green;font-size:12>
	Fig. in bracket:Stock<br>
	</div>
	Item name/Code:<input type=text onkeyup=request('/controllers/search.php?mode=3&val=',this.value,'a',3)>
	<div id=search style=color:red;>
	</div>
	</div>
	</body>";
?>
