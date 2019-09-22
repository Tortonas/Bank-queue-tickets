<?php
	class UserHandler 
	{
		function __construct()
		{
            if(!isset($_SESSION['loginStatus']) && empty($_SESSION['loginStatus']))
            {
                $_SESSION['loginStatus'] = "0";
            }
            if(!isset($_SESSION['clientName']) && empty($_SESSION['clientName']))
            {
                $_SESSION['clientName'] = "0";
            }
            if(!isset($_SESSION['clientId']) && empty($_SESSION['clientId']))
            {
                $_SESSION['clientId'] = "0";
            }
		}

		public function register($username, $name, $lastname, $password, $password_repeat)
		{
			if(strlen($password) == 0 || strlen($username) == 0 || strlen($name) == 0 || strlen($lastname) == 0 || strlen($password_repeat) == 0)
				return false;
			if($password != $password_repeat)
				return false;

            $dbModel = new DB_Model();

            $username = $dbModel->real_escape_string($username);
            $name = $dbModel->real_escape_string($name);
            $lastname = $dbModel->real_escape_string($lastname);
            $password = $dbModel->real_escape_string($password);

			if(!($dbModel->checkIfYouCanRegisterWithThisUsername($username)))
            {
                return false;
            }

			$dbModel->sendQuery("INSERT INTO clients (username, name, lastname, password) VALUES ('$username', '$name', '$lastname', '$password')");

			return true;
		}

		public function loginAsClient($username, $password)
		{
            $dbModel = new DB_Model();
            $username = $dbModel->real_escape_string($username);
            $password = $dbModel->real_escape_string($password);

            $canILogin = $dbModel->checkIfYouCanLogin($username, $password);
            if($canILogin)
            {
                $_SESSION['loginStatus'] = "client";
                $_SESSION['clientName'] = $dbModel->getClientNameByUsername($username);
                $_SESSION['clientId'] = $dbModel->getClientIdByUsername($username);
                return true;
            }
            else
            {
                $_SESSION['loginStatus'] = "0";
                $_SESSION['clientName'] = null;
                $_SESSION['clientId'] = "0";
                return false;
            }
		}

		public function loginAsSpecialist($username, $password)
        {
            $dbModel = new DB_Model();
            $username = $dbModel->real_escape_string($username);
            $password = $dbModel->real_escape_string($password);

            $canILogin = $dbModel->checkIfYouCanLoginSpecialist($username, $password);
            if($canILogin)
            {
                $_SESSION['loginStatus'] = "specialist";
                $_SESSION['clientName'] = $dbModel->getClientNameByUsernameSpecialist($username);
                $_SESSION['clientId'] = "0"; // TODO: Will specialist need his ID?
                return true;
            }
            else
            {
                $_SESSION['loginStatus'] = "0";
                $_SESSION['clientName'] = null;
                $_SESSION['clientId'] = "0";
                return false;
            }
        }

		public function logout()
		{
            $_SESSION['loginStatus'] = "0";
		}

		public function checkIfPositiveNumber($number)
        {
            if(is_numeric($number) && $number > 0)
            {
                return true;
            }
            else
            {
                return false;
            }
        }
	}

?>