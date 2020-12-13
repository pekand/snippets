<?php

echo "<pre><h1>Nullsafe operator</h1>";

$session = null;

$country = $session?->user?->getAddress()?->country;

print_r($country == null);
