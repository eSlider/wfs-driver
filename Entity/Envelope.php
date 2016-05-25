<?php
namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Envelope
 *
 * @package Wheregroup\WFS\Entity
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Envelope extends BaseEntity
{
    protected $srsName;
    protected $lowerCorner;
    protected $upperCorner;

    /**
     * @return mixed
     */
    public function getMaxX()
    {
        return current(explode(' ', $this->upperCorner));
    }

    /**
     * @return mixed
     */
    public function getMaxY()
    {
        return end(explode(' ', $this->upperCorner));
    }

    /**
     * @return mixed
     */
    public function getMinY()
    {
        return end(explode(' ', $this->lowerCorner));
    }

    /**
     * @return mixed
     */
    public function getMinX()
    {
        return current(explode(' ', $this->lowerCorner));
    }

    /**
     * @return string
     */
    public function getSRID()
    {
        static $srid;

        if (!$srid) {
            $parts = explode(':', $this->srsName);
            $srid  = end($parts);
        }

        return $srid;
    }
}