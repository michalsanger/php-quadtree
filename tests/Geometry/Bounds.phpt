<?php

require __DIR__ . '/../bootstrap.php';

use Tester\Assert;
use Quadtree\Geometry\Bounds;

$b = new Bounds(10, 20);
Assert::equal((float)10, $b->getWidth());
Assert::equal((float)20, $b->getHeight());
Assert::equal((float)0, $b->getLeft());
Assert::equal((float)0, $b->getTop());

$b2 = new Bounds(10, 20, -5, 8);
Assert::equal((float)-5, $b2->getLeft());
Assert::equal((float)8, $b2->getTop());

$b3 = new Bounds('10', '20', '4', '7');
Assert::equal((float)10, $b3->getWidth());
Assert::equal((float)20, $b3->getHeight());
Assert::equal((float)4, $b3->getLeft());
Assert::equal((float)7, $b3->getTop());

Assert::exception(function(){
    new Bounds('xyz', NULL);
}, 'InvalidArgumentException', 'Input must be numeric');

Assert::exception(function(){
    new Bounds(15, 18, 'ab', 'de');
}, 'InvalidArgumentException', 'Input must be numeric');
