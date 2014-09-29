<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Bounds;

$b = new Bounds(10, 10, -5, 5);
Assert::false($b->intersects(new Bounds(5, 5, 20)));
Assert::false($b->intersects(new Bounds(5, 5, -20)));
Assert::false($b->intersects(new Bounds(5, 5, 5))); // corner touch
Assert::false($b->intersects(new Bounds(5, 5, 5, 5))); // border touch

Assert::true($b->intersects($b));   // self
Assert::true($b->intersects(new Bounds(5, 5, 0, 5)));   // small inside
Assert::true($b->intersects(new Bounds(100, 100, -50)));    // big outside

Assert::true($b->intersects(new Bounds(20, 20, 3, 13)));    // partial intersection on bottom right corner
Assert::true($b->intersects(new Bounds(10, 10, -10, 13)));    // partial intersection on bottom left corner
