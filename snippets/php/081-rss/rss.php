<?php
$url = "https://www.sciencealert.com/";

$html = file_get_contents($url);

if ($html === false) {
    echo "Failed to load page.";
    exit;
}

$dom = new DOMDocument();
@$dom->loadHTML($html);
$links = $dom->getElementsByTagName('link');

foreach ($links as $link) {
    if ($link->getAttribute('rel') === 'alternate' && ($link->getAttribute('type') === 'application/rss+xml' || $link->getAttribute('type') === 'application/atom+xml')) {
        echo "RSS Feed found: " . $link->getAttribute('href')."\n\n";

        $rss_feed_url = $link->getAttribute('href');

        $rss = simplexml_load_file($rss_feed_url);

        if ($rss === false) {
            echo "Failed to load RSS feed.";
            continue;
        }

        foreach ($rss->channel->item as $item) {
            $title = (string) $item->title;
            $link = (string) $item->link;
            echo "<h2><a href='$link'>$title</a></h2>";
        }
    }
}