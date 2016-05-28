<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Schema
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Schema extends BaseEntity
{
    protected $elementFormDefault;
    protected $targetNamespace;
    protected $version;

    /** @var \Wheregroup\WFS\Entity\Element[] */
    protected $elements;

    /** @var \Wheregroup\WFS\Entity\ComplexType[] */
    protected $complexTypes;

    protected $simpleType;

    /**
     * Get types
     */
    public function getTypes(){

    }

}