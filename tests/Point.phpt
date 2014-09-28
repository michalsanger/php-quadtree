<?php

require __DIR__ . '/bootstrap.php';

use Tester\Assert;
use Quadtree\Point;

$point = new Point(10, 20);
Assert::equal((float)10, $point->getLeft());
Assert::equal((float)20, $point->getTop());

$pointStr = new Point('10', '20');
Assert::equal((float)10, $pointStr->getLeft());
Assert::equal((float)20, $pointStr->getTop());

Assert::exception(function(){
    new Point('xyz', NULL);
}, 'InvalidArgumentException', 'Input must be numeric');
