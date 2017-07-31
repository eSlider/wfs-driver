<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Geometry
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Geometry extends BaseEntity
{
    protected $gml_id;

    /** @var \Wheregroup\WFS\Entity\Primitive\Polygon */
    protected $polygon;
    protected $lineString;
    protected $lineRing;
}