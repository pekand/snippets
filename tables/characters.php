<?php

function row($charDec) {
    $charDecPad = str_pad($charDec,5,"0", STR_PAD_LEFT);
    $charHex = strtoupper(str_pad(dechex($charDec),4,"0", STR_PAD_LEFT));
    $charOct = str_pad(decoct($charDec),6,"0", STR_PAD_LEFT);
    $unicode = iconv('UCS-4LE', 'UTF-8', pack('V', $charDec));;
    $ascii = ($charDec< 256) ? mb_convert_encoding(chr($charDec), 'UTF-8', 'ISO-8859-1') : "";
    $htmlEntity = "&#x".strtoupper(str_pad(dechex($charDec),4,"0", STR_PAD_LEFT)).";";
    $htmlEntityCode = htmlspecialchars($htmlEntity);
    $unicodeName = IntlChar::charName($unicode);
    return "<tr>
    <td>{$charDecPad}</td>
    <td>{$charHex}</td>
    <td>{$charOct}</td>
    <td>{$htmlEntityCode}</td>
    <td>{$htmlEntity}</td>
    <td>{$unicodeName}</td>
    <td>{$ascii}</td>
    <td>{$unicode}</td>
    </tr>\n\n";
}
?><!DOCTYPE html>
<html>
<head>
    <title></title>
    <style type="text/css">

        table {
            border-collapse: collapse;
        }
        table tr td{
            border:1px solid black;
            font-size:32px;
            
        }
    </style>
</head>
<body>
    <table>
        <tr>
            <td>Dec</td>
            <td>Hex</td>
            <td>Oct</td>
            <td>htmlentity</td>
            <td>htmlentity code</td>
            <td>unicode name</td>
            <td>ascii</td>
            <td>unicode</td>
        </tr>
        <?php for($i=0;$i<256*256;$i++) echo row($i); ?>
    </table>
</body>
</html>


