<?php

namespace Quadtree;

interface IIntersector // TODO: ICollisionDetector?
{
    /**
     * Test if two bounds intersects
     * @param \Quadtree\IBoundable $bounds
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    function intersects(IBoundable $bounds, IBoundable $item);
    
    /**
     * Test if new items collides with collection of items
     * @param array $insertedItems
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    function collide(array $insertedItems, IBoundable $item);
}
