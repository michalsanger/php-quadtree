<?php

namespace Quadtree;

interface Insertable
{
    /**
     * Get 2D envelope
     * @return Geometry\Bounds
     */
    function getBounds();
}
