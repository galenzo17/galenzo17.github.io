/*
$("$button").click(function() {
    $('html,body').animate({
        scrollTop: $(".second").offset().top},
        'slow');
});
*/
$(function() {
    $('a[href*=\\#]:not([href=\\#])').on('click', function() {
        var target = $(this.hash);
        target = target.length ? target : $('[name=' + this.hash.substr(1) +']');
        if (target.length) {
            $('html,body').animate({
                scrollTop: target.offset().top
            }, 1000);
            return false;
            console.log('123')
        }
    });
});

var elem = document.getElementById("myAnimation");   
  var pos = 0;
  var w =false;
  var id = setInterval(frame, 30);
  function frame() {
    if (pos >=0 && !w ) {
     // clearInterval(id);
     // pos=0;
     pos++;
     elem.style.top = pos + 'px'; 
     elem.style.bottom = pos + 'px'; 
    } 
	if(pos==18){
    w=true;
    }
    if(w){
    pos--;
     elem.style.top = pos + 'px'; 
     elem.style.bottom = pos + 'px';
     }
     if(pos==0){
     w=false;
     }
  }