<?php
?>
<html>
<body>
<script type = "text/javascript">
var text = []
var posx = 100;
var posy = 100;
for(var i = 0; i<5;i++)
{
	text[i] = []
	for(var j = 0; j<10;j++)
	{
		text[i][j] 					= document.createElement('input');
  		text[i][j].type 			= "text";
  		text[i][j].style.position 	= "absolute";
  		text[i][j].style.left		= posx + i*50 + "px";
  		text[i][j].style.top 		= posy + j*25 + "px";
  		text[i][j].style.width 		= "50px";
  		text[i][j].style.height     = "25px";

		document.getElementsByTagName("BODY")[0].appendChild(text[i][j]);
	}
}
</script>

</body>
</html>