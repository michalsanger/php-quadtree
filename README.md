php-quadtree
============

An easy-to-modify Quadtree with standard 2D implementation.

Usage
-----
Standard 2D collision detection:
```php
use \Quadtree\Quadtree;
use \Quadtree\Geometry\Bounds;
use \Quadtree\Geometry\Point;

$qtBounds = new Bounds(1024, 1024);
$qt = new Quadtree($qtBounds);

$qt->insert(new Bounds(300, 200)); // TRUE
$qt->insert(new Bounds(100, 50)); // FALSE
$qt->insert(new Point(250, 100)); // FALSE
$qt->insert(new Point(2000, 500)); // FALSE
$qt->insert(new Point(299, 199)); // TRUE
```