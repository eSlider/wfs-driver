<?php

namespace Wheregroup\WFS\Entity;

use Wheregroup\XML\Entity\BaseEntity;

/**
 * Class Member
 *
 * @author  Andriy Oblivantsev <eslider@gmail.com>
 */
class Member extends BaseEntity
{
    protected $id;
    protected $data;
    protected $type;
    protected $directedNode;
    protected $name;

    /** @var \Wheregroup\WFS\Entity\Geometry */
    protected $wkbGeom;

    /** @var Envelope */
    protected $boundedBy;

    protected $tileId;

    protected $gml_id;


    /**
     * @param mixed $boundedBy
     */
    public function setBoundedBy($boundedBy)
    {
        $envelopeData    = current(array_values($boundedBy));
        $this->boundedBy = new Envelope($envelopeData);
    }

    /**
     * Get member type name
     *
     * @return string
     */
    public function getTypeName()
    {
        return $this->type;
    }

    /**
     * Get member ID
     *
     * @return string
     */
    public function getId()
    {
        return end(explode('.', $this->id));
    }

    /**
     * @return Envelope
     */
    public function getBoundedBy()
    {
        return $this->boundedBy;
    }

    /**
     * @return int SRID
     */
    public function getSRID()
    {
        return $this->getBoundedBy()->getSRID();
    }

    /**
     * @return Geometry
     */
    public function getGeometry()
    {
        return $this->wkbGeom;
    }
}