<?php
error_reporting(E_ALL);
$handle = printer_open();
printer_write($handle, "Text to print");
printer_close($handle);
?>
