<!DOCTYPE html>
<html>
<head>
    <title>ColorPicker</title>
    <style type="text/css">
        main {
            padding-top: 0px;
            width:1200px;
            margin: 0px auto;
        }

        body {
            background-color: black;
            color:white;
        }

        .block {
            margin:0px;
            padding:0px;
            height:3px;
            width:3px;
            background-color: white;
            color:black;
            text-align:center;
            float:left;
        }

        #range1 {
            width:100%;
            margin: 30px 0px;
        }
        #color {
            width:293px;
            margin:10px 0px;
            padding:10px 10px;
            font-size:32px;
            border:0px;
            color:white;
            background:black;
            text-shadow: 2px 2px 5px black;
            float:left;
            height:32px;
        }
        #color-invert {
            width:293px;
            margin:10px 0px;
            padding:10px 10px;
            font-size:32px;
            border:0px;
            color:white;
            background:black;
            text-shadow: 2px 2px 5px black;
            text-align:right;
            float:left;
            height:32px;
        }

        #colors {
            float:left
        }

        #picker {
            float:left;
            background:black;
            margin:0px 10px;
            padding:0px 10px;
            width:300px;
            height:750px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .picker-block {
            margin:0px 0px 10px 0px;
            padding:10px;
            font-size:32px;
            width:93%;
            color:white;
            text-shadow: 2px 2px 5px black;
        }
    </style>
</head>
<body>
    
<main>
<div>
    <form>
        <input id="range1" type="range" min="0" max="255" value="0" step="1" oninput="changeColor()" onchange="changeColor()"><br>
        <div id="color"></div> 
        <div id="color-invert"></div> 
    </form>
</div>
    <div>

        <div id="colors" draggable='false'>
            <canvas id="canvas" width="770" height="770" onmousedown="mouseDown(event, this);" onmousemove="mouseMove(event, this);" onmouseup="mouseUp(event, this);"></canvas>
        </div>

        <div id="picker">
        </div>

    </div>
</main>


<script type="text/javascript">

    var options = {
        useImageCache: true,
        useCache: false,
        createUrls: false
    }

    function invertColor(hex) {
      hex = hex.replace('#', '');
      return '#'+(Number(`0x1${hex}`) ^ 0xFFFFFF).toString(16).substr(1).toUpperCase()
    }

    function toHex(d) {
        return  ("0"+(Number(d).toString(16))).slice(-2).toUpperCase()
    }

    function id(i){
        return document.getElementById(i);
    }

    var timer = null;
    function changeColor() {
        if(timer==null) {
            timer = setTimeout(function() { 
                window.localStorage.setItem('range', id('range1').value);
                draw();
                timer = null;
            }, 100);
        }
        
    }

    var mDown = false;

    function mouseDown(e, el) {
        var x = e.pageX - el.offsetLeft; 
        var y = e.pageY - el.offsetTop; 

        mDown = true;
    }

    function mouseMove(e, el) {
        var x = e.pageX - el.offsetLeft; 
        var y = e.pageY - el.offsetTop; 

        if (event.which === 1 || event.buttons === 1) {
            setColor(x,y);
        }
    }

    function mouseUp(e, el) {
        var x = e.pageX - el.offsetLeft; 
        var y = e.pageY - el.offsetTop; 

        if (mDown) {
            setColor(x,y);
            pickColorFromMousePosition(x,y);
        }
    }

    window.addEventListener('mouseup', function(event){
        mDown = false;
    })

    function mousePositionToColor(x,y) {
        var c1 = id('range1').value;
        var c2 = Math.floor(x / 3);
        var c3 = Math.floor(y / 3);

        if(c1<0)c1=0;
        if(c1>255)c1=255;
        if(c2<0)c2=0;
        if(c2>255)c2=255;
        if(c3<0)c3=0;
        if(c3>255)c3=255;

        return "#"+toHex(c1)+toHex(c2)+toHex(c3);
    }

    function setColor(x,y) {
        var color = mousePositionToColor(x,y);

        id('color').innerHTML = color;
        id('color').style.backgroundColor = color;

        id('color-invert').innerHTML = invertColor(color);
        id('color-invert').style.backgroundColor = invertColor(color);
    }

    var pickedColors = [];

    function pickColorFromMousePosition(x,y) {
        var color = mousePositionToColor(x,y);

        pickedColors.unshift(color);
        pickedColors= pickedColors.slice(0, 1000);

        window.localStorage.setItem('pickedColors', JSON.stringify(pickedColors));

        addPickedColor(color);
    }

    function addPickedColor(color) {
        var picked = document.createElement("div");
        picked.classList.add("picker-block");
        picked.innerHTML = color;
        picked.style.backgroundColor = color;
        id('picker').prepend(picked);
    }
    
    var cache = [];
    var cacheImages = [];

    function buildCache() {
        var canvas = id('canvas');
        canvas.style.display = 'none';
        if (!canvas.getContext) {
            return;
        }

        var ctx = canvas.getContext('2d');

        for(var k = 0; k <= 255; k = k+1) {
            cache[k] = ctx.getImageData(0, 0, 770, 770)
            for(var i = 0; i <= 255; i = i+1) {
                for(var j = 0; j <= 255; j = j+1) {
                    var color = "#"+toHex(k)+toHex(i)+toHex(j);
                    ctx.fillStyle = color;
                    ctx.fillRect(i*3, j*3, 3, 3);
                }    
            }
            cache[k] = ctx.getImageData(0, 0, 770, 770);
            if(options.createUrls)cacheDataUrls[k] = canvas.toDataURL();
        }
        canvas.style.display = 'block';
    }

    function buildImageCache() {
        for(var i = 0; i < cacheDataUrls.length; i++) {
            cacheImages[i] = new Image();
            cacheImages[i].src = cacheDataUrls[i];
        }
    }

    function draw() {
        var canvas = document.getElementById('canvas');
        if (!canvas.getContext) {
            return;
        }

        var ctx = canvas.getContext('2d');

        r = id('range1').value;

        if (typeof cacheImages[r] != 'undefined') {
            ctx.drawImage(cacheImages[r], 0, 0);
            return;
        }

        if (typeof cache[r] != 'undefined') {
            ctx.putImageData(cache[r], 0, 0);
            return;
        }

        for(var i = 0; i <= 255; i = i+1) {
            for(var j = 0; j <= 255; j = j+1) {
                var color = "#"+toHex(r)+toHex(i)+toHex(j);
                ctx.fillStyle = color;
                ctx.fillRect(i*3, j*3, 3, 3);
            }    
        }

        cache[r] = ctx.getImageData(0, 0, 770, 770)
    }

    function init(){

        if(window.localStorage.getItem('range') != null){
            id('range1').value = window.localStorage.getItem('range');
        }

        if(window.localStorage.getItem('pickedColors') != null){
            pickedColors = JSON.parse(window.localStorage.getItem('pickedColors'))
        }

        for(var i = pickedColors.length-1; i >= 0; i--) {
            addPickedColor(pickedColors[i]);
        }

        if(options.useCache)buildCache();
        if(options.useImageCache)buildImageCache();
    }

    window.addEventListener('load', init);
    window.addEventListener("load", draw);

    
</script>
<script type="text/javascript" src='cache.js'></script>

</body>
</html>
