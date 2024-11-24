<?php


$dom = Dom\HTMLDocument::createFromString(
    <<<HTML
        <main>
            <article>PHP 8.4 is a feature-rich release!</article>
            <article class="featured">PHP 8.4 adds new DOM classes that are spec-compliant, keeping the old ones for compatibility.</article>
        </main>
        HTML,
    LIBXML_NOERROR,
);

$node = $dom->querySelector('main > article:last-child');
var_dump($node->classList->contains("featured")); // bool(true)
