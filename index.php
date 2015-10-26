<?php
//new Account
include './gamefiles/main.php';

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Microculture</title>
 
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=yes">
 
    <link rel="stylesheet" href="./cs/style.css"   />
 	<?php
 		$game = New Game();
    $game->load();
    $game->sendValues();
 	?>
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
