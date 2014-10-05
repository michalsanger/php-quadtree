<?php

namespace Quadtree\Geometry;

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
     * @return \Quadtree\Geometry\Point
     */
    public function getCenter()
    {
        $left = $this->left + ($this->width / 2);
        $top = $this->top + ($this->height / 2);
        return new Point($left, $top);
    }
    
    /**
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
     * @return \Quadtree\Geometry\Bounds
     */
    public function getBounds()
    {
        return $this;
    }
}