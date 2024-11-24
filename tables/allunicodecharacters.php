<?php

// Helper function to check if a code point is valid and printable
function isValidUnicodeCharacter($codePoint) {
    // Skip surrogate pairs (D800-DFFF) and non-characters (FFFE, FFFF)
    if (($codePoint >= 0xD800 && $codePoint <= 0xDFFF) || 
        ($codePoint & 0xFFFF) == 0xFFFE || 
        ($codePoint & 0xFFFF) == 0xFFFF) {
        return false;
    }
    return true;
}

function generateFile($from, $to) {
    $file = "out/unicode_characters_".str_pad($from, 7, "0", STR_PAD_LEFT)."_".str_pad($to, 7, "0", STR_PAD_LEFT).".html";

    $handle = fopen($file, 'w');

    fwrite($handle, "\xEF\xBB\xBF"); // BOM for UTF-8
    fwrite($handle, '<!DOCTYPE html><html lang="en"><meta charset="utf-8"><main>');

    for ($codePoint = $from; $codePoint <= $to; $codePoint++) {
        if (!isValidUnicodeCharacter($codePoint)) {
            continue;
        }

        $char = mb_convert_encoding('&#' . $codePoint . ';', 'UTF-8', 'HTML-ENTITIES');

        fwrite($handle, $char);
        fwrite($handle, " ");
    }

    fclose($handle);
}

$step = floor(0x10FFFF / 100);
$from = 0;
$to = $step;
for ($i=0; $i <= 100; $i++) { 
    generateFile($from, $to);
    $from += $step;
    $to += $step;
    if($from>0x10FFFF) {
        break;
    }
    if($to > 0x10FFFF) {
        $to = 0x10FFFF;
    }
}

