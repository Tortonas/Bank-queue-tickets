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
            date_default_timezone_set("Europe/Vilnius");
            $dbConfigFile = fopen("./includes/database.config", "r") or die("Unable to open file!");

            $dbConfigFileString =  fgets($dbConfigFile);
            $dbConfigLines = explode(":", $dbConfigFileString);

            fclose($dbConfigFile);
			$this->server = $dbConfigLines[0];
            $this->dbUser = $dbConfigLines[1];
            $this->dbPassword = $dbConfigLines[2];
			$this->dbName = $dbConfigLines[3];


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
			$returnValue = mysqli_real_escape_string($this->conn, $text);
			$returnValue = htmlentities($returnValue);
			return $returnValue;
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
            $sql = "SELECT visits.id, estimatedTime, name, lastname FROM visits INNER JOIN clients ON client_id=clients.id WHERE serviced='0' ORDER BY visits.id LIMIT 10";

            $result = $this->conn->query($sql);

            $viewHandler = new ViewHandler();
            $viewHandler->printWaitingPeopleList($result);
        }

        public function calculateLeftTime()
        {
            $sql = "SELECT clients.id as client_id, visits.id as visit_id, estimatedTime, serviced name, lastname FROM visits INNER JOIN clients ON client_id=clients.id WHERE serviced='0' ORDER BY visit_id";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0) {
                $estimatedTimeLeft = 0;
                $howManyClientsInFront = 0;
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
                            $sqlGetAverageWaitingTime = "SELECT * FROM (SELECT id, AVG(TIMESTAMPDIFF(MINUTE, visitStarted, visitEnded)) as diff FROM visits GROUP BY id) data WHERE diff IS NOT NULL";
                            $result2 = $this->conn->query($sqlGetAverageWaitingTime);
                            $averageWaitingTime = 0;
                            $averageWaitingTimeCount = 0;
                            if ($result2->num_rows > 0)
                            {
                                while($row = $result2->fetch_assoc())
                                {
                                    $averageWaitingTime = $averageWaitingTime + $row['diff'];
                                    $averageWaitingTimeCount++;
                                }
                                /*if($averageWaitingTimeCount == 0)
                                {
                                    $averageWaitingTimeCount = 1;
                                }*/
                                $averageWaitingTime = $averageWaitingTime / $averageWaitingTimeCount;

                                $averageWaitingTime = round($averageWaitingTime *  $howManyClientsInFront);

                                $viewHandler->informAboutEstimatedLeftTime($estimatedTimeLeft, $averageWaitingTime);
                            }
                        }
                        break;
                    }
                    else
                    {
                        $estimatedTimeLeft = $estimatedTimeLeft + $row['estimatedTime'];
                        $howManyClientsInFront++;
                    }
                }
            }
        }

        public function getNextWaitingClient()
        {
            $sql = "SELECT visits.id as visit_id, estimatedTime, name, lastname, serviced FROM visits INNER JOIN clients on visits.client_id = clients.id WHERE serviced='0' ORDER BY visit_id";
            $result = $this->conn->query($sql);
            $viewHandler = new ViewHandler();
            $visitId = NULL;
            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $viewHandler->printNextClientForm($row['name'], $row['lastname'], $row['visit_id'], $row['estimatedTime']);
                    $visitId = $row['visit_id'];
                    $currentTime = date('Y-m-d H:i:s');

                    if(isset($_POST['clientServicedStart']))
                    {
                        $sqlStartVisit = "UPDATE visits SET visitStarted='$currentTime' WHERE id='$visitId'";
                        $this->sendQuery($sqlStartVisit);
                        $viewHandler->redirect_to_another_page("/main-specialist.php", 0);
                    }
                    if(isset($_POST['clientServiced']))
                    {
                        //Checks if even visit started
                        $sqlCheckIfVisitStarted = "SELECT visitStarted FROM visits WHERE id='$visitId' LIMIT 1";

                        $result = $this->conn->query($sqlCheckIfVisitStarted);
                        $canIServiceTheClient = false;

                        if ($result->num_rows > 0)
                        {
                            while($row = $result->fetch_assoc())
                            {
                                if($row['visitStarted'] == NULL)
                                {
                                    $canIServiceTheClient = false;
                                }
                                else
                                {
                                    $canIServiceTheClient = true;
                                }
                            }
                        }
                        else
                        {
                            echo "Unexpected error in getNextWaitingClient() this shouldn't have happened.";
                        }

                        if($canIServiceTheClient)
                        {
                            $sqlServiced = "UPDATE visits SET serviced='1', visitEnded='$currentTime' WHERE id='$visitId'";
                            $this->sendQuery($sqlServiced);
                            $viewHandler->redirect_to_another_page("/main-specialist.php", 0); // basically page reload
                        }
                        else
                        {
                            $viewHandler->printYouCannotSkipClient();
                        }
                    }
                    break;
                }
            }
            else
            {
                $viewHandler = new ViewHandler();
                $viewHandler->informAboutEmptyQueue();
            }


            $previousVisitId = $visitId - 1;

            if($previousVisitId < 0)
            {
                $sqlGetLastVisitId = "SELECT id FROM visits ORDER BY id DESC LIMIT 1";
                $result = $this->conn->query($sqlGetLastVisitId);
                while($row = $result->fetch_assoc())
                {
                    $previousVisitId = $row['id'];
                    break;
                }
            }

            $sqlGetTimeStamps = "SELECT visitStarted, visitEnded FROM visits WHERE id='$previousVisitId' LIMIT 1";

            $result = $this->conn->query($sqlGetTimeStamps);

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $visitStart = new DateTime($row['visitStarted']);
                    $visitEnd = new DateTime($row['visitEnded']);
                    $difference = $visitStart->diff($visitEnd);

                    $timeDiff = $difference->format('%H:%I:%S');

                    $viewHandler->printPreviousClientTime($timeDiff);
                    break;
                }
            }
        }

        public function checkEstimatedTimeById($id)
        {
            $id = $this->real_escape_string($id);

            // Since this is re-used code from before and it searches estimated time left with client_id and I got visit_id I have to get that other variable.
            $sqlTransferClientIdToVisitId = "SELECT clients.id as client_id, visits.id as visit_id, estimatedTime, name, lastname FROM visits INNER JOIN clients ON client_id=clients.id WHERE serviced='0' AND visits.id='$id' ORDER BY visit_id";
            $result = $this->conn->query($sqlTransferClientIdToVisitId);

            $didIFindVisitId = false;
            $viewHandler = new ViewHandler();

            if ($result->num_rows > 0)
            {
                while ($row = $result->fetch_assoc())
                {
                    $id = $row['client_id'];
                    $didIFindVisitId = true;
                }
            }

            if(!$didIFindVisitId)
            {
                $viewHandler->printTicketIdNotFound();
                return;
            }


            $sql = "SELECT clients.id as client_id, visits.id as visit_id, estimatedTime, name, lastname FROM visits INNER JOIN clients ON client_id=clients.id WHERE serviced='0' ORDER BY visit_id";
            $result = $this->conn->query($sql);

            if ($result->num_rows > 0)
            {
                $estimatedTimeLeft = 0;
                $howManyClientsInFront = 0;
                while($row = $result->fetch_assoc())
                {
                    if($id == $row['client_id'])
                    {
                        if($estimatedTimeLeft == 0)
                        {
                            $viewHandler->informClientAboutHisQueueEnd();
                        }
                        else
                        {
                            $sqlGetAverageWaitingTime = "SELECT * FROM (SELECT id, AVG(TIMESTAMPDIFF(MINUTE, visitStarted, visitEnded)) as diff FROM visits GROUP BY id) data WHERE diff IS NOT NULL";
                            $result2 = $this->conn->query($sqlGetAverageWaitingTime);
                            $averageWaitingTime = 0;
                            $averageWaitingTimeCount = 0;
                            if ($result2->num_rows > 0)
                            {
                                while($row = $result2->fetch_assoc())
                                {
                                    $averageWaitingTime = $averageWaitingTime + $row['diff'];
                                    $averageWaitingTimeCount++;
                                }
                                /*if($averageWaitingTimeCount == 0)
                                {
                                    $averageWaitingTimeCount = 1;
                                }*/
                                $averageWaitingTime = $averageWaitingTime / $averageWaitingTimeCount;

                                $averageWaitingTime = round($averageWaitingTime *  $howManyClientsInFront);

                                $viewHandler->informAboutEstimatedLeftTime($estimatedTimeLeft, $averageWaitingTime);
                            }
                        }
                        break;
                    }
                    else
                    {
                        $estimatedTimeLeft = $estimatedTimeLeft + $row['estimatedTime'];
                        $howManyClientsInFront++;
                    }
                }
            }
            else
            {
                echo "Unexpected error in checkEstimatedTimeById().";
            }
        }

        public function checkIfICanRegisterForTicket($userInputEstimatedTime)
        {
            $userHandler = new UserHandler();
            $viewHandler = new ViewHandler();

            $returnValueBool = $userHandler->checkIfPositiveNumber($userInputEstimatedTime);

            if($returnValueBool)
            {
                if($userInputEstimatedTime < 60)
                {
                    $clientId = $_SESSION['clientId'];
                    $sqlCheckCurrentRegistrations = "SELECT * FROM visits WHERE serviced=0 AND client_id='$clientId'";
                    $result = $this->conn->query($sqlCheckCurrentRegistrations);

                    $isThereAnyDuplicate = false;
                    $currentVisitId = -1;

                    if ($result->num_rows > 0)
                    {
                        while($row = $result->fetch_assoc())
                        {
                            $isThereAnyDuplicate = true;
                            $currentVisitId = $row['id'];
                        }
                    }

                    if($isThereAnyDuplicate)
                    {

                        $viewHandler->printThatYouAlreadyHaveANumber($currentVisitId);
                        return false;
                    }
                    else
                    {
                        return true;
                    }
                }
                else
                {
                    $viewHandler->pleaseUseLimitedRanges(60);
                    return false;
                }
            }
            else
            {
                $viewHandler->printRandomError();
                return false;
            }
        }

        public function checkIfIveRegisteredForTicket()
        {
            $clientId = $_SESSION['clientId'];
            $sqlCheckCurrentRegistrations = "SELECT * FROM visits WHERE serviced=0 AND client_id='$clientId'";
            $result = $this->conn->query($sqlCheckCurrentRegistrations);

            $myTicketId = -1;

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $myTicketId = $row['id'];
                    break;
                }
            }

            return $myTicketId;
        }

        public function cancelMyVisit($visitId)
        {
            $sql = "DELETE FROM visits WHERE id='$visitId'";
            $this->sendQuery($sql);
        }

        public function checkIfYouCanRegisterWithThisUsername($username)
        {
            $sql = "SELECT * FROM clients WHERE username='$username'";

            $result = $this->conn->query($sql);

            $isThisUsernameTaken = false;

            if ($result->num_rows > 0)
            {
                while($row = $result->fetch_assoc())
                {
                    $isThisUsernameTaken = true;
                }
            }

            if($isThisUsernameTaken)
            {
                $viewHandler = new ViewHandler();
                $viewHandler->printThisUsernameTaken();
                return false;
            }
            else
            {
                return true;
            }
        }
	}

?>