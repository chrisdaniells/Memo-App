<?php

	class MySqlDatabase
	{

		private static $db_instance;
		private $con;

		private $db_host = 'xxx';
		private $db_user = 'xxx';
		private $db_pass = 'xxx';
		private $db_name = 'xxx';

		public static function getInstance()
		{
			if (!self::$db_instance) {
				self::$db_instance = new self();
			}
			return self::$db_instance;
		}

		private function __construct()
		{
			$this->con = new mysqli($this->db_host, $this->db_user, $this->db_pass, $this->db_name);

			if(mysqli_connect_error()) {
				trigger_error("Failed to conencto to MySQL: " . mysql_connect_error(), E_USER_ERROR);
			}
		}

		private function __clone() {}

		public function getConnection()
		{
			return $this->con;
		}

	}

?>
