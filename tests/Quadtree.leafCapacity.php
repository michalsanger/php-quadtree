<?php

require __DIR__ . '/bootstrap.php';
require './assets/coords_z9.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;

$zoomLevel = 9;
$qtBounds = new Bounds(256 * pow(2, $zoomLevel), 256 * pow(2, $zoomLevel));
$qt1 = new Quadtree($qtBounds, 2);
$qt2 = new Quadtree($qtBounds, 10);

$c1 = $c2 = 0;
foreach ($coords as $coord) {
    $rect = new Bounds(40, 40, $coord[0], $coord[1]);
    if ($qt1->insert($rect)) {
            $c1++;
    }
    if ($qt2->insert($rect)) {
            $c2++;
    }
    Assert::equal($c1, $c2);
}
