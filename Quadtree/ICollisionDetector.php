<?php

namespace Quadtree;

interface IIntersector // TODO: ICollisionDetector?
{
    /**
     * Test if two bounds intersects
     * @param \Quadtree\Insertable $bounds
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    function intersects(Insertable $bounds, Insertable $item);
    
    /**
     * Test if new items collides with collection of items
     * @param array $insertedItems
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    function collide(array $insertedItems, Insertable $item);
}
