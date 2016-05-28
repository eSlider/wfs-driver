<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class ComplexType
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class ComplexType extends BaseEntity
{
    protected $name;
    protected $complexContent;
    protected $base;

    /** @var \Wheregroup\WFS\Entity\Element[] */
    protected $elements;


    /**
     * @param mixed $complexContent
     */
    public function setComplexContent($complexContent)
    {
        $extension = reset($complexContent);
        $sequence  = end($extension);

        $this->fill($extension["@attributes"]);
        $this->fill($sequence);
        $this->complexContent = $complexContent;
    }
}