<?php
namespace Wheregroup\WFS\Entity\Request;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureRequestQuery
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureQuery extends BaseEntity
{
    /** @var  string */
    protected $typeNames;

    /** @var \Wheregroup\WFS\Entity\Request\QueryFilter[] */
    protected $queryFilters;

    /**
     * @param QueryFilter $filter
     */
    public function addFilter(QueryFilter $filter)
    {
        $this->queryFilters[] = $filter;
    }

    /**
     * @return array
     */
    public function toXML()
    {
        $r = array();
        foreach ($this->queryFilters as $filter) {
            $r[] = $filter->toArray();
        }
        return $r;
    }

    /**
     * @param string $typeNames
     */
    public function setTypeNames($typeNames)
    {
        $this->typeNames = $typeNames;
    }

}