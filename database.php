<?php
class db {
	protected $mysqli;
	
	function __construct() {
		$this->mysqli = new mysqli('localhost', 'microcultureuser', '#', 'microculture');
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
