<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page("Delete Item",1);
	if(!isset($_SESSION['uname']))
		header("location:/views/login.php");
?>
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
			var reply=eval('(' + xmlhttp.responseText + ')');
			fill(reply);
   	}
  }
xmlhttp.open("GET",url,true);
xmlhttp.send();
}

function fill(json)
{
	if(json!=false)
		document.getElementById('name').value=json[0].name;
	else
	{
		alert("Invalid code");
		document.getElementById('code').value='';
		document.getElementById('code').focus();
	}
}

</script>
<form action=/controllers/delete.php method=post>
Enter Code
	<input style=left:200px;position:absolute; type=text id=code name=code onchange=request("/controllers/search.php?mode=5&val=",this.value,2)><br><br>
Name 
	<input style=left:200px;position:absolute; type=text id=name readonly><br><br>

	<input type=submit value=Delete>

</form>
</html>
