<?php
	class database
	{
//		include("$_SERVER[DOCUMENT_ROOT]/coop/config/config.php");
		private $con,$tablename;

		public function __construct($tablename)
		{
			$this->tablename=$tablename;
//			$this->con=mysql_connect($DB_HOST,$DB_USER,$DB_PASSWD);
			$this->con=mysql_connect("localhost","root","password");
			mysql_select_db("store");
		}

		public function autofill($itemCode)
		{
			$query="SELECT unitPrice FROM $this->tablename WHERE code='$itemCode'";

			$reply=mysql_query($query,$this->con);
			echo json_encode(mysql_fetch_assoc($reply));
		}
	};
?>
