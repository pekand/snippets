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

        #color-picker__range-input {
            width:100%;
            margin: 30px 0px;
        }

        #color {
            width:293px;
            margin:0px;
            padding:0px;
            font-size:32px;
            border:0px;
            color:white;
            background:black;
            text-shadow: 2px 2px 5px black;
            float:left;
        }

        #color-invert {
            width:293px;
            margin:0px;
            padding:0px;
            font-size:32px;
            border:0px;
            color:white;
            background:black;
            text-shadow: 2px 2px 5px black;
            text-align:right;
            float:left;
        }

        input.color-picker__color-input {
            width:293px;
            text-shadow: 2px 2px 5px black;
            color:white;
            background-color:black;
            border:0;
            outline:0;
            font-size:32px;
            padding:5px;
        }

        input:focus.color-picker__color-input {
            outline:none!important;
        }

        .color-picker__picker {
            float:left
        }

        #color-picker__picked-colors {
            float:left;
            background:black;
            margin:0px 10px;
            padding:0px 10px;
            width:300px;
            height:750px;
            overflow-y: auto;
            overflow-x: hidden;
        }

        .color-picker__picked-colors__block {
            margin:0px 0px 10px 0px;
            padding:10px;
            height:34px;
        }

        .color-picker__picked-colors__block__text {
            float:left;
            font-size:32px;
            width:93%;
            color:white;
            text-shadow: 2px 2px 5px black;
        }

        .color-picker__picked-colors__block__remove-button {
            float:right;
            color:black;
            user-select: none;
            opacity:0.9;
            text-shadow: 2px 2px 5px white;
        }

        ::-webkit-scrollbar {
          width: 10px;
        }

        ::-webkit-scrollbar-track {
          background: #f1f1f1; 
        }
         
        ::-webkit-scrollbar-thumb {
          background: #888; 
        }

        ::-webkit-scrollbar-thumb:hover {
          background: #555; 
        }

        .range {
          -webkit-appearance: none;
          width: 100%;
          height: 15px;
          border-radius: 5px;  
          background: #d3d3d3;
          outline: none;
          opacity: 0.7;
          -webkit-transition: .2s;
          transition: opacity .2s;
        }

        .range::-webkit-slider-thumb {
          -webkit-appearance: none;
          appearance: none;
          width: 25px;
          height: 25px;
          border-radius: 50%; 
          background: #04AA6D;
          cursor: pointer;
        }

        .range::-moz-range-thumb {
          width: 25px;
          height: 25px;
          border-radius: 50%;
          background: #04AA6D;
          cursor: pointer;
        }


    </style>
</head>
<body>
    
<main>
    <div class="color-picker">
        <div class="color-picker__header">
            <div><input id="color-picker__range-input" type="range" class="color-picker__range-input" min="0" max="255" value="0" step="1"></div>
            <div id="color"><input type="text" name="color" id="color-picker__color-input" class="color-picker__color-input" value="#000000"></div> 
            <div id="color-invert"><input type="text" name="color" id="color-picker__color-invert-input" class="color-picker__color-input color-picker__color-input--invert" value="#FFFFFF"></div> 
        </div>
        <div class="color-picker__body">

            <div draggable='false' class="color-picker__picker">
                <canvas id="color-picker__picker" width="770" height="770" >
                </canvas>
            </div>

            <div id="color-picker__picked-colors" class="color-picker__picked-colors">
            </div>

        </div>
    </div>
</main>


<script type="text/javascript">

    var options = {
        useCache: true,
        useImageCache: true,
        createUrls: true
    }

    var cache = [];
    var cacheImages = [];
    var pickedColors = [];
    var timer = null;
    var mDown = false;

    // tool
    function invertColor(hex) {
      hex = hex.replace('#', '');
      return '#'+(Number(`0x1${hex}`) ^ 0xFFFFFF).toString(16).substr(1).toUpperCase()
    }

    // tool
    function toHex(d) {
        return  ("0"+(Number(d).toString(16))).slice(-2).toUpperCase()
    }

    // tool
    function id(i){
        return document.getElementById(i);
    }

    // tools
    function uid() {
        return "UID"+Date.now().toString(36)+Math.random().toString(36).substr(2);
    }

    function l(m){
        console.log(m);
    }

    // range input
    function changeColorRange(range) {

        if(options.useCache) {
            rememberLastRange(range);
            drawColorPicker();
            return;
        }

        if(timer==null) {
            timer = setTimeout(function() { 
                rememberLastRange(range);
                drawColorPicker();
                timer = null;
            }, 100);
        }
    }

    // range input
    function colorToRange(color) {
        var a = color.match(/^\#([a-fA-F0-9]{2})([a-fA-F0-9]{2})([a-fA-F0-9]{2})$/);
        return parseInt(Number("0x"+a[1]), 10);
    }


    // color picker component
    function pickColorFromMousePosition(x,y) {
        var color = mousePositionToColor(x,y);

        var pickedColor = {
            uid: uid(),
            color: color
        };

        pickedColors.unshift(pickedColor);

        pickedColors= pickedColors.slice(0, 1000);

        rememberLastPickedColors(pickedColors);

        addPickedColor(pickedColor);
    }

    // picked colors component
    function selectPickedColorEvent(e) {
        selectColor(this.dataset.color);
        changeColorRange(this.dataset.color);
    }


    function removeColorFromPickedColors(uid) {
        pickedColors = pickedColors.filter(function(e){
            return e.uid !== uid;
        });
    }

    // picked colors component
    function removePickedColorEvent(e) {
        e.stopPropagation();

        var el = this;

        removeColorFromPickedColors(el.dataset.remove);
        rememberLastPickedColors(pickedColors);

        id(el.dataset.remove).remove();
    }
    
    // picked colors component
    function addPickedColor(pickedColor) {
        var picked = document.createElement("div");
        var collorText = document.createElement("div");
        var removeButton = document.createElement("div");

        picked.classList.add("color-picker__picked-colors__block");
        picked.style.backgroundColor = pickedColor.color;
        picked.addEventListener('click', selectPickedColorEvent);
        picked.id = pickedColor.uid;
        picked.dataset.color = pickedColor.color;

        collorText.classList.add("color-picker__picked-colors__block__text");
        collorText.innerHTML = pickedColor.color;
        collorText.dataset.color = pickedColor.color;
        
        
        removeButton.classList.add("color-picker__picked-colors__block__remove-button");
        removeButton.innerHTML = "&#x2715;";
        removeButton.addEventListener('click', removePickedColorEvent);
        removeButton.dataset.remove = pickedColor.uid;

        picked.append(collorText);
        picked.append(removeButton);
        id('color-picker__picked-colors').prepend(picked);
    }

    // color input
    function changeColorInput(color) {
        id('color-picker__color-input').value = color;
        id('color-picker__color-input').style.backgroundColor = color;
        id('color-picker__range-input').value = colorToRange(color);
        id('color-picker__color-invert-input').value = invertColor(color);
        id('color-picker__color-invert-input').style.backgroundColor = invertColor(color);
    }

    // invert color input
    function changeColorInvertInput(color) {
        id('color-picker__color-invert-input').value = color;
        id('color-picker__color-invert-input').style.backgroundColor = color;
        id('color-picker__range-input').value = colorToRange(invertColor(color));
        id('color-picker__color-input').value = invertColor(color);
        id('color-picker__color-input').style.backgroundColor = invertColor(color);
    }

    // color input
    function selectColor(color) {
        changeColorInput(color);
        rememberLastPickedColor(color);
    }

    // color picker component
    function mousePositionToColor(x,y) {
        var c1 = id('color-picker__range-input').value;
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

    // color picker component
    function setColorOnPosition(x,y) {
        var color = mousePositionToColor(x,y);
        selectColor(color);
    }

    // color picker component
    function drawColorPicker() {
        var canvas = document.getElementById('color-picker__picker');
        if (!canvas.getContext) {
            return;
        }

        var ctx = canvas.getContext('2d');

        r = id('color-picker__range-input').value;

        if (typeof cache[r] != 'undefined') {
            ctx.putImageData(cache[r], 0, 0);
            return;
        }

        l("drawing: " + r);

        for(var i = 0; i <= 255; i = i+1) {
            for(var j = 0; j <= 255; j = j+1) {
                var color = "#"+toHex(r)+toHex(i)+toHex(j);
                ctx.fillStyle = color;
                ctx.fillRect(i*3, j*3, 3, 3);
            }    
        }

        cache[r] = ctx.getImageData(0, 0, 770, 770)
    }

    // storage
    function restoreLastPickedColor() {
        selectColor((window.localStorage.getItem('last-picked-color') == null ?  "#000000" : window.localStorage.getItem('last-picked-color')));
    }

    // storage
    function rememberLastPickedColor(color) {
        window.localStorage.setItem('last-picked-color', color);
    }

    // storage
    function restoreLastRange() {
        id('color-picker__range-input').value = (window.localStorage.getItem('last-range') == null ?  0 : window.localStorage.getItem('range'));
    }

    // storage
    function rememberLastRange(range) {
        window.localStorage.setItem('last-range', range);
    }

    // storage
    function getLastPickedColors() {
        return JSON.parse((window.localStorage.getItem('last-picked-colors') == null ?  "[]" : window.localStorage.getItem('last-picked-colors')));
    }

    // storage
    function rememberLastPickedColors(pickedColors) {
        window.localStorage.setItem('last-picked-colors', JSON.stringify(pickedColors));
    }

    // storage
    function restoreLastPickedColors() {
        pickedColors = getLastPickedColors();

        for(var i = pickedColors.length-1; i >= 0; i--) {
            addPickedColor(pickedColors[i]);
        }
    }

    // storage
    function saveCache(index, value) {
        window.localStorage.setItem('cache-'+index, value);
    }

    // storage
    function restoreCache(index) {
        return window.localStorage.getItem('cache-'+index) == null ?  null : window.localStorage.getItem('cache-'+index);
    }

    // events
    function colorInputChangeEvent() {
        if (id('color-picker__color-input').value.match(/^\#[a-fA-F0-9]{6}$/)) {
            changeColorInput(id('color-picker__color-input').value);
            changeColorRange(id('color-picker__color-input').value);
            addPickedColor({uid:uid(), color:id('color-picker__color-input').value});
        }
    }

    // events
    function colorInvertInputChangeEvent() {
        if (id('color-picker__color-invert-input').value.match(/^\#[a-fA-F0-9]{6}$/)) {
            changeColorInvertInput(id('color-picker__color-invert-input').value);
            changeColorRange(invertColor(id('color-picker__color-invert-input').value));
            addPickedColor({uid:uid(), color:id('color-picker__color-invert-input').value});
        }
    }

    // event - range input
    function rangeChangeEvent(e) {
        changeColorRange(id('color-picker__range-input').value);
    } 

    // event - range input
    function rangeInputEvent(e) {
        if(options.useCache) {
            changeColorRange(id('color-picker__range-input').value);
        }
    }

    

    // events - global mouse click
    function afterMouseUpGlobalEvent() {
        mDown = false;
    }

    // events - color picker component
    function pickerMouseDownEvent(e) {
        var x = e.pageX - this.offsetLeft; 
        var y = e.pageY - this.offsetTop; 

        mDown = true;
    }

    // events - color picker component
    function pickerMouseMoveEvent(e) {
        var x = e.pageX - this.offsetLeft; 
        var y = e.pageY - this.offsetTop; 

        if (event.which === 1 || event.buttons === 1) {
            setColorOnPosition(x,y);
        }
    }

    // events - color picker component
    function pickerMouseUpEvent(e) {
        var x = e.pageX - this.offsetLeft; 
        var y = e.pageY - this.offsetTop; 

        if (mDown) {
            setColorOnPosition(x,y);
            pickColorFromMousePosition(x,y);
        }
    }

    // events - binding
    function bindEventListeners() {
        id('color-picker__color-input').addEventListener('input', colorInputChangeEvent);
        id('color-picker__color-invert-input').addEventListener('input', colorInvertInputChangeEvent);
        id('color-picker__range-input').addEventListener('change', rangeChangeEvent);
        id('color-picker__range-input').addEventListener('input', rangeInputEvent);
        id('color-picker__picker').addEventListener('mousedown', pickerMouseDownEvent);
        id('color-picker__picker').addEventListener('mousemove', pickerMouseMoveEvent);
        id('color-picker__picker').addEventListener('mouseup', pickerMouseUpEvent);
        window.addEventListener('mouseup', afterMouseUpGlobalEvent);
    }

    // cache
    function buildPickerCache(k) {
        var canvas = document.createElement('canvas');;
        canvas.width = 770;
        canvas.height = 770;

        if (!canvas.getContext) {
            return;
        }

        if (typeof cache[k] != 'undefined') {
            return;
        }

        l("building cache: "+k);

        var ctx = canvas.getContext('2d');

        for(var i = 0; i <= 255; i = i+1) {
            for(var j = 0; j <= 255; j = j+1) {
                var color = "#"+toHex(k)+toHex(i)+toHex(j);
                ctx.fillStyle = color;
                ctx.fillRect(i*3, j*3, 3, 3);
            }    
        }
        cache[k] = ctx.getImageData(0, 0, 770, 770);
    }

    // cache
    function buildCache() {
        var cacheTimerCounter = 255;
        var cacheBuildTimer = setInterval(function() {
            if(options.useCache) {

                while (typeof cache[cacheTimerCounter] != 'undefined' && cacheTimerCounter > 0) {
                    cacheTimerCounter = cacheTimerCounter - 1;
                }

                buildPickerCache(cacheTimerCounter);
                cacheTimerCounter = cacheTimerCounter - 1;

                if (cacheTimerCounter < 0){
                    clearInterval(cacheBuildTimer);
                }
            }
        }, 100);
    }

    // init
    function initApplication() {
        restoreLastPickedColor();
        restoreLastRange();
        restoreLastPickedColors();
        buildCache();
        bindEventListeners();
    }

    window.addEventListener('load', initApplication);
    window.addEventListener("load", drawColorPicker);
    

</script>

</body>
</html>
