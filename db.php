<?php
class DB 
{
	//Constructor
	function __construct() 
	{		
		include 'config.php';
		
		$this->mysqli = new mysqli($config_dbServer, 
									$config_dbUser, 
									$config_dbPassword, 
									$config_dbName);
		if ($this->mysqli->connect_error) 
		{
			die('Connect Error (' . $this->mysqli->connect_errno . ') '
					. $this->mysqli->connect_error);
		}
	}

	//Attributes
	protected $mysqli;

	//Methods
	function sendQuery($sql) {
		return $this->mysqli->query($sql);
	}

	function __destruct() {
       $this->mysqli->close();
	}
}

class LoadData 
{
	//Contructor
	function LoadData()
	{
		$this->db = New DB();
		$this->atts1 = array();
		$this->atts2 = array();
	}

	//Attributes
	protected $atts1;
	protected $atts2;
	protected $db;

	//Methods
	function load()
	{
		$output =  $this->db->sendQuery("SELECT * FROM zellen;");
		//$data =  mysqli_fetch_all($output);
		$data = [];
		while ($row = $output->fetch_assoc()) {
			$data[] = $row;
		}
		//var_dump($data);
		for($i = 0; $i<MAXCELLCOUNT;$i++)
		{
			$this->atts1[$i] = New Attributes($data[$i]['ID'], $data[$i]['name'], $data[$i]['mass'], 
										$data[$i]['membran'], $data[$i]['attack'], $data[$i]['agility'], 
										$data[$i]['speed'], $data[$i]['posx'], $data[$i]['posy'],
										$data[$i]['tactic']);
		}
		for($i = 0; $i<MAXCELLCOUNT;$i++)
		{
			$j = $i+MAXCELLCOUNT;
			$this->atts2[$i] = New Attributes($data[$j]['ID'], $data[$j]['name'], $data[$j]['mass'], 
										$data[$j]['membran'], $data[$j]['attack'], $data[$j]['agility'], 
										$data[$j]['speed'], $data[$j]['posx'], $data[$j]['posy'],
										$data[$j]['tactic']);
		}
	}
}

class CreateTestTable
{
	//Constructor
	function CreateTestTable($db)
	{
		if($db->sendQuery("SELECT 1 FROM zellen LIMIT 1;")==false)
		{
			$db->sendQuery("CREATE TABLE IF NOT EXISTS zellen
		    	(ID VARCHAR(20), name VARCHAR(20), 
		    	mass VARCHAR(20),membran VARCHAR(20), 
		    	attack VARCHAR(20),	agility VARCHAR(20),
		    	speed VARCHAR(20), posx VARCHAR(20), 
		    	posy VARCHAR(20), tactic VARCHAR(20))");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('0', 'name', '1', '1', '1', '1', '1', '50' , '50', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('1', 'name', '1', '1', '1', '1', '1', '50' , '100', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('2', 'name', '1', '1', '1', '1', '1', '50' , '150', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('3', 'name', '1', '1', '1', '1', '1', '50' , '200', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('4', 'name', '1', '1', '1', '1', '1', '50' , '250', 'aggro')");

			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('5', 'name', '1', '1', '1', '1', '1', '300' , '75', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('6', 'name', '1', '1', '1', '1', '1', '300' , '125', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('7', 'name', '1', '1', '1', '1', '1', '300' , '175', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('8', 'name', '1', '1', '1', '1', '1', '300' , '225', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('9', 'name', '1', '1', '1', '1', '1', '300' , '275', 'aggro')");
		}
	}
}

?>
