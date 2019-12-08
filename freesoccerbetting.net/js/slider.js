$(function(){
    $('#sidebar').on('click',function(event){
       event.preventDefault() ;
       //event.stopPropagation();
    });
});
/* Function to activate button */
function open_panel(){
    slideIt();
    var a = document.getElementById("sidebar");
    a.setAttribute("id","sidebar1");
    a.setAttribute("onclick","close_panel()");
}

/* Function to slide open panel */
function slideIt(){
    var slidingDiv = document.getElementById("slider");
    var stopPosition = 14;
    if (parseInt(slidingDiv.style.left) < stopPosition) {
        slidingDiv.style.left = parseInt(slidingDiv.style.left) + 2 + "px";
        setTimeout(slideIt, 1);
    }
}

/* Function to close panel */
function close_panel(){
    slideIn();
    a = document.getElementById("sidebar1");
    a.setAttribute("id","sidebar");
    a.setAttribute("onclick","open_panel()");
}

/* Function to slide out open panel */
function slideIn(){
    var slidingDiv = document.getElementById("slider");
    var stopPosition = -264;
    if (parseInt(slidingDiv.style.left) > stopPosition) {
        slidingDiv.style.left = parseInt(slidingDiv.style.left) - 2 + "px";
        setTimeout(slideIn, 1);
    }
}

