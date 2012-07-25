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
</script>


<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Print Old bill",1);
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

<form method=post action=/views/oldbillList.php>
	Bill Date<input style=left:200px;position:absolute;background:yellow; tabindex=-1 type=text id=date readonly name=date>
	<div id="calender" style="margin:10px 0 30px 0;
			 width:205px; height:200px;">
    </div>
	<input type=submit value='Retrieve'>
</form>
</html>
