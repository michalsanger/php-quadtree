<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;
use Quadtree\Geometry\Point;

$b = new Bounds(10, 20, 10, 10);
Assert::true($b->containsPoint(new Point(15, 15)));
Assert::true($b->containsPoint(new Point(10, 10)));
Assert::true($b->containsPoint(new Point(19, 29)));

Assert::false($b->containsPoint(new Point(20, 30)));
Assert::false($b->containsPoint(new Point(0, 0)));
Assert::false($b->containsPoint(new Point(21, 31)));