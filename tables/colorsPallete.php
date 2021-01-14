<!DOCTYPE html>
<html>
<head>
    <title>Colors</title>
</head>
<body>
    <style type="text/css">

        
    </style>
<main>
<div>
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
    <form>
        <input id="range1" type="range" min="0" max="255" value="0" step="1" oninput="changeColor()" onchange="changeColor()"><br>
        <div id="color"></div> 
        <div id="color-invert"></div> 
    </form>

    <script type="text/javascript">
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

        function changeColor() {
            range1 = id('range1').value;

            for(var i = 0; i <= 255; i = i+1) {
                for(var j = 0; j <= 255; j = j+1) {
                    var color = "#"+toHex(range1)+toHex(i)+toHex(j);
                    id('b-'+i+'-'+j).style.backgroundColor = color;
                    id('b-'+i+'-'+j).dataset.color = color;
                }    
            }
        }

        var mDown = false;

        function mouseDown(event, el) {
            mDown = true;
        }

        function mouseMove(event, el) {
            if (event.which === 1 || event.buttons === 1) {
                setColor(el);
            }
        }

        function mouseUp(event, el) {
            if (mDown) {
                setColor(el);
                pickColor(el);
            }
        }

        window.addEventListener('mouseup', function(event){
            mDown = false;
        })

        function setColor(el) {
            id('color').innerHTML = el.dataset.color;
            id('color').style.backgroundColor = el.style.backgroundColor;

            id('color-invert').innerHTML = invertColor(el.dataset.color);
            id('color-invert').style.backgroundColor = invertColor(el.dataset.color);
        }

        function pickColor(el) {
            var picked = document.createElement("div");
            picked.classList.add("picker-block");
            picked.innerHTML = el.dataset.color;
            picked.style.backgroundColor = el.dataset.color;
            id('picker').prepend(picked);
        }

        function init(){
            changeColor();
        }

        window.addEventListener('load', init);
    </script>
</div>
<div>
<div id="colors" draggable='false'>

    <?php

    for($i = 0; $i <= 255; $i=$i+1) {
        echo "<div>";
        for($j = 0; $j <= 255; $j=$j+1) {
            echo "<div id='b-{$i}-{$j}' draggable='false' class='block' onmousedown='mouseDown(event, this);' onmousemove='mouseMove(event, this);' onmouseup='mouseUp(event, this);'></div>";
        } 
        echo "<div style='clear:both;'></div>";
        echo "</div>";
    }
    ?>
    
</div>
<div id="picker">
</div>
</div>
</main>
</body>
</html>
