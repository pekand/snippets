<?php

/*
not working. result image size is bigger then original
todo: change code and get smaller image size
*/
function generateThumbnail($img, $width, $height, $outPath, $scale = 4, $quality = 30)
{
    if (is_file($img)) {
    	list($originalWidth,$originalHeight) = getimagesize($img);
        $thumbCreate = ImageCreateTrueColor($originalWidth/$scale, $originalHeight/$scale);
        $source = imagecreatefrompng($img);
        
        imagecopyresized($thumbCreate, $source, 0, 0, 0, 0, $originalWidth/$scale, $originalHeight/$scale, $originalWidth, $originalHeight);
        $path_parts = pathinfo($img);

        $filename = $path_parts['filename'];
        imagejpeg($thumbCreate, $outPath.'/'.$filename.'.jpg', $quality);
        imagedestroy($thumbCreate);
        imagedestroy($source);
    }
}

foreach (glob("images/*.png") as $file) {
    
    $size = generateThumbnail($file, 100, 100, 'thumbnails');   
}