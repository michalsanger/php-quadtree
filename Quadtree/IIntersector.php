<?php

namespace Quadtree;

interface IIntersector // TODO: ICollisionDetector?
{
    function Intersects(IBoundable $bounds, IBoundable $item);
    
    //function Collide(array $items, IBoundable $item);
}
