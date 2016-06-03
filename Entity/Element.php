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

    protected $valueList;
    protected $metadata;

    /**
     * @param mixed $valueList
     */
    public function setValueList($valueList)
    {
        $values          = reset($valueList);
        $this->valueList = is_array($values) ? $values : array($values);
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getType()
    {
        return $this->type;
    }
}