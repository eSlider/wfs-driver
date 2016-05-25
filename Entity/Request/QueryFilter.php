<?php
namespace Wheregroup\WFS\Entity\Request;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureRequestQuery
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class QueryFilter extends BaseEntity
{
    /**
     * @return array
     */
    public function toXML()
    {
        return array('@arguments' => array(
            'typeNames' => $this->typeNames
        ));
    }

    protected $resourceId;
}

