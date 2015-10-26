<?php
include './gamefiles/constants.php';
include './db.php';

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
		$this->team1 = New Team($this->atts1);
		$this->team2 = New Team($this->atts2);

		//send Constants
		$this->sendConstants();
	}
	private function sendScript($script)
	{
		$out = "\n<script type = 'text/javascript'>\n";
		$out .= $script;
		$out .= "\n</script>\n";		

		echo $out;
	}
	private function sendConstants()
	{
		$script = "";
		$script .= 
		"
		const  	MAXCELLCOUNT 		= ".MAXCELLCOUNT.",".
		"	
				BALLRADIUS 			= 15, 
				BALLSPEEDX 			= 20,
				BALLSPEEDY 			= 0,
				BALLCOLOR 			= \"#55AA55\";
		";
		$this->sendScript($script);
	}
	public function sendValues()
	{
		$script = "";
		for($i = 0; $i < MAXCELLCOUNT; $i++)
		{
			$script .= "team1[".$i."][0] = ";
			$script .= $this->team1->cells[$i]->getId();
			$script .= ";";

			$script .= "team1[".$i."][1] = '";
			$script .= $this->team1->cells[$i]->getName();
			$script .= "';\n";
		}
		$this->sendScript($script);
	}

	//Attributes
	protected $team1;
	protected $team2;
}
?>