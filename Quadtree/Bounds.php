<?php

namespace Quadtree;

class Bounds
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
}