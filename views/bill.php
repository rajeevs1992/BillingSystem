<html>
<script type="text/javascript">
function showUser(str)
{
if (str=="")
  {
  document.getElementById("txtHint").innerHTML="";
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
    document.getElementById("txtHint").innerHTML=xmlhttp.responseText;
    }
  }
xmlhttp.open("GET","getuser.php?q="+str,true);
xmlhttp.send();
}
</script>
<?php
	echo"
	<form action=/controllers/test.php method=post style=width:100%;height:500px>
	";

	echo "<div style='left:80px;position:absolute'>Item Code</div>";
	echo "<div style='left:255px;position:absolute'>Qty</div>";
	echo "<div style='left:430px;position:absolute'>Unit Price</div>";
	echo "<div style='left:605px;position:absolute'>Total</div><br>";
	for($i=1;$i<25;$i++)
	{
		echo "<input type=text name=num value=$i readonly size=2>";
		echo "<input type=text name=code$i onchange=populate(this.value)>";
		echo "<input type=text name=qty$i>";
		echo "<input type=text id=unitPrice$i name=unitPrice$i value='' readonly>";
		echo "<input type=text id=total$i name=total$i value='' readonly><br>\n";

	}
	echo "
	<input type=submit value='Add Users'>
	</form>
	</body>";
?>
