

// add and remove event from element
function listener(){
	console.log('test');
	document.getElementById("id").removeEventListener("click", listener, false);
}

document.getElementById("id").addEventListener(
	"click", 
	listener, 
	false
);

// one time event listener
document.getElementById("id").addEventListener("click", function(e){
	    console.log('click');
	},{capture:false, once:true}
);

document.getElementById("id").addEventListener("click", function(e){
		e.stopPropagation(); // prevent bubbling event
	    console.log('click');
	},false
);

//add event to all elements
for(x of document.body.getElementsByTagName("*")){
    x.addEventListener("click",function(e){
        console.log(e.currentTarget.id, e.target.id, e.eventPhase);
    }, true); // capturing
    
    x.addEventListener("click",function(e){
        console.log("currentTarget="+e.currentTarget.id, "target="+e.target.id, "eventPhase="+e.eventPhase);
    }, false); // bubbling
}

// one time event
var el = document.getElementById("id");
var handler = function(e) {
  this.loginBox.classList.remove("login--shake");
  el.removeEventListener("click", handler, false); 
};
el.addEventListener("click", handler, false); 

document.getElementById("id").addEventListener("abort", function(){ });
document.getElementById("id").addEventListener("afterprint", function(){ });
document.getElementById("id").addEventListener("animationcancel", function(){ });
document.getElementById("id").addEventListener("animationend", function(){ });
document.getElementById("id").addEventListener("animationiteration", function(){ });
document.getElementById("id").addEventListener("animationstart", function(){ });
document.getElementById("id").addEventListener("audioprocess", function(){ });
document.getElementById("id").addEventListener("auxclick", function(){ });
document.getElementById("id").addEventListener("beforeprint", function(){ });
document.getElementById("id").addEventListener("beforeunload", function(){ });
document.getElementById("id").addEventListener("blur", function(){ });
document.getElementById("id").addEventListener("broadcast", function(){ });
document.getElementById("id").addEventListener("canplay", function(){ });
document.getElementById("id").addEventListener("canplaythrough", function(){ });
document.getElementById("id").addEventListener("change", function(){ });
document.getElementById("id").addEventListener("CheckboxStateChange", function(){ });
document.getElementById("id").addEventListener("checking", function(){ });
document.getElementById("id").addEventListener("click", function(){ });
document.getElementById("id").addEventListener("close", function(){ });
document.getElementById("id").addEventListener("complete", function(){ });
document.getElementById("id").addEventListener("compositionend", function(){ });
document.getElementById("id").addEventListener("compositionstart", function(){ });
document.getElementById("id").addEventListener("compositionupdate", function(){ });
document.getElementById("id").addEventListener("contextmenu", function(){ });
document.getElementById("id").addEventListener("copy", function(){ });
document.getElementById("id").addEventListener("cut", function(){ });
document.getElementById("id").addEventListener("dblclick", function(){ });
document.getElementById("id").addEventListener("downloading", function(){ });
document.getElementById("id").addEventListener("drag", function(){ });
document.getElementById("id").addEventListener("dragend", function(){ });
document.getElementById("id").addEventListener("dragenter", function(){ });
document.getElementById("id").addEventListener("dragleave", function(){ });
document.getElementById("id").addEventListener("dragover", function(){ });
document.getElementById("id").addEventListener("dragstart", function(){ });
document.getElementById("id").addEventListener("drop", function(){ });
document.getElementById("id").addEventListener("durationchange", function(){ });
document.getElementById("id").addEventListener("emptied", function(){ });
document.getElementById("id").addEventListener("ended", function(){ });
document.getElementById("id").addEventListener("error", function(){ });
document.getElementById("id").addEventListener("focus", function(){ });
document.getElementById("id").addEventListener("fullscreenchange", function(){ });
document.getElementById("id").addEventListener("fullscreenerror", function(){ });
document.getElementById("id").addEventListener("hashchange", function(){ });
document.getElementById("id").addEventListener("input", function(){ });
document.getElementById("id").addEventListener("invalid", function(){ });
document.getElementById("id").addEventListener("keydown", function(){ });
document.getElementById("id").addEventListener("keypress", function(){ });
document.getElementById("id").addEventListener("keyup", function(){ });
document.getElementById("id").addEventListener("load", function(){ });
document.getElementById("id").addEventListener("loadeddata", function(){ });
document.getElementById("id").addEventListener("loadedmetadata", function(){ });
document.getElementById("id").addEventListener("loadend", function(){ });
document.getElementById("id").addEventListener("loadstart", function(){ });
document.getElementById("id").addEventListener("message", function(){ });
document.getElementById("id").addEventListener("mousedown", function(){ });
document.getElementById("id").addEventListener("mouseenter", function(){ });
document.getElementById("id").addEventListener("mouseleave", function(){ });
document.getElementById("id").addEventListener("mousemove", function(){ });
document.getElementById("id").addEventListener("mouseout", function(){ });
document.getElementById("id").addEventListener("mouseover", function(){ });
document.getElementById("id").addEventListener("mouseup", function(){ });
document.getElementById("id").addEventListener("noupdate", function(){ });
document.getElementById("id").addEventListener("obsolete", function(){ });
document.getElementById("id").addEventListener("offline", function(){ });
document.getElementById("id").addEventListener("online", function(){ });
document.getElementById("id").addEventListener("open", function(){ });
document.getElementById("id").addEventListener("pagehide", function(){ });
document.getElementById("id").addEventListener("pageshow", function(){ });
document.getElementById("id").addEventListener("paste", function(){ });
document.getElementById("id").addEventListener("pause", function(){ });
document.getElementById("id").addEventListener("play", function(){ });
document.getElementById("id").addEventListener("playing", function(){ });
document.getElementById("id").addEventListener("pointerlockchange", function(){ });
document.getElementById("id").addEventListener("pointerlockerror", function(){ });
document.getElementById("id").addEventListener("popstate", function(){ });
document.getElementById("id").addEventListener("progress", function(){ });
document.getElementById("id").addEventListener("RadioStateChange", function(){ });
document.getElementById("id").addEventListener("ratechange", function(){ });
document.getElementById("id").addEventListener("readystatechange", function(){ });
document.getElementById("id").addEventListener("reset", function(){ });
document.getElementById("id").addEventListener("resize", function(){ });
document.getElementById("id").addEventListener("scroll", function(){ });
document.getElementById("id").addEventListener("seeked", function(){ });
document.getElementById("id").addEventListener("seeking", function(){ });
document.getElementById("id").addEventListener("select", function(){ });
document.getElementById("id").addEventListener("show", function(){ });
document.getElementById("id").addEventListener("stalled", function(){ });
document.getElementById("id").addEventListener("storage", function(){ });
document.getElementById("id").addEventListener("submit", function(){ });
document.getElementById("id").addEventListener("suspend", function(){ });
document.getElementById("id").addEventListener("timeout", function(){ });
document.getElementById("id").addEventListener("timeupdate", function(){ });
document.getElementById("id").addEventListener("transitioncancel", function(){ });
document.getElementById("id").addEventListener("transitionend", function(){ });
document.getElementById("id").addEventListener("transitionrun", function(){ });
document.getElementById("id").addEventListener("transitionstart", function(){ });
document.getElementById("id").addEventListener("unload", function(){ });
document.getElementById("id").addEventListener("updateready", function(){ });
document.getElementById("id").addEventListener("ValueChange", function(){ });
document.getElementById("id").addEventListener("volumechange", function(){ });
document.getElementById("id").addEventListener("waiting", function(){ });
document.getElementById("id").addEventListener("wheel", function(){ });
