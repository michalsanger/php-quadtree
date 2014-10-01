<?php

namespace Quadtree;

class Quadtree
{
    const CAPACITY = 4;

    /** @var Bounds */
    private $bounds;
    
    /** @var IBoundable[] */
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
    
    /**
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    public function insert(IBoundable $item)
    {
        if (!$this->bounds->intersects($item->getBounds())) {
            return FALSE;
        }
        foreach ($this->items as $inserted) {
            if ($item->getBounds()->intersects($inserted->getBounds())) {
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