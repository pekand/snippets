<?php

function row($charDec) {
    $htmlEntity = "&#x".strtoupper(str_pad(dechex($charDec),4,"0", STR_PAD_LEFT)).";";
    return '<span title="'.htmlspecialchars($htmlEntity).'" onclick="log(this)">'.$htmlEntity."</span>";
}
?><!DOCTYPE html>
<html>
<body>
    <style type="text/css">
        * {
            font-size:32px;
        }
    </style>
    <script type="text/javascript">
        function log(el){
            console.log(el.title)
        }
    </script>
    <?php for($i=0;$i<256*256;$i++) {
        echo row($i); 
    }?>
</body>
</html>


