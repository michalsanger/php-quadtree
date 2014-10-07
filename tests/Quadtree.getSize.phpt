<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;

$qtBounds = new Bounds(50, 50);
$qt = new Quadtree($qtBounds);
Assert::equal(0, $qt->getSize());

Assert::true($qt->insert(new Bounds(10, 10, 5, 5)));
Assert::equal(1, $qt->getSize());

Assert::true($qt->insert(new Bounds(10, 10, 20, 20)));
Assert::equal(2, $qt->getSize());
