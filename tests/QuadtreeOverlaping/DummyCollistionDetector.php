<?php

class DummyCollisionDetector implements \Quadtree\ICollisionDetector
{
    public function collide(array $insertedItems, \Quadtree\Insertable $item)
    {
        return FALSE;
    }

    public function intersects(\Quadtree\Geometry\Bounds $bounds, \Quadtree\Insertable $item)
    {
        return $bounds->intersects($item->getBounds());
    }
}
    