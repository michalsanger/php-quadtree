<?php

require __DIR__ . '/../vendor/nette/tester/Tester/bootstrap.php';
require __DIR__ . '/../Quadtree/Quadtree.php';

use Tester\Assert;

$qt = new Quadtree();

Assert::true($qt->insert(null));