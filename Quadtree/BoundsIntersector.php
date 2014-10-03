<?php

namespace Quadtree; // TODO: Quadtree/Intersector or Quadtree/Boundary?

class BoundsIntersector implements \Quadtree\IIntersector
{
    /**
     * @param \Quadtree\IBoundable $bounds
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    public function intersects(IBoundable $bounds, IBoundable $item)
    {
        return $bounds->getBounds()->intersects($item->getBounds());
    }
    
    /**
     * @param \Quadtree\IBoundable $insertedItems
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    public function collide(array $insertedItems, IBoundable $item) {
        foreach ($insertedItems as $insertedItem) {
            /* @var $insertedItem IBoundable */
            if ($insertedItem->getBounds()->intersects($item->getBounds())) {
                return TRUE;
            }
        }
        return FALSE;
    }
}
    