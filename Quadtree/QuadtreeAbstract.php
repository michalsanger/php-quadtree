<?php

namespace Quadtree;

abstract class QuadtreeAbstract
{
    const CAPACITY = 4;

    /** @var IIntersector */
    private $intersector;
    
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
     * @param IIntersector $intersector
     * @param \Quadtree\Bounds $bounds
     */
    function __construct(IIntersector $intersector, Bounds $bounds)
    {
        $this->intersector = $intersector;
        $this->bounds = $bounds;
    }
    
    /**
     * @param \Quadtree\IBoundable $item
     * @return boolean
     */
    public function insert(IBoundable $item)
    {
        if (!$this->intersector->Intersects($this->bounds, $item)) {
            return FALSE;
        }
        foreach ($this->items as $inserted) {
            if ($this->intersector->Intersects($inserted, $item)) {
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