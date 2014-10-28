<?php

require __DIR__ . '/../bootstrap.php';
require './DummyCollistionDetector.php';
require './BlackHoleQuadtree.php';

use Tester\Assert;
use Quadtree\Quadtree;
use Quadtree\Geometry\Bounds;

$qt = new BlackHoleQuadtree(new Bounds(100, 100), 2);
Assert::true($qt->insert(new Bounds(100, 100)));
Assert::true($qt->insert(new Bounds(100, 100)));
Assert::true($qt->insert(new Bounds(100, 100)));

Assert::true($qt->insert(new Bounds(10, 10)));
Assert::true($qt->insert(new Bounds(10, 10)));
Assert::true($qt->insert(new Bounds(10, 10)));
