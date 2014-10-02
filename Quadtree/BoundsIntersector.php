<?php

namespace Quadtree; // TODO: Quadtree/Intersector or Quadtree/Boundary?

class BoundsIntersector implements \Quadtree\IIntersector
{
    /**
     * @param \Quadtree\IBoundable $bounds
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    public function Intersects(IBoundable $bounds, IBoundable $item)
    {
        return $bounds->getBounds()->intersects($item->getBounds());
    }
}
    