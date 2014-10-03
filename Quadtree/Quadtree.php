<?php

namespace Quadtree;

class Quadtree extends \Quadtree\QuadtreeAbstract
{
    function __construct(Bounds $bounds)
    {
        $intersector = new BoundsCollisionDetector();
        parent::__construct($intersector, $bounds);
    }
}