<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Bounds;
use Quadtree\Point;

$qtBounds = new Bounds(50, 50);
$qt = new Quadtree($qtBounds);

Assert::true($qt->insert(new Point(10, 10)));
Assert::false($qt->insert(new Point(10, 10)));
Assert::false($qt->insert(new Point(100, 100)));

Assert::true($qt->insert(new Point(10, 40)));
Assert::true($qt->insert(new Point(40, 40)));
Assert::true($qt->insert(new Point(40, 10)));
Assert::true($qt->insert(new Point(15, 15)));

Assert::false($qt->insert(new Point(40, 10)));