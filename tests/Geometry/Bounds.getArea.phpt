<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$b1 = new Bounds(10, 20);
Assert::equal(200.0, $b1->getArea());

$b2 = new Bounds(10, 0);
Assert::equal(0.0, $b2->getArea());

$b3 = new Bounds(0, 0);
Assert::equal(0.0, $b3->getArea());