<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class FeatureType
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class FeatureType extends BaseEntity
{
    protected $title;
    protected $name;
    protected $abstract;
    protected $defaultCRS;
    protected $minX;
    protected $minY;
    protected $keywords;
    protected $maxX;
    protected $maxY;

    /**
     * @return mixed
     */
    public function getMaxX()
    {
        return $this->maxX;
    }

    /**
     * @return mixed
     */
    public function getMaxY()
    {
        return $this->maxY;
    }

    /**
     * @return mixed
     */
    public function getKeywords()
    {
        return $this->keywords;
    }

    /**
     * @return mixed
     */
    public function getMinY()
    {
        return $this->minY;
    }

    /**
     * @return mixed
     */
    public function getMinX()
    {
        return $this->minX;
    }

    /**
     * @param $data
     */
    protected function setOws_WGS84BoundingBox($data)
    {
        foreach ($data as $k => $value) {
            if ($k == "ows_LowerCorner") {
                list($this->minX, $this->minY) = explode(' ', $data["ows_LowerCorner"]);
            }
            if ($k == "ows_UpperCorner") {
                list($this->maxX, $this->maxY) = explode(' ', $data["ows_UpperCorner"]);
            }
        }
    }

    /**
     * @param $data
     */
    protected function setOws_Keywords($data)
    {
        $this->keywords = $data["ows_Keyword"];
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @return mixed
     */
    public function getAbstract()
    {
        return $this->abstract;
    }

    /**
     * @param mixed $abstract
     */
    public function setAbstract($abstract)
    {
        $this->abstract = $abstract;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return string
     */
    public function getDefaultCRS()
    {
        return $this->defaultCRS;
    }

    /**
     * @param string $defaultCRS
     */
    public function setDefaultCRS($defaultCRS)
    {
        $this->defaultCRS = $defaultCRS;
    }

    /**
     * @return string
     */
    public function getSRID()
    {
        static $srid;

        if (!$srid) {
            $parts = explode(':', $this->defaultCRS);
            $srid  = end($parts);
        }

        return $srid;
    }

    /**
     * @return string Type name
     */
    public function __toString()
    {
        return $this->getName();
    }

}