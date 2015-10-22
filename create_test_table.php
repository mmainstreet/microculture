<?php
$db = new db();

if($db->sendQuery("SELECT 1 FROM zellen LIMIT 1;")==false)
{
	$db->sendQuery("CREATE TABLE IF NOT EXISTS zellen
    	(ID VARCHAR(20), mass VARCHAR(20),
    	membran VARCHAR(20), attack VARCHAR(20),
    	agility VARCHAR(20), speed VARCHAR(20), 
    	posx VARCHAR(20), posy VARCHAR(20),
    	tactic VARCHAR(20))");
	$db->sendQuery("INSERT INTO zellen (ID, mass, membran, attack, agility, speed, posx, posy, tactic)
	VALUES ('0', '1', '1', '1', '1', '1', '50' , '50', 'aggro')");
	$db->sendQuery("INSERT INTO zellen (ID, mass, membran, attack, agility, speed, posx, posy, tactic)
	VALUES ('1', '1', '1', '1', '1', '1', '50' , '100', 'aggro')");
	$db->sendQuery("INSERT INTO zellen (ID, mass, membran, attack, agility, speed, posx, posy, tactic)
	VALUES ('2', '1', '1', '1', '1', '1', '50' , '150', 'aggro')");
	$db->sendQuery("INSERT INTO zellen (ID, mass, membran, attack, agility, speed, posx, posy, tactic)
	VALUES ('3', '1', '1', '1', '1', '1', '50' , '200', 'aggro')");
	$db->sendQuery("INSERT INTO zellen (ID, mass, membran, attack, agility, speed, posx, posy, tactic)
	VALUES ('4', '1', '1', '1', '1', '1', '50' , '250', 'aggro')");
}
?>