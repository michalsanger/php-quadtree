<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$a1 = new Bounds(20, 20, 10, 10);
$b1 = new Bounds(25, 25, 15, 15);
$i1 = $a1->intersection($b1);

Assert::equal(15.0, $i1->getWidth());
Assert::equal(15.0, $i1->getHeight());
Assert::equal(15.0, $i1->getLeft());
Assert::equal(15.0, $i1->getTop());

$a2 = new Bounds(1, 1, 0, 0);
$b2 = new Bounds(25, 25, 15, 15);
$i2 = $a2->intersection($b2);

Assert::null($i2);