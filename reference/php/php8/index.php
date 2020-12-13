<?php

echo '<style> a {color: inherit; } a:link {text-decoration: none; } a:visited {text-decoration: none; } a:hover {text-decoration: none; } a:active { text-decoration: none; } div{display:block; float:left; font-size:20px; margin:5px; padding:10px; background:#F0F0F0;} div:hover {background:#A0A0A0;} </style>';

$files = glob('./*.php');

foreach ($files as $key => $file) {
   $filename = pathinfo($file, PATHINFO_FILENAME);

   if($filename == 'index'){
        continue;
   }    
   echo "<div><a href=\"./{$file}\">{$filename}</a><br></div>";
}
