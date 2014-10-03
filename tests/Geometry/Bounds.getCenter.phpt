<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$b = new Bounds(10, 20);
$c = $b->getCenter();
Assert::equal($c->getLeft(), 5.0);
Assert::equal($c->getTop(), 10.0);

$bn = new Bounds(10, 20, -10, -20);
$cn = $bn->getCenter();
Assert::equal($cn->getLeft(), -5.0);
Assert::equal($cn->getTop(), -10.0);
