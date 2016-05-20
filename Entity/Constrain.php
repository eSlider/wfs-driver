<?php
namespace WFS\Entity;

/**
 * Class Constrain
 *
 * @package WFS
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Constrain extends BaseEntity
{
    protected $allowedValues;
    protected $defaultValue;
    protected $noValues;
    protected $name;

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDefaultValue()
    {
        return $this->defaultValue;
    }

    /**
     * @return mixed
     */
    public function getNoValues()
    {
        return $this->noValues;
    }

    /**
     * @return mixed
     */
    public function getAllowedValues()
    {
        return $this->allowedValues;
    }


    /**
     * @param $data
     */
    protected function setAllowedValues($data)
    {
        $this->allowedValues = $data["ows_Value"];
    }

    /**
     * @return string
     */
    public function __toString()
    {
        return $this->getName() . "=" . $this->getDefaultValue();
    }

}