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
            $sql = "SELECT * FROM `clients` WHERE username='$username' AND password='$password'";
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

        public function checkIfYouCanLoginSpecialist($username, $password)
        {
            $sql = "SELECT * FROM `specialists` WHERE username='$username' AND password='$password'";
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

            $sql = "SELECT * FROM clients WHERE username='$username'";
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

        public function getClientIdByUsername($username)
        {
            $clientId = null;

            $sql = "SELECT * FROM clients WHERE username='$username'";
            $sqlResult = mysqli_query($this->conn, $sql);

            if ($sqlResult->num_rows > 0)
            {
                while($row = $sqlResult->fetch_assoc())
                {
                    $clientId = $row['id'];
                    break;
                }
            }

            if($clientId == null)
            {
                echo "getClientIdByUsername() method in model.inc.php didn't find any username!";
            }

            return $clientId;
        }

        public function getClientNameByUsernameSpecialist($username)
        {
            $clientName = null;

            $sql = "SELECT * FROM specialists WHERE username='$username'";
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
                echo "getClientNameByUsernameSpecialist() method in model.inc.php didn't find any username!";
            }

            return $clientName;
        }

        public function registerTicket($time)
        {
            $time = $this->real_escape_string($time);
            $clientId = $_SESSION['clientId'];
            $sql = "INSERT INTO visits (estimatedTime, client_id) VALUES ('$time', '$clientId')";
            if($this->conn->query($sql) === TRUE)
            {
                return true;
            }
            else
            {
                echo "Unexpected error from registerTicket() on model.inc.php";
                return false;
            }
        }

        public function readAndPrintVisits()
        {
            $sql = "SELECT visits.id, estimatedTime, name, lastname FROM visits INNER JOIN clients ON client_id=clients.id ORDER BY visits.id LIMIT 10";

            $result = $this->conn->query($sql);

            $viewHandler = new ViewHandler();
            $viewHandler->printWaitingPeopleList($result);
        }

        public function calculateLeftTime()
        {
            // Check if I even need to calculate left time (if client has ticket)

            $sql = "SELECT clients.id as client_id, visits.id as visit_id, estimatedTime, name, lastname FROM visits INNER JOIN clients ON client_id=clients.id ORDER BY visit_id LIMIT 10";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $estimatedTimeLeft = 0;
                while($row = $result->fetch_assoc())
                {
                    if($_SESSION['clientId'] == $row['client_id'])
                    {
                        $viewHandler = new ViewHandler();
                        if($estimatedTimeLeft == 0)
                        {
                            $viewHandler->informClientAboutHisQueueEnd();
                        }
                        else
                        {
                            $viewHandler->informAboutEstimatedLeftTime($estimatedTimeLeft);
                        }
                        break;
                    }
                    else
                    {
                        $estimatedTimeLeft = $estimatedTimeLeft + $row['estimatedTime'];
                    }
                }
            }
        }

        public function getNextWaitingClient()
        {
            $sql = "SELECT visits.id as visit_id, estimatedTime, name, lastname FROM visits INNER JOIN clients on visits.client_id = clients.id ORDER BY visit_id";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $viewHandler = new ViewHandler();
                    $viewHandler->printNextClientForm($row['name'], $row['lastname'], $row['visit_id'], $row['estimatedTime']);
                    if(isset($_POST['clientServiced']))
                    {
                        $visitId = $row['visit_id'];
                        $sqlDelete = "DELETE FROM visits WHERE id='$visitId'";
                        $this->sendQuery($sqlDelete);
                        $viewHandler->redirect_to_another_page("/main-specialist.php", 0); // basically page reload
                    }
                    break;
                }
            }
            else
            {
                $viewHandler = new ViewHandler();
                $viewHandler->informAboutEmptyQueue();
            }
        }
	}

?>