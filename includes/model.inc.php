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
			$this->dbUser = "root";
			$this->dbPassword = "";

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

		public function checkIfYouCanLogin($username, $password)
        {
            $sql = "SELECT * FROM `klientai` WHERE username='$username' AND password='$password'";
            $sqlAnswer = mysqli_query($this->conn, $sql);
            if(mysqli_num_rows($sqlAnswer)>=1)
            {
                return true;
            }
            else
            {
                return false;
            }
        }

        public function getClientNameByUsername($username)
        {
            $clientName = null;

            $sql = "SELECT * FROM klientai WHERE username='$username'";
            $sqlResult = mysqli_query($this->conn, $sql);

            if ($sqlResult->num_rows > 0)
            {
                while($row = $sqlResult->fetch_assoc())
                {
                    $clientName = $row['name']." ".$row['lastname'];
                    break;
                }
            }

            if($clientName == null)
            {
                echo "getClientNameByUsername() method in model.inc.php didn't find any username!";
            }

            return $clientName;
        }
	}

?>