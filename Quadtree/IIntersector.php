<?php

namespace Quadtree;

interface IIntersector
{
    function Intersects(IBoundable $bounds, IBoundable $item);
}
