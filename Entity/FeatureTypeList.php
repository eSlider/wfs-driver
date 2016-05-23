<?php
namespace WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureTypeList
 *
 * @package WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureTypeList extends BaseEntity
{
    /** @var \WFS\Entity\FeatureType[] */
    protected $featureTypes;
}