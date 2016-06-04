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

    /** @var Envelope */
    protected $boundedBy;

    /**
     * @param array $type
     * @param array $data
     */
    public function __construct($type, array $data, $saveOriginalData = false)
    {
        $this->type = $type;
        $this->data = $data;
        $specs      = array();

        if (isset($data["@attributes"])) {
            $specs = $data["@attributes"];
            unset($data["@attributes"]);
        }

        foreach ($data as $key => $item) {
            if (strpos($key, "gml_") === 0) {
                $specs[ $key ] = $item;
                unset($data[ $key ]);
            }
        }

        parent::__construct($specs, $saveOriginalData);
    }


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
}