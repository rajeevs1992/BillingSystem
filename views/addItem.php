<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page('Add new Item',1);
?>

<form action=/controllers/addItem.php method=post>
<?php
	$readonly="style=background:#f1ec9b";
	echo "
		<div style=left:2px;position:relative;display:inline;>Sl No</div>
		<div style=left:10px;position:relative;display:inline;>Code</div>
		<div style=left:100px;position:relative;display:inline;>Name</div>
		<div style=left:100px;position:relative;display:inline;>Qty</div>
		<div style=left:100px;position:relative;display:inline;>Unit Price</div>
	
	
	";
	for($i=1;$i<51;$i++)
	{
		echo "<br><input type=text tabindex=-1 id=n$i value=$i readonly $readonly size=2>\n";
		echo "<input type=text name=code$i id=code$i size=6>\n";
		echo "<input type=text id=name$i size=25>\n";
		echo "<input type=text id='mrp$i' name=mrp$i size=4>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6>\n";
		echo "<input type=text id=unitPrice$i name=unitPrice$i size=7 >\n";
		echo "<input type=text id=rateOfTax$i size=7>\n";
	}


