<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Element
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Element extends BaseEntity
{
    protected $name;
    protected $nillable;
    protected $type;
    protected $substitutionGroup;

    protected $minOccurs;
    protected $maxOccurs;

    /** @var \Wheregroup\WFS\Entity\SimpleType[] */
    protected $simpleType;
}