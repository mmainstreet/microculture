<?php 

//Constants
define("MAXCELLCOUNT",	"5");
define("AREAX",			"800");
define("AREAY",			"600");

class Attributes
{
	function Attributes($name, $health, $defense, $agility, $damage, $speed)
	{
		$this->name 		= $name;
	 	$this->health 		= $health;
	 	$this->defense 		= $defense;
	 	$this->agility 		= $agility;
	 	$this->damage 		= $damage;
	 	$this->speed 		= $speed;
	}
	public $name;
	public $health;
	public $defense;
	public $agility;
	public $damage;
	public $speed;
};

class Cell
{
	//Contructor
	function Cell($name, $health, $defense, $agility, $damage, $speed)
	{
		$this->m_name 		= $name;
	 	$this->m_health 	= $health;
	 	$this->m_defense	= $defense;
	 	$this->m_agility	= $agility;
	 	$this->m_damage 	= $damage;
	 	$this->m_speed 		= $speed;
	}

	//Attributes
	private $m_name;
	private $m_health;
	private $m_defense;
	private $m_agility;
	private $m_damage;
	private $m_speed;

	//SetMethods
	function setName($name){ 		$this->m_name 		= $name;}
	function setHealth($health){ 	$this->$m_health 	= $health;}
	function setDefense($defense){	$this->$m_defense	= $defense;}
	function setAgility($agility){	$this->$m_agility	= $agility;}
	function setDamage($damage){	$this->$m_damage 	= $damage;}
	function setSpeed($speed){		$this->$m_speed 	= $speed;}

	//GetMethods
	function getName(){		return 	$this->m_name;}
	function getHealth(){ 	return 	$this->m_health;}
	function getDefense(){	return 	$this->m_defense;}
	function getAgility(){	return 	$this->m_agility;}
	function getDamage(){	return 	$this->m_damage;}
	function getSpeed(){	return 	$this->m_speed;}
};

class Team
{
	//Constructor
	function Team($attributes)
	{
		$this->cells 		= array();
		for($i = 0; $i < MAXCELLCOUNT; $i++)
		{
			$this->cells[$i] = New Cell($attributes[$i]->name,
			 							$attributes[$i]->health, 
			 							$attributes[$i]->defense, 
			 							$attributes[$i]->agility, 
			 							$attributes[$i]->damage, 
			 							$attributes[$i]->speed);
		}	
	}

	//Attributes
	public 	$cells;
};

class Game
{
	function Game($atts1, $atts2)
	{
		$this->team1 = New Team($atts1);
		$this->team2 = New Team($atts2);
	}
	function start()
	{

	}

	protected $team1;
	protected $team2;

}
$atts 	= array();
for($i=0;$i<MAXCELLCOUNT; $i++)
{
	$atts[$i] = New Attributes("hallo",0,0,0,0,0);
}
$test 	= New Game($atts, $atts);
?>
