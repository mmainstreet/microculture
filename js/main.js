const FPS = 50,
      BALL_BORDER_WIDTH = 1,
      BALL_BORDER_COLOR = "#000000";

var g_context,   
    g_timer,     
    cells = []; 
var pause = false;
 
function click()
{
  alert();
  if(pause)
    {
      pause = false;
    }
  else
  {
    pause = true;
  }
};
pausebut.onclick = click;
function startFight()
{
  pause  = false;
}

function game()
{
  if(!pause)
  {
    for (var i = 0; i < MAXCELLCOUNT; i++)
    { 
      cells[0][i].calcDirection();
      cells[1][i].calcDirection();

      cells[0][i].move();
      cells[1][i].move();
    }
  }
} 


function createCells()
{
  for(var j = 0;j<2;j++)
  {
    cells[j] = [];
    for (var i = 0; i < MAXCELLCOUNT; i++)
    { 
      var team;
      if(j==0)
      {
        team = team1;
      }
      else
      {
        team = team2;
      }
      cells[j][i] =
        { 
          id:       team[i][0],
          name:     team[i][1],
          mass:     team[i][2]*15,
          defense:  team[i][3],
          damage:   team[i][4],
          agility:  team[i][5],
          speed:    team[i][6],
          posx:     team[i][7],
          posy:     team[i][8],
          tactic:   team[i][9],
          teamid: j+1,
          dirx: 0, 
          diry: 0,

          collisionDetection:
          function()
          {
            var result = [];
            for(var j = 0; j<2; j++)
            for(var i = 0; i<5;i++)
            {
              var k = i*(j+1);
              result[k] = [];
              if(i == this.id && j == this.teamid-1)
              {

              }
              else
              {
                var posx    = cells[j][i].posx;
                var posy    = cells[j][i].posy;
                var radius  = cells[j][i].mass;

                if(Math.abs(this.posx - posx)<=radius + this.mass)
                {
                  result[k][0] = true;
                }        
                else
                {
                  result[k][0] = false;
                }
                if(Math.abs(this.posy - posy)<=radius + this.mass)
                {
                  result[k][1] = true;
                }              
                else
                {
                  result[k][1] = false; 
                } 
              }
            }
            return result;
          },

          calcDirection:
            function()
            {
              if(this.tactic == "aggro")
              {
                var distance  = 5000;
                for(var i = 0; i<MAXCELLCOUNT; i++)
                {
                  var tempx = cells[this.teamid%2][i].posx;
                  var tempy = cells[this.teamid%2][i].posy;

                  if(this.teamid == 0)
                  {
                    tempx = tempx - this.posx;
                    tempy = tempy - this.posy;
                  }
                  else
                  {
                    tempx = tempx - this.posx;
                    tempy = tempy - this.posy;
                  }

                  var tempdis = Math.sqrt(tempx*tempx+tempy*tempy);

                  //Choose Focused cell
                  if(distance > tempdis)
                  {
                    distance  = tempdis;
                    this.dirx = tempx/tempdis;
                    this.diry = tempy/tempdis;
                  }
                }
              }              
            },
          move:
            function()
            { 
              if(this.id<5)
              {
                text[this.id+1][0].value = this.id;
                text[this.id+1][1].value = this.name;
                text[this.id+1][2].value = this.mass;
                text[this.id+1][3].value = this.defense;
                text[this.id+1][4].value = this.damage;
                text[this.id+1][5].value = this.agility;
                text[this.id+1][6].value = this.speed;
                text[this.id+1][7].value = this.posx;
                text[this.id+1][8].value = this.posy;
                text[this.id+1][9].value = this.tactic;
              }
              var collision = this.collisionDetection();

            
                  this.posx = this.posx+this.dirx*this.speed;
                  this.posy = this.posy+this.diry*this.speed;

            },

          draw:
            function(p_context)
            { p_context.beginPath();
              p_context.arc(this.posx, this.posy, this.mass, 0, 2*Math.PI);
              p_context.lineWidth   = BALL_BORDER_WIDTH;
              p_context.strokeStyle = BALL_BORDER_COLOR;
              p_context.fillStyle   = CELLCOLOR1;
              p_context.stroke();
              p_context.fill();
            }
        };
    }
  }

  //Free Memory of temp 
}

function o_redraw() 
{ 
  //game-calculations
  game();

  //Redraw Scene
  g_context.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
  for (var i = 0; i < MAXCELLCOUNT; i++)
  { 
    cells[0][i].draw(g_context);
    cells[1][i].draw(g_context); 
  }
}

function f_init() 
{ 
  var l_canvas = document.getElementById("d_canvas");
  createCells();

  // Initialize the canvas.
  l_canvas.width  = CANVAS_WIDTH;
  l_canvas.height = CANVAS_HEIGHT;
  g_context       = l_canvas.getContext("2d");

  g_timer = window.setInterval(o_redraw, 1000/FPS);
}

window.onload = f_init;