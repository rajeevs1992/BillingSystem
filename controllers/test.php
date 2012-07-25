<?php
	var_dump($_POST);
	echo "
	<script language=javascript>
	window.print();
	window.close();
	</script>";
	header("location:/views/bill.php");
?>
