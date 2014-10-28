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
    
    /** @var boolean */
    private $overlappingInserted = FALSE;

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
        if ($this->collideWithItems($item)) {
            return FALSE;
        }
        return $this->insertItem($item);
    }

    /**
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    public function collideWithItems(Insertable $item)
    {
        if (!$this->detector->intersects($this->bounds, $item)) {
            return false;
        }
        if ($this->nw === NULL) {
            return $this->detector->collide($this->items, $item);
        } else {
            return $this->nw->collideWithItems($item)
                    || $this->ne->collideWithItems($item)
                    || $this->sw->collideWithItems($item)
                    || $this->se->collideWithItems($item);
        }
    }

    /**
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    private function insertItem(Insertable $item)
    {
        if ($this->overlappingInserted || $item->getBounds()->contains($this->bounds)) {
            $this->items[] = $item;
            $this->overlappingInserted = true;
            return TRUE;
        }

        if ($this->nw === NULL && count($this->items) < $this->capacity) {
            $this->items[] = $item;
            return TRUE;
        } else {
            if (count($this->items) >= $this->capacity) {
                $this->subdivide();
            }
            return $this->insertItemIntoSubtrees($item);
        }
    }

    /**
     * @param \Quadtree\Insertable $item
     * @return boolean
     */
    private function insertItemIntoSubtrees(Insertable $item)
    {
        $nwIn = $this->nw->insert($item);
        $neIn = $this->ne->insert($item);
        $swIn = $this->sw->insert($item);
        $seIn = $this->se->insert($item);
        return $nwIn || $neIn || $swIn || $seIn;
    }

    /**
     * Number of levels in the tree
     * @return int
     */
    public function getDepth()
    {
        if ($this->nw === NULL) {
            return 0;
        } else {
            $max = max($this->nw->getDepth(), $this->ne->getDepth(), $this->sw->getDepth(), $this->se->getDepth());
            return 1 + $max;
        }
    }

    /**
     * Number of items in the tree
     * @return int
     */
    public function getSize()
    {
        if ($this->nw === NULL) {
            return count($this->items);
        } else {
            return $this->nw->getSize() + $this->ne->getSize() + $this->sw->getSize() + $this->se->getSize();
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