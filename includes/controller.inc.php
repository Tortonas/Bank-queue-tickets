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

			$dbModel->sendQuery("INSERT INTO klientai (username, name, lastname, password) VALUES ('$username', '$name', '$lastname', '$password')");

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
                return true;
            }
            else
            {
                $_SESSION['loginStatus'] = "0";
                $_SESSION['clientName'] = null;
                return false;
            }
		}

		public function logout()
		{
            $_SESSION['loginStatus'] = "0";
		}
	}

?>