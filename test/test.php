<?php
$handle = printer_open();
printer_write($handle, "Text to print");
printer_close($handle);
?>
