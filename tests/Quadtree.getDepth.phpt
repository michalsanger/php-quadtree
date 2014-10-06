<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;
use Quadtree\Geometry\Point;

$qtBounds = new Bounds(100, 100);
$qt = new Quadtree($qtBounds, 1);
Assert::equal(0, $qt->getDepth());

$qt->insert(new Point(10, 10));
Assert::equal(0, $qt->getDepth());
$qt->insert(new Point(60, 60));
Assert::equal(1, $qt->getDepth());

$qt->insert(new Point(30, 30));
Assert::equal(2, $qt->getDepth());

$qt->insert(new Point(15, 15));
Assert::equal(3, $qt->getDepth());