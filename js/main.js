const FPS = 50,
      BALL_BORDER_WIDTH = 1,
      BALL_BORDER_COLOR = "#000000";

var g_context,   
    g_timer,     
    cells = []; 
var pause = false;

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
          mass:     team[i][2],
          defense:  team[i][3],
          attack:   team[i][4],
          agility:  team[i][5],
          speed:    team[i][6],
          posx:     team[i][7],
          posy:     team[i][8],
          tactic:   team[i][9],
          teamid: j+1,
          dirx: 0, 
          diry: 0,

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
              this.posx = this.posx+this.dirx*this.speed;
              this.posx = this.posx+this.diry*this.speed;
            },

          draw:
            function(p_context)
            { p_context.beginPath();
              p_context.arc(this.posx, this.posy, this.mass*15, 0, 2*Math.PI);
              p_context.lineWidth   = BALL_BORDER_WIDTH;
              p_context.strokeStyle = BALL_BORDER_COLOR;
              p_context.fillStyle   = CELLCOLOR1;
              p_context.stroke();
              p_context.fill();
            }
        };
    }
  }
s
  //Free Memory of temp 
}
{}
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
