<?php

namespace Quadtree;

class Quadtree extends \Quadtree\QuadtreeAbstract
{
    function __construct(Bounds $bounds)
    {
        $intersector = new BoundsIntersector();
        parent::__construct($intersector, $bounds);
    }
}