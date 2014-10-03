<?php

namespace Quadtree;

class Point implements Insertable
{
    /** @var float */
    private $left;
    
    /** @var float */
    private $top;
    
    /** @var Bounds */
    private $bounds;
    
    /**
     * @param float $left
     * @param float $top
     */
    function __construct($left, $top)
    {
        if (!is_numeric($left) || !is_numeric($top) ) {
            throw new \InvalidArgumentException('Input must be numeric');
        }
        $this->left = (float)$left;
        $this->top = (float)$top;
    }
    
    /**
     * @return float
     */
    function getLeft()
    {
        return $this->left;
    }

    /**
     * @return float
     */
    function getTop()
    {
        return $this->top;
    }
    
    /**
     * @param \Quadtree\Point $point
     * @return boolean
     */
    public function equals(Point $point)
    {
        return $this->left === $point->getLeft() && $this->top === $point->getTop();
    }
    
    /**
     * @return Bounds
     */
    public function getBounds()
    {
        if ($this->bounds === NULL) {
            $this->bounds = new Bounds(0, 0, $this->left, $this->top);
        }
        return $this->bounds;
    }

}