"use strict";

var g_context,    //the 2d context of the canvas
    g_timer,      // the "physics engine" timer
    g_balls = []; // all the balls

for (var i = 0; i < BALLS_NUMBER; i++)
{ g_balls[i] =
    { r:  BALL_RADIUS_MIN + Math.random()*(BALL_RADIUS_MAX-BALL_RADIUS_MIN),
      x:  BALL_RADIUS_MAX + Math.random()*(CANVAS_WIDTH-2*BALL_RADIUS_MAX),
      y:  BALL_RADIUS_MAX + Math.random()*(CANVAS_HEIGHT-2*BALL_RADIUS_MAX),
      vx:   (Math.random() < 0.5 ? 1 : -1)
          * (BALL_VX_MIN + Math.random() * (BALL_VX_MAX - BALL_VX_MIN)), 
      vy:   (Math.random() < 0.5 ? 1 : -1)
          * (BALL_VY_MIN + Math.random() * (BALL_VY_MAX - BALL_VY_MIN)),

      // Moves the ball in direction (vx,vy); the step size depends on FPS.
      move:
        function()
        { this.x += this.vx/FPS;
          this.y += this.vy/FPS;
        },

      // Draws the ball at its current position onto a 2d context.
      draw:
        function(p_context)
        { p_context.beginPath();
          p_context.arc(this.x, this.y, this.r, 0, 2*Math.PI);
          p_context.lineWidth   = BALL_BORDER_WIDTH;
          p_context.strokeStyle = BALL_BORDER_COLOR;
          p_context.fillStyle   = BALL_COLOR;
          p_context.stroke();
          p_context.fill();
        }
    };
}

// An event observer: 
// It is called every 1000/FPS milliseconds.
function o_redraw() 
{ var i, l_ball;

  for (i = 0; i < BALLS_NUMBER; i++)
  { l_ball = g_balls[i];
  
    // Collision detection: current ball <-> wall 
    // Collision response:  change the moving direction of the current ball
    if (l_ball.x <= l_ball.r || l_ball.x >= CANVAS_WIDTH  - l_ball.r)
    { l_ball.vx = -l_ball.vx; }
    if (l_ball.y <= l_ball.r || l_ball.y >= CANVAS_HEIGHT - l_ball.r)
    { l_ball.vy = -l_ball.vy; }
  
    // Move the current ball.
    l_ball.move();
  }

  // Clear and redraw the canvas.
  g_context.clearRect(0, 0, CANVAS_WIDTH, CANVAS_HEIGHT);
  for (i = 0; i < BALLS_NUMBER; i++)
  { g_balls[i].draw(g_context); }
}

// Has to be called after the HTML page has been loaded.
function f_init() 
{ var l_canvas = document.getElementById("d_canvas");

  // Initialize the canvas.
  l_canvas.width  = CANVAS_WIDTH;
  l_canvas.height = CANVAS_HEIGHT;
  g_context       = l_canvas.getContext("2d");

  // Start the timer for redrawing the canvas every 1000/FPS milliseconds.
  g_timer = window.setInterval(o_redraw, 1000/FPS);
}

//Execute the init function after the HTML page has been loaded.
window.onload = f_init;