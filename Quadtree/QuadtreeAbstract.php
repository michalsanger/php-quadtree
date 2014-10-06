<?php

namespace Quadtree;

use Quadtree\Geometry\Bounds;

abstract class QuadtreeAbstract
{
    const CAPACITY = 4;

    /** @var ICollisionDetector */
    private $detector;
    
    /** @var Geometry\Boundss */
    private $bounds;
    
    /** @var int */
    private $capacity;
    
    /** @var Insertable[] */
    private $items = array();
    
    /** @var Quadtree */
    private $nw;

    /** @var Quadtree */
    private $ne;

    /** @var Quadtree */
    private $sw;

    /** @var Quadtree */
    private $se;
    
    /**
     * @param \Quadtree\ICollisionDetector $detector
     * @param \Quadtree\Geometry\Bounds $bounds
     * @param int $leafCapacity
     */
    function __construct(ICollisionDetector $detector, Geometry\Bounds $bounds, $leafCapacity = NULL)
    {
        $this->detector = $detector;
        $this->bounds = $bounds;

        $capacity = (int)$leafCapacity;
        if ($capacity <= 0) {
            $capacity = static::CAPACITY;
        }
        $this->capacity = $capacity;
    }
    
    /**
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    public function insert(Insertable $item)
    {
        if (!$this->detector->intersects($this->bounds, $item)) {
            return FALSE;
        }
        if ($this->detector->collide($this->items, $item)) {
            return FALSE;
        }
        
        if ($this->nw === NULL && count($this->items) < $this->capacity) {
            $this->items[] = $item;
            return TRUE;
        } else {
            if (count($this->items) >= $this->capacity) {
                $this->subdivide();
            }
            $nwIn = $this->nw->insert($item);
            $neIn = $this->ne->insert($item);
            $swIn = $this->sw->insert($item);
            $seIn = $this->se->insert($item);
            return $nwIn || $neIn || $swIn || $seIn;
        }
    }
    
    private function subdivide()
    {
        list($this->nw, $this->ne, $this->sw, $this->se) = $this->getDividedBounds();
        foreach ($this->items as $item) {
            $this->nw->insert($item);
            $this->ne->insert($item);
            $this->sw->insert($item);
            $this->se->insert($item);
        }
        $this->items = array();
    }
    
    /**
     * @return QuadtreeAbstract[]
     */
    private function getDividedBounds()
    {
        $c = $this->bounds->getCenter();
        $width = $this->bounds->getWidth() / 2;
        $height = $this->bounds->getHeight() / 2;
        
        $nw = new static(new Bounds($width, $height, $c->getLeft() - $width, $c->getTop() - $height), $this->capacity);
        $ne = new static(new Bounds($width, $height, $c->getLeft(), $c->getTop() - $height), $this->capacity);
        $sw = new static(new Bounds($width, $height, $c->getLeft() - $width, $c->getTop()), $this->capacity);
        $se = new static(new Bounds($width, $height, $c->getLeft(), $c->getTop()), $this->capacity);
        return array($nw, $ne, $sw, $se);
    }
}