<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureTypeList
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureTypeList extends BaseEntity
{
    /** @var \Wheregroup\WFS\Entity\FeatureType[] */
    protected $featureTypes;
}