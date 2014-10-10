<?php

namespace Quadtree;

interface ICollisionDetector
{
    /**
     * Test if insertable item intersects with bounds
     * @param \Quadtree\Geometry\Bounds $bounds
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    function intersects(Geometry\Bounds $bounds, Insertable $item);
    
    /**
     * Test if new item collides with collection of items
     * @param \Quadtree\Insertable[] $insertedItems
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    function collide(array $insertedItems, Insertable $item);
}
