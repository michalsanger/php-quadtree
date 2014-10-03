<?php

namespace Quadtree;

class Quadtree extends \Quadtree\QuadtreeAbstract
{
    function __construct(Geometry\Bounds $bounds)
    {
        $intersector = new BoundsCollisionDetector();
        parent::__construct($intersector, $bounds);
    }
}