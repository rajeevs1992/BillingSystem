<?php
	class database
	{
		private $con;

		public function __construct()
		{
			$this->con=mysql_connect("localhost","root","password");
			mysql_select_db("store");
		}

		public function autofill($itemCode)
		{

			$code=strtolower($itemCode);
			$query="SELECT * FROM item WHERE code='$code'";
			$reply=mysql_query($query,$this->con);
			echo json_encode(mysql_fetch_assoc($reply));
		}
		public function verifyStockServer($code,$qty)
		{
			$query="SELECT totalStock FROM item WHERE code='$code'";
			$reply=mysql_query($query,$this->con);
			$reply=mysql_fetch_assoc($reply);
			$stock=$reply['totalStock'];
			if($stock-$qty<0)
			{
				$reply=array('code'=>$code,'stock'=>$stock*-1,'qty'=>$qty);
				return $reply;
			}
			else 
			{
				$reply=array('code'=>$code,'stock'=>$stock,'qty'=>$qty);
				return $reply;
			}
		}
		public function query($query)
		{
			$reply=mysql_query($query);
			if($reply)		
    			return $reply;
			else
				return 0;			
		}

		public function verifyStock($code,$qty)
		{
			$query="SELECT totalStock FROM item WHERE code='$code'";
			$reply=mysql_query($query,$this->con);
			$reply=mysql_fetch_assoc($reply);
			$stock=$reply['totalStock'];
			if($stock-$qty<0)
			{
				$reply=array('code'=>$code,'stock'=>$stock*-1,'qty'=>$qty);
				echo json_encode($reply);
				return $reply;
			}
			else 
			{
				$reply=array('code'=>$code,'stock'=>$stock,'qty'=>$qty);
				echo json_encode($reply);
			}
		}

	};
?>
