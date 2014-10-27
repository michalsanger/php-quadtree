<?php

require __DIR__ . '/bootstrap.php';
require './assets/coords_z9.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;

$zoomLevel = 9;
$qtBounds = new Bounds(256 * pow(2, $zoomLevel), 256 * pow(2, $zoomLevel));
$qt1 = new Quadtree($qtBounds);

$c = 0;
$bf = array();
foreach ($coords as $coord) {
    $rect = new Bounds(40, 40, $coord[0], $coord[1]);
    if ($qt1->insert($rect)) {
            $c++;
    }
    $intersects = false;
    foreach ($bf as $inserted) {
        /* @var $inserted Quadtree\Insertable */
        if ($inserted->getBounds()->intersects($rect)) {
            $intersects = true;
            break;
        }
    }
    if (!$intersects) {
        $bf[] = $rect;
    }
}

Assert::equal($c, count($bf));