var text = [];
var posx = 850;
var posy = 5;
var lablenames = ["id","name","mass", "defense", "attack", "agility", "speed", "posx", "posy", "tactic"];
for(var i = 0; i<6;i++)
{
  text[i] = [];
	for(var j = 0; j<10;j++)
	{
		  text[i][j] 					= document.createElement('input');
  		text[i][j].type 			= "text";
  		text[i][j].style.position 	= "absolute";
  		text[i][j].style.left		= posx + i*50 + "px";
  		text[i][j].style.top 		= posy + j*25 + "px";
  		text[i][j].style.width 		= "50px";
  		text[i][j].style.height     = "25px";

		document.getElementsByTagName("DIV")[0].appendChild(text[i][j]);
  }
}
for(var i = 0;i<10;i++)
{
  text[0][i].value = lablenames[i];
}
var pausebut = document.createElement('input');
    pausebut.type       = "button";
    pausebut.style.position   = "absolute";
    pausebut.style.left   = posx + 6*50/2 + "px";
    pausebut.style.top    = posy + 10*25 + 50 + "px";
    pausebut.style.width    = "50px";
    pausebut.style.height     = "25px";
    pausebut.value = "Pause";

    document.getElementsByTagName("DIV")[0].appendChild(pausebut);