const FPS = 50,
      BALL_BORDER_WIDTH = 1,
      BALL_BORDER_COLOR = "#000000";

var g_context,   
    g_timer,     
    cells = []; 

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
        { r:  team[i][2]*20,
          x:  team[i][7],
          y:  team[i][8],
          vx: 0, 
          vy: 0,

          move:
            function()
            { 
              this.x = this.x;
              this.y = this.y;
            },

          draw:
            function(p_context)
            { p_context.beginPath();
              p_context.arc(this.x, this.y, this.r, 0, 2*Math.PI);
              p_context.lineWidth   = BALL_BORDER_WIDTH;
              p_context.strokeStyle = BALL_BORDER_COLOR;
              p_context.fillStyle   = CELLCOLOR1;
              p_context.stroke();
              p_context.fill();
            }
        };
    }
  }
}

function o_redraw() 
{ 
  for (var i = 0; i < MAXCELLCOUNT; i++)
  { 
    cells[0][i].move();
    cells[1][i].move();
  }

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