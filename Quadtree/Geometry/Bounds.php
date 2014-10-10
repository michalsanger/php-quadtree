<?php

namespace Quadtree\Geometry;

/**
 * A Bounds represents a rectangle on a two-dimensional plane
 */
class Bounds implements \Quadtree\Insertable
{
    /** @var float */
    private $width;
    
    /** @var float */
    private $height;

    /** @var float */
    private $left;
    
    /** @var float */
    private $top;
    
    /**
     * @param float $width
     * @param float $height
     * @param float $left
     * @param float $top
     */
    public function __construct($width, $height, $left = 0, $top = 0)
    {
        if (
            !is_numeric($width)
            || !is_numeric($height)
            || !is_numeric($left) 
            || !is_numeric($top)
        ) {
            throw new \InvalidArgumentException('Input must be numeric');
        }
        $this->width = (float)$width;
        $this->height = (float)$height;
        $this->left = (float)$left;
        $this->top = (float)$top;
    }
    
    /**
     * @return float
     */
    function getWidth()
    {
        return $this->width;
    }

    /**
     * @return float
     */
    function getHeight()
    {
        return $this->height;
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
     * Returns true if the given point is in this bounds
     * @param \Quadtree\Geometry\Point $point
     * @return boolean
     */
    public function containsPoint(Point $point)
    {
        $leftIn = $point->getLeft() >= $this->left && $point->getLeft() < ($this->left + $this->width);
        $topIn = $point->getTop() >= $this->top && $point->getTop() < ($this->top + $this->height);
        return $leftIn && $topIn;
    }
    
    /**
     * Computes the center of this bounds
     * @return \Quadtree\Geometry\Point
     */
    public function getCenter()
    {
        $left = $this->left + ($this->width / 2);
        $top = $this->top + ($this->height / 2);
        return new Point($left, $top);
    }
    
    /**
     * Returns true if this bounds shares any points with other bounds
     * @param \Quadtree\Geometry\Bounds $other
     * @return boolean
     */
    public function intersects(Bounds $other)
    {
        return $this->left <= $other->getLeft() + $other->getWidth()
                && $other->getLeft() <= $this->left + $this->width
                && $this->top <= $other->getTop() + $other->getHeight()
                && $other->getTop() <= $this->top + $this->height;
    }
    
    /**
     * Returns the intersection of two bounds
     * @param \Quadtree\Geometry\Bounds $other
     * @return \Quadtree\Geometry\Bounds | NULL
     */
    public function intersection(Bounds $other)
    {
        $x0 = max($this->left, $other->getLeft());
        $x1 = min($this->left + $this->width, $other->getLeft() + $other->getWidth());
        if ($x0 <= $x1) {
            $y0 = max($this->top, $other->getTop());
            $y1 = min($this->top + $this->height, $other->getTop() + $other->getHeight());
            if ($y0 <= $y1) {
                return new static($x1 - $x0, $y1 - $y0, $x0, $y0);
            }
        }
        return NULL;
    }


    /**
     * Get 2D envelope
     * @return \Quadtree\Geometry\Bounds
     */
    public function getBounds()
    {
        return $this;
    }
    
    /**
     * Calculate size of area
     * @return float
     */
    public function getArea()
    {
        return $this->width * $this->height;
    }
    
    /**
     * Comparison function
     * @param \Quadtree\Geometry\Bounds $other
     * @return boolean
     */
    public function equals(Bounds $other)
    {
        return $this->width === $other->getWidth()
                && $this->height === $other->getHeight()
                && $this->left === $other->getLeft()
                && $this->top === $other->getTop();
    }
}