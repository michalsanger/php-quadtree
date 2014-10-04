Quadtree
============
An easy-to-modify [Quadtree](http://en.wikipedia.org/wiki/Quadtree) with standard 2D implementation.

Usage
-----
Standard 2D collision detection supports points and bounds (rectangular regions):

```php
use \Quadtree\Quadtree;
use \Quadtree\Geometry\Bounds;
use \Quadtree\Geometry\Point;

$qtBounds = new Bounds(1024, 1024);
$qt = new Quadtree($qtBounds);

$qt->insert(new Bounds(300, 200)); // TRUE
$qt->insert(new Bounds(100, 50, 20, 10)); // FALSE
$qt->insert(new Point(250, 100)); // FALSE
$qt->insert(new Point(2000, 500)); // FALSE
$qt->insert(new Point(299, 199)); // TRUE
```

Need more logic for collision detection? Create your own [`ICollisionDetector`](https://github.com/michalsanger/php-quadtree/blob/master/Quadtree/ICollisionDetector.php). 
Need to insert other objects then points and bounds? Implement [`Insertable`](https://github.com/michalsanger/php-quadtree/blob/master/Quadtree/Insertable.php) interface.

Installation
------------
Use Composer:
```json
{
    "require": {
        "michalsanger/quadtree": "0.0.1"
    },
    "repositories": [
        {
            "type": "git",
            "url": "https://github.com/michalsanger/php-quadtree.git"
        }
    ]
}
```

Tests
-----
Due to [Nette Tester](https://github.com/nette/tester/) tests are simple and readable. Run:
```
> vendor/bin/tester tests/
```
