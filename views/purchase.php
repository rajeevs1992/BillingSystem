<html>
<head>
	<link rel="stylesheet" type="text/css" media="all" href="date.css" />
	<script type="text/javascript" src="date.js"></script>
</head>


<script language=javascript>
	window.onload = function(){
		var d=new Date;
		document.getElementById("date").value = d.getYear()+1900 + "-" + (parseInt(d.getMonth())+1) + "-" + d.getDate();
		g_globalObject = new JsDatePick({
			useMode:1,
			isStripped:true,
			target:"calender"
		});		
		
		g_globalObject.setOnSelectedDelegate(function(){
			var obj = g_globalObject.getSelectedDay();
			document.getElementById("date").value = obj.year + "-" + obj.month + "-" + obj.day;
		});
		
		
		
	};
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
		else if (mode==2)
		{
			var reply=eval('(' + xmlhttp.responseText + ')');
			fill(reply);
		}
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function notify(json)
{
	if(json==false)
	{
		alert("Eh?!!\nItem does not exist!!!\nDid you mean 'Add new item'?");
    	document.getElementById("code").value='';
    	document.getElementById("code").focus();
		return;
	}
	else
	{
    	document.getElementById("iname").value=json.name;
	}
		
}

function fill(json)
{
	var a=10;
}

</script>


<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Purchase",1);
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

<form method=post action=/controllers/purchase.php>
	Item Code
	<input style=left:200px;position:absolute; type=text id=code name=code onchange=request("/controllers/billComplete.php?code=",this.value,1)><br><br>

	Item Name<input style=left:200px;position:absolute;background:yellow; tabindex=-1 type=text id=iname readonly><br><br>

	Quantity<input style=left:200px;position:absolute; type=text name=qty><br><br>

	Purchase Date<input style=left:200px;position:absolute;background:yellow; tabindex=-1 type=text id=date readonly name=date>
	<div id="calender" style="margin:10px 0 30px 0;
			 width:205px; height:200px;">
    </div>
	<input type=submit value='Add'>
</form>

<div id=codeBrowser style=left=600;top:500;position:absolute;>
</div>
	
</html>
