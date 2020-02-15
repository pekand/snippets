<style>

    img {
        background: gray;
        margin: 2px;
        padding: 2px;
        border:none; 
        outline: none;
    }
</style>
    
<script>
    
    function isElementInViewport (el) {

        var inAdvance = 100;

        return (
           el.offsetTop < window.innerHeight + window.pageYOffset + inAdvance
        );
    }

    function displayImages() {
        var elements = document.getElementsByTagName('img');
        for (var i = 0; i < elements.length; i++) {
            if (isElementInViewport(elements[i])) {
                elements[i].src = elements[i].getAttribute('data-src');
            }
        }
    }
    
    window.addEventListener("load", function() {
        window.setInterval(function(){
          displayImages();
        }, 200);
    });
</script>

<?php

$files = array();
foreach (glob("images/*.png") as $file) {
    
    $size = getimagesize($file);
    
    $files[] = [
        'path' => $file,
        'w' => $size[0],
        'h' => $size[1],
    ];
}

foreach ($files as $file) {
    echo '<img src="data:image/gif;base64,R0lGODlhAQABAAAAACH5BAEKAAEALAAAAAABAAEAAAICTAEAOw==" data-src="'.$file['path'].'" width="'.$file['w'].'" height="'.$file['h'].'" >';
}