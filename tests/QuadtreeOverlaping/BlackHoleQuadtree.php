<?php

class BlackHoleQuadtree extends \Quadtree\QuadtreeAbstract
{
    public function __construct(\Quadtree\Geometry\Bounds $bounds, $leafCapacity)
    {
        $detector = new \DummyCollisionDetector();
        parent::__construct($detector, $bounds, $leafCapacity);
    }
}