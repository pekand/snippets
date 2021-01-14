<!DOCTYPE html>
<html>
<head>
    <title>Colors</title>
</head>
<body>
    <style type="text/css">

        main {
            padding-top: 0px;
            width:1100px;
            margin: 0px auto;
        }

        body {
            background-color: black;
            color:white;
        }
        .block {
            margin:0px;
            padding:0px;
            height:15px;
            width:15px;
            background-color: white;
            color:black;
            text-align:center;
            float:left;
        }
    </style>
<main>
<?php
 
    function formatInttoHex($i) {
        $value = dechex($i);
        $value = strtoupper($value);
        $value = str_pad($value, 2, "0", STR_PAD_LEFT);
        return $value;
    }

    $color = 0;


    for($i = 0; $i < 256; $i=$i+(256/32)) {

        for($j = 0; $j < 256; $j=$j+(256/32)) {
            echo "<div>";
            for($k = 0; $k < 256; $k=$k+(256/32)) {
                $value = '#'.formatInttoHex($i).formatInttoHex($j).formatInttoHex($k);

                echo "<div class='block' style='background-color:$value;' data-color='$value' onclick='console.log(\"$value\")'></div>";
            }
            echo "<div style='clear:both;'></div>";
            echo "</div>";
            
        }


        
    }
?>   
</main>
</body>
</html>
