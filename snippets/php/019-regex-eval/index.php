<?php
    $text = "";
    $regex = "";
    if (isset($_GET['text'])) {
        $regex = $_GET['regex'];
        $param = $_GET['text'];
        $param = base64_decode($param);
        $param = gzuncompress($param);
        $text = $param;
    } else if (isset($_POST['text'])) {
        $regex = $_POST['regex'];
        $text = $_POST['text'];
        $param = gzcompress($text, 9);
        $param = base64_encode($param);
        $param = urlencode($param);
        header("Location: ".$_SERVER['REQUEST_URI']."?regex=".urlencode($regex)."&text=".$param);
        die();
    }
?><!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Eval regex</title>
    <link rel="shortcut icon" type="image/png" href="img/favicon.png" />
    <style type="text/css">
        .content{width: 1100px; margin: 0 auto;margin-bottom: 200px;}
        input[type="text"]{width: 100%;margin:10px 0px;}
        textarea{width: 100%;height:200px}
        .hash{color: green}
        .opp{color: red}
        table {width: 100%;border-collapse: collapse;}
        th{text-align: left;}
        td{border: 1px solid gray;text-align: center;}
        pre{border: 1px solid grey;padding:10px;}
        .result div{display:inline-block;padding:5px;margin:5px;}
    </style>
  </head>
  <body>
    <div class="content">
        <h1>Eval regex</h1>

        <hr>

        <form method="post" action=".">
            <input type="text" name="regex" value="<?php echo htmlspecialchars($regex); ?>">
            <textarea name="text"><?php echo htmlspecialchars($text); ?></textarea>
            <input type="submit" value="Evaluate" name="send">
        </form>

        <hr>

        <div><?php
        function drawRegex($regex, $text)
        {
            $result = "";
            if ($regex != "") {

                preg_match_all(
                    $regex,
                    $text,
                    $out,
                    PREG_OFFSET_CAPTURE
                );

                //echo "<pre>".print_r($out, true)."</pre>";

                $colors = array("Grey", "Green", "Blue", "Yellow","Fuchsia","Silver","Red","Olive","Purple","Maroon","Aqua","Lime","Teal","Navy","AliceBlue","Aqua","Aquamarine","Azure","Beige","Bisque","Black","BlanchedAlmond","BlueViolet","Brown","BurlyWood","CadetBlue","Chartreuse","Chocolate","Coral","CornflowerBlue","Cornsilk","Crimson","Cyan","DarkBlue","DarkCyan","DarkGoldenRod","DarkGray","DarkGrey","DarkGreen","DarkKhaki","DarkMagenta","DarkOliveGreen","DarkOrange","DarkOrchid","DarkRed","DarkSalmon","DarkSeaGreen","DarkSlateBlue","DarkSlateGray","DarkSlateGrey","DarkTurquoise","DarkViolet","DeepPink","DeepSkyBlue","DimGray","DimGrey","DodgerBlue","FireBrick","ForestGreen","Fuchsia","Gainsboro","Gold","GoldenRod","Gray","Grey","GreenYellow","HoneyDew","HotPink","IndianRed","Indigo","Ivory","Khaki","Lavender","LavenderBlush","LawnGreen","LemonChiffon","LightBlue","LightCoral","LightCyan","LightGoldenRodYellow","LightGray","LightGrey","LightGreen","LightPink","LightSalmon","LightSeaGreen","LightSkyBlue","LightSlateGray","LightSlateGrey","LightSteelBlue","LightYellow","Lime","LimeGreen","Linen","Magenta","Maroon","MediumAquaMarine","MediumBlue","MediumOrchid","MediumPurple","MediumSeaGreen","MediumSlateBlue","MediumSpringGreen","MediumTurquoise","MediumVioletRed","MidnightBlue","MintCream","MistyRose","Moccasin","Navy","OldLace","Olive","OliveDrab","Orange","OrangeRed","Orchid","PaleGoldenRod","PaleGreen","PaleTurquoise","PaleVioletRed","PapayaWhip","PeachPuff","Peru","Pink","Plum","PowderBlue","Purple","RebeccaPurple","RosyBrown","RoyalBlue","SaddleBrown","Salmon","SandyBrown","SeaGreen","SeaShell","Sienna","Silver","SkyBlue","SlateBlue","SlateGray","SlateGrey","Snow","SpringGreen","SteelBlue","Tan","Teal","Thistle","Tomato","Turquoise","Violet","Wheat","Yellow","YellowGreen");

                $i = 0;
                $j = 0;
                $items = array();
                foreach ($out as $value) {
                    $color = $colors[$i++];
                    foreach ($value as $value2) {
                        if (!isset($value2[0]) || !isset($value2[1])) {
                            continue;
                        }

                        $items[] = array(
                            'text' => $value2[0],
                            'offset' => $value2[1],
                            'insert' => "<div style='background-color:".$color.";'>",
                            'order' => $j++
                        );
                        $items[] = array(
                            'text' => $value2[0],
                            'offset' => $value2[1] + strlen($value2[0]),
                            'insert' => "</div>",
                            'order' => $j++
                        );
                    }
                }

                //echo "<pre>".print_r($items, true)."</pre>";

                usort($items, function($a, $b) {
                    $compar = $a['offset'] - $b['offset'];
                    if ( $compar == 0)
                    {
                        return $a['order'] - $b['order'];
                    }

                    return $compar;
                });

                //echo "<pre>".print_r($items, true)."</pre>";

                $result = $text;
                $last_insert = 0;
                for ($i=0; $i < count($items); $i++) {

                    $current_offset = $items[$i]['offset'];
                    $current_insert = $items[$i]['insert'];

                    // specialchars remove
                    $correction = 0;
                    if ($last_insert < $current_offset) {
                        $subpart = substr($result, $last_insert, $current_offset - $last_insert );
                        $correction = strlen(htmlspecialchars($subpart)) - strlen($subpart);
                        if ($correction > 0) {
                            $result =  substr_replace(
                                $result,
                                htmlspecialchars($subpart),
                                $last_insert,
                                strlen($subpart)
                            );
                        }
                    }

                    // insert
                    $result =  substr_replace(
                        $result,
                        $current_insert,
                        $current_offset + $correction,
                        0
                    );

                    // move last insert to new position
                    $last_insert = $current_offset + strlen($current_insert) + $correction;

                    // move
                    for ($j=$i+1; $j < count($items) ; $j++) {
                       $new_position =  $items[$j]['offset'] + strlen($current_insert) + $correction;
                       $items[$j]['offset'] = $new_position;
                    }
                }
            }

            return $result;
        }
        ?></div>
        <pre class="result"><?php echo drawRegex($regex, $text);?></pre>
    </div>
  </body>
</html>
