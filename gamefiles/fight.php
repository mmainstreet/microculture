<?php

//Constants
define("MAXCELLCOUNT",	"5");
define("AREAX",			"800");
define("AREAY",			"600");

class Attributes
{
	//Contructor
	function Attributes($id, $name, $health, $defense, $damage, $agility, $speed, $posx, $posy, $tactic)
	{
		$this->id 			= $id;
		$this->name 		= $name;
	 	$this->health 		= $health;
	 	$this->defense 		= $defense;
	 	$this->agility 		= $agility;
	 	$this->damage 		= $damage;
	 	$this->speed 		= $speed;
	 	$this->posx 		= $posx;
	 	$this->posy 		= $posy;
	 	$this->tactic 		= $tactic;

	}

	//Attributes
	public $id;
	public $name;
	public $health;
	public $defense;
	public $agility;
	public $damage;
	public $speed;
	public $posx;
	public $posy;
	public $tactic;
};

class Cell
{
	//Contructor
	function Cell($id, $name, $health, $defense, $damage, $agility, $speed, $posx, $posy, $tactic)
	{
		$this->m_id 		= $id;
		$this->m_name 		= $name;
	 	$this->m_health 	= $health;
	 	$this->m_defense	= $defense;
	 	$this->m_agility	= $agility;
	 	$this->m_damage 	= $damage;
	 	$this->m_speed 		= $speed;
	 	$this->posx 		= $posx;
	 	$this->posy 		= $posy;
	 	$this->tactic 		= $tactic;
	}

	//Attributes
	private $m_id;
	private $m_name;
	private $m_health;
	private $m_defense;
	private $m_agility;
	private $m_damage;
	private $m_speed;
	private $m_posx;
	private $m_posy;
	private $m_tactic;

	//SetMethods
	function setId($id){			$this->m_id 		= $id;}
	function setName($name){ 		$this->m_name 		= $name;}
	function setHealth($health){ 	$this->m_health 	= $health;}
	function setDefense($defense){	$this->m_defense	= $defense;}
	function setAgility($agility){	$this->m_agility	= $agility;}
	function setDamage($damage){	$this->m_damage 	= $damage;}
	function setSpeed($speed){		$this->m_speed 		= $speed;}
	function setPosx($posx){		$this->m_posx		= $posx;}
	function setPosy($posy){		$this->m_posy		= $posy;}
	function setTactic($tactic){	$this->m_tactic		= $tactic;}

	//GetMethods
	function getId(){		return 	$this->m_id;}
	function getName(){		return 	$this->m_name;}
	function getHealth(){ 	return 	$this->m_health;}
	function getDefense(){	return 	$this->m_defense;}
	function getAgility(){	return 	$this->m_agility;}
	function getDamage(){	return 	$this->m_damage;}
	function getSpeed(){	return 	$this->m_speed;}
	function getPosx(){		return 	$this->m_posx;}
	function getPosy(){		return 	$this->m_posy;}
	function getTactic(){	return 	$this->m_tactic;}
};

class Team
{
	//Constructor
	function Team($attributes)
	{
		$cells = array();
		for($i = 0; $i < count($attributes); $i++)
		{
			$this->cells[$i] = New Cell($attributes[$i]->id,
										$attributes[$i]->name,
			 							$attributes[$i]->health, 
			 							$attributes[$i]->defense, 
			 							$attributes[$i]->damage, 
			 							$attributes[$i]->agility, 
			 							$attributes[$i]->speed,
			 							$attributes[$i]->posx,
			 							$attributes[$i]->posy,
			 							$attributes[$i]->tactic);
		}	
	}

	//Attributes
	public 	$cells;
};

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
			VALUES ('5', 'name', '1', '1', '1', '1', '1', '300' , '50', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('6', 'name', '1', '1', '1', '1', '1', '300' , '100', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('7', 'name', '1', '1', '1', '1', '1', '300' , '150', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('8', 'name', '1', '1', '1', '1', '1', '300' , '200', 'aggro')");
			$db->sendQuery("INSERT INTO zellen (ID, name, mass, membran, attack, agility, speed, posx, posy, tactic)
			VALUES ('9', 'name', '1', '1', '1', '1', '1', '300' , '250', 'aggro')");
		}
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
		$data =  mysqli_fetch_all($output);
		for($i = 0; $i<MAXCELLCOUNT;$i++)
		{
			$this->atts1[$i] = New Attributes($data[$i][0], $data[$i][1], $data[$i][2], 
										$data[$i][3], $data[$i][4], $data[$i][5], 
										$data[$i][6], $data[$i][7], $data[$i][8],
										$data[$i][9]);
		}
		for($i = 0; $i<MAXCELLCOUNT;$i++)
		{
			$j = $i+MAXCELLCOUNT;
			$this->atts2[$i] = New Attributes($data[$j][0], $data[$j][1], $data[$j][2], 
										$data[$j][3], $data[$j][4], $data[$j][5], 
										$data[$j][6], $data[$j][7], $data[$j][8],
										$data[$j][9]);
		}
	}
}

class Game extends LoadData
{
	//Contructor
	function Game()
	{
		//Connection to Database (via LoadData Contructor)
		parent::__construct();

		//Creating TestTable if not exist
		$TestTable = New CreateTestTable($this->db);

		//Load Data from Database
		$this->load();

		//Creating Teams
		//$this->team1 = New Team($this->atts1);
		$this->team2 = New Team($this->atts2);
	}
	function start()
	{

	}
	//Attributes
	protected $team1;
	protected $team2;
}
$game = New Game();
$game->load();
?>