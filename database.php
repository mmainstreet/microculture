<?php



class db {
	protected $mysqli;
	
	function __construct() {
		
		include 'config.php';
		
		$this->mysqli = new mysqli($config_dbServer, $config_dbUser, $config_dbPassword, $config_dbName);
		if ($this->mysqli->connect_error) {
			die('Connect Error (' . $this->mysqli->connect_errno . ') '
					. $this->mysqli->connect_error);
		}
	}

	function sendQuery($sql) {
		if ($this->mysqli->query($sql) === FALSE) {
			echo "Error: " . $sql . "<br>" . $this->mysqli->error;
		}
	}

	function __destruct() {
       $this->mysqli->close();
	}
}
?>
