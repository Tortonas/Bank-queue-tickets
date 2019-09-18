<?php
	class UserHandler 
	{
		function __construct()
		{

		}

		public function register($username, $name, $lastname, $password, $password_repeat)
		{
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

		}

		public function logout()
		{

		}
	}

?>