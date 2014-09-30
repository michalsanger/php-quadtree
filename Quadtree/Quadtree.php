<?php

namespace Quadtree;

class Quadtree
{
    const CAPACITY = 4;

    /** @var Bounds */
    private $bounds;
    
    /** @var Point[] */
    private $items = [];
    
    /** @var Quadtree */
    private $nw;

    /** @var Quadtree */
    private $ne;

    /** @var Quadtree */
    private $sw;

    /** @var Quadtree */
    private $se;
    
    /**
     * @param \Quadtree\Bounds $bounds
     */
    function __construct(Bounds $bounds)
    {
        $this->bounds = $bounds;
    }
    
    public function insert(Point $item)
    {
        if (!$this->bounds->containsPoint($item)) {
            return FALSE;
        }
        foreach ($this->items as $i) {
            if ($item->equals($i)) {
                return FALSE;
            }
        }
        
        if ($this->nw === NULL && count($this->items) < self::CAPACITY) {
            $this->items[] = $item;
            return TRUE;
        } else {
            if (count($this->items) >= self::CAPACITY) {
                $this->subdivide();
            }
            return $this->nw->insert($item) 
                    || $this->ne->insert($item)
                    || $this->sw->insert($item)
                    || $this->se->insert($item);
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
        $this->items = [];
    }
    
    /**
     * @return Quadtree[]
     */
    private function getDividedBounds()
    {
        $c = $this->bounds->getCenter();
        $width = $this->bounds->getWidth() / 2;
        $height = $this->bounds->getHeight() / 2;
        
        $nw = new Quadtree(new Bounds($width, $height, $c->getLeft() - $width, $c->getTop() - $height));
        $ne = new Quadtree(new Bounds($width, $height, $c->getLeft(), $c->getTop() - $height));
        $sw = new Quadtree(new Bounds($width, $height, $c->getLeft() - $width, $c->getTop()));
        $se = new Quadtree(new Bounds($width, $height, $c->getLeft(), $c->getTop()));
        return [$nw, $ne, $sw, $se];
    }
}