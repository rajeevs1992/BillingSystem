<html>
<script language=javascript>
function request(url,arg1,mode)
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
		if(mode==1)
		{
			var reply=eval('(' + xmlhttp.responseText + ')');
			notify(reply);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function notify(json)
{
	if(json!=false)
	{
    	document.getElementById("iname").value=json.name;
    	document.getElementById("ts").value=json.totalStock;
    	document.getElementById("mrp").value=json.mrp;

		<?php
			require_once("$_SERVER[DOCUMENT_ROOT]/config/config.php");
			echo "
				var tax0='<option value=0>0%</option><option value=1>$tax1%</option><option value=2>$tax2%</option>';
				var tax1='<option value=1>$tax1%</option><option value=0>0%</option><option value=2>$tax2%</option>';
				var tax2='<option value=2>$tax2%</option><option value=0>0%</option><option value=1>$tax1%</option>';
				var mode0='<option value=0>%</option><option value=1>Rs.</option>';
				var mode1='<option value=1>Rs.</option><option value=0>%</option>';

				if(json.rateOfTax=='$tax1')
    				document.getElementById('tax').innerHTML=tax1;
				else if(json.rateOfTax=='$tax2')
    				document.getElementById('tax').innerHTML=tax2;
				else
    				document.getElementById('tax').innerHTML=tax0;
				if(json.profitMode=='0')
    				document.getElementById('mode').innerHTML=mode0;
				else
    				document.getElementById('mode').innerHTML=mode1;
			";
		?>
    	document.getElementById("pp").value=json.purchasingPrice;
    	document.getElementById("profit").value=json.profit;
	}
	else
	{
		alert("Invalid code!!!");
    	document.getElementById("code").value='';
    	document.getElementById("code").focus();
	}

}
</script>


<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Edit Item",1);
	if(isset($_SESSION['message']))
	{
	echo "
		<script type=text/javascript>
			alert('$_SESSION[message]');
			return;
		</script>";
		unset($_SESSION['message']);
	}
?>

<form method=post action=/controllers/editItem.php>
	Item Code*
	<input style=left:200px;position:absolute; type=text id=code name=code onchange=request("/controllers/billComplete.php?code=",this.value,1)><br><br>

	Item Name*<input style=left:200px;position:absolute; type=text name=iname id=iname><br><br>
	Total Stock*<input style=left:200px;position:absolute; type=text name=ts id=ts><br><br>
	MRP*<input style=left:200px;position:absolute;  type=text name=mrp id=mrp><br><br>
	Purchase Price(per unit)*<input style=left:200px;position:absolute;  type=text name=pp id=pp><br><br>
	Profit*<input style=left:200px;position:absolute; type=text name=profit id=profit>
	<select name=profitmode style=left:373px;position:absolute id=mode>
			<option value=0>%</option>
			<option value=1>Rs.</option>
	</select><br><br>
	Rate of Tax*
	<?php
		include("$_SERVER[DOCUMENT_ROOT]/config/config.php");
		echo "<select name=rot style=left:200px;position:absolute id=tax>
					<option value=0>0%</option>
					<option value=1>$tax1%</option>
					<option value=2>$tax2%</option>
				</select>";
	?><br><br>
	<input type=submit value='Done'>
</form>
</html>
