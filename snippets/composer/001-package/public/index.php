<?php

require __DIR__ . '/../vendor/autoload.php';

use CustomVendor\CustomPackage\CustomComponent;
use CustomVendor\CustomApplication\Main;

$component = new CustomComponent();
$component->show();

$main = new Main();
$main->show();
