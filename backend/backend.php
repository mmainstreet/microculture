<?php

include '../db.php';
include '../gamefiles/constants.php';

class Backend extends LoadData
{
	//Contructor
	function Backend()
	{
		//Connection to Database (via LoadData Contructor)
		parent::__construct();

		//Load Data from Database
		$this->load();

	}
}

$backend = new Backend();
?>
