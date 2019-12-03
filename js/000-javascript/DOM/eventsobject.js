/*
abort
beforeunload
error
load
resize
scroll
select
unload
*/

document.getElementById("id").addEventListener("load", function(e){  // UiEvent
    
    /*
        Event
        inherited from event object
        (all events ingherit from events object)
    */

    e.bubbles;
    e.cancelBubble;
    e.cancelable;
    e.composed;
    e.createEvent();
    e.composedPath();
    e.currentTarget;
    e.defaultPrevented;
    e.eventPhase;
    e.isTrusted;
    e.preventDefault();
    e.stopImmediatePropagation();
    e.stopPropagation();
    e.target;
    e.timeStamp;
    e.type;

    /*
        UiEvent
    */
 
    e.detail;
    e.view;
});

/*
animationend
animationiteration
animationstart
*/

document.getElementById("id").addEventListener("animationstart", function(e){  // AnimationEvent 
    e.animationName;
    e.elapsedTime;
    e.pseudoElement;
});

/*
oncopy
oncut
onpaste
*/

document.getElementById("input").addEventListener("copy", function(e){  // ClipboardEvent 
    e.clipboardData;
});

/*
ondrag
ondragend
ondragenter
ondragleave
ondragover
ondragstart
ondrop
*/

document.getElementById("id").addEventListener("drag", function(e){  // DragEvent 
    e.dataTransfer;
});

/*
onblur
onfocus
onfocusin
onfocusout
*/

document.getElementById("id").addEventListener("focus", function(e){  //FocusEvent
    e.relatedTarget;
});

/*
onhashchange
*/

document.getElementById("id").addEventListener("hashchange", function(e){  //HashChangeEvent
    e.newURL;
    e.oldURL;
});

/*
oninput
*/

document.getElementById("id").addEventListener("input", function(e){  //InputEvent
    e.data;
    e.dataTransfer;
    e.getTargetRanges();
    e.inputType;
    e.isComposing;
});

/*
onkeydown
onkeypress
onkeyup
*/

document.getElementById("id").addEventListener("keypress", function(e){  //KeyboardEvent
    e.altKey;
    e.charCode;
    e.code;
    e.ctrlKey;
    e.getModifierState();
    e.isComposing;
    e.key;
    e.keyCode;
    e.location;
    e.metaKey;
    e.repeat;
    e.shiftKey;
    e.which;
});

/*
onclick
oncontextmenu
ondblclick
onmousedown
onmouseenter
onmouseleave
onmousemove
onmouseout
onmouseover
onmouseup
*/

document.getElementById("id").addEventListener("click", function(e){  //MouseEvent

    e.button;
    e.buttons;
    e.clientX;
    e.clientY;
    e.ctrlKey;
    e.getModifierState();
    e.metaKey;
    e.movementX;
    e.movementY;
    e.offsetX;
    e.offsetY;
    e.pageX;
    e.pageY;
    e.region;
    e.relatedTarget;
    e.screenX;
    e.screenY;
    e.shiftKey;
    e.which;
});

/*
pagehide
pageshow
*/

document.getElementById("id").addEventListener("pageshow", function(e){  //PageTransitionEvent
    e.persisted;
});

/*
popstate
*/

document.getElementById("id").addEventListener("popstate", function(e){  //PopStateEvent
    e.state;
});

/*
onerror
onloadstart
*/

document.getElementById("id").addEventListener("loadstart", function(e){  //ProgressEvent
    e.lengthComputable;
    e.loaded;
    e.total;
});

/*
storage
*/

document.getElementById("id").addEventListener("storage", function(e){  //
    e.key;
    e.newValue;
    e.oldValue;
    e.storageArea;
    e.url;
});

/*
ontouchcancel
ontouchend
ontouchmove
ontouchstar
*/

document.getElementById("id").addEventListener("touchstar", function(e){  //TouchEvent
    e.altKey;
    e.changedTouches;
    e.ctrlKey;
    e.metaKey;
    e.shiftKey;
    e.targetTouches;
    e.touches;
});

/*
transitionend
*/

document.getElementById("id").addEventListener("transitionend", function(e){  //TransitionEvent
    e.propertyName;
    e.elapsedTime;
    e.pseudoElement;
});


/*
onwheel
*/

document.getElementById("id").addEventListener("wheel", function(e){  //WheelEvent
    e.deltaX;
    e.deltaY;
    e.deltaZ;
    e.deltaMode;
});

