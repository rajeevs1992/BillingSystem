<?php
	require_once("$_SERVER[DOCUMENT_ROOT]/classes/common.php");
	$page=new page('Add new Item',1);
?>

<form action=/controllers/newItem.php method=post>
<?php
	
	for($i=1;$i<51;$i++)
	{
		echo "<input type=text tabindex=-1 id=n$i value=$i readonly $readonly size=2>\n";
		echo "<input type=text tabindex=-1 id='mrp$i' name=mrp$i size=4>\n";
		echo "<input type=text tabindex=-1 id=name$i size=25>\n";
		echo "<input type=text name=code$i id=code$i size=6>\n";
		echo "<input type=text name=qty$i  id=qty$i  size=6>\n";
		echo "<input type=text tabindex=-1 id=unitPrice$i name=unitPrice$i size=7 >\n";
		echo "<input type=text tabindex=-1 id=rateOfTax$i size=7>\n";
		echo "<input type=text tabindex=-1 id=taxAmt$i name=taxAmt$i size=7>\n";
		echo "<input type=text tabindex=-1 id=cess$i name=cess$i size=7>\n";
		echo "<input type=text tabindex=-1 id=total$i name=total$i value=0 readonly $readonly><br>\n";
	}


