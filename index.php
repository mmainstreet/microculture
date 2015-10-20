<?php
//new Account

include 'database.php';
$db = new db();
$db->sendQuery("CREATE TABLE IF NOT EXISTS zellen
    (ID VARCHAR(20), height VARCHAR(20),
    membran VARCHAR(20), attack VARCHAR(20), color VARCHAR(20))");
$db->sendQuery("INSERT INTO zellen (ID, height, membran, attack, color)
VALUES ('1', '3', '1', '1', 'cccccc')");
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Microculture</title>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
 
    <link rel="stylesheet" href="style.css"   />
 
    <script type="text/javascript" src="js/CONSTANT.js"></script>
    <script type="text/javascript" src="js/main.js"    ></script>
 </head>
  <body>
	<div id="wrapper">
		<canvas id="d_canvas">
		  Ihr Browser unterstützt HTML5 leider nicht!
		</canvas>
	</div>
  </body>
</html>
