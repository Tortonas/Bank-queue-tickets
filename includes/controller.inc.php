<?php
	class UserHandler 
	{
		function __construct()
		{

		}

		public function register($username, $name, $lastname, $password, $password_repeat)
		{
			//TODO: Set default session values


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

		public function login($username, $password)
		{
			// TODO: Complete login
			$_SESSION['loginStatus'] = "client";
		}

		public function logout()
		{
			// TODO: Complete logout, remove session value.
		}
	}

?>