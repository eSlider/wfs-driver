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
     *
     * @return Element[]
     */
    public function getTypes()
    {
        $types       = array();
        $complexType = $this->complexTypes[0];
        $extension   = $complexType->getComplexContent();
        $elements    = $extension["extension"]["sequence"]["element"];
        foreach ($elements as $elementData) {
            $element                      = new Element($elementData, true);
            $types[ $element->getName() ] = $element;
        }
        return $types;
    }

}