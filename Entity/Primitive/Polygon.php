<?php
namespace Wheregroup\WFS\Entity\Primitive;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Polygon
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Polygon extends BaseEntity
{
    protected $gml_id;
    protected $srsName;
    protected $exterior;
}