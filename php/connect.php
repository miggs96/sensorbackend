<?php
	class Database{
		private $servername = "localhost";
		private $username = "root";
		private $password = "";
		private $dbname = "woohah";
		public $con; 

			public function connect(){
			$this->con = mysqli_connect($this->servername, $this->username, $this->password, $this->dbname);

			// Check connection
			if (!$this->con) {
				die("Connection failed: " . mysqli_connect_error());
			}
			echo "";

			return $this->con;
		}
	}
?>