<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Point;

$point = new Point(10, 20);
Assert::true($point->equals(new Point(10, 20)));
Assert::true($point->equals(new Point('10', '20')));

Assert::false($point->equals(new Point(-10, -20)));
Assert::false($point->equals(new Point(10, 30)));
Assert::false($point->equals(new Point(15, 20)));