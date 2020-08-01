const nombre ='Agustin'

localStorage.setItem('nombreDeusurio',nombre)

var mouseX = 0, mouseY = 0, limitX, limitY, containerWidth;

window.onload = function(e) {
  var containerObjStyle = window.getComputedStyle(document.querySelectorAll(".container")[0]);
  containerWidth =  parseFloat(containerObjStyle.width).toFixed(0);
  containerHeight = parseFloat(containerObjStyle.height).toFixed(0);
  document.getElementById('debug').innerHTML = 'Container Width = ' + containerWidth + '<br/>Container Height = ' + containerHeight;
  var follower = document.getElementById("follower");
  var xp = 0, yp = 0;
  limitX = containerWidth-15;
  limitY = containerHeight-15;
  var loop = setInterval(function(){
    xp = (mouseX == limitX) ? limitX : mouseX -7;
    xp = (xp < 0) ? 0 : xp;
    yp = (mouseY == limitY) ? limitY : mouseY -7;
    yp = (yp < 0) ? 0 : yp;
    follower.style.left = xp + 'px';
    follower.style.top = yp + 'px';
  }, 15);
  window.onresize = function(e) {
    limitX = parseFloat(window.getComputedStyle(document.querySelectorAll(".container")[0]).width).toFixed(0);
    document.getElementById("debug")[0].innerHTML='Container Width = ' + containerWidth + '<br/>Container Height = ' + containerHeight;
  }
  document.onmousemove = function(e) {
    mouseX = Math.min(e.pageX, limitX);
    mouseY = Math.min(e.pageY, limitY);
  }
};