<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$b1 = new Bounds(10, 20);
Assert::true($b1->equals(new Bounds(10, 20)));
Assert::false($b1->equals(new Bounds(10, 20, 5, 5)));

$b2 = new Bounds(10, 50, 3, 24);
Assert::true($b2->equals(new Bounds('10', '50', '3', '24')));
