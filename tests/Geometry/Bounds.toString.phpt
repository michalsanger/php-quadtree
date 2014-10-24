<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$testData = array(
    array('(5, 6, 3, 4)', 5, 6, 3, 4),
    array('(5.1, 6, 0, 0)', 5.1, 6),
    array('(5, 6.3, 3, 4.2)', 5, 6.3, 3, 4.2),
);

foreach($testData as $data) {
    $width = $data[1];
    $height = $data[2];
    $left = isset($data[3]) ? $data[3] : null;
    $top = isset($data[4]) ? $data[4] : null;
    if ($left === null) {
        $bounds = new Bounds($width, $height);
    } else {
        $bounds = new Bounds($width, $height, $left, $top);
    }
    
    Assert::equal($data[0], (string)$bounds);
}