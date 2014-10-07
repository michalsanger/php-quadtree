<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;

$qtBounds = new Bounds(50, 50);
$qt = new Quadtree($qtBounds);

Assert::true($qt->insert(new Bounds(10, 10, 5, 5)));
Assert::false($qt->insert(new Bounds(10, 10, 5, 5)));

Assert::true($qt->insert(new Bounds(10, 10, 20, 20)));
Assert::false($qt->insert(new Bounds(5, 5, 25, 25)));

// one big takes it all
$qt2 = new Quadtree($qtBounds);
Assert::true($qt2->insert(new Bounds(100, 100, -20, -20)));
Assert::false($qt->insert(new Bounds(10, 10, 5, 5)));

$qt3 = new Quadtree($qtBounds);
Assert::true($qt3->insert(new Bounds(2, 2, 10, 40)));
Assert::true($qt3->insert(new Bounds(2, 2, 40, 40)));
Assert::true($qt3->insert(new Bounds(2, 2, 40, 10)));
Assert::true($qt3->insert(new Bounds(2, 2, 15, 15)));

Assert::false($qt3->insert(new Bounds(2, 2, 40, 10)));

Assert::equal(2, $qt->getSize());
Assert::equal(1, $qt2->getSize());
Assert::equal(4, $qt3->getSize());