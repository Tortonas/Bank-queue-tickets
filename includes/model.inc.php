<?php
	/* Once object is created, you will connect to database. */
	class DB_Model 
	{
		private $server;
		private $dbName;
		private $dbUser;
		private $dbPassword;
		
		private $conn;

		function __construct()
		{
			$this->server = "localhost";
			$this->dbName = "u429721638_nfq";
			$this->dbUser = "u429721638_nfq";
			$this->dbPassword = "nfq321";

			$this->conn = new mysqli($this->server, $this->dbUser, $this->dbPassword, $this->dbName);

			// Check connection
			if ($this->conn->connect_error) {
			    die("Connection failed: " . $this->conn->connect_error);
			}
			//echo "CONNECTION VEIKIA";
		}

		public function sendQuery($sql)
		{
			if ($this->conn->query($sql) === TRUE) 
			{
			    return true;
			} 
			else 
			{
			    echo "Error: " . $sql . "<br>" . $this->conn->error;
			    return false;
			}
		}

		public function real_escape_string($text)
		{
			return mysqli_real_escape_string($this->conn, $text);
		}
	}

?>