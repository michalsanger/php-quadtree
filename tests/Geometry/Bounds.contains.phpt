<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$b0 = new Bounds(100, 100);
Assert::true($b0->contains(new Bounds(10, 10)));
Assert::true($b0->contains(new Bounds(10, 10, 5, 5)));
Assert::true($b0->contains($b0));
Assert::false($b0->contains(new Bounds(200, 200)));

$b = new Bounds(10, 20, 10, 10);
Assert::true($b->contains(new Bounds(5, 5, 15, 15)));
Assert::true($b->contains(new Bounds(5, 5, 15, 25)));
Assert::true($b->contains($b));
Assert::false($b->contains(new Bounds(10, 10)));

