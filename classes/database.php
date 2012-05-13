<?php
	class database
	{
		private $con,$tablename;

		public function __construct($tablename)
		{
			$this->tablename=$tablename;
			$this->con=mysql_connect("localhost","root","password");
			mysql_select_db("store");
		}

		public function autofill($itemCode)
		{
			$query="SELECT * FROM $this->tablename WHERE code='$itemCode'";
			$reply=mysql_query($query,$this->con);
			echo json_encode(mysql_fetch_assoc($reply));
		}

		public function verifyStock($code,$qty)
		{
			$query="SELECT totalStock FROM $this->tablename WHERE code='$code'";
			$reply=mysql_query($query,$this->con);
			$reply=mysql_fetch_assoc($reply);
			$stock=$reply['totalStock'];
			if($stock-$qty<0)
			{
				$reply=array('code'=>$code,'stock'=>$stock*-1,'qty'=>$qty);
				echo json_encode($reply);
			}
			else 
			{
				$reply=array('code'=>$code,'stock'=>$stock,'qty'=>$qty);
				echo json_encode($reply);
			}
		}

	};
?>
